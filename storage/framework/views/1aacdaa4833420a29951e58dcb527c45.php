<?php $__env->startSection('title', 'Messages'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="mb-4">Messages</h4>
    <p class="text-muted">
        View, manage, and respond to messages received through your website. Keep track of communication and ensure no message goes unanswered.
    </p>

    <!-- Cards for Messages Overview -->
    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <!-- Opened Messages Card -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                            <div>
                                <h6 class="mb-2">Opened Messages</h6>
                                <h4 class="mb-2"><?php echo e($openedMessagesCount); ?></h4>
                                <p class="mb-0">
                                    <span class="text-muted me-2">Messages viewed</span>
                                    <span class="badge bg-label-success">Up to Date</span>
                                </p>
                            </div>
                            <span class="avatar me-sm-4">
                                <span class="avatar-initial bg-label-secondary rounded">
                                    <i class="ti-md ti ti-mail-opened text-body"></i>
                                </span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>

                    <!-- Unread Messages Card -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                            <div>
                                <h6 class="mb-2">Unread Messages</h6>
                                <h4 class="mb-2"><?php echo e($unreadMessagesCount); ?></h4>
                                <p class="mb-0">
                                    <span class="text-muted me-2">Messages yet to be viewed</span>
                                    <span class="badge bg-label-danger">Action Needed</span>
                                </p>
                            </div>
                            <span class="avatar p-2 me-lg-4">
                                <span class="avatar-initial bg-label-secondary rounded">
                                    <i class="ti-md ti ti-mail text-body"></i>
                                </span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>

                    <!-- Total Messages Card -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h6 class="mb-2">Total Messages</h6>
                                <h4 class="mb-2"><?php echo e($totalMessagesCount); ?></h4>
                                <p class="mb-0 text-muted">All messages received</p>
                            </div>
                            <span class="avatar p-2 me-sm-4">
                                <span class="avatar-initial bg-label-secondary rounded">
                                    <i class="ti-md ti ti-inbox text-body"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Messages</h5>


        </div>

        <div class="card-datatable table-responsive">
            <table class="table table-hover" id="messages-table">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="messages-tbody">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if(!$message->is_opened): ?>
                                    <div class="badge bg-danger rounded-pill ms-auto">New</div>
                                <?php else: ?>
                                    <div class="badge bg-primary rounded-pill ms-auto">Opened</div>
                                <?php endif; ?>
                                <?php echo e($message->name); ?>

                            </td>

                            <td><?php echo e($message->email); ?></td>
                            <td><?php echo e($message->subject); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.messages.show', $message->id)); ?>" class="btn btn-info btn-sm">
                                    <i class="ti ti-eye me-1"></i> View
                                </a>
                                <form action="<?php echo e(route('admin.messages.destroy', $message->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">
                                        <i class="ti ti-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php if($messages->isEmpty()): ?>
                <div class="text-center py-4">
                    <h5 class="text-muted">No messages found</h5>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-center mt-4">
                <?php echo e($messages->links('vendor.pagination.bootstrap-5')); ?>

            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/messages/index.blade.php ENDPATH**/ ?>