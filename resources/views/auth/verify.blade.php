@extends('admin.layouts.app')
@section('title', $title)

@section('app')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/illustrations/auth-two-step-illustration-light.png') }}" alt="auth-two-steps-cover" class="img-fluid my-5 auth-illustration">
                <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-two-steps-cover" class="platform-bg">
            </div>
        </div>

        <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
            <div class="w-px-400 mx-auto">
                <div class="app-brand mb-4">
                    <a href="{{ url('/') }}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo -->
                        </span>
                    </a>
                </div>
                <h4 class="mb-1">Two Step Verification 💬</h4>
                <p class="text-start mb-4">
                    We sent a verification code to your email. Enter the code in the field below.
                </p>

                <form id="verifyForm" method="POST" action="{{ route('verify.email.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                            <input type="tel" class="form-control auth-input h-px-50 text-center mx-1 my-2 verification-code-input" maxlength="1" required>
                            <input type="tel" class="form-control auth-input h-px-50 text-center mx-1 my-2 verification-code-input" maxlength="1" required>
                            <input type="tel" class="form-control auth-input h-px-50 text-center mx-1 my-2 verification-code-input" maxlength="1" required>
                            <input type="tel" class="form-control auth-input h-px-50 text-center mx-1 my-2 verification-code-input" maxlength="1" required>
                            <input type="tel" class="form-control auth-input h-px-50 text-center mx-1 my-2 verification-code-input" maxlength="1" required>
                            <input type="tel" class="form-control auth-input h-px-50 text-center mx-1 my-2 verification-code-input" maxlength="1" required>
                            <input type="hidden" id="verification_code" name="verification_code">
                        </div>
                    </div>
                    <button type="submit" id="verifyButton" class="btn btn-primary d-grid w-100">Verify my account</button>
                </form>

                <div class="text-center mt-3">
                    Didn't get the code?
                    <form id="resendForm" method="POST" action="{{ route('resend.code') }}">
                        @csrf
                        <button type="submit" id="resendButton" class="btn btn-link">Resend</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputs = document.querySelectorAll('.verification-code-input');
        const hiddenInput = document.getElementById('verification_code');
        const verifyButton = document.getElementById('verifyButton');
        const resendButton = document.getElementById('resendButton');
        const verifyForm = document.getElementById('verifyForm');
        const resendForm = document.getElementById('resendForm');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    } else {
                        let code = '';
                        inputs.forEach(i => {
                            code += i.value;
                        });
                        hiddenInput.value = code;
                    }
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        verifyForm.addEventListener('submit', function (e) {
            e.preventDefault();
            verifyButton.disabled = true;
            verifyButton.innerHTML = `
                <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                Loading...
            `;
            this.submit(); // Submit the form after updating the button
        });

        resendForm.addEventListener('submit', function (e) {
            e.preventDefault();
            resendButton.disabled = true;
            resendButton.innerHTML = `
                <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                Resending...
            `;
            this.submit(); // Submit the form after updating the button
        });
    });
</script>
@endsection
