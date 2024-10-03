<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('user'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <?php if (\Illuminate\Support\Facades\Blade::check('isUser')): ?>
    <h4 class="mb-4">User Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the User dashboard. Below is a quick overview of your account.
    </p>




</div>

    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('isVendor')): ?>
    <h4 class="mb-4">Vendor Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the Vendor dashboard. Below is a quick overview of your account.
    </p>
    <?php endif; ?>

   

    <div class="row g-4">





    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TUFF\Documents\Laravel\TanzaAdmin-Laravel-11-Admin-Starter-Kit\resources\views/user/dashboard/index.blade.php ENDPATH**/ ?>