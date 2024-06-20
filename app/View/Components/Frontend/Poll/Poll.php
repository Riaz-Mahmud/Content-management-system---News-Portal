<?php

namespace App\View\Components\Frontend\Poll;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Backend\Poll\PollController;

class Poll extends Component
{
    protected $data = array();
    protected $poll;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($code){
        $this->data['items'] = [];
        $this->poll = [];

        if($code){
            $pollData = \Facades\App\Http\Controllers\Backend\Poll\PollController::result(Crypt::encrypt($code['id']));
            $items = $pollData->data['poll_items'];
            foreach($items as $item){
                $this->data['items'][] = [
                    'id' => $item->id,
                    'hashId' => Crypt::encrypt($item->id),
                    'option' => $item->option,
                    'order' => $item->order,
                    'total' => $item->total ?? 0,
                    'percentage' => $item->percentage ?? 0,
                ];
            }

            $this->poll = [
                'id' => $pollData->data['poll']->id,
                'hashId' => Crypt::encrypt($pollData->data['poll']->id),
                'question' => $pollData->data['poll']->question,
                'description' => $pollData->data['poll']->description,
            ];

            $this->poll['items'] = $this->data['items'];
            $this->poll['userPollResponse'] = $code['userPollResponse'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){
        return view('components.frontend.poll.poll')->with('data', $this->poll);
    }
}
