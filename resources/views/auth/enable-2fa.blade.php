@extends('admin.layouts.app')

@section('title', 'Enable Two-Factor Authentication')

@section('app')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/illustrations/auth-verify-email-illustration-light.png') }}" alt="auth-verify-email-cover" class="img-fluid my-5 auth-illustration">
                <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-verify-email-cover" class="platform-bg">
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
                <h3 class="mb-1">Enable Two-Factor Authentication</h3>
                <p class="text-start mb-4">
                    Scan the QR code with your authenticator app and enter the generated code below to enable 2FA. If you prefer, you can manually enter the secret key instead of scanning the QR code.
                </p>
                <div class="text-center mb-4">
                    {!! $QR_Image !!}
                </div>
                <div class="text-center mb-4">
                    <p>Or manually enter this code: <strong>{{ $secret }}</strong></p>
                </div>
                <form id="verify2FAForm" method="POST" action="{{ route('user.2fa.verify') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="2fa_code" class="form-label">Authentication Code</label>
                        <input type="text" class="form-control" id="2fa_code" name="2fa_code" placeholder="Enter the code" required autofocus>
                        @error('2fa_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" id="verify2FAButton" class="btn btn-primary d-grid w-100">Enable 2FA</button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary d-grid w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('verify2FAForm').addEventListener('submit', function (e) {
        let verify2FAButton = document.getElementById('verify2FAButton');
        verify2FAButton.disabled = true;
        verify2FAButton.innerHTML = `
            <button class="btn btn-primary waves-effect waves-light" type="button" disabled="">
                <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        `;
    });
</script>
@endsection
