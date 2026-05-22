
<?php $__env->startSection('title', 'Ticket Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-ticket-alt me-2 text-primary"></i>Ticket Details</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?php echo e(route('faculty.tickets.index')); ?>">Request Monitoring</a></li>
                <li class="breadcrumb-item active"><?php echo e($ticket->ticket_number); ?></li>
            </ol>
        </nav>
    </div>
    <a href="<?php echo e(route('faculty.tickets.index')); ?>" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <!-- Ticket Info -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Ticket Information</span>
                <div class="d-flex gap-2">
                    <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span>
                    <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span>
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
                        <label class="text-muted small">Location</label>
                        <div><?php echo e($ticket->facility?->full_location ?? 'Not specified'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Assigned To</label>
                        <div><?php echo e($ticket->assignedStaff?->full_name ?? 'Not yet assigned'); ?></div>
                    </div>
                </div>

                <?php if($ticket->photo_path): ?>
                <div class="mt-3">
                    <label class="text-muted small">Photo Evidence</label>
                    <div class="mt-2">
                        <img src="<?php echo e($ticket->photo_url); ?>" alt="Evidence" class="img-fluid rounded" style="max-height:250px; cursor:pointer;" onclick="window.open(this.src,'_blank')">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Status Timeline -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-stream me-2 text-primary"></i>Status Timeline
            </div>
            <div class="card-body">
                <?php
                    $statuses = ['pending','approved','assigned','ongoing','resolved','completed'];
                    $currentIndex = array_search($ticket->status, $statuses);
                    if ($ticket->status === 'rejected') $currentIndex = -1;
                ?>
                <?php if($ticket->status === 'rejected'): ?>
                <div class="alert alert-danger"><i class="fas fa-times-circle me-2"></i>This ticket has been rejected.</div>
                <?php else: ?>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1
                            <?php echo e($i <= $currentIndex ? 'bg-primary text-white' : 'bg-light text-muted border'); ?>"
                            style="width:40px;height:40px;">
                            <?php if($i < $currentIndex): ?>
                                <i class="fas fa-check fa-sm"></i>
                            <?php elseif($i === $currentIndex): ?>
                                <i class="fas fa-circle fa-sm"></i>
                            <?php else: ?>
                                <span class="small"><?php echo e($i+1); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="small text-capitalize <?php echo e($i <= $currentIndex ? 'fw-semibold text-primary' : 'text-muted'); ?>"><?php echo e($status); ?></div>
                    </div>
                    <?php if($i < count($statuses)-1): ?>
                    <div class="flex-grow-1" style="height:2px; background:<?php echo e($i < $currentIndex ? 'var(--primary, #4f46e5)' : '#dee2e6'); ?>;"></div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Maintenance Logs -->
        <?php if($ticket->maintenanceLogs->count()): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-clipboard-list me-2 text-primary"></i>Repair Activity
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
                            <?php if($log->repair_notes): ?><div class="text-muted small"><?php echo e($log->repair_notes); ?></div><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Right: Actions -->
    <div class="col-md-4">
        <?php if($ticket->status === 'completed' && !$ticket->feedback): ?>
        <div class="card shadow-sm border-warning mb-4">
            <div class="card-body text-center p-4">
                <i class="fas fa-star fa-3x text-warning mb-3"></i>
                <h6 class="fw-semibold">Your repair is complete!</h6>
                <p class="text-muted small">Please take a moment to rate the service.</p>
                <a href="<?php echo e(route('faculty.feedback.create', $ticket)); ?>" class="btn btn-warning w-100">
                    <i class="fas fa-star me-2"></i>Submit Feedback
                </a>
            </div>
        </div>
        <?php endif; ?>

        <?php if($ticket->feedback): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold"><i class="fas fa-star me-2 text-warning"></i>Your Feedback</div>
            <div class="card-body">
                <div class="d-flex gap-1 mb-2">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo e($i <= $ticket->feedback->rating ? 'text-warning' : 'text-muted'); ?>"></i>
                    <?php endfor; ?>
                </div>
                <?php if($ticket->feedback->comment): ?>
                <p class="text-muted small mb-0"><?php echo e($ticket->feedback->comment); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold"><i class="fas fa-info-circle me-2 text-primary"></i>Ticket Summary</div>
            <div class="card-body">
                <div class="mb-2">
                    <div class="text-muted small">Submitted</div>
                    <div class="small"><?php echo e($ticket->created_at->format('M d, Y')); ?></div>
                </div>
                <?php if($ticket->approved_at): ?>
                <div class="mb-2">
                    <div class="text-muted small">Reviewed</div>
                    <div class="small"><?php echo e($ticket->approved_at->format('M d, Y')); ?></div>
                </div>
                <?php endif; ?>
                <?php if($ticket->completed_at): ?>
                <div class="mb-2">
                    <div class="text-muted small">Completed</div>
                    <div class="small"><?php echo e($ticket->completed_at->format('M d, Y')); ?></div>
                </div>
                <?php endif; ?>
                <?php if($ticket->assignedStaff): ?>
                <div class="mb-2">
                    <div class="text-muted small">Assigned Staff</div>
                    <div class="small fw-semibold"><?php echo e($ticket->assignedStaff->full_name); ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/faculty/tickets/show.blade.php ENDPATH**/ ?>