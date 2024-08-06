<?php

namespace App\Http\Controllers\Backend\Profile;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use App\Models\LoginLog;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\DB;

class ProfileController extends BackendController
{

    public function __construct(){

        $this->middleware('auth');
    }

    public function index(Request $request){

        parent::log($request , 'View Profile');

        return redirect()->route('admin.profile.show', Auth::user()->email);
    }

    public function edit(Request $request){
        $data = [];
        $data['user'] = Auth::user();
        $data['profile'] = $data['user']->profile;

        $data['profile']->image = ImageHelper::generateImage($data['user']->profile->image, 'main');

        parent::log($request , 'Edit Profile');

        return view('backend.pages.profile.edit')->with('data', $data);
    }

    public function update(Request $request, $email){
        $validator = Validator::make($request->all(),
        [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'mailing_address' => 'required',
            'about' => 'required',
            'date_of_birth' => 'required',
        ]);

        if ($validator->fails()) {
            Session()->flash('error', 'Please fill all the required fields');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $profile = Profile::where('email', $email)->first();

        if($profile == null){
            Session()->flash('error', 'Profile not found');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();

        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->phone = $request->phone;
        $profile->about = $request->about;
        $profile->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');

        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis').rand(1000, 9999);
            $file_full_name = $file_name.'.'.$file_ext;
            $upload_path = 'assets/user/'.Auth::user()->id.'/'. $file_full_name;
            Storage::disk('public')->put($upload_path, file_get_contents($file));

            $thumbnailUploadPath = 'assets/user/'.Auth::user()->id.'/'. $file_name.'_thumbnail.'.$file_ext;

            if (!is_dir(storage_path("app/public/assets/user/".Auth::user()->id))) {
                mkdir(storage_path("app/public/assets/user/".Auth::user()->id), 0775, true);
            }
            $thumbnail = Image::make($file);
            $thumbnail->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/".$thumbnailUploadPath));

            $profile->image = $upload_path;
        }

        $save = $profile->save();

        if($save == null){
            DB::rollBack();
            Session()->flash('error', 'Something went wrong');
            return redirect()->back();
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->first_name.' '.$request->last_name;
        $user->save();

        DB::commit();

        parent::log($request, 'Update User Profile.');

        Session()->flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    public function security(Request $request, $email){
        $data = [];
        $data['user'] = User::where('email', $email)->first();
        $data['rows'] = LoginLog::where('user_id', $data['user']->id)->latest()->take(5)->get();


        $data['profile'] = $data['user']->profile;

        $data['profile']->image = ImageHelper::generateImage($data['user']->profile->image, 'main');

        parent::log($request , 'View Security page of ' . $data['user']->name);

        return view('backend.pages.profile.security')->with('data', $data);
    }

    function updatePassword(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'currentPassword' => 'required',
                'newPassword' => 'required|min:6|max:20',
                'confirmPassword' => 'required|same:newPassword'
            ]);

            if ($validator->fails()) {
                Session()->flash('error', $validator->errors()->first());
                return redirect()->back();
            }

            if($request->newPassword != $request->confirmPassword){
                Session()->flash('error', 'Password and confirm password does not match');
                return redirect()->back();
            }

            $user = User::where('id', Auth::user()->id)->first();
            if($user == null){
                Session::flash('error', 'User not found');
                return redirect()->back();
            }

            if(!Hash::check($request->currentPassword, $user->password)){
                Session()->flash('error', 'Current password does not match');
                return redirect()->route('admin.profile.security');
            }

            $user->password = Hash::make($request->newPassword);
            $save = $user->save();

            if(!$save){
                Session()->flash('error', 'Something went wrong');
                return redirect()->back();
            }

            parent::log($request , 'Change password');

            Session()->flash('success', 'Password updated successfully');
            return redirect()->back();

        }catch(\Exception $e){
            Session()->flash('error', $e->getMessage());
            return redirect()->back();
        }


    }

    function show(Request $request, $email) {
        $user = User::where('email', $email)->firstOrFail();

        $profile = $user->profile()->where('is_deleted', 0)->first();
        if (is_null($profile)) {
            Session::flash('error', 'User not found');
            return redirect()->back();
        }

        $profile->hashId = Crypt::encrypt($user->id);
        $profile->image = ImageHelper::generateImage($profile->image, 'main');

        parent::log($request, 'View Profile of ' . $user->name);

        $data = [
            'user' => $user,
            'profile' => $profile,
        ];

        return view('backend.pages.profile.profile')->with('data', $data);
    }

    protected function getUserArticle($user) {
        $articles = $user->news()->where('is_deleted', 0)->latest()->get();

        foreach ($articles as $article) {
            $article->hashId = Crypt::encrypt($article->id);
            $article->image = ImageHelper::generateImage($article->image_src, 'medium');
            $article->category = $article->category; // Assuming category is a relationship and eager loading is used
        }

        return $articles;
    }

    function article(Request $request, $email) {
        $user = User::where('email', $email)->first();
        if (is_null($user) || is_null($user->profile()->where('is_deleted', 0)->first())) {
            Session::flash('error', 'User not found');
            return redirect()->back();
        }

        $profile = $user->profile;
        $profile->image = ImageHelper::generateImage($profile->image, 'main');

        $articles = $this->getUserArticle($user);

        parent::log($request, 'View Article of ' . $user->name);

        $data = [
            'user' => $user,
            'profile' => $profile,
            'articles' => $articles,
        ];

        return view('backend.pages.profile.article')->with('data', $data);
    }

}
