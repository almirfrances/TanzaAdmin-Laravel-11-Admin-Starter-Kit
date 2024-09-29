@extends('admin.layouts.app')

@section('title', $title)

@section('app')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/illustrations/auth-login-illustration-light.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration">
                <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg">
            </div>
        </div>

        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <div class="app-brand mb-4">
                    <a href="{{ url('/') }}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo -->
                        </span>
                    </a>
                </div>
                <h3 class="mb-1">Welcome! 👋</h3>
                <p class="mb-4">Please sign in to your account.</p>

                <form id="loginForm" method="POST" action="{{ route('user.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email_username_phone" class="form-label">Email, Username, or Phone</label>
                        <input type="text" class="form-control" id="email_username_phone" name="email_username_phone" placeholder="Enter your email, username, or phone" required autofocus>
                        @error('email_username_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="············" required>
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('user.password.request') }}" class="text-primary">Forgot Password?</a>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                        </div>
                    </div>
                    <button type="submit" id="loginButton" class="btn btn-primary d-grid w-100">Sign in</button>
                </form>

                <p class="text-center mt-3">
                    <span>New on our platform?</span>
                    <a href="{{ route('user.register') }}">
                        <span>Create an account</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let loginButton = document.getElementById('loginButton');
        let originalButtonContent = loginButton.innerHTML;

        loginButton.disabled = true;
        loginButton.innerHTML = `
             <button class="btn btn-primary waves-effect waves-light" type="button" disabled="">
                    <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
        `;

        let form = e.target;
        let formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Login successful!',
                    text: 'Redirecting to your dashboard...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = data.redirect;
                });
            } else {
                loginButton.disabled = false;
                loginButton.innerHTML = originalButtonContent;

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'These credentials do not match our records.',
                });

                if (data.errors) {
                    for (const [key, value] of Object.entries(data.errors)) {
                        let input = document.getElementById(key);
                        if (input) {
                            let errorElement = document.createElement('span');
                            errorElement.classList.add('text-danger');
                            errorElement.innerHTML = value[0];
                            input.closest('.mb-3').appendChild(errorElement);
                        }
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loginButton.disabled = false;
            loginButton.innerHTML = originalButtonContent;


        });
    });
</script>
@endsection
