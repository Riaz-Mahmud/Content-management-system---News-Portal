<?php

namespace App\Http\Controllers\Backend\Poll;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Poll\PollRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\Poll;
use App\Models\PollItem;
use App\Models\PollResponse;
use Illuminate\Support\Facades\DB;

class PollController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.poll.index')->only(['index']);
        $this->middleware('permission:admin.poll.create')->only(['create', 'store']);
        $this->middleware('permission:admin.poll.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.poll.delete')->only(['delete']);
        $this->middleware('permission:admin.poll.result.index')->only(['result']);
        $this->middleware('permission:admin.poll.result.delete')->only(['responseDelete']);
    }

    function index(Request $request){
        $data = [];
        $data['rose'] = Poll::orderBy('id', 'DESC')->where('is_deleted', 0)->with('items')->paginate(30);

        parent::log($request , 'Visited admin poll list');

        return view('backend.pages.poll.index')->with('data', $data);
    }

    function create(Request $request){

        parent::log($request , 'Visited admin poll create page');

        return view('backend.pages.poll.create');
    }

    function store(PollRequest $request){
        $request->validated();

        $poll = new Poll();
        $poll->question = $request->question;
        $poll->description = $request->description;
        $poll->status = $request->status;
        $save = $poll->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Created a new poll. Poll Name: ' . $request->question);

        Session::flash('success', 'Poll has been created successfully!');
        return redirect()->route('admin.poll.index');
    }

    function edit(Request $request, $id){
        $data = array();

        $data['rose'] = Poll::find(Crypt::decrypt($id));

        parent::log($request , 'Visited admin poll edit page. Poll Name: ' . $data['rose']->question);

        return view('backend.pages.poll.edit')->with('data', $data);
    }

    function update(PollRequest $request, $id){

        $request->validated();

        $poll = Poll::find(Crypt::decrypt($id));
        $poll->question = $request->question;
        $poll->description = $request->description;
        $poll->status = $request->status;
        $save = $poll->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Updated a poll. Poll Name: ' . $request->question . ' Poll ID: ' . $poll->id);

        Session::flash('success', 'Poll has been updated successfully!');
        return redirect()->route('admin.poll.index');
    }

    function delete(Request $request, $id){
        $poll = Poll::find(Crypt::decrypt($id));

        if($poll == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $poll->is_deleted = 1;
        $save = $poll->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Deleted a poll. Poll Name: ' . $poll->question . ' Poll ID: ' . $poll->id);

        Session::flash('success', 'Poll has been deleted successfully!');
        return redirect()->route('admin.poll.index');
    }

    function result(Request $request, $id){
        $data = array();

        $data['rose'] = PollResponse::where('poll_id', Crypt::decrypt($id))->with('pollItem')->with('user')->where('is_deleted', 0)->paginate(30);

        $response = PollResponse::select('poll_responses.poll_item_id', DB::raw('count(*) as total'))
                    ->where('poll_responses.poll_id', Crypt::decrypt($id))
                    ->where('poll_responses.is_deleted', 0)
                    ->groupBy('poll_responses.poll_item_id')
                    ->get();

        $pollItems = PollItem::where('poll_id', Crypt::decrypt($id))->where('is_deleted', 0)->get();

        //percentage calculation
        foreach($response as $value){
            foreach($pollItems as $item){
                if($item->id == $value->poll_item_id){
                    $item->total = $value->total;
                    $item->percentage = round(($value->total / $data['rose']->total()) * 100);
                }
            }
        }
        // dd($pollItems);

        $data['poll'] = Poll::find(Crypt::decrypt($id));

        $data['poll_items'] = $pollItems;

        parent::log($request , 'Visited admin poll result page. Poll Name: ' . $data['poll']->question);

        return view('backend.pages.poll.result')->with('data', $data);
    }

    function responseDelete(Request $request, $id){
        $poll = PollResponse::find(Crypt::decrypt($id));

        if($poll == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $poll->is_deleted = 1;
        $save = $poll->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Deleted a poll response. Poll Name: ' . $poll->poll->question . ' Poll ID: ' . $poll->poll_id);

        Session::flash('success', 'Poll has been deleted successfully!');
        return redirect()->route('admin.poll.result', Crypt::encrypt($poll->poll_id));
    }
}
