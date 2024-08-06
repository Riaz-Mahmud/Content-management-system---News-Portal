<?php

namespace App\Http\Controllers\Backend\AD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AD;
use App\Http\Requests\Backend\AD\ADRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Backend\BackendController;

class ADController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.ad.index')->only(['index']);
        $this->middleware('permission:admin.ad.create')->only(['create', 'store']);
        $this->middleware('permission:admin.ad.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.ad.delete')->only(['delete']);
    }

    function index(Request $request){

        $data = [];
        $data['rows'] = AD::where('is_deleted', 0)->paginate(20);

        foreach($data['rows'] as $row){

            $row->image = ImageHelper::generateImage($row->src, 'thumbnail');
            $row->hashId = Crypt::encrypt($row->id);
        }

        parent::log($request , 'Visited admin ad list');

        return view('backend.pages.ad.index')->with('data', $data);

    }

    function create(Request $request){

        parent::log($request , ' Visited admin ad create page');

        return view('backend.pages.ad.create');

    }

    function store(ADRequest $request){

        $ad = new AD();
        $ad->title = $request->title;
        $ad->description = $request->description;
        $ad->code = $request->code;
        $ad->height = $request->height;
        $ad->width = $request->width;
        $ad->start_date = $request->start_date;
        $ad->end_date = $request->end_date;
        $ad->url = $request->url;
        $ad->status = $request->status;
        $save = $ad->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis').rand(1000, 9999);
            $file_full_name = $file_name.'.'.$file_ext;
            $upload_path = 'assets/ad/'.$ad->id.'/'. $file_full_name;
            Storage::disk('public')->put($upload_path, file_get_contents($file));


            $thumbnailUploadPath = 'assets/ad/'.$ad->id.'/'. $file_name.'_thumbnail.'.$file_ext;

            if (!is_dir(storage_path("app/public/assets/ad/".$ad->id))) {
                mkdir(storage_path("app/public/assets/ad/".$ad->id), 0775, true);
            }
            $thumbnail = Image::make($file);
            $thumbnail->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/".$thumbnailUploadPath));

            $ad->src = $upload_path;
            $ad->save();
        }

        parent::log($request , 'Created new ad with title: ' . $request->title );

        Session::flash('success', 'AD created successfully!');
        return redirect()->route('admin.ad.index');

    }

    function edit(Request $request, $id){

        $data = [];
        $id  = Crypt::decrypt($id);

        $data['rows'] = AD::where('id', $id)->where('is_deleted', 0)->first();

        if($data['rows'] == null){
            Session::flash('error', 'AD not found!');
            return redirect()->back();
        }

        $data['rows']->hashId = Crypt::encrypt($data['rows']->id);

        parent::log($request , 'Visited admin ad edit page');

        return view('backend.pages.ad.edit')->with('data', $data);

    }

    function update(ADRequest $request, $id){

        $id  = Crypt::decrypt($id);

        $ad = AD::where('id', $id)->where('is_deleted', 0)->first();

        if($ad == null){
            Session::flash('error', 'AD not found!');
            return redirect()->back();
        }

        $ad->title = $request->title;
        $ad->description = $request->description;
        $ad->code = $request->code;
        $ad->height = $request->height;
        $ad->width = $request->width;
        $ad->start_date = $request->start_date;
        $ad->end_date = $request->end_date;
        $ad->url = $request->url;
        $ad->status = $request->status;
        $save = $ad->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis').rand(1000, 9999);
            $file_full_name = $file_name.'.'.$file_ext;
            $upload_path = 'assets/ad/'.$ad->id.'/'. $file_full_name;
            Storage::disk('public')->put($upload_path, file_get_contents($file));


            $thumbnailUploadPath = 'assets/ad/'.$ad->id.'/'. $file_name.'_thumbnail.'.$file_ext;

            if (!is_dir(storage_path("app/public/assets/ad/".$ad->id))) {
                mkdir(storage_path("app/public/assets/ad/".$ad->id), 0775, true);
            }
            $thumbnail = Image::make($file);
            $thumbnail->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/".$thumbnailUploadPath));

            $ad->src = $upload_path;
            $ad->save();
        }

        parent::log($request , 'Updated ad with title: ' . $request->title . ' and id: ' . $id );

        Session::flash('success', 'AD updated successfully!');
        return redirect()->route('admin.ad.index');

    }

    function delete(Request $request, $id){

        $id  = Crypt::decrypt($id);

        $ad = AD::where('id', $id)->where('is_deleted', 0)->first();

        if($ad == null){
            Session::flash('error', 'AD not found!');
            return redirect()->back();
        }

        $ad->is_deleted = 1;
        $save = $ad->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Deleted ad with title: ' . $ad->title . ' and id: ' . $id );

        Session::flash('success', 'AD deleted successfully!');
        return redirect()->back();
    }
}
