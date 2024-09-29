<!-- resources/views/admin/settings/general.blade.php -->

<?php $__env->startSection('title', 'General Settings'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">General Settings</h4>
            <p class="text-muted">Manage your general settings efficiently</p>
        </div>
    </div>

    <form action="<?php echo e(route('admin.settings.general.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row g-4">
            <!-- Site Information -->
            <div class="col-12 col-lg-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Site Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="site_name">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo e(old('site_name', $settings['site_name'] ?? '')); ?>" required>
                            <small class="form-text text-muted">Enter the name of your site.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="site_email">Site Email</label>
                            <input type="email" class="form-control" id="site_email" name="site_email" value="<?php echo e(old('site_email', $settings['site_email'] ?? '')); ?>" required>
                            <small class="form-text text-muted">Enter the email address for your site.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="site_phone">Site Phone</label>
                            <input type="text" class="form-control" id="site_phone" name="site_phone" value="<?php echo e(old('site_phone', $settings['site_phone'] ?? '')); ?>" required>
                            <small class="form-text text-muted">Enter the phone number for your site (used for calls and WhatsApp chats).</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo e(old('address', $settings['address'] ?? '')); ?>">
                            <small class="form-text text-muted">Enter the address of your site.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="col-12 col-lg-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Social Media Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="facebook_url">Facebook URL</label>
                            <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="<?php echo e(old('facebook_url', $settings['facebook_url'] ?? '')); ?>">
                            <small class="form-text text-muted">Enter the Facebook URL for your site.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="instagram_url">Instagram URL</label>
                            <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="<?php echo e(old('instagram_url', $settings['instagram_url'] ?? '')); ?>">
                            <small class="form-text text-muted">Enter the Instagram URL for your site.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="telegram_url">Telegram URL</label>
                            <input type="url" class="form-control" id="telegram_url" name="telegram_url" value="<?php echo e(old('telegram_url', $settings['telegram_url'] ?? '')); ?>">
                            <small class="form-text text-muted">Enter the Telegram URL for your site.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="twitter_url">Twitter URL</label>
                            <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="<?php echo e(old('twitter_url', $settings['twitter_url'] ?? '')); ?>">
                            <small class="form-text text-muted">Enter the Twitter URL for your site.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appearance -->
            <div class="col-12 col-lg-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Appearance</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="primary_color">Primary Site Color</label>
                            <input type="color" class="form-control" id="primary_color" name="primary_color" value="<?php echo e(old('primary_color', $settings['primary_color'] ?? '')); ?>">
                            <small class="form-text text-muted">Choose the primary color for your site.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="footer_copyright">Footer Copyright</label>
                            <textarea class="form-control" id="footer_copyright" name="footer_copyright"><?php echo e(old('footer_copyright', $settings['footer_copyright'] ?? '')); ?></textarea>
                            <small class="form-text text-muted">Enter the footer copyright text for your site.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary waves-effect waves-light me-2">
                <i class="ti ti-check me-1"></i> Save Changes
            </button>
            <button type="button" class="btn btn-label-secondary waves-effect" onclick="window.history.back();">
                <i class="ti ti-arrow-left me-1"></i> Cancel
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/settings/general.blade.php ENDPATH**/ ?>