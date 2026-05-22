
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-tachometer-alt me-2 text-primary"></i>Admin Dashboard</h4>
        <p class="text-muted small mb-0">Welcome back, <?php echo e(auth()->user()->full_name); ?></p>
    </div>
    <div class="text-muted small"><?php echo e(now()->format('l, F d, Y')); ?></div>
</div>

<!-- ─── Stats Cards ─────────────────────────────────────────────────────────── -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['total_tickets']); ?></div>
                <div class="stat-label">Total Tickets</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['pending_tickets']); ?></div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-tools"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['ongoing_tickets']); ?></div>
                <div class="stat-label">Ongoing</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['completed_tickets']); ?></div>
                <div class="stat-label">Completed</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-danger">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['urgent_tickets']); ?></div>
                <div class="stat-label">Urgent Active</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-secondary">
            <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['rejected_tickets']); ?></div>
                <div class="stat-label">Rejected</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['total_users']); ?></div>
                <div class="stat-label">Faculty/Staff</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-hard-hat"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($stats['maintenance_staff']); ?></div>
                <div class="stat-label">Maintenance Staff</div>
            </div>
        </div>
    </div>
</div>

<!-- ─── Charts Row ──────────────────────────────────────────────────────────── -->
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-chart-line me-2 text-primary"></i>Monthly Ticket Submissions (Last 6 Months)
            </div>
            <div class="card-body" style="height:250px; position:relative;">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-chart-pie me-2 text-primary"></i>Priority Distribution
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="height:250px; position:relative;">
                <canvas id="priorityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ─── Status Distribution ─────────────────────────────────────────────────── -->
<div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-chart-bar me-2 text-primary"></i>Ticket Status Overview
            </div>
            <div class="card-body" style="height:200px; position:relative;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ─── Recent Tickets Table ────────────────────────────────────────────────── -->
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="fas fa-list me-2 text-primary"></i>Recent Ticket Requests</span>
        <a href="<?php echo e(route('admin.tickets.index')); ?>" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="recentTicketsTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><code><?php echo e($ticket->ticket_number); ?></code></td>
                        <td><?php echo e(Str::limit($ticket->title, 40)); ?></td>
                        <td><?php echo e($ticket->user->full_name); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($ticket->priority_badge); ?> text-capitalize">
                                <?php echo e($ticket->priority_level); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($ticket->status_badge); ?> text-capitalize">
                                <?php echo e($ticket->status); ?>

                            </span>
                        </td>
                        <td><?php echo e($ticket->created_at->format('M d, Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.tickets.show', $ticket)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">No tickets yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Monthly Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($monthlyData['labels']); ?>,
        datasets: [{
            label: 'Tickets Submitted',
            data: <?php echo json_encode($monthlyData['data']); ?>,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#0d6efd',
            pointRadius: 5,
        }]
    },
    options: {
        animation: { duration: 0 },
        responsive: true,
        maintainAspectRatio: false,
        resizeDelay: 200,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

// Priority Pie Chart
const priorityCtx = document.getElementById('priorityChart').getContext('2d');
new Chart(priorityCtx, {
    type: 'doughnut',
    data: {
        labels: ['Urgent', 'High', 'Normal'],
        datasets: [{
            data: [<?php echo e($priorityData['urgent']); ?>, <?php echo e($priorityData['high']); ?>, <?php echo e($priorityData['normal']); ?>],
            backgroundColor: ['#dc3545', '#ffc107', '#198754'],
            borderWidth: 2,
        }]
    },
    options: {
        animation: { duration: 0 },
        responsive: true,
        maintainAspectRatio: false,
        resizeDelay: 200,
        plugins: { legend: { position: 'bottom' } }
    }
});

// Status Bar Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Approved', 'Assigned', 'Ongoing', 'Resolved', 'Completed', 'Rejected'],
        datasets: [{
            label: 'Tickets',
            data: [
                <?php echo e($statusData['pending']); ?>, <?php echo e($statusData['approved']); ?>,
                <?php echo e($statusData['assigned']); ?>, <?php echo e($statusData['ongoing']); ?>,
                <?php echo e($statusData['resolved']); ?>, <?php echo e($statusData['completed']); ?>,
                <?php echo e($statusData['rejected']); ?>

            ],
            backgroundColor: ['#ffc107','#0dcaf0','#0d6efd','#6c757d','#20c997','#198754','#dc3545'],
        }]
    },
    options: {
        animation: { duration: 0 },
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

$(document).ready(function() {
    <?php if($recentTickets->count()): ?>
    $('#recentTicketsTable').DataTable({ paging: false, searching: false, info: false, order: [] });
    <?php endif; ?>
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>