
<?php $__env->startSection('title', 'Maintenance Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i>Dashboard</h4>
        <p class="text-muted small mb-0">Welcome, <?php echo e(auth()->user()->full_name); ?>

            <?php if(auth()->user()->specialization): ?>
            &nbsp;·&nbsp;<span class="badge bg-primary">
                <i class="fas fa-id-badge me-1"></i><?php echo e(\App\Models\User::SPECIALIZATIONS[auth()->user()->specialization] ?? auth()->user()->specialization); ?>

            </span>
            <?php endif; ?>
        </p>
    </div>
    <span class="text-muted small"><?php echo e(now()->format('l, F d, Y')); ?></span>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-tasks"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['assigned_tasks']); ?></div>
                <div class="stat-label">Active Tasks</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-danger">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['urgent_tasks']); ?></div>
                <div class="stat-label">Urgent Tasks</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-check"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['resolved_tasks']); ?></div>
                <div class="stat-label">Resolved</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="fas fa-check-double"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['completed_tasks']); ?></div>
                <div class="stat-label">Completed</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Active Tasks -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="fas fa-tools me-2 text-primary"></i>Active Assigned Tasks</span>
                <a href="<?php echo e(route('maintenance.tasks.index')); ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <?php $__empty_1 = true; $__currentLoopData = $assignedTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></span>
                                <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span>
                                <span class="badge bg-light text-dark border" style="font-size:0.7rem;">
                                    <i class="fas <?php echo e($ticket->category_icon); ?> me-1"></i><?php echo e($ticket->category_label); ?>

                                </span>
                                <code class="small text-muted"><?php echo e($ticket->ticket_number); ?></code>
                            </div>
                            <div class="fw-semibold"><?php echo e($ticket->title); ?></div>
                            <div class="text-muted small">
                                <i class="fas fa-map-marker-alt me-1"></i><?php echo e($ticket->facility?->full_location ?? 'Location not specified'); ?>

                            </div>
                            <div class="text-muted small">
                                <i class="fas fa-user me-1"></i><?php echo e($ticket->user->full_name); ?> — <?php echo e($ticket->user->department); ?>

                            </div>
                        </div>
                        <a href="<?php echo e(route('maintenance.tasks.show', $ticket)); ?>" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center text-muted py-5">
                    <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                    <div>No active tasks assigned to you.</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Completed -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="fas fa-history me-2 text-primary"></i>Recently Completed</span>
                <a href="<?php echo e(route('maintenance.tasks.completed')); ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $recentCompleted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('maintenance.tasks.show', $ticket)); ?>" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        <code class="small"><?php echo e($ticket->ticket_number); ?></code>
                        <span class="badge bg-success">Completed</span>
                    </div>
                    <div class="small fw-semibold"><?php echo e(Str::limit($ticket->title, 40)); ?></div>
                    <div class="text-muted" style="font-size:0.75rem;"><?php echo e($ticket->completed_at?->format('M d, Y') ?? $ticket->updated_at->format('M d, Y')); ?></div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center text-muted py-4 small">No completed tasks yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/maintenance/dashboard.blade.php ENDPATH**/ ?>