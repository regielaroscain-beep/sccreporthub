
<?php $__env->startSection('title', 'Notifications'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-bell me-2 text-primary"></i>Notifications</h4>
    <form method="POST" action="<?php echo e(route('notifications.mark-all-read')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-check-double me-1"></i>Mark All Read
        </button>
    </form>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="d-flex align-items-start p-3 border-bottom <?php echo e(!$notif->is_read ? 'bg-light' : ''); ?>">
            <div class="me-3 mt-1">
                <?php
                    $icon = match($notif->type) {
                        'new_ticket'       => 'fa-ticket-alt text-primary',
                        'ticket_approved'  => 'fa-check-circle text-success',
                        'ticket_rejected'  => 'fa-times-circle text-danger',
                        'ticket_assigned'  => 'fa-user-plus text-info',
                        'task_assigned'    => 'fa-hard-hat text-warning',
                        'task_started'     => 'fa-play-circle text-info',
                        'task_resolved'    => 'fa-check-double text-success',
                        'ticket_completed' => 'fa-star text-warning',
                        default            => 'fa-bell text-secondary',
                    };
                ?>
                <i class="fas <?php echo e($icon); ?> fa-lg"></i>
            </div>
            <div class="flex-grow-1">
                <div class="small <?php echo e(!$notif->is_read ? 'fw-semibold' : ''); ?>"><?php echo e($notif->message); ?></div>
                <div class="text-muted" style="font-size:0.75rem;"><?php echo e($notif->created_at->diffForHumans()); ?> — <?php echo e($notif->created_at->format('M d, Y h:i A')); ?></div>
            </div>
            <?php if(!$notif->is_read): ?>
            <span class="badge bg-primary rounded-pill ms-2">New</span>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center text-muted py-5">
            <i class="fas fa-bell-slash fa-3x mb-3"></i>
            <div>No notifications yet.</div>
        </div>
        <?php endif; ?>
    </div>
    <?php if($notifications->hasPages()): ?>
    <div class="card-footer bg-white"><?php echo e($notifications->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/notifications/index.blade.php ENDPATH**/ ?>