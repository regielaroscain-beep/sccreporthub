
<?php $__env->startSection('title', 'Facilities'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-building me-2 text-primary"></i>Facilities Management</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacilityModal">
        <i class="fas fa-plus me-2"></i>Add Facility
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="facilitiesTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Building Name</th>
                        <th>Room Number</th>
                        <th>Floor</th>
                        <th>Description</th>
                        <th>Tickets</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td class="fw-semibold"><?php echo e($facility->building_name); ?></td>
                        <td><?php echo e($facility->room_number ?? '—'); ?></td>
                        <td><?php echo e($facility->floor ?? '—'); ?></td>
                        <td><?php echo e($facility->description ?? '—'); ?></td>
                        <td><span class="badge bg-primary"><?php echo e($facility->tickets_count); ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editFacilityModal<?php echo e($facility->id); ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" action="<?php echo e(route('admin.facilities.destroy', $facility)); ?>" class="d-inline" onsubmit="return confirm('Delete this facility?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editFacilityModal<?php echo e($facility->id); ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <form method="POST" action="<?php echo e(route('admin.facilities.update', $facility)); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Facility</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Building Name <span class="text-danger">*</span></label>
                                            <input type="text" name="building_name" class="form-control" value="<?php echo e($facility->building_name); ?>" required>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label">Room Number</label>
                                                <input type="text" name="room_number" class="form-control" value="<?php echo e($facility->room_number); ?>">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Floor</label>
                                                <input type="text" name="floor" class="form-control" value="<?php echo e($facility->floor); ?>">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="2"><?php echo e($facility->description); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">No facilities found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($facilities->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($facilities->links()); ?></div>
    <?php endif; ?>
</div>

<!-- Add Facility Modal -->
<div class="modal fade" id="addFacilityModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('admin.facilities.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Add Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Building Name <span class="text-danger">*</span></label>
                        <input type="text" name="building_name" class="form-control <?php $__errorArgs = ['building_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('building_name')); ?>" required>
                        <?php $__errorArgs = ['building_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Room Number</label>
                            <input type="text" name="room_number" class="form-control" value="<?php echo e(old('room_number')); ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Floor</label>
                            <input type="text" name="floor" class="form-control" value="<?php echo e(old('floor')); ?>">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2"><?php echo e(old('description')); ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Add Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>$(document).ready(function() { $('#facilitiesTable').DataTable({ paging: false, searching: true, info: false, order: [] }); });</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/facilities/index.blade.php ENDPATH**/ ?>