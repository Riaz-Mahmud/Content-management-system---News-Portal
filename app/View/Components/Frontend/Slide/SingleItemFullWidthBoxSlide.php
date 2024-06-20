<?php

namespace App\View\Components\Frontend\Slide;

use App\Models\Category;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\Component;

class SingleItemFullWidthBoxSlide extends Component
{
    protected $data = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($slug, $limit){
        $this->data['slideNewsItems'] = [];
        if($slug != '' && $limit > 0){
            $category = Category::where('slug', $slug)->where('is_deleted', 0)->where('status', 'Active')->first();
            if ($category) {
                $newses =  $category->news()->where('is_deleted',0)->where('status','Active')->orderBy('id','desc')->limit($limit)->get();
                foreach ($newses as $news) {
                    $this->data['slideNewsItems'][] = [
                        'title' => StringHelper::title($news->title),
                        'slug' => $news->slug ?? '',
                        'category' => $category,
                        'image' => ImageHelper::generateImage($news->image_src, 'large'),
                        'date' => Carbon::parse($news->created_at)->format('d F Y'),
                        'viewCount' => $news->view_count ?? 0,
                        'commentCount' => $news->comment_count ?? 0,
                        'author_id' => $news->user->email,
                        'author' => $news->user ? $news->user->name : '',
                        'author_image' => ImageHelper::generateImage($news->user->profile->image),
                    ];
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){

        return view('components.frontend.slide.single-item-full-width-box-slide')->with('data', $this->data);
    }
}
