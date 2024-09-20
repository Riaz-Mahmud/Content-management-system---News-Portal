<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // get splited name and save it to first_name and last_name, if array has more them 2 elements, it will be saved to save rest of the name to last_name
        $name = explode(' ', $request->name);
        $first_name = $name[0];
        $last_name = count($name) > 1 ? $name[1] : '';

        if (count($name) > 2) {
            for ($i = 2; $i < count($name); $i++) {
                $last_name .= ' ' . $name[$i];
            }
        }

        $user->profile()->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $request->email,
            'status' => 'Pending',
        ]);

        DB::commit();

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME)->with('success', 'Your account has been created. Please wait for the admin to approve your account.');
    }
}
