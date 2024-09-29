<?php

namespace App\Http\Controllers\Auth;

use \Log;
use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\SendsVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use SendsVerificationCode;

    public function showRegistrationForm()
    {
        if (Auth::guard('web')->check() || Auth::guard('vendor')->check()) {
            sweetalert()->info('You are already registered and logged in.');
            return redirect()->route(Auth::guard('web')->check() ? 'user.dashboard' : 'vendor.dashboard');
        }


        $title = 'Register';
        return view('auth.register', compact('title'));
    }


    public function register(Request $request)
    {

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:user,vendor',
        ]);

        try {

            $userData = [
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ];


            if ($request->user_type === 'user') {
                $user = User::create($userData);
                Auth::guard('web')->login($user);
                $redirectRoute = 'user.dashboard';
            } elseif ($request->user_type === 'vendor') {
                $user = Vendor::create($userData);
                Auth::guard('vendor')->login($user);
                $redirectRoute = 'vendor.dashboard';
            } 

            $user->sendVerificationCode();
            sweetalert()->success('Registration successful! A verification code has been sent to your email.');
            return redirect()->route($redirectRoute);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            sweetalert()->error('An error occurred during registration. Please try again.');
            return redirect()->back()->withInput();
        }

    }

}