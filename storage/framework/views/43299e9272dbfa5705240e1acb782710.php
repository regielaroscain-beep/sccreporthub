
<?php $__env->startSection('title', 'History'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left me-2 text-primary"></i>History</h4>
        <p class="text-muted small mb-0">View completed and rejected tickets</p>
    </div>
</div>

<!-- Filter -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Search ticket #, title..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Date From</label>
                <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo e(request('date_from')); ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Date To</label>
                <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo e(request('date_to')); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-magnifying-glass me-1"></i>Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('admin.history')); ?>" class="btn btn-outline-secondary btn-sm w-100">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="historyTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Assigned To</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Completed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><code class="small"><?php echo e($ticket->ticket_number); ?></code></td>
                        <td><?php echo e(Str::limit($ticket->title, 40)); ?></td>
                        <td class="small"><?php echo e($ticket->user->full_name); ?></td>
                        <td class="small"><?php echo e($ticket->assignedStaff?->full_name ?? '—'); ?></td>
                        <td><span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span></td>
                        <td><span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span></td>
                        <td class="small"><?php echo e($ticket->completed_at?->format('M d, Y') ?? '—'); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.tickets.show', [$ticket, 'from' => 'history'])); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if($ticket->status === 'completed'): ?>
                            <a href="<?php echo e(route('admin.monitoring.receipt', $ticket)); ?>" class="btn btn-sm btn-outline-success" target="_blank">
                                <i class="fas fa-print"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="text-center text-muted py-4">No history records found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($tickets->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($tickets->withQueryString()->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>$(document).ready(function() {
    <?php if($tickets->count()): ?>
    $('#historyTable').DataTable({ paging: false, searching: false, info: false, order: [] });
    <?php endif; ?>
});</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/history.blade.php ENDPATH**/ ?>