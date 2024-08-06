<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\Profile;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends BackendController
{
    function index( Request $request ){

        $data = [];

        // get all the role except the super admin
        $data['roles'] = Role::where('name', '!=', config('backend.role')[0])->get();

        $user = Auth::user();
        $data['user'] = $user;
        $data['permissions'] = $user->getAllPermissions()->pluck('name')->toArray();

        foreach ($data['roles'] as $role) {
            $role->hashId = Crypt::encrypt($role->id);
        }

        parent::log($request, 'View User');

        return view('backend.pages.user.index')->with('data', $data);
    }

    function getAllUsers( Request $request ){

        $profiles = Profile::where('is_deleted', 0)->get();

        $data = [];
        $data['data'] = [];

        foreach ($profiles as $profile) {

            $data['data'][] = [
                'id' => Crypt::encrypt($profile->user_id),
                'full_name' => $profile->first_name . ' ' . $profile->last_name,
                'role' => $profile->user->getRoleNames()->first() ?? 'N/A',
                'phone' => $profile->phone,
                'email' => $profile->email,
                'current_plan' => $profile->user->getRoleNames()->first() ?? 'N/A',
                'billing' => $profile->user->getRoleNames()->first() ?? 'N/A',
                'status' => $profile->status == 'Active' ? 2 : ($profile->status == 'Pending' ? 1 : 3),
                'avatar' => ImageHelper::generateImage($profile->user->profile->image, 'thumbnail'),
                'permission' => Auth::user()->hasPermissionTo('admin.user.assign.role') ? true : false,
            ];
        }

        parent::log($request, 'Get all users');

        return json_encode($data);
    }

    function delete( Request $request, $hashId){

        try {

            $id = Crypt::decrypt($hashId);

            $profile = Profile::where('user_id', $id)->first();

            $profile->is_deleted = 1;
            $profile->save();

            parent::log($request, 'User deleted successfully! Profile Name: '.$profile->first_name.' '.$profile->last_name . ' Profile ID: '.$profile->id);

            return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    function updateStatus( Request $request, $hashId){

        try {

            $id = Crypt::decrypt($hashId);

            $profile = Profile::where('user_id', $id)->first();

            $profile->status = $profile->status == 'Blocked' ? 'Active' : 'Blocked';
            $profile->save();

            parent::log($request, 'User status updated successfully to '.$profile->status.'! name: '.$profile->first_name.' '.$profile->last_name . ' Profile ID: '.$profile->id);

            return redirect()->back()->with('success', 'User status updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


}
