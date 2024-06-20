<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $assignId = null){

        if(Auth::check()){
            $permissions =   Auth::user()->getAllPermissions()->pluck('name')->toArray();

            if( (! is_null($permissions)) &&  (Auth::user()->role_id != 1) ){
                if( in_array($assignId , $permissions )){
                    return $next($request);
                }
                else{
                    // return response()->view('backend.pages.error.not-authorized');
                    return redirect()->route('home');
                }
            }else{
                return $next($request);
            }
        }else{
            return redirect()->route('home');
        }
    }
}
