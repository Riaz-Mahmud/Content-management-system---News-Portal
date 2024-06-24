<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Models\News;
use App\Models\Category;
use App\Models\Poll;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class HomeController extends FrontendController{

    protected $defaultData = [];

    function __construct(){
        $this->defaultData = parent::defaultData();

    }

    function index(Request $request){

        $data = array();

        $data = $this->defaultData;

        $data['slideItems'] = [];
        $slider = Slider::where('label', 'Home Page Slider')->where('is_deleted', 0)->where('status', 'Active')->first();
        if($slider != null){
            $data['slideItems'] = SliderItem::where('slider_id', $slider->id)->where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->get();
        }

        $data['starCategories'] = Category::where('status','active')->where('is_deleted', 0)->where('status', 'Active')->where('star', 1)->limit(4)->get();
        $data['popularNewses'] = News::where('status','active')->where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
        $data['recentNewses'] = News::where('status','active')->where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

        // Market and Politics
        $data['MarketPoliticsNewses'] = News::where('status','active')->where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(7)->get();

        $data['featuredVideos'] = News::where('status','active')->where('is_deleted', 0)->where('status', 'Active')->where('attachment_type', 'video')->orderBy('id', 'desc')->limit(5)->get();
        $data['popularVideos'] = News::where('status','active')->where('is_deleted', 0)->where('attachment_type', 'video')->orderBy('view_count', 'desc')->limit(4)->get();

        $data['singleNewsWithLeftSideSlide'] = News::where('status','active')->where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(10)->get();
        $data['threeItemNewsSlideRightSideText'] = News::where('status','active')->where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(10)->get();

        return view('frontend.home.index')->with(['data' => $data]);

    }

    function newsDetails(){
        return view('frontend.partials.pages.news-details');
    }
    function blogDetails(){
        return view('frontend.partials.pages.blog-details');
    }
    function editorialDetails(){
        return view('frontend.partials.pages.editorial-details');
    }

}
