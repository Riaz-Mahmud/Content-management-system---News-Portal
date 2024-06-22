<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Menu;
use App\Models\News;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\UserPublication;
use App\Models\UserSocialMedia;
use App\Services\GeocodeLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Frontend\FrontendController;

// use Image;

class UserController extends FrontendController{

    protected $defaultData = [];

    function __construct(){
        $this->defaultData = parent::defaultData();

    }

    function index(Request $request){

        parent::log($request, 'View User Profile');

        if(Auth::check()){
            return redirect()->route('profile.show', Auth::user()->email);
        }else{
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }
    }

    function show(Request $request, $email){
        try{
            $data = array();
            $data = $this->defaultData;

            $data['user'] = User::where('email', $email)->first();
            if($data['user'] == null){
                Session()->flash('error', 'User not found');
                return redirect()->back();
            }
            $data['rose'] = $data['user']->profile;

            // count days months years of membership of user
            $data['totalYearOfMembership'] = $data['user']->created_at->diffInYears(now()) > 0 ? $data['user']->created_at->diffInYears(now()). ' Years of Membership' : ' Less than 1 Year of Membership';

            if($data['rose'] == null){
                Session()->flash('error', 'Profile not found');
                return redirect()->back();
            }

            $data['rose']['hashId'] = Crypt::encrypt($data['user']['id']);
            $data['rose']['news'] = News::where('user_id', $data['user']['id'])->where('is_deleted', 0)->orderBy('id', 'desc')->paginate(8);

            $data['totalViewCount'] = 0;
            foreach($data['rose']['news'] as $news){
                $news['hashId'] = Crypt::encrypt($news['id']);
                $data['totalViewCount'] += $news['view_count'];
            }

            $data['rose']['socialMedia'] = $data['user']->socialMedia()->where('is_deleted', 0)->where('status', 'Active')->get();

            $data['menu'] = Menu::where('is_deleted',0)->where('status','Active')->where('label','Main Menu')->first();
            $data['hotNewses'] = News::where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->limit(5)->get();
            $data['categories'] = Category::where('is_deleted', 0)->where('status', 'Active')->get();

            parent::log($request, 'View User Profile. User: '.$data['user']->name . 'Id: '.$data['user']->id);

            return view('frontend.partials.pages.profile.profile')->with('data' , $data);

        }catch(\Exception $e){
            Session()->flash('error', 'Something went wrong');
            return redirect()->back();
        }
    }

    function edit(Request $request){

        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $data = [];
        $data = $this->defaultData;

        $data['user'] = User::where('id', Auth::user()->id)->first();
        $data['rose'] = $data['user']->profile;

        // count days months years of membership of user
        $data['totalYearOfMembership'] = $data['user']->created_at->diffInYears(now()) > 0 ? $data['user']->created_at->diffInYears(now()). ' Years of Membership' : ' Less than 1 Year of Membership';

        if($data['rose'] == null){
            Session()->flash('error', 'Profile not found');
            return redirect()->back();
        }

        $data['rose']['hashId'] = Crypt::encrypt($data['user']['id']);
        $data['rose']['news'] = News::where('user_id', $data['user']['id'])->where('is_deleted', 0)->get();
        $data['totalViewCount'] = 0;
        foreach($data['rose']['news'] as $news){
            $news['hashId'] = Crypt::encrypt($news['id']);
            $data['totalViewCount'] += $news['view_count'];
        }

        $data['rose']['socialMedia'] = $data['user']->socialMedia()->where('is_deleted', 0)->where('status', 'Active')->get();

        $data['menu'] = Menu::where('is_deleted',0)->where('status','Active')->where('label','Main Menu')->first();
        $data['hotNewses'] = News::where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->limit(5)->get();
        $data['categories'] = Category::where('is_deleted', 0)->where('status', 'Active')->get();

        parent::log($request, 'View Edit User Profile page');

        return view('frontend.partials.pages.profile.edit')->with('data' , $data);
    }

    function update(Request $request){

        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(),
        [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mailing_address' => 'required',
            'about' => 'required',
            'date_of_birth' => 'required',
            'country' => 'required',
            'profession' => 'required',
            'field_of_profession' => 'required',
            'current_job' => 'required',
            'job_experience' => 'required',
            'organization' => 'required',
            'organization_address' => 'required'
        ]);

