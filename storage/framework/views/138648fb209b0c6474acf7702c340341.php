<!-- resources/views/admin/settings/index.blade.php -->


<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Settings</h4>
    <p class="mb-4">
        Here you can manage all the essential settings of your application. Customize your site's appearance, behavior, and more to suit your needs.
    </p>
    <div class="row g-4">

        <!-- General Settings Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center mb-3 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title mb-2">General Settings</h5>
                        <p class="card-text text-muted small">Manage the general settings of the site, including site title, description, and more.</p>
                    </div>
                    <a href="<?php echo e(route('admin.settings.general')); ?>" class="btn btn-primary mt-auto waves-effect waves-light">
                        <i class="ti ti-settings me-1"></i> View General Settings
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center mb-3 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title mb-2">Email Settings</h5>
                        <p class="card-text text-muted small">Configure outgoing email settings such as SMTP server, email templates, and more.</p>
                    </div>
                    <a href="<?php echo e(route('admin.settings.email')); ?>" class="btn btn-primary mt-auto waves-effect waves-light">
                        <i class="ti ti-mail me-1"></i> View Email Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Logo Settings Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center mb-3 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title mb-2">Logo Settings</h5>
                        <p class="card-text text-muted small">Update and manage the logos and branding images used across the site.</p>
                    </div>
                    <a href="<?php echo e(route('admin.settings.logo')); ?>" class="btn btn-primary mt-auto waves-effect waves-light">
                        <i class="ti ti-picture-in-picture me-1"></i> View Logo Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Custom Code Settings Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center mb-3 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title mb-2">Custom Code</h5>
                        <p class="card-text text-muted small">Insert custom HTML, CSS, or JavaScript code to modify your site's appearance or behavior.</p>
                    </div>
                    <a href="<?php echo e(route('admin.settings.custom_code')); ?>" class="btn btn-primary mt-auto waves-effect waves-light">
                        <i class="ti ti-code me-1"></i> View Custom Code
                    </a>
                </div>
            </div>
        </div>





    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>