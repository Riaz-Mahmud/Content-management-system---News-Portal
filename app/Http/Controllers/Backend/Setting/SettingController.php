<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Setting\SettingRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class SettingController extends BackendController
{
    public function __construct(){
        $this->middleware('permission:admin.setting.index')->only(['index']);
        $this->middleware('permission:admin.setting.edit')->only(['edit', 'update']);
    }

    function index(Request $request){

        $data = [];
        $data['rows'] = Setting::where('is_deleted', 0)->paginate(20);

        foreach($data['rows'] as $row){
            $row->hashId = Crypt::encrypt($row->id);
        }

        parent::log($request , 'View Settings');

        return view('backend.pages.setting.index')->with('data', $data);

    }

    function edit(Request $request, $id){

        $data = [];
        $id  = Crypt::decrypt($id);

        $data['rows'] = Setting::where('id', $id)->where('is_deleted', 0)->first();

        if($data['rows'] == null){
            Session::flash('error', 'AD not found!');
            return redirect()->back();
        }

        $data['rows']->hashId = Crypt::encrypt($data['rows']->id);

        parent::log($request , 'View Setting Edit page');

        return view('backend.pages.setting.edit')->with('data', $data);

    }

    function update(SettingRequest $request, $id){

        $request->validated();

        $setting = Setting::where('id', crypt::decrypt($id))->where('is_deleted', 0)->first();

        if($setting == null){
            Session::flash('error', 'Setting not found!');
            return redirect()->back();
        }

        $setting->settings_value = $request->value;
        $setting->status = $request->status;
        $save = $setting->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Update Setting. Key : ' . $setting->settings_key . ' Id : ' . $setting->id);

        Session::flash('success', 'Setting updated successfully!');
        return redirect()->route('admin.setting.index');

    }

}
