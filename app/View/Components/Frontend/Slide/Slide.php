<?php

namespace App\View\Components\Frontend\Slide;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\View\Component;
use App\Helpers\ImageHelper;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Crypt;

class Slide extends Component
{
    protected $data = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($code){
        $this->data['slideItems'] = [];
        if(count($code) == 0 ){
            $this->data['slideItems'] = [];
        }else{
            foreach($code as $item){
                if($item->newses_id){
                    $news = News::where('id',$item->newses_id)->where('is_deleted', 0)->where('status', 'Active')->first();
                    if($news != null){
                        $this->data['slideItems'][] = [
                            'is_news' => true,
                            'title' => StringHelper::title($news->title),
                            'slug' => $news->slug,
                            'category' => $news->categories()->inRandomOrder()->first() ?? '',
                            'description' => StringHelper::shortDescription($news->description ?? ''),
                            'image' => ImageHelper::generateImage($news->image_src),
                            'thumbnail' => ImageHelper::generateImage($news->image_src, 'thumbnail'),
                            'date' => Carbon::parse($news->created_at)->format('d M Y'),
                            'author_id' => $news->user->email,
                            'author' => $news->user ? $news->user->name : '',
                            'author_image' => ImageHelper::generateImage($news->user->profile->image, 'main'),
                        ];
                    }
                }else{
                    $this->data['slideItems'][] = [
                        'is_slide' => true,
                        'title' => StringHelper::title($item->label),
                        'description' => StringHelper::shortDescription($item->description ?? ''),
                        'image' => ImageHelper::generateImage($item->src),
                        'thumbnail' => ImageHelper::generateImage($item->src, 'thumbnail'),
                        'date' => Carbon::parse($item->created_at)->format('d M Y'),
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

        return view('components.frontend.slide.slide')->with(['data' => $this->data]);
    }
}
