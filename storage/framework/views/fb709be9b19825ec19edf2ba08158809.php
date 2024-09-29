<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Custom Code Settings</h4>
            <p class="text-muted">
                Add or update custom JavaScript codes for the site. These scripts can be used for tracking, analytics, or custom functionalities across your website.
            </p>
        </div>
    </div>

    <form action="<?php echo e(route('admin.settings.custom_code.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row g-4">

            <!-- Header JavaScript -->
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Header JavaScript</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="header_code" class="form-label">Header Code</label>
                            <textarea class="form-control code" id="header_code" name="header_code" rows="5" style="font-family: monospace;"><?php echo e($settings['header_code'] ?? ''); ?></textarea>
                            <small class="form-text text-muted">
                                Paste your custom JavaScript code that you want to load in the header of every page. This is typically used for tracking codes like Google Analytics, Google Tag Manager, or other header scripts that need to load early.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer JavaScript -->
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Footer JavaScript</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="footer_code" class="form-label">Footer Code</label>
                            <textarea class="form-control code" id="footer_code" name="footer_code" rows="5" style="font-family: monospace;"><?php echo e($settings['footer_code'] ?? ''); ?></textarea>
                            <small class="form-text text-muted">
                                Paste your custom JavaScript code that you want to load in the footer of every page. This section is typically used for live chat scripts, additional analytics, or scripts that don’t need to load immediately.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary waves-effect waves-light me-2">
                <i class="ti ti-check me-1"></i> Update Settings
            </button>
            <button type="button" class="btn btn-label-secondary waves-effect" onclick="window.history.back();">
                <i class="ti ti-arrow-left me-1"></i> Cancel
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/settings/custom_code.blade.php ENDPATH**/ ?>