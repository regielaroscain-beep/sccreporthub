
<?php $__env->startSection('title', 'Assigned Maintenance Tasks'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-screwdriver-wrench me-2 text-primary"></i>Assigned Maintenance Tasks</h4>
</div>

<!-- Priority Filter -->
<div class="card shadow-sm mb-4">
    <div class="card-body py-2">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <label class="small text-muted mb-0">Filter by Priority:</label>
            <a href="<?php echo e(route('maintenance.tasks.index')); ?>" class="btn btn-sm <?php echo e(!request('priority') ? 'btn-primary' : 'btn-outline-secondary'); ?>">All</a>
            <a href="<?php echo e(route('maintenance.tasks.index', ['priority' => 'urgent'])); ?>" class="btn btn-sm <?php echo e(request('priority') === 'urgent' ? 'btn-danger' : 'btn-outline-danger'); ?>">Urgent</a>
            <a href="<?php echo e(route('maintenance.tasks.index', ['priority' => 'high'])); ?>" class="btn btn-sm <?php echo e(request('priority') === 'high' ? 'btn-warning' : 'btn-outline-warning'); ?>">High</a>
            <a href="<?php echo e(route('maintenance.tasks.index', ['priority' => 'normal'])); ?>" class="btn btn-sm <?php echo e(request('priority') === 'normal' ? 'btn-success' : 'btn-outline-success'); ?>">Normal</a>
        </form>
    </div>
</div>

<?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="card shadow-sm mb-3 <?php echo e($ticket->priority_level === 'urgent' ? 'border-danger' : ''); ?>">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize">
                        <?php if($ticket->priority_level === 'urgent'): ?><i class="fas fa-exclamation-triangle me-1"></i><?php endif; ?>
                        <?php echo e($ticket->priority_level); ?>

                    </span>
                    <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span>
                    <code class="small text-muted"><?php echo e($ticket->ticket_number); ?></code>
                </div>
                <h6 class="fw-semibold mb-1"><?php echo e($ticket->title); ?></h6>
                <div class="text-muted small mb-1">
                    <i class="fas fa-map-marker-alt me-1"></i><?php echo e($ticket->facility?->full_location ?? 'Location not specified'); ?>

                </div>
                <div class="text-muted small">
                    <i class="fas fa-user me-1"></i><?php echo e($ticket->user->full_name); ?> — <?php echo e($ticket->user->department); ?>

                    &nbsp;|&nbsp;
                    <i class="fas fa-calendar me-1"></i><?php echo e($ticket->created_at->format('M d, Y')); ?>

                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="<?php echo e(route('maintenance.tasks.show', $ticket)); ?>" class="btn btn-primary">
                    <i class="fas fa-eye me-2"></i>View Task
                </a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="card shadow-sm">
    <div class="card-body text-center py-5 text-muted">
        <i class="fas fa-check-circle fa-4x mb-3 text-success"></i>
        <h5>No active tasks</h5>
        <p>You have no assigned tasks at the moment.</p>
    </div>
</div>
<?php endif; ?>

<?php if($tickets->hasPages()): ?>
<div class="mt-3"><?php echo e($tickets->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/maintenance/tasks/index.blade.php ENDPATH**/ ?>