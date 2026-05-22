
<?php $__env->startSection('title', 'Track Ticket'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-search me-2 text-primary"></i>Track Ticket</h4>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <form method="GET" action="<?php echo e(route('faculty.tickets.track')); ?>">
                    <label class="form-label fw-semibold">Enter Ticket Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-ticket-alt text-muted"></i></span>
                        <input type="text" name="ticket_number" class="form-control form-control-lg <?php $__errorArgs = ['ticket_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="e.g. TKT-20240101-ABCDE" value="<?php echo e(request('ticket_number')); ?>" required>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-search me-2"></i>Track
                        </button>
                        <?php $__errorArgs = ['ticket_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </form>
            </div>
        </div>

        <?php if(isset($ticket)): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Ticket: <code><?php echo e($ticket->ticket_number); ?></code></span>
                <div class="d-flex gap-2">
                    <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span>
                    <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize fs-6"><?php echo e($ticket->status); ?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="text-muted small">Title</div>
                        <div class="fw-semibold"><?php echo e($ticket->title); ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Location</div>
                        <div><?php echo e($ticket->facility?->full_location ?? '—'); ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Submitted</div>
                        <div><?php echo e($ticket->created_at->format('F d, Y')); ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Assigned To</div>
                        <div><?php echo e($ticket->assignedStaff?->full_name ?? 'Not yet assigned'); ?></div>
                    </div>
                </div>

                <!-- Progress Steps -->
                <?php
                    $statuses = ['pending','approved','assigned','ongoing','resolved','completed'];
                    $currentIndex = array_search($ticket->status, $statuses);
                ?>
                <?php if($ticket->status !== 'rejected'): ?>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1
                            <?php echo e($i <= $currentIndex ? 'bg-primary text-white' : 'bg-light text-muted border'); ?>"
                            style="width:36px;height:36px;">
                            <?php if($i < $currentIndex): ?><i class="fas fa-check fa-xs"></i>
                            <?php elseif($i === $currentIndex): ?><i class="fas fa-circle fa-xs"></i>
                            <?php else: ?><span style="font-size:0.7rem;"><?php echo e($i+1); ?></span><?php endif; ?>
                        </div>
                        <div class="text-capitalize" style="font-size:0.7rem; <?php echo e($i <= $currentIndex ? 'font-weight:600;color:var(--primary,#4f46e5);' : 'color:#6c757d;'); ?>"><?php echo e($status); ?></div>
                    </div>
                    <?php if($i < count($statuses)-1): ?>
                    <div class="flex-grow-1" style="height:2px;background:<?php echo e($i < $currentIndex ? 'var(--primary,#4f46e5)' : '#dee2e6'); ?>;"></div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="alert alert-danger"><i class="fas fa-times-circle me-2"></i>This ticket has been rejected.</div>
                <?php endif; ?>

                <a href="<?php echo e(route('faculty.tickets.show', $ticket)); ?>" class="btn btn-primary">
                    <i class="fas fa-eye me-2"></i>View Full Details
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/faculty/tickets/track.blade.php ENDPATH**/ ?>