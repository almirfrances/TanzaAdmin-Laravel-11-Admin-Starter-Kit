<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile Settings';
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin', 'title'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($request->only('first_name', 'last_name', 'username', 'email'));

        sweetalert('Profile updated successfully.');

        return redirect()->back();
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($request->hasFile('profile')) {
            // Delete the old profile picture if it exists
            if ($admin->profile) {
                Storage::disk('public')->delete($admin->profile);
            }

            $path = $request->file('profile')->store('profiles', 'public');
            $admin->update(['profile' => $path]);

            sweetalert('Profile picture updated successfully.');

            return redirect()->back();
        }

        sweetalert()->error('Profile picture update failed.');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            sweetalert()->error('Current password is incorrect');
            return back();
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        sweetalert('Password updated successfully.');
        return redirect()->back();
    }

    public function deactivate(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $firstAdmin = Admin::orderBy('id')->first();

        if ($admin->id == $firstAdmin->id) {
            sweetalert()->error('The first admin cannot deactivate their account.');
            return redirect()->back();
        }

        $admin->delete();

        sweetalert()->warning('Account deactivated successfully.');
        return redirect()->route('admin.login');
    }
}