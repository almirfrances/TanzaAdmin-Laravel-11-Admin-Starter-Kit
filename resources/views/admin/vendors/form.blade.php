@extends('admin.layouts.admin')

@section('title', isset($vendor) ? 'Edit Vendor' : 'Create Vendor')

@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">{{ isset($vendor) ? 'Edit Vendor' : 'Create Vendor' }}</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ isset($vendor) ? route('admin.vendors.update', $vendor) : route('admin.vendors.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($vendor))
                        @method('PUT')
                    @endif

                    <div class="row mb-3">
                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="vendor_name" class="form-label">Vendor Name</label>
                            <input type="text" id="vendor_name" name="vendor_name" class="form-control"
                                value="{{ old('vendor_name', isset($vendor) ? $vendor->vendor_name : '') }}" required>
                            <small
                                class="form-text text-muted">{{ isset($vendor) ? 'Edit the full name for this vendor.' : 'Enter the full name for the new vendor.' }}</small>
                        </div>

                        <!-- Username -->
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                value="{{ old('username', isset($vendor) ? $vendor->username : '') }}" required>
                            <small
                                class="form-text text-muted">{{ isset($vendor) ? 'Edit the username for this vendor.' : 'Enter a unique username for the new vendor.' }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', isset($vendor) ? $vendor->email : '') }}" required>
                            <small
                                class="form-text text-muted">{{ isset($vendor) ? 'Update the email address for this vendor.' : 'Provide a valid email address for the new vendor.' }}</small>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone', isset($vendor) ? $vendor->phone : '') }}" required>
                            <small
                                class="form-text text-muted">{{ isset($vendor) ? 'Update the phone number for this vendor.' : 'Provide a valid phone number for the new vendor.' }}</small>
                        </div>
                    </div>





                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="address" class="form-label">Streat Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                value="{{ old('address', isset($vendor) ? $vendor->address : '') }}">
                            <small
                                class="form-text text-muted">{{ isset($vendor) ? 'Edit the address for this vendor.' : 'Enter the street address for the new vendor.' }}</small>
                        </div>
                        <!-- City -->
                        <div class="col-md-4">
                            <label for="city" class="form-label">City</label>
                            <input type="text" id="city" name="city" class="form-control"
                                value="{{ old('city', isset($vendor) ? $vendor->city : '') }}">
                        </div>

                        <!-- State -->
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <input type="text" id="state" name="state" class="form-control"
                                value="{{ old('state', isset($vendor) ? $vendor->state : '') }}">
                        </div>


                    </div>

                    <div class="row mb-3">
                        <!-- Postal Code -->
                        <div class="col-md-6">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control"
                                value="{{ old('postal_code', isset($vendor) ? $vendor->postal_code : '') }}">
                        </div>
                        <!-- Country -->
                        <div class="col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" id="country" name="country" class="form-control"
                                value="{{ old('country', isset($vendor) ? $vendor->country : '') }}">
                        </div>


                    </div>


                    <div class="row mb-3">
                        <!-- Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                {{ isset($vendor) ? '' : 'required' }}>
                            <small
                                class="form-text text-muted">{{ isset($vendor) ? 'Leave empty to keep the current password.' : 'Enter a strong password for the new vendor.' }}</small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" {{ isset($vendor) ? '' : 'required' }}>
                            <small class="form-text text-muted">Please confirm the password.</small>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ isset($vendor) && $vendor->status == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ isset($vendor) && $vendor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <small class="form-text text-muted">Set the vendor's account status.</small>
                    </div>

                    <button type="submit"
                        class="btn btn-primary mt-3">{{ isset($vendor) ? 'Update' : 'Create' }}</button>
                </form>

            </div>
        </div>
    </div>
@endsection
