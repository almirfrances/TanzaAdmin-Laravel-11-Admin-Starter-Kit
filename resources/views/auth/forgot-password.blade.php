@extends('admin.layouts.app')

@section('title', $title)

@section('app')
<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-forgot-password-illustration-light.png') }}" alt="auth-forgot-password-cover" class="img-fluid my-5 auth-illustration">
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-forgot-password-cover" class="platform-bg">
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
        <h3 class="mb-1">Forgot Password? 🔒</h3>
        <p class="mb-4">Enter your email, username, or phone and we'll send you instructions to reset your password</p>
        <form id="forgotPasswordForm" method="POST" action="{{ route('user.password.email') }}">
          @csrf
          <div class="mb-3">
            <label for="email_username_phone" class="form-label">Email, Username, or Phone</label>
            <input type="text" class="form-control" id="email_username_phone" name="email_username_phone" placeholder="Enter your email, username, or phone" required autofocus>
            @error('email_username_phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" id="forgotPasswordButton" class="btn btn-primary d-grid w-100">Send Reset Link</button>
        </form>
        <div class="text-center">
          <a href="{{ route('user.login') }}" class="d-flex align-items-center justify-content-center">
            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
            Back to login
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', function (e) {
        let forgotPasswordButton = document.getElementById('forgotPasswordButton');
        forgotPasswordButton.disabled = true;
        forgotPasswordButton.innerHTML = `
            <button class="btn btn-primary waves-effect waves-light" type="button" disabled="">
                <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        `;
    });
</script>
@endsection
