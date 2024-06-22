<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;

use App\Models\User;
use App\Models\Profile;
use App\Models\Session;
use App\Helpers\Helpers;
use Jenssegers\Agent\Agent;
use App\Jobs\ActivityLogJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BackendController
{

    function index(Request $request){

        $data = [];
        $data['users'] = [
            'total' => User::count(),
            'active' => Profile::where('status','Active')->where('is_deleted',0)->count(),
            'inactive' => Profile::where('status','Inactive')->where('is_deleted',0)->count(),
            'pending' => Profile::where('status','Pending')->where('is_deleted',0)->count(),
            'deleted' => Profile::where('is_deleted',1)->count(),
        ];
        $news = News::all();
        $data['news'] = [
            'total' => $news->count(),
            'active' => $news->where('status','Active')->where('is_deleted',0)->count(),
            'inactive' => $news->where('status','Inactive')->where('is_deleted',0)->count(),
            'pending' => $news->where('status','Pending')->where('is_deleted',0)->count(),
            'deleted' => $news->where('is_deleted',1)->count(),
        ];

        $data['topTags'] = \Facades\App\Services\DashboardService::getTopTags();
        $data['topCategories'] = \Facades\App\Services\DashboardService::getTopCategories();
        $data['latestNews'] = \Facades\App\Services\DashboardService::getLatestNews();
        $data['latestComments'] = \Facades\App\Services\DashboardService::getLatestComments();

        $data['newVisitors'] = \Facades\App\Services\DashboardService::getNewVisitors();

        $data['active_data'] = \Facades\App\Services\DashboardService::getActiveNow();

        $data['countries'] = \Facades\App\Services\DashboardService::getVisitedCountryList();

        parent::log($request , 'View Dashboard');

        return view('backend.pages.home.index')->with('data', $data);
    }
}
