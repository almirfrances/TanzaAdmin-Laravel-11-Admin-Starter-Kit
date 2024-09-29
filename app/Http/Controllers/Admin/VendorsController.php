<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorsController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::when($request->search, function ($query) use ($request) {
            return $query->where('username', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->simplePaginate(12);

        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendors.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:vendors',
            'email' => 'required|string|email|max:255|unique:vendors',
            'phone' => 'required|string|max:255|unique:vendors',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        Vendor::create($data);

        sweetalert('Vendor created successfully.');

        return redirect()->route('admin.vendors.index');
    }


    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.form', compact('vendor'));
    }





    public function update(Request $request, Vendor $vendor)
{
    $request->validate([
        'vendor_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:vendors,username,' . $vendor->id,
        'email' => 'required|string|email|max:255|unique:vendors,email,' . $vendor->id,
        'phone' => 'required|string|max:255|unique:vendors,phone,' . $vendor->id,
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

    $vendor->update($data);

    sweetalert('Vendor updated successfully.');

    return redirect()->route('admin.vendors.index');
}


    public function destroy(Vendor $vendor)
    {

        $vendor->delete();

        sweetalert('Vendor deleted successfully.');

        return redirect()->route('admin.vendors.index');
    }
}
