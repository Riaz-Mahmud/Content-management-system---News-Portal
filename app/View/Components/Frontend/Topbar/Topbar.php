<?php

namespace App\View\Components\Frontend\Topbar;

use Illuminate\View\Component;

class Topbar extends Component
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
                    'title' => $item->title,
                    'slug' => $item->slug,
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
        return view('components.frontend.topbar.topbar')->with('data', $this->data);
    }
}
