<?php

namespace App\Http\Controllers\Admin;

use \Exception;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Log;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function general()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'site_phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'primary_color' => 'nullable|string|max:7',
            'footer_copyright' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'site_name', 'site_email', 'site_phone', 'address', 'facebook_url',
            'instagram_url', 'telegram_url', 'twitter_url', 'primary_color', 'footer_copyright'
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forever('primary_color', $request->input('primary_color'));

        sweetalert()->success('General settings updated successfully.');
        return redirect()->route('admin.settings.general');
    }

    public function logo()
    {
        $title = 'Logo and Favicon Settings';
        return view('admin.settings.logo', compact('title'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo_light' => 'nullable|image|mimes:jpeg,png,jpg',
            'logo_dark' => 'nullable|image|mimes:jpeg,png,jpg',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $images = ['logo_light', 'logo_dark', 'favicon'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                $path = $request->file($image)->store('settings', 'public');
                Setting::updateOrCreate(['key' => $image], ['value' => $path]);
                Log::info("Uploaded $image to $path");
            }
        }

        sweetalert()->success('Logo and Favicon settings updated successfully.');
        return redirect()->route('admin.settings.logo');
    }




    public function showCustomCode()
{
    $settings = Setting::pluck('value', 'key')->toArray();
    $title = 'Custom Code Settings';
    return view('admin.settings.custom_code', compact('settings', 'title'));
}

public function updateCustomCode(Request $request)
{
    $request->validate([
        'header_code' => 'nullable|string',
        'footer_code' => 'nullable|string',
    ]);

    // Process and save the header_code and footer_code
    $codes = ['header_code', 'footer_code'];
    foreach ($codes as $code) {
        Setting::updateOrCreate(['key' => $code], ['value' => $request->input($code)]);
    }

    sweetalert()->success('Custom Code settings updated successfully.');
    return redirect()->route('admin.settings.custom_code');
}


public function email()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $title = 'Email Settings';
        return view('admin.settings.email', compact('settings', 'title'));
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email_method' => 'required|string|in:phpmailer,smtp',
            'smtp_host' => 'nullable|required_if:email_method,smtp|string|max:255',
            'smtp_port' => 'nullable|required_if:email_method,smtp|integer',
            'smtp_username' => 'nullable|required_if:email_method,smtp|string|max:255',
            'smtp_password' => 'nullable|required_if:email_method,smtp|string|max:255',
            'smtp_encryption' => 'nullable|required_if:email_method,smtp|string|in:none,ssl,tls',
            'smtp_from_email' => 'required|email|max:255',
            'smtp_from_name' => 'required|string|max:255',
        ]);

        $data = $request->only([
            'email_method', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption', 'smtp_from_email', 'smtp_from_name'
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        sweetalert()->success('Email settings updated successfully.');
        return redirect()->route('admin.settings.email');
    }

    public function testEmail(Request $request)
{
    $request->validate([
        'test_email' => 'required|email',
    ]);

    $email = $request->input('test_email');

    try {
        Mail::raw('This is a test email to verify your email settings.', function ($message) use ($email) {
            $message->to($email)
                    ->subject('Test Email');
        });

        

        sweetalert()->success('Test email sent successfully to ' . $email);
    } catch (Exception $e) {
        sweetalert()->error('Failed to send test email. Please check your email settings and try again.');
    }

    return back();
}


}