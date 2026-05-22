
<?php $__env->startSection('title', 'Feedback'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>User Feedback</h4>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm text-center p-4">
            <div class="display-4 fw-bold text-warning"><?php echo e(number_format($avgRating, 1)); ?></div>
            <div class="text-muted">Average Rating</div>
            <div class="mt-2">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-star <?php echo e($i <= round($avgRating) ? 'text-warning' : 'text-muted'); ?>"></i>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm p-4">
            <h6 class="fw-semibold mb-3">Rating Distribution</h6>
            <?php for($i = 5; $i >= 1; $i--): ?>
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="small" style="width:40px;"><?php echo e($i); ?> <i class="fas fa-star text-warning fa-xs"></i></span>
                <div class="progress flex-grow-1" style="height:12px;">
                    <?php $count = $ratingCounts[$i] ?? 0; $total = $feedbacks->total() ?: 1; ?>
                    <div class="progress-bar bg-warning" style="width:<?php echo e(($count/$total)*100); ?>%"></div>
                </div>
                <span class="small text-muted" style="width:30px;"><?php echo e($count); ?></span>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Submitted By</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><code class="small"><?php echo e($feedback->ticket->ticket_number); ?></code></td>
                        <td class="small"><?php echo e($feedback->user->full_name); ?></td>
                        <td>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo e($i <= $feedback->rating ? 'text-warning' : 'text-muted'); ?> fa-sm"></i>
                            <?php endfor; ?>
                        </td>
                        <td class="small"><?php echo e($feedback->comment ?? '—'); ?></td>
                        <td class="small"><?php echo e($feedback->created_at->format('M d, Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">No feedback yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($feedbacks->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($feedbacks->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/feedback/index.blade.php ENDPATH**/ ?>