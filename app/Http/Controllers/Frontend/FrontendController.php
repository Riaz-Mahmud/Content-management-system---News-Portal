<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\Menu;
use App\Models\News;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ActivityLogJob;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class FrontendController extends Controller{

    protected function defaultData(){
        $data = array();

        $data['menu'] = Menu::where('is_deleted',0)->where('status','Active')->where('label','Main Menu')->first();
        $data['hotNewses'] = News::where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->limit(5)->get();
        $data['categories'] = Category::where('is_deleted', 0)->where('status', 'Active')->latest()->take(5)->get();
        $data['tags'] = Tag::where('is_deleted', 0)->where('status', 'Active')->orderBy('count', 'desc')->get();
        $data['pages'] = Page::where('is_deleted', 0)->orderBy('id', 'desc')->get();

        return $data;
    }

    protected function log(Request $request, $msg = null){

        try{
            $log = [
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'description' => $msg ?? null,
                'url' => $request->getRequestUri() ?? null,
                'method' => $request->method() ?? null,
                'route' => Route::currentRouteName() ?? null,
                'ip' => $request->ip() ?? null,
                'agent' => $request->userAgent() ?? null,
                //'device_data' => new Agent(),
            ];

            // ActivityLogJob::dispatch($log);

        }catch(\Exception $e){
            Log::info('Activity Log Error: ' . $e->getMessage());
        }
    }

}
