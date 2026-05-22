
<?php $__env->startSection('title', 'Ticket Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-ticket-alt me-2 text-primary"></i>Ticket Details</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.tickets.index')); ?>">Tickets</a></li>
                <li class="breadcrumb-item active"><?php echo e($ticket->ticket_number); ?></li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <?php if($ticket->status === 'resolved'): ?>
        <a href="<?php echo e(route('admin.tickets.receipt', $ticket)); ?>" class="btn btn-success" target="_blank">
            <i class="fas fa-print me-1"></i>Print Receipt
        </a>
        <?php endif; ?>
        <a href="<?php echo e(route('admin.tickets.index')); ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Ticket Info -->
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Ticket Information</span>
                <div class="d-flex gap-2">
                    <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize fs-6">
                        <?php echo e($ticket->priority_level); ?>

                    </span>
                    <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize fs-6">
                        <?php echo e($ticket->status); ?>

                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Ticket Number</label>
                        <div class="fw-semibold"><code><?php echo e($ticket->ticket_number); ?></code></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Date Submitted</label>
                        <div><?php echo e($ticket->created_at->format('F d, Y h:i A')); ?></div>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small">Title</label>
                        <div class="fw-semibold"><?php echo e($ticket->title); ?></div>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small">Description</label>
                        <div class="p-3 bg-light rounded"><?php echo e($ticket->description); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Facility Location</label>
                        <div><?php echo e($ticket->facility?->full_location ?? 'Not specified'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Submitted By</label>
                        <div><?php echo e($ticket->user->full_name); ?></div>
                        <div class="text-muted small"><?php echo e($ticket->user->department); ?></div>
                    </div>
                    <?php if($ticket->approved_at): ?>
                    <div class="col-md-6">
                        <label class="text-muted small">Reviewed By</label>
                        <div><?php echo e($ticket->approvedBy?->full_name ?? '—'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Review Date</label>
                        <div><?php echo e($ticket->approved_at->format('F d, Y h:i A')); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if($ticket->completed_at): ?>
                    <div class="col-md-6">
                        <label class="text-muted small">Completed At</label>
                        <div><?php echo e($ticket->completed_at->format('F d, Y h:i A')); ?></div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if($ticket->photo_path): ?>
                <div class="mt-3">
                    <label class="text-muted small">Photo Evidence</label>
                    <div class="mt-2">
                        <img src="<?php echo e($ticket->photo_url); ?>" alt="Evidence" class="img-fluid rounded" style="max-height:300px; cursor:pointer;"
                             onclick="window.open(this.src,'_blank')">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Maintenance Logs -->
        <?php if($ticket->maintenanceLogs->count()): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-clipboard-list me-2 text-primary"></i>Maintenance Activity Log
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
                            <div class="mt-1"><strong>Action:</strong> <?php echo e($log->action_taken); ?></div>
                            <?php if($log->repair_notes): ?>
                            <div><strong>Notes:</strong> <?php echo e($log->repair_notes); ?></div>
                            <?php endif; ?>
                            <?php if($log->materials_used): ?>
                            <div><strong>Materials:</strong> <?php echo e($log->materials_used); ?></div>
                            <?php endif; ?>
                            <?php if($log->repair_cost > 0): ?>
                            <div><strong>Cost:</strong> ₱<?php echo e(number_format($log->repair_cost, 2)); ?></div>
                            <?php endif; ?>
                            <span class="badge bg-<?php echo e($log->status === 'resolved' ? 'success' : 'info'); ?> mt-1"><?php echo e(ucfirst($log->status)); ?></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Feedback -->
        <?php if($ticket->feedback): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-star me-2 text-warning"></i>User Feedback
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo e($i <= $ticket->feedback->rating ? 'text-warning' : 'text-muted'); ?>"></i>
                    <?php endfor; ?>
                    <span class="fw-semibold"><?php echo e($ticket->feedback->rating); ?>/5</span>
                </div>
                <?php if($ticket->feedback->comment): ?>
                <p class="mb-0 text-muted"><?php echo e($ticket->feedback->comment); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Right Column: Actions -->
    <div class="col-md-4">
        <!-- Admin Actions -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-cog me-2 text-primary"></i>Admin Actions
            </div>
            <div class="card-body d-grid gap-2">

                <?php if($ticket->status === 'pending'): ?>
                <!-- Approve -->
                <form method="POST" action="<?php echo e(route('admin.tickets.approve', $ticket)); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success w-100" onclick="return confirm('Approve this ticket?')">
                        <i class="fas fa-check me-2"></i>Approve Ticket
                    </button>
                </form>
                <!-- Reject -->
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    <i class="fas fa-times me-2"></i>Reject Ticket
                </button>
                <?php endif; ?>

                <?php if(in_array($ticket->status, ['approved'])): ?>
                <!-- Assign -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#assignModal">
                    <i class="fas fa-user-plus me-2"></i>Assign to Staff
                </button>
                <?php endif; ?>

                <?php if($ticket->status === 'resolved'): ?>
                <!-- Verify Completion -->
                <form method="POST" action="<?php echo e(route('admin.tickets.verify', $ticket)); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success w-100" onclick="return confirm('Mark this ticket as completed?')">
                        <i class="fas fa-check-double me-2"></i>Verify & Complete
                    </button>
                </form>
                <a href="<?php echo e(route('admin.tickets.receipt', $ticket)); ?>" class="btn btn-outline-success w-100" target="_blank">
                    <i class="fas fa-print me-2"></i>Print Receipt
                </a>
                <?php endif; ?>

                <?php if($ticket->status === 'completed'): ?>
                <a href="<?php echo e(route('admin.tickets.receipt', $ticket)); ?>" class="btn btn-outline-success w-100" target="_blank">
                    <i class="fas fa-print me-2"></i>Print Receipt
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Assigned Staff Info -->
        <?php if($ticket->assignedStaff): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-hard-hat me-2 text-primary"></i>Assigned Staff
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <img src="<?php echo e($ticket->assignedStaff->profile_photo_url); ?>" alt="Avatar" class="rounded-circle" width="48" height="48" style="object-fit:cover;">
                    <div>
                        <div class="fw-semibold"><?php echo e($ticket->assignedStaff->full_name); ?></div>
                        <div class="text-muted small"><?php echo e($ticket->assignedStaff->department); ?></div>
                        <div class="text-muted small"><?php echo e($ticket->assignedStaff->contact_number); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('admin.tickets.reject', $ticket)); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="fas fa-times-circle me-2"></i>Reject Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Reason for Rejection <span class="text-danger">*</span></label>
                    <textarea name="rejection_reason" class="form-control" rows="4" placeholder="Explain why this ticket is being rejected..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assign Modal -->
<div class="modal fade" id="assignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('admin.tickets.assign', $ticket)); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title text-primary"><i class="fas fa-user-plus me-2"></i>Assign Maintenance Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Select Maintenance Staff <span class="text-danger">*</span></label>
                    <select name="assigned_to" class="form-select" required>
                        <option value="">-- Select Staff --</option>
                        <?php $__currentLoopData = $maintenanceStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->full_name); ?> — <?php echo e($staff->department); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/tickets/show.blade.php ENDPATH**/ ?>