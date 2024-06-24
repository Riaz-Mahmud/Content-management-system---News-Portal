<?php

namespace App\Http\Controllers\Backend\Tags;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Tags\TagsRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\Tag;

class TagsController extends BackendController
{
    public function __construct(){
        $this->middleware('permission:admin.tags.index')->only(['index']);
        $this->middleware('permission:admin.tags.create')->only(['create', 'store']);
        $this->middleware('permission:admin.tags.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.tags.delete')->only(['delete']);
    }

    function index( Request $request){
        $data = array();

        $data['rose'] = Tag::orderBy('id', 'DESC')->where('is_deleted', 0)->paginate(30);

        parent::log($request, 'View Tags');

        return view('backend.pages.tags.index')->with('data', $data);
    }

    function create( Request $request){
        parent::log($request, 'View Tags Create page');

        return view('backend.pages.tags.create');
    }

    function store(TagsRequest $request){

        $request->validated();

        $tag = new Tag();
        $tag->label = $request->label;
        $tag->status = $request->status;
        $save = $tag->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request, 'Tag has been created successfully! Label: '.$request->label);

        Session::flash('success', 'Tag has been created successfully!');
        return redirect()->route('admin.tags.index');
    }

    function edit(Request $request, $id){
        $data = array();

        $data['rose'] = Tag::find(Crypt::decrypt($id));

        parent::log($request, 'View Tags Edit page');

        return view('backend.pages.tags.edit')->with('data', $data);
    }

    function update(TagsRequest $request, $id){

        $tag = Tag::find(Crypt::decrypt($id));
        $tag->label = $request->label;
        $tag->status = $request->status;
        $save = $tag->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request, 'Tag has been updated successfully! Label: '.$request->label . ' ID: '. $tag->id);

        Session::flash('success', 'Tag has been updated successfully!');
        return redirect()->route('admin.tags.index');
    }

    function delete( Request $request, $id){
        $tag = Tag::find(Crypt::decrypt($id));

        if($tag == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $tag->is_deleted = 1;
        $delete = $tag->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request, 'Tag has been deleted successfully! Label: '.$tag->label . ' ID: '. $tag->id);

        Session::flash('success', 'Tag has been deleted successfully!');
        return redirect()->route('admin.tags.index');
    }
}
