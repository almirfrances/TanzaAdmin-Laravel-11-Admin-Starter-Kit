<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationCode;

class VerifyEmailController extends Controller
{
    public function showVerifyForm()
    {
        $title = 'Verify Email';

        $guard = $this->getCurrentGuard();
        $user = Auth::guard($guard)->user();

        if ($user && $user->is_verified) {
            sweetalert()->info('Your email is already verified.');
            return redirect()->route("{$guard}.dashboard");
        }

        return view('auth.verify', compact('title'));
    }

    public function verify(Request $request)
    {
        $guard = $this->getCurrentGuard();
        $user = Auth::guard($guard)->user();

        if ($user) {
            $request->validate(['verification_code' => 'required|digits:6']);

            if ($user->verification_code === $request->verification_code) {
                $user->is_verified = 1;
                $user->email_verified_at = now();
                $user->verification_code = null;
                $user->save();

                sweetalert('Email verified successfully!');
                return redirect()->route("{$guard}.dashboard");
            }

            sweetalert()->error('The verification code is incorrect.');
            return back()->withErrors(['verification_code' => 'The verification code is incorrect.']);
        } else {
            sweetalert()->error('Please log in to verify your email.');
            return redirect()->route('user.login');
        }
    }

    public function resendCode()
    {
        $guard = $this->getCurrentGuard();
        $user = Auth::guard($guard)->user();

        if ($user) {

            $user->verification_code = random_int(100000, 999999);
            $user->save();

            Mail::to($user->email)->send(new SendVerificationCode($user));

            sweetalert('A new verification code has been sent to your email.');
            return back()->with('status', 'A new verification code has been sent to your email.');
        } else {
            sweetalert()->error('Please log in to request a new verification code.');
            return redirect()->route('user.login'); // Default redirect if not authenticated
        }
    }

    protected function getCurrentGuard()
    {
        if (Auth::guard('vendor')->check()) {
            return 'vendor';
        } 

        return 'web';
    }
}