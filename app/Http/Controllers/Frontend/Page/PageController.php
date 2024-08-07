<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends FrontendController{

    protected $defaultData = [];

    function __construct(){
        $this->defaultData = parent::defaultData();
    }

    function index(Request $request, $slug){
        $slug = 'pages/'.$slug;
        $data = array();
        $data = $this->defaultData;

        $data['rows'] = Page::where('slug', $slug)->first();

        parent::log($request, 'View Page: '.$data['rows']->title);

        return view('frontend.partials.pages.page.index')->with('data', $data);
    }
}
