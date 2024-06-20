<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\PollItem;
use Jenssegers\Agent\Agent;
use App\Jobs\ActivityLogJob;
use App\Models\PollResponse;
use Illuminate\Http\Request;
use App\Models\Poll as PollModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class Poll extends Component{

    public $data = [];

    public function reponseSubmit(Request $request, $pollId, $pollItemId){
        $pollId = Crypt::decrypt($pollId);
        $pollItemId = Crypt::decrypt($pollItemId);

        $pollFind = PollModel::where('id', $pollId)->first();
        $pollItemFind = PollItem::where('id', $pollItemId)->first();
        if($pollFind != null && $pollItemFind != null){
            if(Auth::check()){

                $checkResponse = PollResponse::where('poll_id', $pollId)
                    ->where('user_id', Auth::user()->id)->first();

                if($checkResponse == null){

                    $pollResponse = new PollResponse();
                    $pollResponse->poll_id = $pollId;
                    $pollResponse->poll_item_id = $pollItemId;
                    $pollResponse->user_id = Auth::user()->id;
                    $pollResponse->save();

                    $response=['date'=>Carbon::now()->format('Y-m-d'),'value'=> $pollItemId];
                    Cookie::queue('poll_response', json_encode($response), time() + 60*24*7);
                    // Cookie::queue('poll_response', date('Y-m-d'), time() + 60*24*7);

                    $this->log($request, 'Poll response submitted successfully');
                }
            }else{

                $cookie = $request->cookie('poll_response');
                if($cookie == null && $cookie != date('Y-m-d')){

                    $pollResponse = new PollResponse();
                    $pollResponse->poll_id = $pollId;
                    $pollResponse->poll_item_id = $pollItemId;
                    $pollResponse->ip_address = $request->ip();
                    $pollResponse->save();

                    $response=['date'=>Carbon::now()->format('Y-m-d'),'value'=> $pollItemId];
                    Cookie::queue('poll_response', json_encode($response), time() + 60*24*7);
                    // Cookie::queue('poll_response', date('Y-m-d'), time() + 60*24*7);

                    $this->log($request, 'Poll response submitted successfully');
                }
            }
        }
        $polls = PollModel::where('is_deleted', 0)->where('status', 'Active')->whereDate('created_at', '=', Carbon::now())->orderBy('id', 'desc')->first();
        $this->calculatePercentage($request, $polls);
    }

    private function calculatePercentage($request, $polls){
        $this->data = [];
        if($polls != null){
            $this->data['id'] = $polls->id;
            $this->data['hashId'] = Crypt::encrypt($polls->id);
            $this->data['question'] = $polls->question;
            if(Auth::check()){
                $this->data['userPollResponse'] = $polls->pollResponses()->where('user_id', Auth::user()->id)->where('is_deleted', 0)->where('status', 'Active')->first();
            }else{
                $guestUserResponse = $polls->pollResponses()->where('ip_address', $request->ip())->where('is_deleted', 0)->where('status', 'Active')->first();
                if($guestUserResponse != null){
                    $cookie = $request->cookie('poll_response');
                    $cookie = json_decode($cookie);
                    if($cookie != null && $cookie->date == $guestUserResponse->created_at->format('Y-m-d')){

                        $this->data['userPollResponse'] = $guestUserResponse;

                    }else{
                        $this->data['userPollResponse'] = null;
                    }
                }
            }

            $pollResponse = PollResponse::where('poll_id', $polls->id)->where('is_deleted', 0)->count();

            $response = PollResponse::select('poll_responses.poll_item_id', DB::raw('count(*) as total'))
                        ->where('poll_responses.poll_id', $polls->id)
                        ->where('poll_responses.is_deleted', 0)
                        ->groupBy('poll_responses.poll_item_id')
                        ->get();

            $pollItems = PollItem::where('poll_id',$polls->id)->where('is_deleted', 0)->get();

            foreach($response as $value){
                foreach($pollItems as $item){
                    if($item->id == $value->poll_item_id){
                        $item->total = $value->total;
                        $item->percentage = round(($value->total / $pollResponse) * 100);
                    }
                }
            }

            foreach($pollItems as $item){
                $this->data['items'][] = [
                    'id' => $item->id,
                    'hashId' => Crypt::encrypt($item->id),
                    'option' => $item->option,
                    'order' => $item->order,
                    'total' => $item->total ?? 0,
                    'percentage' => $item->percentage ?? 0,
                ];
            }
        }
    }

    public function mount(Request $request){
        $polls = PollModel::where('is_deleted', 0)->where('status', 'Active')->whereDate('created_at', '=', Carbon::now())->orderBy('id', 'desc')->first();
        $this->calculatePercentage($request, $polls);
    }

    public function render(){

        return view('livewire.poll');

    }

    public function log(Request $request, $msg = null){
        try{
            $log = [
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'description' => $msg ?? null,
                'url' => $request->getRequestUri() ?? null,
                'method' => $request->method() ?? null,
                'route' => Route::currentRouteName() ?? null,
                'ip' => $request->ip() ?? null,
                'agent' => $request->userAgent() ?? null,
                //'device_data' => new Agent(),
            ];

            //ActivityLogJob::dispatch($log);

        }catch(\Exception $e){
            Log::info('Activity Log Error: ' . $e->getMessage());
        }
    }
}
