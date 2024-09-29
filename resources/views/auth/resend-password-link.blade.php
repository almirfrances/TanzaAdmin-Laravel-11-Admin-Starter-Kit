@extends('admin.layouts.app')

@section('title', $title)

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
                <h3 class="mb-1">Resend Password Reset Link ✉️</h3>
                <p class="text-start mb-4">
                    A password reset link has been sent to your email address: {{ session('email') }}. Please check your inbox.
                </p>
                <p class="text-center">
                    Didn't get the email?
                    <form id="resendForm" method="POST" action="{{ route('user.resend.password.link') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <button type="submit" id="resendButton" class="btn btn-primary w-100 mb-3 waves-effect waves-light">Resend</button>
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const resendForm = document.getElementById('resendForm');
        const resendButton = document.getElementById('resendButton');

        resendForm.addEventListener('submit', function (e) {
            resendButton.disabled = true;
            resendButton.innerHTML = `
                <button class="btn btn-link p-0 waves-effect waves-light" type="button" disabled="">
                    <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                    Resending...
                </button>
            `;
        });
    });
</script>
@endsection
