<?php $__env->startSection('title', isset($university) ? 'Edit University' : 'Create University'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4"><?php echo e(isset($university) ? 'Edit University' : 'Create University'); ?></h4>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(isset($university) ? route('admin.universities.update', $university) : route('admin.universities.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($university)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="row mb-3">
                    <!-- University Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">University Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', isset($university) ? $university->name : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($university) ? 'Edit the university name.' : 'Enter the university name.'); ?></small>
                    </div>

                    <!-- Username -->
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo e(old('username', isset($university) ? $university->username : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($university) ? 'Edit the username for this university.' : 'Enter a unique username for the new university.'); ?></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', isset($university) ? $university->email : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($university) ? 'Update the email address for this university.' : 'Provide a valid email address for the new university.'); ?></small>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo e(old('phone', isset($university) ? $university->phone : '')); ?>" required>
                        <small class="form-text text-muted"><?php echo e(isset($university) ? 'Update the phone number for this university.' : 'Provide a valid phone number for the new university.'); ?></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Street Address -->
                    <div class="col-md-4">
                        <label for="address" class="form-label">Street Address</label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo e(old('address', isset($university) ? $university->address : '')); ?>">
                        <small class="form-text text-muted"><?php echo e(isset($university) ? 'Edit the address for this university.' : 'Enter the street address for the new university.'); ?></small>
                    </div>
                    <!-- City -->
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php echo e(old('city', isset($university) ? $university->city : '')); ?>">
                    </div>

                    <!-- State -->
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text" id="state" name="state" class="form-control" value="<?php echo e(old('state', isset($university) ? $university->state : '')); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Postal Code -->
                    <div class="col-md-6">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control" value="<?php echo e(old('postal_code', isset($university) ? $university->postal_code : '')); ?>">
                    </div>
                    <!-- Country -->
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" id="country" name="country" class="form-control" value="<?php echo e(old('country', isset($university) ? $university->country : '')); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Password -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" <?php echo e(isset($university) ? '' : 'required'); ?>>
                        <small class="form-text text-muted"><?php echo e(isset($university) ? 'Leave empty to keep the current password.' : 'Enter a strong password for the new university.'); ?></small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" <?php echo e(isset($university) ? '' : 'required'); ?>>
                        <small class="form-text text-muted">Please confirm the password.</small>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" <?php echo e(isset($university) && $university->status == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(isset($university) && $university->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                    <small class="form-text text-muted">Set the university's account status.</small>
                </div>

                <button type="submit" class="btn btn-primary mt-3"><?php echo e(isset($university) ? 'Update' : 'Create'); ?></button>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/universities/form.blade.php ENDPATH**/ ?>