<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Profile Details</h4>
            <p class="text-muted">Update your profile details, change your password, or deactivate your account.</p>
        </div>
    </div>

    <!-- Profile Details Card -->
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <div class="card-body">
            <form id="profilePictureForm" method="POST" action="<?php echo e(route('admin.profile.updatePicture')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="<?php echo e(Auth::guard('admin')->user()->profile ? asset('storage/' . Auth::guard('admin')->user()->profile) : asset('assets/img/avatars/1.png')); ?>" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="ti ti-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" name="profile" accept="image/png, image/jpeg" hidden="">
                        </label>
                        <button type="button" class="btn btn-label-secondary account-image-reset mb-3 waves-effect" id="resetProfilePicture">
                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>
                        <div class="text-muted">Allowed JPG, GIF, or PNG. Max size of 800K</div>
                    </div>
                </div>
            </form>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="<?php echo e(route('admin.profile.update')); ?>" class="fv-plugins-bootstrap5 fv-plugins-framework">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="mb-3 col-md-6 fv-plugins-icon-container">
                        <label for="firstName" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="firstName" name="first_name" value="<?php echo e(Auth::guard('admin')->user()->first_name); ?>" autofocus="">
                    </div>
                    <div class="mb-3 col-md-6 fv-plugins-icon-container">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="lastName" value="<?php echo e(Auth::guard('admin')->user()->last_name); ?>">
                    </div>
                    <div class="mb-3 col-md-6 fv-plugins-icon-container">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo e(Auth::guard('admin')->user()->username); ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" value="<?php echo e(Auth::guard('admin')->user()->email); ?>" placeholder="john.doe@example.com">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                    <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Card -->
    <div class="card mb-4">
        <h5 class="card-header">Change Password</h5>
        <div class="card-body">
            <form id="formPasswordSettings" method="POST" action="<?php echo e(route('admin.profile.updatePassword')); ?>" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="currentPassword">Current Password</label>
                        <div class="input-group input-group-merge has-validation">
                            <input class="form-control" type="password" name="current_password" id="currentPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="newPassword">New Password</label>
                        <div class="input-group input-group-merge has-validation">
                            <input class="form-control" type="password" id="newPassword" name="new_password" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="confirmPassword">Confirm New Password</label>
                        <div class="input-group input-group-merge has-validation">
                            <input class="form-control" type="password" name="new_password_confirmation" id="confirmPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
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
            </form>
        </div>
    </div>

    <!-- Delete Account Card -->
    <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-3 col-12">
                <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" method="POST" action="<?php echo e(route('admin.profile.deactivate')); ?>" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                <?php echo csrf_field(); ?>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                    <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate Account</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('upload').addEventListener('change', function() {
        document.getElementById('profilePictureForm').submit();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>