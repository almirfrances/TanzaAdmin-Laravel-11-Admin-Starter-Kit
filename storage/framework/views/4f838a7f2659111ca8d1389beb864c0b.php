<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('admin'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Users</h4>
    <p class="text-muted">Manage your users. Create, edit, or delete users.</p>

    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">Create User</a>

            <form action="<?php echo e(route('admin.users.index')); ?>" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control" placeholder="Search users..." value="<?php echo e(request()->get('search')); ?>">
                <button type="submit" class="btn btn-secondary ms-2">Search</button>
            </form>
        </div>

        <div class="card-datatable table-responsive">
            <table class="table table-hover" id="users-table">
                <thead class="thead-light">
                    <tr>
                        <th>Username</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="d-flex align-items-center">
                                <div class="user-initials">
                                    <?php echo e(strtoupper($user->username[0])); ?>

                                </div>
                                <span class="ms-2"> <strong><?php echo e($user->username); ?></strong> </span>

                                <style>
                                    .user-initials {
                                        width: 30px; /* Adjust size as needed */
                                        height: 30px; /* Adjust size as needed */
                                        background-color: #d12728; /* Placeholder color */
                                        color: white;
                                        font-size: 20px; /* Adjust size as needed */
                                        font-weight: bolder ;
                                        text-transform: uppercase;
                                        display: inline-flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 15%;
                                        object-fit: cover;
                                    }
                                </style>
                            </td>
                            <td><?php echo e($user->phone); ?></td>


                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php if($user->status === 'active'): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>


                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item"
                                                href="<?php echo e(route('admin.users.edit', $user->id)); ?>"><i
                                                    class="ti ti-pencil me-2"></i>Edit</a></li>
                                        <li>
                                            <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="dropdown-item text-danger" type="submit"><i
                                                        class="ti ti-trash me-2"></i>Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php if($users->isEmpty()): ?>
                <div class="text-center py-4">
                    <h5 class="text-muted">No users found</h5>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-center mt-4">
                <?php echo e($users->links('vendor.pagination.simple-bootstrap-4')); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/admin/users/index.blade.php ENDPATH**/ ?>