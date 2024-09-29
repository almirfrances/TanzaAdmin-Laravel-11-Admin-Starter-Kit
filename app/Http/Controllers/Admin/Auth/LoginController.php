<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Admin Login';
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $login = $request->input('email-username');
        $password = $request->input('password');
        $remember = $request->filled('remember');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $login,
            'password' => $password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $redirectTo = session()->pull('redirectTo', route('admin.dashboard'));
            sweetalert('Logged in successfully.');
            return redirect()->intended($redirectTo);
        }

        sweetalert()->error('The provided credentials do not match our records.');
        return back()->withErrors([
            'email-username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        sweetalert('Logged out successfully.');
        return redirect()->route('admin.login');
    }
}