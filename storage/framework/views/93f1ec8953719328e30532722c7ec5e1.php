<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('app'); ?>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Login Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4 mt-2">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bold ms-1"><?php echo e($settings['site_name']); ?></span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <!-- Welcome Message -->
                    <h4 class="mb-1 pt-2">Welcome to <?php echo e($settings['site_name']); ?>! 👋</h4>
                    <p class="mb-4">Please sign in to your account and start the adventure.</p>

                    <!-- Login Form -->
                    <form id="formAuthentication" class="mb-3" action="<?php echo e(route('admin.login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <!-- Email or Username Input -->
                        <div class="mb-3">
                            <label for="email-username" class="form-label">Email or Username</label>
                            <input type="text" class="form-control" id="email-username" name="email-username"
                                   placeholder="Enter your email or username" autofocus />
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>

                        <!-- Sign In Button -->
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login Card -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>