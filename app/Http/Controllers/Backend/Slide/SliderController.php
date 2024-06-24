<?php

namespace App\Http\Controllers\Backend\Slide;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Backend\Slide\SlideRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class SliderController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.slide.index')->only(['index']);
        $this->middleware('permission:admin.slide.create')->only(['create', 'store']);
        $this->middleware('permission:admin.slide.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.slide.delete')->only(['delete']);
    }

    public function index( Request $request){

        $data = array();

        $sliders = Slider::orderBy('id', 'DESC')->where('is_deleted' , 0)->paginate(20);

        $data['rose'] = $sliders;

        parent::log($request, 'View Slider');

        return view('backend.pages.slider.index')->with('data', $data);
    }

    public function create( Request $request){
        parent::log($request, 'View Slider Create page');
        return view('backend.pages.slider.create');
    }

    public function store(SlideRequest $request){

        $slider = Slider::create([
            'label' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if($slider == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request, 'Slider created successfully! Title: '.$request->title);

        Session::flash('success', 'Slider created successfully!');
        return redirect()->back();

    }

    public function edit(Request $request, $id){

        $data = array();

        $slider = Slider::where('id', Crypt::decrypt($id))->where('is_deleted', 0)->first();

        if($slider == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $data['rose'] = $slider;

        parent::log($request, 'View Slider Edit page');

        return view('backend.pages.slider.edit')->with('data', $data);
    }

    public function update(SlideRequest $request, $id){
        $request->validated();

        $slider = Slider::where('id', Crypt::decrypt($id))->where('is_deleted', 0)->first();

        if($slider == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $slider->label = $request->title;
        $slider->description = $request->description;
        $slider->status = $request->status;

        $update = $slider->save();

        if($update == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request, 'Slider updated successfully! Title: '.$request->title . ' ID: ' . $slider->id);

        Session::flash('success', 'Slider updated successfully!');
        return redirect()->route('admin.slide.index');

    }

    public function delete(Request $request, $id){

        $id = Crypt::decrypt($id);

        $slider = Slider::find($id);

        if($slider == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $slider->is_deleted = 1;
        $delete = $slider->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request, 'Slider deleted successfully! Title: '.$slider->title . ' ID: ' . $slider->id);

        Session::flash('success', 'Slider deleted successfully!');
        return redirect()->back();

    }
}
