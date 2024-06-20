<?php

namespace App\View\Components\Frontend\Slide;

use App\Models\Category;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class FeaturedVideoSlide extends Component
{
    protected $data = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($code){

        $this->data['videoItems'] = [];
        if(count($code) > 0){
            foreach ($code as $item) {
                $this->data['videoItems'][] = [
                    'title' => StringHelper::title($item->title),
                    'slug' => $item->slug ?? '',
                    'category' => $item->category()->inRandomOrder()->first(),
                    'image' => ImageHelper::generateImage($item->image_src, 'large'),
                    'video' => asset(Storage::url($item->attachment_src ?? '')),
                    'date' => Carbon::parse($item->created_at)->format('d M Y'),
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
        return view('components.frontend.slide.featured-video-slide')->with('data', $this->data);
    }
}
