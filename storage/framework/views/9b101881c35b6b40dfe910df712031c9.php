<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('app'); ?>
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="<?php echo e(asset('assets/img/illustrations/auth-register-illustration-light.png')); ?>" alt="auth-register-cover" class="img-fluid my-5 auth-illustration">
                <img src="<?php echo e(asset('assets/img/illustrations/bg-shape-image-light.png')); ?>" alt="auth-register-cover" class="platform-bg">
            </div>
        </div>

        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <div class="app-brand mb-4">
                    <a href="<?php echo e(url('/')); ?>" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo -->
                        </span>
                    </a>
                </div>
                <h3 class="mb-1">Adventure starts here 🚀</h3>
                <p class="mb-4">Make your app management easy and fun!</p>

                <form method="POST" action="<?php echo e(route('user.register')); ?>" id="registerForm">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="user_type" value="user"> 


                    <div class="mb-3">
                        <label for="user_type" class="form-label">Register as a</label>
                        <select class="form-select" id="user_type" name="user_type" required>
                            <option value="" disabled selected>Select your user type</option>
                            <option value="user">User</option>
                            <option value="vendor">Vendor</option>
                            <option value="university">University</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                        <small class="form-text text-muted" id="usernameHelp">Choose a unique username, such as <strong>john_doe123</strong>. It should contain letters, numbers, and underscores only.</small>
                        <div id="usernameFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        <small class="form-text text-muted">Your email will be used for account verification and communication.</small>
                        <div id="emailFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        <small class="form-text text-muted">We might send important updates or security codes to this number.</small>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="············" required>
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        <small class="form-text text-muted">Choose a strong password to keep your account secure.</small>
                        <div id="passwordFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="············" required>
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        <small class="form-text text-muted">Re-enter your password to confirm it’s correct.</small>
                        <div id="confirmPasswordFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">I agree to <a href="#">privacy policy & terms</a></label>
                            <small class="form-text text-muted">Please review and accept our privacy policy and terms.</small>
                        </div>
                    </div>
                    <button type="submit" id="registerButton" class="btn btn-primary d-grid w-100">Sign up</button>
                </form>

                <p class="text-center mt-4">
                    <span>Already have an account?</span>
                    <a href="<?php echo e(route('user.login')); ?>">
                        <span>Sign in instead</span>
                    </a>
                </p>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const registerForm = document.getElementById('registerForm');
        const registerButton = document.getElementById('registerButton');

        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        // Username validation
        usernameInput.addEventListener('input', function () {
            const usernameRegex = /^[a-zA-Z0-9_]+$/;
            if (!usernameRegex.test(this.value)) {
                this.classList.add('is-invalid');
                document.getElementById('usernameFeedback').textContent = 'Username can only contain letters, numbers, and underscores.';
            } else {
                this.classList.remove('is-invalid');
                document.getElementById('usernameFeedback').textContent = '';
            }
        });

        // Email validation
        emailInput.addEventListener('input', function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.value)) {
                this.classList.add('is-invalid');
                document.getElementById('emailFeedback').textContent = 'Please enter a valid email address.';
            } else {
                this.classList.remove('is-invalid');
                document.getElementById('emailFeedback').textContent = '';
            }
        });

        // Password validation
        passwordInput.addEventListener('input', function () {
            if (this.value.length < 8) {
                this.classList.add('is-invalid');
                document.getElementById('passwordFeedback').textContent = 'Password must be at least 8 characters long.';
            } else {
                this.classList.remove('is-invalid');
                document.getElementById('passwordFeedback').textContent = '';
            }
        });

        // Confirm password validation
        confirmPasswordInput.addEventListener('input', function () {
            if (this.value !== passwordInput.value) {
                this.classList.add('is-invalid');
                document.getElementById('confirmPasswordFeedback').textContent = 'Passwords do not match.';
            } else {
                this.classList.remove('is-invalid');
                document.getElementById('confirmPasswordFeedback').textContent = '';
            }
        });

        // Submit form with loading state
        registerForm.addEventListener('submit', function () {
            registerButton.disabled = true;
            registerButton.innerHTML = `
                <button class="btn btn-primary waves-effect waves-light" type="button" disabled="">
                    <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            `;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/auth/register.blade.php ENDPATH**/ ?>