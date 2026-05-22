
<?php $__env->startSection('title', 'Tasks History'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left me-2 text-primary"></i>Tasks History</h4>
    <p class="text-muted small mb-0">View Completed Tasks</p>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="completedTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Total Cost</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><code class="small"><?php echo e($ticket->ticket_number); ?></code></td>
                        <td><?php echo e(Str::limit($ticket->title, 40)); ?></td>
                        <td class="small"><?php echo e($ticket->facility?->full_location ?? '—'); ?></td>
                        <td><span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span></td>
                        <td><span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span></td>
                        <td class="small">₱<?php echo e(number_format($ticket->maintenanceLogs->sum('repair_cost'), 2)); ?></td>
                        <td class="small"><?php echo e($ticket->completed_at?->format('M d, Y') ?? $ticket->updated_at->format('M d, Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('maintenance.tasks.show', $ticket)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="text-center text-muted py-4">No completed tasks yet.</td></tr>
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
    $('#completedTable').DataTable({ paging: false, searching: true, info: false, order: [[6,'desc']] });
    <?php endif; ?>
});</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/maintenance/tasks/completed.blade.php ENDPATH**/ ?>