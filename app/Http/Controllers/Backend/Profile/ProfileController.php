<?php

namespace App\Http\Controllers\Backend\Profile;

use Carbon\Carbon;
use App\Models\User;
use App\Models\LoginLog;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    function show(Request $request, $email){
        $data = [];

        $data['user'] = User::where('email', $email)->first();

        if($data['user'] == null || $data['user']->profile()->where('is_deleted', 0) == null){
            Session::flash('error', 'User not found');
            return redirect()->back();
        }

        $data['profile'] = $data['user']->profile;
        $data['profile']->hashId = Crypt::encrypt($data['user']->id);
        $data['profile']->image = ImageHelper::generateImage($data['user']->profile->image, 'main');

        parent::log($request , 'View Profile of ' . $data['user']->name);

        return view('backend.pages.profile.profile')->with('data', $data);
    }

    protected function getUserArticle($user){

        $articles = $user->news()->where('is_deleted', 0)->latest()->get();

        foreach($articles as $article){
            $article->hashId = Crypt::encrypt($article->id);
            $article->image = ImageHelper::generateImage($article->image_src, 'medium');

            $article->category = $article->category()->get();
        }

        return $articles;
    }

    function article(Request $request, $email){
        $data = [];

        $data['user'] = User::where('email', $email)->first();
        if($data['user'] == null || $data['user']->profile()->where('is_deleted', 0) == null){
            Session::flash('error', 'User not found');
            return redirect()->back();
        }

        $data['profile'] = $data['user']->profile;
        $data['profile']->image = ImageHelper::generateImage($data['user']->profile->image, 'main');

        $data['articles'] = $this->getUserArticle($data['user']);

        parent::log($request , 'View Article of ' . $data['user']->name);

        return view('backend.pages.profile.article')->with('data', $data);
    }
}
