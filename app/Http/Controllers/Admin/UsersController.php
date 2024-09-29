<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($query) use ($request) {
            return $query->where('username', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->simplePaginate(12);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        User::create($data);

        sweetalert('User created successfully.');

        return redirect()->route('admin.users.index');
    }


    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }





    public function update(Request $request, User $user)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'status' => 'required|string|in:active,inactive',
    ]);

    $data = $request->except('password');

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    sweetalert('User updated successfully.');

    return redirect()->route('admin.users.index');
}


    public function destroy(User $user)
    {

        $user->delete();

        sweetalert('User deleted successfully.');

        return redirect()->route('admin.users.index');
    }
}