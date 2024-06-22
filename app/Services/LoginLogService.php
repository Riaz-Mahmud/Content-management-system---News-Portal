<?php
namespace App\Services;

use App\Models\LoginLog;
use Browser;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class LoginLogService{

    public function saveLoginLog($request){
        $data = [];
        $data['user_id'] = Auth::id();
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent() ?? null;
        $data['device'] = Browser::deviceType();
        $data['browser'] = Browser::browserName();

        if(Browser::isWindows()){
            $data['platform'] = 'Windows';
        }elseif(Browser::isLinux()){
            $data['platform'] = 'Linux';
        }elseif(Browser::isMac()){
            $data['platform'] = 'Mac';
        }elseif(Browser::isAndroid()){
            $data['platform'] = 'Android';
        }else{
            $data['platform'] = 'Other';
        }

        $locate = Location::get($request->ip());
        if ($locate) {
            $data['latitude'] = $locate->latitude;
            $data['longitude'] = $locate->longitude;
            $data['country'] = $locate->countryName;
            $data['city'] = $locate->cityName;
            $data['timezone'] = $locate->timezone;
            $data['postal_code'] = $locate->zipCode;
        } else {
            $data['latitude'] = null;
            $data['longitude'] = null;
            $data['country'] = null;
            $data['city'] = null;
            $data['timezone'] = null;
            $data['postal_code'] = null;
        }

        $log = new LoginLog();
        $log->user_id = $data['user_id'];
        $log->ip_address = $data['ip_address'];
        $log->user_agent = $data['user_agent'];
        $log->device = $data['device'];
        $log->browser = $data['browser'];
        $log->platform = $data['platform'];
        $log->country = $data['country'];
        $log->city = $data['city'];
        $log->latitude = $data['latitude'];
        $log->longitude = $data['longitude'];
        $log->timezone = $data['timezone'];
        $log->postal_code = $data['postal_code'];
        $log->save();

    }

}
