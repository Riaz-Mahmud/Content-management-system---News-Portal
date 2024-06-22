<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Jobs\ActivityLogJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->log($request, 'Logged in successfully');

        Session()->flash('success', 'You are logged in successfully!');

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session()->flash('success', 'You are logged out successfully!');

        $this->log($request, 'Logged out');

        return redirect('/');
    }

    private function log(Request $request, $msg = null){
        try{
            $log = [
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'description' => $msg ?? null,
                'url' => $request->getRequestUri() ?? null,
                'method' => $request->method() ?? null,
                'route' => Route::currentRouteName() ?? null,
                'ip' => $request->ip() ?? null,
                'agent' => $request->userAgent() ?? null,
                //'device_data' => new Agent(),
            ];

            ActivityLogJob::dispatch($log);

        }catch(\Exception $e){
            Log::info('Activity Log Error: ' . $e->getMessage());
        }
    }
}
