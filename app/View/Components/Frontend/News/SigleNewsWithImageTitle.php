<?php

namespace App\View\Components\Frontend\News;

use Illuminate\View\Component;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class SigleNewsWithImageTitle extends Component
{
    protected $data = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($news){
        if($news){
            $this->data['news'] = [
                'title' => StringHelper::title($news->title),
                'description' => StringHelper::shortDescription($news->description),
                'slug' => $news->slug ?? '',
                'category' => $news->category()->inRandomOrder()->first(),
                'image' => ImageHelper::generateImage($news->image_src, 'medium'),
                'date' => Carbon::parse($news->created_at)->format('d F Y'),
                'viewCount' => $news->view_count ?? 0,
                'commentCount' => $news->comment_count ?? 0,
                'author_id' => $news->user->email,
                'author' => $news->user ? $news->user->name : '',
                'author_image' => ImageHelper::generateImage($news->user->profile->image, 'main'),
            ];

        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.news.sigle-news-with-image-title')->with('data', $this->data);
    }
}
