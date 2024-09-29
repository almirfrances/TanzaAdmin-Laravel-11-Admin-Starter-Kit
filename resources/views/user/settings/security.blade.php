@extends('user.layouts.user')

@section('title', $title)

@section('user')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Security</h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                @isUser
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.settings.account') }}"><i class="ti-xs ti ti-users me-1"></i> Account</a>
                </li>
                @endisUser

                @isVendor
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vendor.settings.account') }}"><i class="ti-xs ti ti-users me-1"></i> Account</a>
                </li>
                @endisVendor

              
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-lock me-1"></i> Security</a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    @isUser
                    <form action="{{ route('user.settings.updatePassword') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="············" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="············" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="newPassword_confirmation" id="confirmPassword" placeholder="············" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <h6>Password Requirements:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                            </div>
                        </div>
                    </form>
                    @endisUser
                    @isVendor
                    <form action="{{ route('vendor.settings.updatePassword') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="············" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="············" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="newPassword_confirmation" id="confirmPassword" placeholder="············" required>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <h6>Password Requirements:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                            </div>
                        </div>
                    </form>
                    @endisVendor


                </div>
            </div>

           <!-- Two-steps verification -->
{{-- <div class="card mb-4">
    <h5 class="card-header">Two-steps verification</h5>
    <div class="card-body">
        @if (Auth::user()->google2fa_secret)
            <h5 class="mb-3">Two-factor authentication is currently enabled.</h5>
            <p class="w-75">
                Two-factor authentication adds an additional layer of security to your account by requiring more
                than just a password to log in.
            </p>
            <form action="{{ route('user.2fa.disable') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mt-2 waves-effect waves-light">
                    Disable two-factor authentication
                </button>
            </form>
        @else
            <h5 class="mb-3">Two-factor authentication is not enabled yet.</h5>
            <p class="w-75">
                Two-factor authentication adds an additional layer of security to your account by requiring more
                than just a password to log in.
            </p>
            <a href="{{ route('user.2fa.enable') }}" class="btn btn-primary mt-2 waves-effect waves-light">
                Enable two-factor authentication
            </a>
        @endif
    </div>
</div> --}}


            <!-- Recent Devices -->
            <div class="card mb-4">
                <h5 class="card-header">Recent Devices</h5>
                <div class="table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th>Browser</th>
                                <th>Device</th>
                                <th>Location</th>
                                <th>Recent Activities</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- List recent devices here -->
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