        if ($validator->fails()) {
            Session()->flash('error', 'Please fill all the required fields');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $checkEmailUnique = User::where('email', $request->email)->where('id', '!=', Auth::user()->id)->first();
        if($checkEmailUnique != null){
            Session()->flash('error', 'Email already exists');
            return redirect()->back()->withInput();
        }

        $profile = Profile::where('user_id', Auth::user()->id)->first();

        if($profile == null){
            Session()->flash('error', 'Profile not found');
            return redirect()->back();
        }

        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->about = $request->about;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->country = $request->country;
        $profile->profession = $request->profession;
        $profile->field_of_profession = $request->field_of_profession;
        $profile->current_job = $request->current_job;
        $profile->job_experience = $request->job_experience;
        $profile->organization = $request->organization;
        $profile->organization_address = $request->organization_address;

        // if address is changed then update lat lng
        if($profile->mailing_address != $request->mailing_address){
            $profile->mailing_address = $request->mailing_address;
            $data = (new GeocodeLocation)->addressToCoordinates($request->mailing_address);
            $profile->lat = $data['lat'];
            $profile->lng = $data['lng'];
        }

        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis').rand(1000, 9999);
            $file_full_name = $file_name.'.'.$file_ext;
            $upload_path = 'assets/user/'.Auth::user()->id.'/'. $file_full_name;
            Storage::disk('public')->put($upload_path, file_get_contents($file));

            $thumbnailUploadPath = 'assets/user/'.Auth::user()->id.'/'. $file_name.'_thumbnail.'.$file_ext;

            if (!is_dir(storage_path("app/public/assets/user/".Auth::user()->id))) {
                mkdir(storage_path("app/public/assets/slide/".Auth::user()->id), 0775, true);
            }
            $thumbnail = Image::make($file);
            $thumbnail->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/".$thumbnailUploadPath));

            $profile->image = $upload_path;
        }

        $save = $profile->save();

        if($save == null){
            Session()->flash('error', 'Something went wrong');
            return redirect()->back();
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->save();

        parent::log($request, 'Update User Profile.');

        Session()->flash('success', 'Profile updated successfully');
        return redirect()->route('profile.show' , Auth::user()->email);
    }

    function changePassword(Request $request){
        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $data = [];
        $data = $this->defaultData;

        $data['user'] = User::where('id', Auth::user()->id)->first();
        $data['rose'] = $data['user']->profile;

        // count days months years of membership of user
        $data['totalYearOfMembership'] = $data['user']->created_at->diffInYears(now()) > 0 ? $data['user']->created_at->diffInYears(now()). ' Years of Membership' : ' Less than 1 Year of Membership';

        if($data['rose'] == null){
            Session()->flash('error', 'Profile not found');
            return redirect()->back();
        }

        $data['rose']['hashId'] = Crypt::encrypt($data['user']['id']);
        $data['rose']['news'] = News::where('user_id', $data['user']['id'])->where('is_deleted', 0)->get();
        $data['totalViewCount'] = 0;
        foreach($data['rose']['news'] as $news){
            $news['hashId'] = Crypt::encrypt($news['id']);
            $data['totalViewCount'] += $news['view_count'];
        }

        $data['rose']['socialMedia'] = $data['user']->socialMedia()->where('is_deleted', 0)->where('status', 'Active')->get();

        $data['menu'] = Menu::where('is_deleted',0)->where('status','Active')->where('label','Main Menu')->first();
        $data['hotNewses'] = News::where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->limit(5)->get();
        $data['categories'] = Category::where('is_deleted', 0)->where('status', 'Active')->get();

        parent::log($request, 'Change Password Page.');

        return view('frontend.partials.pages.profile.change-password')->with('data' , $data);
    }

    function updatePassword(Request $request){

        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            Session()->flash('error', 'Please fill all the required fields');
            return redirect()->back()->withErrors($validator);
        }

        if($request->password != $request->confirm_password){
            Session()->flash('error', 'Password and confirm password does not match');
            return redirect()->back()->withInput();
        }

        $user = User::where('id', Auth::user()->id)->first();

        if($user == null){
            Session()->flash('error', 'User not found');
            return redirect()->back();
        }

        if(!Hash::check($request->old_password, $user->password)){
            Session()->flash('error', 'Old password does not match');
            return redirect()->back()->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        parent::log($request, 'Update Password.');

        Session()->flash('success', 'Password updated successfully');
        return redirect()->route('profile.show' , Auth::user()->email);
    }

    function publication(Request $request){
        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $data = [];
        $data = $this->defaultData;

        $data['user'] = User::where('id', Auth::user()->id)->first();
        $data['rose'] = $data['user']->profile;

        // count days months years of membership of user
        $data['totalYearOfMembership'] = $data['user']->created_at->diffInYears(now()) > 0 ? $data['user']->created_at->diffInYears(now()). ' Years of Membership' : ' Less than 1 Year of Membership';

        if($data['rose'] == null){
            Session()->flash('error', 'Profile not found');
            return redirect()->back();
        }

        $data['rose']['hashId'] = Crypt::encrypt($data['user']['id']);
        $data['rose']['news'] = News::where('user_id', $data['user']['id'])->where('is_deleted', 0)->get();
        $data['totalViewCount'] = 0;
        foreach($data['rose']['news'] as $news){
            $news['hashId'] = Crypt::encrypt($news['id']);
            $data['totalViewCount'] += $news['view_count'];
        }

        $data['rose']['socialMedia'] = $data['user']->socialMedia()->where('is_deleted', 0)->where('status', 'Active')->get();

        $data['menu'] = Menu::where('is_deleted',0)->where('status','Active')->where('label','Main Menu')->first();
        $data['hotNewses'] = News::where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->limit(5)->get();
        $data['categories'] = Category::where('is_deleted', 0)->where('status', 'Active')->get();

        $data['rose']['publications'] = UserPublication::where('is_deleted', 0)->where('status', 'Active')->where('user_id', Auth::user()->id)->paginate(20);

        foreach($data['rose']['publications'] as $publication){
            $publication['hashId'] = Crypt::encrypt($publication['id']);
        }

        parent::log($request, 'Publication Page.');

        return view('frontend.partials.pages.profile.publication.publication')->with('data' , $data);
    }

