<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CustomResetPasswordMail;
use App\Mail\PasswordChangedNotification;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            sweetalert()->info('You are already logged in.');

            $user = Auth::user();
            if ($user instanceof Vendor) {
                return redirect()->route('vendor.dashboard');
            }else {
                return redirect()->route('user.dashboard');
            }
        }

        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_username_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginData = $request->only('email_username_phone', 'password');
        $guards = ['web', 'vendor'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt(['email' => $loginData['email_username_phone'], 'password' => $loginData['password']]) ||
                Auth::guard($guard)->attempt(['username' => $loginData['email_username_phone'], 'password' => $loginData['password']]) ||
                Auth::guard($guard)->attempt(['phone' => $loginData['email_username_phone'], 'password' => $loginData['password']])) {

                $user = Auth::guard($guard)->user();
                sweetalert('Login successful! Welcome back.');

                if ($user instanceof Vendor) {
                    return response()->json(['success' => true, 'redirect' => route('vendor.dashboard')]);
                }else {
                    return response()->json(['success' => true, 'redirect' => route('user.dashboard')]);
                }
            }
        }

        sweetalert()->error('These credentials do not match our records.');
        return response()->json(['success' => false, 'message' => 'These credentials do not match our records.'], 422);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('vendor')->check()) {
            Auth::guard('vendor')->logout();
        }else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        sweetalert('You have been logged out successfully.');
        return redirect()->route('user.login');
    }

    public function showForgotPasswordForm()
    {
        $title = 'Forgot Password';
        return view('auth.forgot-password', compact('title'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email_username_phone' => 'required|string']);

        $user = User::where('email', $request->email_username_phone)
                    ->orWhere('username', $request->email_username_phone)
                    ->orWhere('phone', $request->email_username_phone)
                    ->first();

        if (!$user) {
            $vendor = Vendor::where('email', $request->email_username_phone)
                            ->orWhere('username', $request->email_username_phone)
                            ->orWhere('phone', $request->email_username_phone)
                            ->first();

        }

        if ($user) {
            $token = Password::broker()->createToken($user);

            Mail::to($user->email)->send(new CustomResetPasswordMail($token, $user->email, get_class($user)));

            sweetalert('A password reset link has been sent to your email.');
            return redirect()->route('user.resend.page')->with('email', $user->email);
        }

        sweetalert()->error('No user found with this information.');
        return back()->withErrors(['email_username_phone' => 'No user found with this information.']);
    }

    public function showResetPasswordForm($token)
    {
        $title = 'Reset Password';
        $email = request()->query('email');
        return view('auth.reset-password', compact('title', 'token', 'email'));
    }




    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->input('email'))->first() ??
                Vendor::where('email', $request->input('email'))->first();

        if ($user) {
            $broker = $this->getPasswordBroker($user);

            $status = Password::broker($broker)->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    Auth::guard($this->getGuardForUser($user))->logout();

                    request()->session()->invalidate();
                    request()->session()->regenerateToken();

                    Auth::guard($this->getGuardForUser($user))->login($user);

                    Mail::to($user->email)->send(new PasswordChangedNotification($user));

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                sweetalert('Your password has been reset successfully.');
                return redirect()->route($this->getDashboardRoute($user));
            }
        }

        sweetalert()->error('Failed to reset the password. Please try again.');
        return back()->withErrors(['email' => [__($status ?? 'passwords.token')]])->withInput();
    }



    private function getDashboardRoute($user)
    {
        if ($user instanceof User) {
            return 'user.dashboard';
        } elseif ($user instanceof Vendor) {
            return 'vendor.dashboard';
        }

        return 'home';
    }




    protected function getPasswordBroker($user)
    {
        if ($user instanceof User) {
            return 'users';
        } elseif ($user instanceof Vendor) {
            return 'vendors';
        }

        throw new \Exception('Unknown user type');
    }



    protected function getGuardForUser($user)
    {
        if ($user instanceof User) {
            return 'web';
        } elseif ($user instanceof Vendor) {
            return 'vendor';
        }

        throw new \Exception('Unknown user type');
    }







    public function showResendPasswordLinkPage()
    {
        $title = 'Resend Password Reset Link';
        return view('auth.resend-password-link', compact('title'));
    }




    public function resendPasswordLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first() ??
                Vendor::where('email', $request->email)->first();

        if ($user) {
            $token = Password::broker()->createToken($user);
            Mail::to($user->email)->send(new CustomResetPasswordMail($token, $user->email, get_class($user)));

            sweetalert('A password reset link has been resent to your email.');
            return redirect()->back();
        }

        sweetalert()->error('No user found with this email address.');
        return back()->withErrors(['email' => 'No user found with this email address.']);
    }
}