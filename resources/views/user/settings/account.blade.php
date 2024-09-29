@extends('user.layouts.user')

@section('title', $title)

@section('user')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-users me-1"></i>
                            Account</a>
                    </li>
                    @isUser
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.settings.security') }}"><i
                                    class="ti-xs ti ti-lock me-1"></i> Security</a>
                        </li>
                    @endisUser

                    @isVendor
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vendor.settings.security') }}"><i
                                    class="ti-xs ti ti-lock me-1"></i> Security</a>
                        </li>
                    @endisVendor



                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        @isUser
                            <form action="{{ route('user.settings.updateAccount') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $user->profile_image ? asset('images/profile/' . $user->profile_image) : asset('assets/img/avatars/default.png') }}"
                                        alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light"
                                            tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="profile_image" class="account-file-input"
                                                accept="image/png, image/jpeg" hidden>
                                        </label>
                                        <button type="button"
                                            class="btn btn-label-secondary account-image-reset mb-3 waves-effect"
                                            onclick="resetImage()">
                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <hr class="my-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input class="form-control" type="text" id="full_name" name="full_name"
                                                value="{{ old('full_name', $user->full_name) }}" required>
                                            @error('full_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone', $user->phone) }}" required>
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ old('address', $user->address) }}" required>
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="city" class="form-label">City</label>
                                            <input class="form-control" type="text" id="city" name="city"
                                                value="{{ old('city', $user->city) }}" required>
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="state" class="form-label">State</label>
                                            <input class="form-control" type="text" id="state" name="state"
                                                value="{{ old('state', $user->state) }}" required>
                                            @error('state')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="postal_code" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                                value="{{ old('postal_code', $user->postal_code) }}" required>
                                            @error('postal_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="country" class="form-label">Country</label>
                                            <input class="form-control" type="text" id="country" name="country"
                                                value="Tanzania" readonly>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save
                                            changes</button>
                                        <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        @endisUser



                        @isVendor
                            <form action="{{ route('vendor.settings.updateAccount') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $user->profile_image ? asset('images/profile/' . $user->profile_image) : asset('assets/img/avatars/default.png') }}"
                                        alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light"
                                            tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="profile_image"
                                                class="account-file-input" accept="image/png, image/jpeg" hidden>
                                        </label>
                                        <button type="button"
                                            class="btn btn-label-secondary account-image-reset mb-3 waves-effect"
                                            onclick="resetImage()">
                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <hr class="my-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="vendor_name" class="form-label">Full Name</label>
                                            <input class="form-control" type="text" id="vendor_name" name="vendor_name"
                                                value="{{ old('vendor_name', $user->vendor_name) }}" required>
                                            @error('vendor_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone', $user->phone) }}" required>
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ old('address', $user->address) }}" required>
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="city" class="form-label">City</label>
                                            <input class="form-control" type="text" id="city" name="city"
                                                value="{{ old('city', $user->city) }}" required>
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="state" class="form-label">State</label>
                                            <input class="form-control" type="text" id="state" name="state"
                                                value="{{ old('state', $user->state) }}" required>
                                            @error('state')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="postal_code" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                                value="{{ old('postal_code', $user->postal_code) }}" required>
                                            @error('postal_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="country" class="form-label">Country</label>
                                            <input class="form-control" type="text" id="country" name="country"
                                                value="Tanzania" readonly>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save
                                            changes</button>
                                        <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        @endisVendor







                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <h5 class="card-header">Delete Account</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h5 class="alert-heading mb-1">Are you sure you want to deactivate your account?</h5>
                                    <p class="mb-0">Once you deactivate your account, you will be logged out and your
                                        account will be inactive.</p>
                                </div>
                            </div>
                            @isUser
                                <form action="{{ route('user.settings.deactivateAccount') }}" method="POST">
                                    @csrf
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" name="accountActivation"
                                            id="accountActivation">
                                        <label class="form-check-label" for="accountActivation">I confirm my account
                                            deactivation</label>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate
                                        Account</button>
                                </form>
                            @endisUser

                            @isVendor
                                <form action="{{ route('vendor.settings.deactivateAccount') }}" method="POST">
                                    @csrf
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" name="accountActivation"
                                            id="accountActivation">
                                        <label class="form-check-label" for="accountActivation">I confirm my account
                                            deactivation</label>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate
                                        Account</button>
                                </form>
                            @endisVendor

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadInput = document.getElementById('upload');
            const uploadedAvatar = document.getElementById('uploadedAvatar');
            const accountImageReset = document.querySelector('.account-image-reset');

            if (uploadInput) {
                uploadInput.addEventListener('change', function() {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        uploadedAvatar.src = e.target.result;
                    };
                    reader.readAsDataURL(uploadInput.files[0]);
                });
            }

            if (accountImageReset) {
                accountImageReset.addEventListener('click', function() {
                    uploadedAvatar.src =
                        '{{ $user->profile_image ? asset('images/profile/' . $user->profile_image) : asset('assets/img/avatars/default.png') }}';
                    uploadInput.value = ''; // Reset file input
                });
            }
        });
    </script>
@endsection
