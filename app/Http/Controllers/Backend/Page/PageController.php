<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\Backend\Page\PageRequest;
use App\Models\Page;

class PageController extends BackendController{

    public function __construct(){
        $this->middleware('permission:admin.page.index')->only(['index']);
        $this->middleware('permission:admin.page.create')->only(['create', 'store']);
        $this->middleware('permission:admin.page.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.page.delete')->only(['delete']);
    }

    function index(Request $request){

        $data = [];
        $data['rows'] = Page::orderBy('id', 'DESC')->where('is_deleted', 0)->paginate(20);

        foreach($data['rows'] as $row){
            $row->hashid = Crypt::encrypt($row->id);
        }

        parent::log($request , 'Visited admin page list');

        return view('backend.pages.page.index')->with('data', $data);
    }

    function create(Request $request){
        $data = [];

        // check news folder available or not. if not then create
        if (!is_dir(storage_path("app/public/assets/pages"))) {
            mkdir(storage_path("app/public/assets/pages"), 0775, true);
        }

        // if session has not old folder_uuid then create new one
        if(!Session::has('folder_uuid')){
            $request->session()->put('folder_uuid', uniqid().date('YmdHis'));

            //create folder with folder_uuid. this folder will be used for upload images
            if (!is_dir(storage_path("app/public/assets/pages/".Session::get('folder_uuid')))) {
                mkdir(storage_path("app/public/assets/pages/".Session::get('folder_uuid')), 0775, true);
            }
        }else{
            if (!is_dir(storage_path("app/public/assets/pages/".Session::get('folder_uuid')))) {
                mkdir(storage_path("app/public/assets/pages/".Session::get('folder_uuid')), 0775, true);
            }
        }

        $data['type'] = 'pages';
        $data['folder_uuid'] = Session::get('folder_uuid');

        parent::log($request , 'Visited admin page create page');

        return view('backend.pages.page.create')->with('data', $data);
    }

    function store(PageRequest $request){

        $request->validated();

        // chekc if slug is available or not
        $slug = 'pages/'.Str::slug(trim($request->title), '-');
        if(count(Page::where('slug', $slug)->where('is_deleted', 0)->get()) > 0){
            $slug = $slug.'-'.date('YmdHis');
        }

        $page = new Page;
        $page->title = trim($request->title);
        $page->slug = $slug;
        $page->description = $request->description;
        $page->content = $request->myeditorinstance;
        $page->status = $request->status;
        $save = $page->save();

        if($save == null){
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

        if (!is_dir(storage_path("app/public/assets/pages/".Session::get('folder_uuid')))) {
            mkdir(storage_path("app/public/assets/pages/".Session::get('folder_uuid')), 0775, true);
        }

        if(rename(storage_path("app/public/assets/pages/".Session::get('folder_uuid')), storage_path("app/public/assets/pages/".$page->id))){

            $replacedContent = str_replace(Session::get('folder_uuid'), $page->id, $page->content);

            $replacebles = ["http://".$_SERVER['HTTP_HOST'],"http://www.".$_SERVER['HTTP_HOST'],"https://".$_SERVER['HTTP_HOST'],"https://www.".$_SERVER['HTTP_HOST']];

            foreach($replacebles as $replace){
                $replacedContent = str_replace($replace, "", $replacedContent);
            }

            $page->content = $replacedContent;
            $page->save();

            // remove session
            $request->session()->forget('folder_uuid');

        }else {
            // remove session
            $request->session()->forget('folder_uuid');

            Session::flash('error', 'Something went wrong!');
            return redirect()->route('admin.page.index');
        }

        parent::log($request , 'Created new page. Title: '.$request->title);

        return redirect()->route('admin.page.index');
    }

    function edit(Request $request, $id){

        $data = [];
        $data['rows'] = Page::find(Crypt::decrypt($id));
        $data['rows']->hashid = Crypt::encrypt($data['rows']->id);

        if($data['rows'] == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->route('admin.page.index');
        }

        $data['type'] = 'pages';
        if (!is_dir(storage_path("app/public/assets/pages/".$data['rows']->id))) {
            mkdir(storage_path("app/public/assets/pages/".$data['rows']->id), 0775, true);
        }
        $data['folder_uuid'] = $data['rows']->id;

        parent::log($request , 'Visited admin page edit page. Title: '.$data['rows']->title);

        return view('backend.pages.page.edit')->with('data', $data);
    }

    function update(PageRequest $request, $id){

        $request->validated();

        $page = Page::find(Crypt::decrypt($id));

        if($page == null){
            Session::flash('error', 'News not found!');
            return redirect()->back();
        }

        // chekc if slug is available or not
        $slug = 'pages/'.Str::slug(trim($request->title), '-');
        if(count(Page::where('slug', $slug)->where('is_deleted', 0)->where('id', '!=', $page->id)->get()) > 0){
            $slug = $slug.'-'.date('YmdHis');
        }

        $page->title = trim($request->title);
        $page->slug = $slug;
        $page->description = $request->description;
        $page->content = $request->myeditorinstance;
        $page->status = $request->status;
        $save = $page->save();

        if($save == null){
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

        $replacedContent = $page->content;

        $replacebles = ["http://".$_SERVER['HTTP_HOST'],"http://www.".$_SERVER['HTTP_HOST'],"https://".$_SERVER['HTTP_HOST'],"https://www.".$_SERVER['HTTP_HOST']];

        foreach($replacebles as $replace){
            $replacedContent = str_replace($replace, "", $replacedContent);
        }

        $page->content = $replacedContent;
        $page->save();

        parent::log($request , 'Updated page. Title: '.$request->title. ' ID: '.$page->id);

        return redirect()->route('admin.page.index');
    }

    function delete( Request $request, $id){

        $page = Page::find(Crypt::decrypt($id));

        if($page == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $page->is_deleted = 1;
        $delete = $page->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

        parent::log($request , 'Deleted page. Title: '.$page->title. ' ID: '.$page->id);

        Session::flash('success', 'Page deleted successfully!');
        return redirect()->route('admin.page.index');
    }

    function show(Request $request, $id){

        $data = [];
        $data['rows'] = Page::find(Crypt::decrypt($id));

        if($data['rows'] == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->route('admin.page.index');
        }

        return view('backend.pages.page.show')->with('data', $data);

        parent::log($request , 'Visited admin page show page. Title: '.$data['rows']->title);
    }

}
