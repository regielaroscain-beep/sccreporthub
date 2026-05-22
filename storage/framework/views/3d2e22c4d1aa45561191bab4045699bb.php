
<?php $__env->startSection('title', 'Request Monitoring'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-magnifying-glass-chart me-2 text-primary"></i>Request Monitoring</h4>
        <p class="text-muted small mb-0">View & Track your ticket requests</p>
    </div>
    <a href="<?php echo e(route('faculty.tickets.create')); ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>New Request
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="myTicketsTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><code class="small"><?php echo e($ticket->ticket_number); ?></code></td>
                        <td>
                            <div><?php echo e(Str::limit($ticket->title, 40)); ?></div>
                            <?php if($ticket->facility): ?>
                            <div class="text-muted" style="font-size:0.75rem;"><i class="fas fa-location-dot me-1"></i><?php echo e($ticket->facility->full_location); ?></div>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span></td>
                        <td><span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span></td>
                        <td class="small text-nowrap"><?php echo e($ticket->created_at->format('M d, Y')); ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('faculty.tickets.show', $ticket)); ?>" class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($ticket->status === 'completed' && !$ticket->feedback): ?>
                                <a href="<?php echo e(route('faculty.feedback.create', $ticket)); ?>" class="btn btn-sm btn-outline-warning" title="Submit Feedback">
                                    <i class="fas fa-star"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">No tickets yet. <a href="<?php echo e(route('faculty.tickets.create')); ?>">Submit your first request</a>.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($tickets->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($tickets->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>$(document).ready(function() {
    <?php if($tickets->count()): ?>
    $('#myTicketsTable').DataTable({ paging: false, searching: true, info: false, order: [[4,'desc']] });
    <?php endif; ?>
});</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/faculty/tickets/index.blade.php ENDPATH**/ ?>