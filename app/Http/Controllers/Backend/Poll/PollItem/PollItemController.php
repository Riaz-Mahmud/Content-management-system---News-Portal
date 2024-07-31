<?php

namespace App\Http\Controllers\Backend\Poll\PollItem;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Poll\PollItem\PollItemRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\Poll;
use App\Models\PollItem;

class PollItemController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.poll.item.index')->only(['index']);
        $this->middleware('permission:admin.poll.item.create')->only(['create', 'store']);
        $this->middleware('permission:admin.poll.item.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.poll.item.delete')->only(['delete']);
    }

    function index(Request $request, $id){
        $data = array();
        $id = Crypt::decrypt($id);
        $data['poll'] = Poll::where('id', $id)->where('is_deleted', 0)->first();
        $data['rose'] = PollItem::where('poll_id', $id)->where('is_deleted', 0)->orderBy('order', 'ASC')->get();

        parent::log($request , 'Visited admin poll item list');

        return view('backend.pages.poll.poll_item.index')->with('data', $data);
    }

    public function create(Request $request, $id){
        $data = array();
        $data['rose'] = Poll::where('id',Crypt::decrypt($id))->where('is_deleted', 0)->first();

        parent::log($request , 'Visited admin poll item create page');

        return view('backend.pages.poll.poll_item.create')->with('data', $data);
    }

    function store(PollItemRequest $request, $id){

        $request->validated();

        // check poll available
        $poll = Poll::where('id',Crypt::decrypt($id))->where('is_deleted', 0)->first();
        if(!$poll){
            Session::flash('error', 'Poll not found');
            return redirect()->back();
        }

        $pollItem = new PollItem();
        $pollItem->poll_id = Crypt::decrypt($id);
        $pollItem->option = $request->option;
        $pollItem->order = $request->position;
        $pollItem->status = $request->status;
        $save = $pollItem->save();

        if($save == null){
            Session::flash('error', 'Poll Item could not be added!');
            return redirect()->back();
        }

        parent::log($request , 'Created a new poll item. Poll Item Name: ' . $request->option);

        Session::flash('success', 'Poll Item Created Successfully');
        return redirect()->route('admin.poll.item.index', $id);
    }

    public function edit(Request $request, $id){
        $data = array();
        $pollItem = PollItem::where('id',Crypt::decrypt($id))->where('is_deleted', 0)->first();

        if(!$pollItem){
            Session::flash('error', 'Poll Item not found');
            return redirect()->back();
        }

        $data['rose'] = $pollItem;

        parent::log($request , 'Visited admin poll item edit page for poll item: ' . $pollItem->option);

        return view('backend.pages.poll.poll_item.edit')->with('data', $data);
    }

    public function update(PollItemRequest $request, $id){

        $request->validated();

        $pollItem = PollItem::find(Crypt::decrypt($id));

        if(!$pollItem){
            Session::flash('error', 'Poll Item not found');
            return redirect()->back();
        }

        $pollItem->option = $request->option;
        $pollItem->order = $request->position;
        $pollItem->status = $request->status;
        $update = $pollItem->save();

        if($update == null){
            Session::flash('error', 'Poll Item could not be updated!');
            return redirect()->back();
        }

        parent::log($request , 'Updated poll item. Poll Item Name: ' . $request->option);

        Session::flash('success', 'Poll Item Updated Successfully');
        return redirect()->route('admin.poll.item.index', Crypt::encrypt($pollItem->poll_id));
    }

    public function delete(Request $request, $id){

        // check the item is  available
        $item = PollItem::find(Crypt::decrypt($id));

        if(!$item){
            Session::flash('error', 'Poll Item not found');
            return redirect()->back();
        }
        $item->is_deleted = 1;
        $delete = $item->save();

        if($delete == null){
            Session::flash('error', 'Poll Item could not be deleted!');
            return redirect()->back();
        }

        parent::log($request , 'Deleted poll item. Poll Item Name: ' . $item->option);

        Session::flash('success', 'Poll Item Deleted Successfully');
        return redirect()->route('admin.poll.item.index', Crypt::encrypt($item->poll_id));
    }
}
