<?php

namespace App\View\Components\Frontend\Slide;

use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\Component;

class ThreeItemNewsSlideRightSideText extends Component
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
                    'title' => StringHelper::title($item->title),
                    'description' => StringHelper::shortDescription($item->description),
                    'slug' => $item->slug ?? '',
                    'category' => $item->category()->inRandomOrder()->first(),
                    'image' => ImageHelper::generateImage($item->image_src,'medium'),
                    'date' => Carbon::parse($item->created_at)->format('d F Y'),
                    'viewCount' => $item->view_count ?? 0,
                    'commentCount' => $item->comment_count ?? 0,
                    'author_id' => $item->user->email,
                    'author' => $item->user ? $item->user->name : '',
                    'author_image' => ImageHelper::generateImage($item->user->profile->image, 'main'),
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
        return view('components.frontend.slide.three-item-news-slide-right-side-text')->with('data', $this->data);
    }
}
