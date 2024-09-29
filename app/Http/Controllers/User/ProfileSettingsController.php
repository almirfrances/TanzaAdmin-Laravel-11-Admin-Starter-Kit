<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileSettingsController extends Controller
{
    protected function getAuthenticatedUser()
    {
        if (Auth::guard('vendor')->check()) {
            return Auth::guard('vendor')->user();
        } else {
            return Auth::guard('web')->user();
        }
    }

    public function account()
    {
        $title = 'Account Settings';
        $user = $this->getAuthenticatedUser();
        return view('user.settings.account', compact('title', 'user'));
    }

    public function updateAccount(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        // Define base validation rules
        $rules = [
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
        ];

        // Add rules specific to the user type
        if ($user instanceof User) {
            $rules = array_merge($rules, [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|string|unique:users,phone,' . $user->id,
            ]);
        } elseif ($user instanceof Vendor) {
            $rules = array_merge($rules, [
                'vendor_name' => 'required|string|max:255',
                'email' => 'required|email|unique:vendors,email,' . $user->id,
                'phone' => 'required|string|unique:vendors,phone,' . $user->id,
            ]);
        }

        $request->validate($rules);

        // Update common fields
        $data = $request->except(['profile_image']);
        $user->update($data);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                File::delete(public_path('images/profile/' . $user->profile_image));
            }

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/profile'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        sweetalert('Profile updated successfully.');
        return back();
    }

    public function deactivateAccount(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $user->status = 'inactive';
        $user->save();

        Auth::logout();
        sweetalert('Account deactivated successfully.');
        return redirect()->route('user.login');
    }













    public function security()
    {
        $title = 'Security Settings';
        return view('user.settings.security', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $user = $this->getAuthenticatedUser();

        // Check current password
        if (!Hash::check($request->currentPassword, $user->password)) {
            sweetalert()->error('Current password is incorrect.');
            return back();
        }

        // Update password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        sweetalert('Password updated successfully.');
        return back();
    }







}
