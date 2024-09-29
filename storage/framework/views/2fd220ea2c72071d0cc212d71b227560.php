<?php $__env->startSection('title', 'Message Details'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Message Details</h4>
            <p class="text-muted">
                Review the details of the message sent by the user. You can see the sender's information, subject, and the full message content.
            </p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label"><strong>Name</strong></label>
                <p class="text-muted"><?php echo e($message->name); ?></p>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label"><strong>Email</strong></label>
                <p class="text-muted"><?php echo e($message->email); ?></p>
            </div>

            <!-- Subject -->
            <div class="mb-3">
                <label class="form-label"><strong>Subject</strong></label>
                <p class="text-muted"><?php echo e($message->subject); ?></p>
            </div>

            <!-- Message -->
            <div class="mb-3">
                <label class="form-label"><strong>Message</strong></label>
                <p class="text-muted"><?php echo e($message->message); ?></p>
            </div>

            <div class="d-flex justify-content-center">
                <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-primary waves-effect waves-light me-2">
                    <i class="ti ti-arrow-left me-1"></i> Back to Messages
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/messages/show.blade.php ENDPATH**/ ?>