    function publicationStore(Request $request){
        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:150',
            'link' => 'required',
        ]);

        if ($validator->fails()) {
            Session()->flash('error', 'Please fill all the required fields');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', Auth::user()->id)->first();

        if($user == null){
            Session()->flash('error', 'User not found');
            return redirect()->back();
        }

        $publication = new UserPublication();
        $publication->title = $request->title;
        $publication->link = $request->link;
        $publication->user_id = Auth::user()->id;
        $publication->published_status = 'Published';
        $publication->status = 'Active';
        $save = $publication->save();

        if($save == null){
            Session()->flash('error', 'Publication not saved');
            return redirect()->back()->withInput();
        }

        parent::log($request, 'New Publication Added.');

        Session()->flash('success', 'Publication added successfully');
        return redirect()->route('profile.publication');
    }

    function publicationDelete(Request $request, $id){

        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $publication = UserPublication::where('id', Crypt::decrypt($id))->first();
        if($publication == null){
            Session()->flash('error', 'Publication not found');
            return redirect()->back();
        }

        $publication->is_deleted = 1;
        $publication->save();

        parent::log($request, 'Publication Deleted. Publication title: '.$publication->title . ' Publication ID: '.$publication->id);

        Session()->flash('success', 'Publication deleted successfully');
        return redirect()->back();

    }

    function social(Request $request){
        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $data = [];
        $data = $this->defaultData;

        $data['user'] = User::where('id', Auth::user()->id)->first();
        $data['rose'] = $data['user']->profile;

        // count days months years of membership of user
        $data['totalYearOfMembership'] = $data['user']->created_at->diffInYears(now()) > 0 ? $data['user']->created_at->diffInYears(now()). ' Years of Membership' : ' Less than 1 Year of Membership';

        if($data['rose'] == null){
            Session()->flash('error', 'Profile not found');
            return redirect()->back();
        }

        $data['rose']['hashId'] = Crypt::encrypt($data['user']['id']);
        $data['rose']['news'] = News::where('user_id', $data['user']['id'])->where('is_deleted', 0)->get();
        $data['totalViewCount'] = 0;
        foreach($data['rose']['news'] as $news){
            $news['hashId'] = Crypt::encrypt($news['id']);
            $data['totalViewCount'] += $news['view_count'];
        }

        $data['rose']['socialMedia'] = $data['user']->socialMedia()->where('is_deleted', 0)->where('status', 'Active')->get();

        $data['menu'] = Menu::where('is_deleted',0)->where('status','Active')->where('label','Main Menu')->first();
        $data['hotNewses'] = News::where('is_deleted', 0)->where('status', 'Active')->orderBy('id', 'desc')->limit(5)->get();
        $data['categories'] = Category::where('is_deleted', 0)->where('status', 'Active')->get();

        $data['rose']['socails'] = UserSocialMedia::where('is_deleted', 0)->where('status', 'Active')->where('user_id', Auth::user()->id)->paginate(20);

        foreach($data['rose']['socails'] as $socail){
            $socail['hashId'] = Crypt::encrypt($socail['id']);
        }

        parent::log($request, 'View Social Media Page.');

        return view('frontend.partials.pages.profile.social.social')->with('data' , $data);
    }

    function socialStore(Request $request){
        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'link' => 'required|regex:/^https:\/\/[a-zA-Z0-9]+/',
        ]);

        if ($validator->fails()) {
            Session()->flash('error', 'Please fill all the required fields');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', Auth::user()->id)->first();

        if($user == null){
            Session()->flash('error', 'User not found');
            return redirect()->back();
        }

        $socail = new UserSocialMedia();
        $socail->type = $request->type;
        $socail->link = $request->link;
        $socail->user_id = Auth::user()->id;
        $socail->status = 'Active';
        $save = $socail->save();

        if($save == null){
            Session()->flash('error', 'Social not saved');
            return redirect()->back()->withInput();
        }

        parent::log($request, 'New Social Media Added. Social Media Link: '.$socail->link);

        Session()->flash('success', 'Social added successfully');
        return redirect()->route('profile.social');
    }

    function socialDelete(Request $request, $id){
        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        $socail = UserSocialMedia::where('id', Crypt::decrypt($id))->first();
        if($socail == null){
            Session()->flash('error', 'Social Media is not found');
            return redirect()->back();
        }

        $socail->is_deleted = 1;
        $socail->save();

        parent::log($request, 'Social Media Deleted. Social Media ID: '.$socail->id);

        Session()->flash('success', 'Social Media deleted successfully');
        return redirect()->back();
    }

}
