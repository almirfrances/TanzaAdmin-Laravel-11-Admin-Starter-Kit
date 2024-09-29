<?php $__env->startSection('title', isset($user) ? 'Edit User' : 'Create User'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4"><?php echo e(isset($user) ? 'Edit User' : 'Create User'); ?></h4>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(isset($user) ? route('admin.users.update', $user) : route('admin.users.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($user)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="row mb-3">
                    <!-- Full Name -->
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo e(old('full_name', isset($user) ? $user->full_name : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($user) ? 'Edit the full name for this user.' : 'Enter the full name for the new user.'); ?></small>
                    </div>

                    <!-- Username -->
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo e(old('username', isset($user) ? $user->username : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($user) ? 'Edit the username for this user.' : 'Enter a unique username for the new user.'); ?></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', isset($user) ? $user->email : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($user) ? 'Update the email address for this user.' : 'Provide a valid email address for the new user.'); ?></small>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo e(old('phone', isset($user) ? $user->phone : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($user) ? 'Update the phone number for this user.' : 'Provide a valid phone number for the new user.'); ?></small>
                    </div>
                </div>





                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="address" class="form-label">Streat Address</label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo e(old('address', isset($user) ? $user->address : '')); ?>">
                        <small class="form-text text-muted"><?php echo e(isset($user) ? 'Edit the address for this user.' : 'Enter the street address for the new user.'); ?></small>
                    </div>
                    <!-- City -->
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php echo e(old('city', isset($user) ? $user->city : '')); ?>">
                    </div>

                    <!-- State -->
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text" id="state" name="state" class="form-control" value="<?php echo e(old('state', isset($user) ? $user->state : '')); ?>">
                    </div>


                </div>

                <div class="row mb-3">
                    <!-- Postal Code -->
                    <div class="col-md-6">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control" value="<?php echo e(old('postal_code', isset($user) ? $user->postal_code : '')); ?>">
                    </div>
                    <!-- Country -->
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" id="country" name="country" class="form-control" value="<?php echo e(old('country', isset($user) ? $user->country : '')); ?>">
                    </div>


                </div>


                <div class="row mb-3">
                    <!-- Password -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" <?php echo e(isset($user) ? '' : 'required'); ?>>
                        <small class="form-text text-muted"><?php echo e(isset($user) ? 'Leave empty to keep the current password.' : 'Enter a strong password for the new user.'); ?></small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" <?php echo e(isset($user) ? '' : 'required'); ?>>
                        <small class="form-text text-muted">Please confirm the password.</small>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" <?php echo e(isset($user) && $user->status == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(isset($user) && $user->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                    <small class="form-text text-muted">Set the user's account status.</small>
                </div>

                <button type="submit" class="btn btn-primary mt-3"><?php echo e(isset($user) ? 'Update' : 'Create'); ?></button>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/users/form.blade.php ENDPATH**/ ?>