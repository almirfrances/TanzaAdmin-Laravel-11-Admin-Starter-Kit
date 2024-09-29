@extends('admin.layouts.app')

@section('title', $title)

@section('app')
<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-reset-password-illustration-light.png') }}" alt="auth-reset-password-cover" class="img-fluid my-5 auth-illustration">
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-reset-password-cover" class="platform-bg">
      </div>
    </div>

    <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
      <div class="w-px-400 mx-auto">
        <div class="app-brand mb-4">
          <a href="{{ route('user.dashboard') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
              <!-- SVG Logo -->
            </span>
          </a>
        </div>
        <h4 class="mb-1">Reset Password 🔒</h4>
        <p class="mb-4">Please enter your new password below.</p>
        <form id="resetPasswordForm" method="POST" action="{{ route('user.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}"> <!-- Hidden email input -->
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">New Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="············" required>
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="············" required>
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" id="resetPasswordButton" class="btn btn-primary d-grid w-100">Set new password</button>
        </form>

        <div class="text-center">
          <a href="{{ route('user.login') }}">
            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
            Back to login
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function (e) {
        let resetPasswordButton = document.getElementById('resetPasswordButton');
        resetPasswordButton.disabled = true;
        resetPasswordButton.innerHTML = `
            <button class="btn btn-primary waves-effect waves-light" type="button" disabled="">
                <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        `;
    });
</script>
@endsection
