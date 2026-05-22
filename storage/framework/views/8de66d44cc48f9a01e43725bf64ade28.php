
<?php $__env->startSection('title', 'View Task Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-screwdriver-wrench me-2 text-primary"></i>View Task Details</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?php echo e(route('maintenance.tasks.index')); ?>">Assigned Maintenance Tasks</a></li>
                <li class="breadcrumb-item active"><?php echo e($ticket->ticket_number); ?></li>
            </ol>
        </nav>
    </div>
    <a href="<?php echo e(route('maintenance.tasks.index')); ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<div class="row g-4">
    <!-- Task Info -->
    <div class="col-md-7">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Task Information</span>
                <div class="d-flex gap-2">
                    <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span>
                    <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="text-muted small">Ticket Number</div>
                        <div class="fw-semibold"><code><?php echo e($ticket->ticket_number); ?></code></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Date Submitted</div>
                        <div><?php echo e($ticket->created_at->format('F d, Y')); ?></div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Title</div>
                        <div class="fw-semibold"><?php echo e($ticket->title); ?></div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Description</div>
                        <div class="p-3 bg-light rounded"><?php echo e($ticket->description); ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Location</div>
                        <div><?php echo e($ticket->facility?->full_location ?? 'Not specified'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Reported By</div>
                        <div><?php echo e($ticket->user->full_name); ?></div>
                        <div class="text-muted small"><?php echo e($ticket->user->contact_number); ?></div>
                    </div>
                </div>

                <?php if($ticket->photo_path): ?>
                <div class="mt-3">
                    <div class="text-muted small mb-2">Photo Evidence</div>
                    <img src="<?php echo e($ticket->photo_url); ?>" alt="Evidence" class="img-fluid rounded" style="max-height:250px; cursor:pointer;" onclick="window.open(this.src,'_blank')">
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Activity Log -->
        <?php if($ticket->maintenanceLogs->count()): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-clipboard-list me-2 text-primary"></i>Activity Log
            </div>
            <div class="card-body p-0">
                <div class="timeline p-3">
                    <?php $__currentLoopData = $ticket->maintenanceLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="timeline-item">
                        <div class="timeline-dot bg-<?php echo e($log->status === 'resolved' ? 'success' : 'primary'); ?>"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <strong><?php echo e($log->maintenanceStaff->full_name); ?></strong>
                                <span class="text-muted small"><?php echo e($log->created_at->format('M d, Y h:i A')); ?></span>
                            </div>
                            <div><?php echo e($log->action_taken); ?></div>
                            <?php if($log->repair_notes): ?><div class="text-muted small">Notes: <?php echo e($log->repair_notes); ?></div><?php endif; ?>
                            <?php if($log->materials_used): ?><div class="text-muted small">Materials: <?php echo e($log->materials_used); ?></div><?php endif; ?>
                            <?php if($log->repair_cost > 0): ?><div class="text-muted small">Cost: ₱<?php echo e(number_format($log->repair_cost, 2)); ?></div><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Actions Panel -->
    <div class="col-md-5">
        <?php if(in_array($ticket->status, ['assigned', 'ongoing'])): ?>

        <!-- Perform Repair / Start Task -->
        <?php if($ticket->status === 'assigned'): ?>
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold mb-3"><i class="fas fa-play me-2 text-primary"></i>Perform Repair</h6>
                <p class="text-muted small">Click below to start working on this task.</p>
                <form method="POST" action="<?php echo e(route('maintenance.tasks.start', $ticket)); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary w-100" onclick="return confirm('Start working on this task?')">
                        <i class="fas fa-play me-2"></i>Start Repair
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <!-- Input Repair Details -->
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-edit me-2 text-primary"></i>Input Repair Details (Cost, etc.)
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('maintenance.tasks.update-repair', $ticket)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label small">Action Taken <span class="text-danger">*</span></label>
                        <textarea name="action_taken" class="form-control form-control-sm <?php $__errorArgs = ['action_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  rows="3" placeholder="Describe what was done..." required><?php echo e(old('action_taken')); ?></textarea>
                        <?php $__errorArgs = ['action_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Repair Notes</label>
                        <textarea name="repair_notes" class="form-control form-control-sm" rows="2" placeholder="Additional notes..."><?php echo e(old('repair_notes')); ?></textarea>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small">Repair Cost (₱)</label>
                            <input type="number" name="repair_cost" class="form-control form-control-sm" step="0.01" min="0" value="<?php echo e(old('repair_cost', 0)); ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label small">Materials Used</label>
                            <input type="text" name="materials_used" class="form-control form-control-sm" placeholder="e.g. Wires, bulbs" value="<?php echo e(old('materials_used')); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100 btn-sm">
                        <i class="fas fa-save me-2"></i>Save Repair Details
                    </button>
                </form>
            </div>
        </div>

        <!-- Update Status: Resolved -->
        <div class="card shadow-sm border-success">
            <div class="card-header bg-white fw-semibold text-success">
                <i class="fas fa-check-circle me-2"></i>Update Status: Resolved
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('maintenance.tasks.resolve', $ticket)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label small">Final Action Taken <span class="text-danger">*</span></label>
                        <textarea name="action_taken" class="form-control form-control-sm <?php $__errorArgs = ['action_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  rows="3" placeholder="Describe the final repair performed..." required><?php echo e(old('action_taken')); ?></textarea>
                        <?php $__errorArgs = ['action_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Resolution Notes <span class="text-danger">*</span></label>
                        <textarea name="repair_notes" class="form-control form-control-sm <?php $__errorArgs = ['repair_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  rows="2" placeholder="Summary of the repair..." required><?php echo e(old('repair_notes')); ?></textarea>
                        <?php $__errorArgs = ['repair_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small">Total Repair Cost (₱) <span class="text-danger">*</span></label>
                            <input type="number" name="repair_cost" class="form-control form-control-sm <?php $__errorArgs = ['repair_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   step="0.01" min="0" value="<?php echo e(old('repair_cost', 0)); ?>" required>
                            <?php $__errorArgs = ['repair_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-6">
                            <label class="form-label small">Materials Used</label>
                            <input type="text" name="materials_used" class="form-control form-control-sm" value="<?php echo e(old('materials_used')); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100" onclick="return confirm('Mark this task as resolved? This will notify the admin for verification.')">
                        <i class="fas fa-check-double me-2"></i>Update Status: Resolved
                    </button>
                </form>
            </div>
        </div>

        <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body text-center py-4">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h6>Task <?php echo e(ucfirst($ticket->status)); ?></h6>
                <p class="text-muted small">This task has been <?php echo e($ticket->status); ?>.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/maintenance/tasks/show.blade.php ENDPATH**/ ?>