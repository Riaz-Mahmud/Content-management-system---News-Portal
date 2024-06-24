<?php

namespace App\Http\Controllers\Backend\Slide\SlideItem;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Slider;
use App\Models\SliderItem;
use App\Models\News;
use App\Http\Requests\Backend\Slide\SlideItemRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlideItemController extends BackendController
{
    public function __construct(){
        $this->middleware('permission:admin.slide.item.index')->only(['index']);
        $this->middleware('permission:admin.slide.item.create')->only(['create', 'store']);
        $this->middleware('permission:admin.slide.item.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.slide.item.delete')->only(['delete']);
    }

    function index(Request $request, $id){
        $data = array();

        $slide = Slider::where('is_deleted', 0)->where('id', Crypt::decrypt($id))->first();

        $slide_items = $slide->slide_items()->with('news')->paginate(15);

        foreach($slide_items as $slide_item){
            $slide_item->hashId = Crypt::encrypt($slide_item->id);
            if($slide_item->newses_id){
                $slide_item->image = ImageHelper::generateImage($slide_item->news->image_src, 'thumbnail');
                $slide_item->imageMain = ImageHelper::generateImage($slide_item->news->image_src);
            }else{
                $slide_item->image = ImageHelper::generateImage($slide_item->src, 'thumbnail');
                $slide_item->imageMain = ImageHelper::generateImage($slide_item->src);
            }

        }

        $data['slide'] = $slide;
        $data['rose'] = $slide_items;

        parent::log($request , 'View Slide Item');

        return view('backend.pages.slider.slideItem.index')->with('data', $data);
    }

    function create(Request $request, $id){
        $data = array();

        $slide = Slider::where('is_deleted', 0)->where('id', Crypt::decrypt($id))->first();
        $news = News::where('is_deleted', 0)->get();
        $data['rose'] = $slide;
        $data['news'] = $news;

        parent::log($request , 'View Slide Item Create page');

        return view('backend.pages.slider.slideItem.create')->with('data', $data);
    }

    function store(SlideItemRequest $request, $id){

        $request->validated();
        $id = Crypt::decrypt($id);
        $slide = Slider::where('is_deleted', 0)->where('id', $id)->first();

        if(!$slide){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $slide_item = new SliderItem();
        $slide_item->slider_id = $slide->id;
        $slide_item->label = $request->type == 'image' ? $request->title : null;
        $slide_item->description = $request->type == 'image' ? $request->description : null;
        $slide_item->status = $request->status;

        $save = $slide_item->save();

        // get the latest id
        $saveSlide = SliderItem::orderBy('id', 'desc')->first();
        $saveSlideId = $saveSlide->id;
        // dd($saveSlide);

        if($request->type == 'image'){
            if($request->hasFile('image')){
                $file = $request->file('image');
                $file_ext = $file->getClientOriginalExtension();
                $file_name = date('YmdHis').rand(1000, 9999);
                $file_full_name = $file_name.'.'.$file_ext;
                $upload_path = 'assets/slide/'.$id.'/'.$saveSlideId.'/'. $file_full_name;
                Storage::disk('public')->put($upload_path, file_get_contents($file));

                $thumbnailUploadPath = 'assets/slide/'.$id.'/'.$saveSlideId.'/'. $file_name.'_thumbnail.'.$file_ext;

                if (!is_dir(storage_path("app/public/assets/slide/".$id.'/'.$saveSlideId))) {
                    mkdir(storage_path("app/public/assets/slide/".$id.'/'.$saveSlideId), 0775, true);
                }
                $thumbnail = Image::make($file);
                $thumbnail->resize(100, 70, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path("app/public/".$thumbnailUploadPath));

                $saveSlide->update([
                    'src' => $upload_path,
                    'thumbnail' => $thumbnailUploadPath
                ]);
            }
        }else{
            $saveSlide->update([
                'newses_id' => Crypt::decrypt($request->news)
            ]);
        }

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Create Slide Item.');// Slide item: '. $request->type == 'image' ? 'title '. $request->title : 'news [Id '. Crypt::decrypt($request->news) .']' );

        Session::flash('success', 'Slide item created successfully!');
        return redirect()->route('admin.slide.item.index', Crypt::encrypt($slide->id));
    }

    function edit(Request $request, $id){
        $data = array();

        $slide_item = SliderItem::where('is_deleted', 0)->where('id', Crypt::decrypt($id))->first();

        if($slide_item == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $news = News::where('is_deleted', 0)->get();

        $data['rose'] = $slide_item;
        $data['news'] = $news;

        parent::log($request, 'View Slide Item Edit page');

        return view('backend.pages.slider.slideItem.edit')->with('data', $data);
    }

    function update(SlideItemRequest $request, $id){
        $request->validated();
        $id = Crypt::decrypt($id);
        $slide_item = SliderItem::where('is_deleted', 0)->where('id', $id)->first();

        if($slide_item == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $slide_item->label = $request->type == 'image' ? $request->title : null;
        $slide_item->description = $request->description == 'image' ? $request->description : null;
        $slide_item->status = $request->status;

        if($request->type == 'image'){
            if($request->hasFile('image')){
                $file = $request->file('image');
                $file_ext = $file->getClientOriginalExtension();
                $file_name = date('YmdHis').rand(1000, 9999);
                $file_full_name = $file_name.'.'.$file_ext;
                $upload_path = 'assets/slide/'.$slide_item->slider_id.'/'. $file_full_name;
                Storage::disk('public')->put($upload_path, file_get_contents($file));

                $thumbnailUploadPath = 'assets/slide/'.$slide_item->slider_id.'/'.$file_name.'_thumbnail.'.$file_ext;

                if (!is_dir(storage_path("app/public/assets/slide/".$slide_item->slider_id."/thumbnail"))) {
                    mkdir(storage_path("app/public/assets/slide/".$slide_item->slider_id."/thumbnail"), 0775, true);
                }

                $thumbnail = Image::make($file);
                $thumbnail->resize(100, 70, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path("app/public/".$thumbnailUploadPath));
                Storage::disk('public')->put($thumbnailUploadPath, $thumbnail->stream());

                $slide_item->src = $upload_path;
                $slide_item->thumbnail = $thumbnailUploadPath;
            }
        }else{
            $slide_item->newses_id = Crypt::decrypt($request->news);
        }

        $save = $slide_item->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Update Slide Item. Slide item Id : '. $slide_item->id );

        Session::flash('success', 'Slide item updated successfully!');
        return redirect()->route('admin.slide.item.index', Crypt::encrypt($slide_item->slider_id));
    }

    function delete(Request $request, $id){

        $id = Crypt::decrypt($id);

        $slide_item = SliderItem::where('is_deleted', 0)->where('id', $id)->first();
        if($slide_item == null){
            Session::flash('error', 'Slide item not found!');
            return redirect()->back();
        }

        $slide_item->is_deleted = 1;
        $delete = $slide_item->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Delete Slide Item. Slide item Id : '. $slide_item->id );

        Session::flash('success', 'Slide item deleted successfully!');
        return redirect()->back();
    }
}
