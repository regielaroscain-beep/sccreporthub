
<?php $__env->startSection('title', 'Ticket Requests'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-ticket-alt me-2 text-primary"></i>Ticket Requests</h4>
</div>

<!-- Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">Search</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Ticket #, title, name..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <?php $__currentLoopData = ['pending','approved','assigned','ongoing','resolved']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php echo e(request('status') == $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Priority</label>
                <select name="priority" class="form-select form-select-sm">
                    <option value="">All Priority</option>
                    <option value="urgent" <?php echo e(request('priority') == 'urgent' ? 'selected' : ''); ?>>Urgent</option>
                    <option value="high"   <?php echo e(request('priority') == 'high'   ? 'selected' : ''); ?>>High</option>
                    <option value="normal" <?php echo e(request('priority') == 'normal' ? 'selected' : ''); ?>>Normal</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100"><i class="fas fa-search me-1"></i>Filter</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('admin.tickets.index')); ?>" class="btn btn-outline-secondary btn-sm w-100"><i class="fas fa-times me-1"></i>Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="ticketsTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><code class="small"><?php echo e($ticket->ticket_number); ?></code></td>
                        <td><?php echo e(Str::limit($ticket->title, 35)); ?></td>
                        <td>
                            <div class="small"><?php echo e($ticket->user->full_name); ?></div>
                            <div class="text-muted" style="font-size:0.75rem;"><?php echo e($ticket->user->department); ?></div>
                        </td>
                        <td class="small"><?php echo e($ticket->facility?->full_location ?? '—'); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize">
                                <?php if($ticket->priority_level === 'urgent'): ?><i class="fas fa-exclamation-triangle me-1"></i><?php endif; ?>
                                <?php echo e($ticket->priority_level); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize"><?php echo e($ticket->status); ?></span>
                        </td>
                        <td class="small"><?php echo e($ticket->assignedStaff?->full_name ?? '—'); ?></td>
                        <td class="small"><?php echo e($ticket->created_at->format('M d, Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.tickets.show', $ticket)); ?>" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="9" class="text-center text-muted py-4">No tickets found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($tickets->hasPages()): ?>
    <div class="card-footer bg-white">
        <?php echo e($tickets->withQueryString()->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    <?php if($tickets->count()): ?>
    $('#ticketsTable').DataTable({ paging: false, searching: false, info: false, order: [] });
    <?php endif; ?>
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>