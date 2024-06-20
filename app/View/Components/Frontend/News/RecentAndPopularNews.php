<?php

namespace App\View\Components\Frontend\News;

use Illuminate\View\Component;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use Carbon\Carbon;

class RecentAndPopularNews extends Component
{
    protected $data = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($popularNewses , $recentNewses){
        $this->data['popularNewses'] = [];
        $this->data['recentNewses'] = [];
        if(count($popularNewses) > 0){
            foreach($popularNewses as $popular){
                $this->data['popularNewses'][] = [
                    'title' => StringHelper::title($popular->title),
                    'description' => StringHelper::shortDescription($popular->description),
                    'slug' => $popular->slug ?? '',
                    'category' => $popular->category()->inRandomOrder()->first(),
                    'image' => ImageHelper::generateImage($popular->image_src, 'medium'),
                    'date' => Carbon::parse($popular->created_at)->format('d F Y'),
                    'viewCount' => $popular->view_count ?? 0,
                    'commentCount' => $popular->comment_count ?? 0,
                ];
            }
        }

        if(count($recentNewses) > 0){
            foreach($recentNewses as $recent){
                $this->data['recentNewses'][] = [
                    'title' => StringHelper::title($recent->title),
                    'description' => StringHelper::shortDescription($recent->description),
                    'slug' => $recent->slug ?? '',
                    'category' => $recent->category()->inRandomOrder()->first(),
                    'image' => ImageHelper::generateImage($recent->image_src, 'thumbnail'),
                    'date' => Carbon::parse($recent->created_at)->format('d F Y'),
                    'viewCount' => $recent->view_count ?? 0,
                    'commentCount' => $recent->comment_count ?? 0,
                ];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){

        return view('components.frontend.news.recent-and-popular-news')->with('data', $this->data);

    }
}
