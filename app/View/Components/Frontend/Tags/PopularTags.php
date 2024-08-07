<?php

namespace App\View\Components\Frontend\Tags;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Crypt;

class PopularTags extends Component
{
    protected $data = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($code){
        $this->data['items'] = [];

        if(count($code) > 0){
            foreach($code as $item){
                $this->data['items'][] = [
                    'id' => $item->id,
                    'hashId' => Crypt::encrypt($item->id),
                    'label' => $item->label,
                    'slug' => 'tag/'.$item->label,
                    'count' => $item->count,
                ];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.tags.popular-tags')->with('data', $this->data);
    }
}
