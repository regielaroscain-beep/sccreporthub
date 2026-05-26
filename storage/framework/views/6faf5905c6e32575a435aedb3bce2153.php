
<?php $__env->startSection('title', 'History'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left me-2 text-primary"></i>History</h4>
        <p class="text-muted small mb-0">Your completed and rejected ticket requests</p>
    </div>
</div>

<div class="list-group shadow-sm">
    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <a href="<?php echo e(route('faculty.tickets.show', [$ticket, 'from' => 'history'])); ?>"
       class="list-group-item list-group-item-action px-3 py-3">
        <div class="d-flex justify-content-between align-items-start gap-2">
            <div class="flex-grow-1 min-width-0">
                <div class="fw-semibold small text-truncate"><?php echo e($ticket->title); ?></div>
                <code style="font-size:0.72rem;"><?php echo e($ticket->ticket_number); ?></code>
                <?php if($ticket->facility): ?>
                <div class="text-muted" style="font-size:0.72rem;">
                    <i class="fas fa-location-dot me-1"></i><?php echo e($ticket->facility->full_location); ?>

                </div>
                <?php endif; ?>
                <div class="text-muted" style="font-size:0.72rem;">
                    <?php echo e($ticket->completed_at?->format('M d, Y') ?? $ticket->updated_at->format('M d, Y')); ?>

                </div>
            </div>
            <div class="d-flex flex-column align-items-end gap-1 flex-shrink-0">
                <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span>
                <?php if($ticket->feedback): ?>
                <div>
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo e($i <= $ticket->feedback->rating ? 'text-warning' : 'text-muted'); ?>"
                           style="font-size:0.65rem;"></i>
                    <?php endfor; ?>
                </div>
                <?php elseif($ticket->status === 'completed'): ?>
                <a href="<?php echo e(route('faculty.feedback.create', $ticket)); ?>"
                   class="badge bg-warning text-dark text-decoration-none"
                   onclick="event.stopPropagation();"
                   style="font-size:0.68rem;">
                    Rate now
                </a>
                <?php endif; ?>
            </div>
        </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="card shadow-sm">
        <div class="card-body text-center text-muted py-5">
            <i class="fas fa-clock-rotate-left fa-3x mb-3 opacity-25"></i>
            <div>No completed requests yet.</div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if($tickets->hasPages()): ?>
<div class="mt-3"><?php echo e($tickets->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/faculty/history.blade.php ENDPATH**/ ?>