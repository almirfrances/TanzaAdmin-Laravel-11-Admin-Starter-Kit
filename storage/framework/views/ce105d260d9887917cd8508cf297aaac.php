<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('user'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <?php if (\Illuminate\Support\Facades\Blade::check('isUser')): ?>
    <h4 class="mb-4">User Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the User dashboard. Below is a quick overview of your account.
    </p>



           <!-- University Selection Popup -->
    <?php if(is_null($user->university_id)): ?>
    <div class="col-lg-4 col-md-6">
        <small class="text-light fw-medium">Select Your University</small>
        <div class="mt-3">
            <!-- Modal -->
            <div class="modal fade" id="universityModal" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Select Your University</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('user.select.university')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="university" class="form-label">Choose your university</label>
                                    <select name="university_id" id="university" class="form-control" required>
                                        <option value="">Select University</option>
                                        <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $university): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($university->id); ?>"><?php echo e($university->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>

<!-- JavaScript to auto-launch modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if(is_null($user->university_id)): ?>
        var myModal = new bootstrap.Modal(document.getElementById('universityModal'), {
            keyboard: false
        });
        myModal.show();
    <?php endif; ?>
});
</script>

    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('isVendor')): ?>
    <h4 class="mb-4">Vendor Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the Vendor dashboard. Below is a quick overview of your account.
    </p>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('isUniversity')): ?>
    <h4 class="mb-4">University Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the University dashboard. Below is a quick overview of your account.
    </p>
    <?php endif; ?>

    <div class="row g-4">





    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/user/dashboard/index.blade.php ENDPATH**/ ?>