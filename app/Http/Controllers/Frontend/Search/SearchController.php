<?php

namespace App\Http\Controllers\Frontend\Search;

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Tag;

class SearchController extends FrontendController
{
    protected $defaultData = [];

    function __construct(){
        $this->defaultData = parent::defaultData();
    }

    function search(Request $request){
        $data = array();
        $data = $this->defaultData;

        $search = $request->q;
        $data['search'] = $search;

        $data['rows'] = News::where('is_deleted', 0)
            ->where('status', 'Active')
            ->where( function($query) use ($search){
                $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        $data['fixedCategory'] = null;

        $data['allCategory'] = Category::where('star',1)->where('status', 'Active')->where('is_deleted', 0)->get();
        foreach($data['allCategory'] as $category){
            $category['count'] = $category->activeNewsCount();
        }

        $data['rose']['tags'] = Tag::orderBy('count','Desc')->where('status', 'Active')->where('is_deleted', 0)->limit(10)->get();
        $data['popularNewses'] = News::where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
        $data['recentNewses'] = News::where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

        parent::log($request, 'Search Neww by keyword: '.$search);

        return view('frontend.partials.pages.search.index')->with('data', $data);

    }

}
