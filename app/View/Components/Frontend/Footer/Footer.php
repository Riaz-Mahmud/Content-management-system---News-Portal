<?php

namespace App\View\Components\Frontend\Footer;

use Illuminate\View\Component;

class Footer extends Component
{
    protected $data = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $pages){
        $this->data['categories'] = [];
        $this->data['pages'] = [];

        if(count($categories) > 0){
            foreach($categories as $category){
                $this->data['categories'][] = [
                    'title' => $category->title,
                    'slug' => $category->slug
                ];
            }
        }
        if(count($pages) > 0){
            foreach($pages as $page){
                $this->data['pages'][] = [
                    'title' => $page->title,
                    'slug' => $page->slug
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
        return view('components.frontend.footer.footer')->with('data', $this->data);
    }
}
