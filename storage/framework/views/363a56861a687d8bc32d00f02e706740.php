<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'SCC ReportHub'); ?> – Southern Christian College</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<!-- ─── Sidebar ──────────────────────────────────────────────────────────── -->
<div class="wrapper d-flex">
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="sidebar-logo">
                    <div class="logo-text">
                        <span class="logo-title">SCC</span>
                        <span class="logo-subtitle">ReportHub</span>
                    </div>
                </div>
                
                <button id="sidebarClose" class="btn btn-link p-1" style="color:rgba(255,255,255,0.5);">
                    <i class="fas fa-xmark fa-lg"></i>
                </button>
            </div>
        </div>

        <div class="sidebar-user">
            <img src="<?php echo e(auth()->user()->profile_photo_url); ?>" alt="Avatar" class="user-avatar" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->full_name)); ?>&background=0d6efd&color=fff&size=40'">
            <div class="user-info">
                <span class="user-name"><?php echo e(auth()->user()->full_name); ?></span>
                <span class="user-role badge bg-primary"><?php echo e(auth()->user()->role->name); ?></span>
            </div>
        </div>

        <ul class="sidebar-nav">
            <?php if(auth()->user()->isAdmin()): ?>
                <li class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-chart-pie"></i> Dashboard</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('admin.tickets.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.tickets.index')); ?>"><i class="fas fa-clipboard-list"></i> Ticket Request Management</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('admin.monitoring.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.monitoring.index')); ?>"><i class="fas fa-wrench"></i> Maintenance Monitoring</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.users.index')); ?>"><i class="fas fa-users"></i> User Management</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('admin.history') || request()->routeIs('admin.feedback') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.history')); ?>"><i class="fas fa-clock-rotate-left"></i> History</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('admin.facilities.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.facilities.index')); ?>"><i class="fas fa-building"></i> Facility Management</a>
                </li>

                <li class="nav-divider"></li>

                
                <li class="nav-item <?php echo e(request()->routeIs('admin.settings') || request()->routeIs('profile.*') || request()->routeIs('password.*') || request()->routeIs('admin.feedback') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.settings')); ?>"><i class="fas fa-gear"></i> Settings</a>
                </li>

            <?php elseif(auth()->user()->isFaculty()): ?>
                <li class="nav-item <?php echo e(request()->routeIs('faculty.dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('faculty.dashboard')); ?>"><i class="fas fa-chart-pie"></i> Dashboard</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('faculty.tickets.create') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('faculty.tickets.create')); ?>"><i class="fas fa-circle-plus"></i> Create Ticket Request</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('faculty.tickets.index') || request()->routeIs('faculty.tickets.show') || request()->routeIs('faculty.tickets.track') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('faculty.tickets.index')); ?>"><i class="fas fa-magnifying-glass-chart"></i> Request Monitoring</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('faculty.history') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('faculty.history')); ?>"><i class="fas fa-clock-rotate-left"></i> History</a>
                </li>

                <li class="nav-divider"></li>

                <li class="nav-item <?php echo e(request()->routeIs('settings.*') || request()->routeIs('profile.*') || request()->routeIs('password.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('settings.index')); ?>"><i class="fas fa-gear"></i> Settings</a>
                </li>

            <?php elseif(auth()->user()->isMaintenance()): ?>
                <li class="nav-item <?php echo e(request()->routeIs('maintenance.dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('maintenance.dashboard')); ?>"><i class="fas fa-chart-pie"></i> Dashboard</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('maintenance.tasks.index') || request()->routeIs('maintenance.tasks.show') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('maintenance.tasks.index')); ?>"><i class="fas fa-screwdriver-wrench"></i> Assigned Maintenance Tasks</a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('maintenance.tasks.completed') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('maintenance.tasks.completed')); ?>"><i class="fas fa-clock-rotate-left"></i> Tasks History</a>
                </li>

                <li class="nav-divider"></li>

                <li class="nav-item <?php echo e(request()->routeIs('settings.*') || request()->routeIs('profile.*') || request()->routeIs('password.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('settings.index')); ?>"><i class="fas fa-gear"></i> Settings</a>
                </li>
            <?php endif; ?>

            <li class="nav-divider"></li>

            <li class="nav-item">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- ─── Main Content ──────────────────────────────────────────────────── -->
    <div class="main-content flex-grow-1">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <button id="sidebarToggle" class="btn btn-link text-dark sidebar-toggle-btn p-1">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <div class="navbar-brand-text">
                    <span class="brand-title">SCC</span>
                    <span class="brand-sub">ReportHub</span>
                </div>
            </div>
            <div class="navbar-right d-flex align-items-center gap-3">
                <!-- Dark Mode Toggle -->
                <button class="dark-mode-toggle" id="darkModeToggle" title="Toggle dark mode">
                    <i class="fas fa-moon" id="darkModeIcon"></i>
                </button>
                <!-- Notification Bell -->
                <div class="dropdown">
                    <button class="btn btn-link text-dark position-relative" data-bs-toggle="dropdown">
                        <i class="fas fa-bell fa-lg"></i>
                        <?php if(($unreadNotificationCount ?? 0) > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notif-badge">
                                <?php echo e($unreadNotificationCount); ?>

                            </span>
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown p-0" style="width:min(360px, calc(100vw - 24px))">
                        <div class="dropdown-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                            <strong>Notifications</strong>
                            <a href="<?php echo e(route('notifications.mark-all-read')); ?>" class="text-muted small" onclick="event.preventDefault(); document.getElementById('mark-all-form').submit();">Mark all read</a>
                            <form id="mark-all-form" method="POST" action="<?php echo e(route('notifications.mark-all-read')); ?>" class="d-none"><?php echo csrf_field(); ?></form>
                        </div>
                        <div id="notification-list" style="max-height:300px; overflow-y:auto;">
                            <div class="text-center py-3 text-muted small">Loading...</div>
                        </div>
                        <div class="dropdown-footer text-center border-top py-2">
                            <a href="<?php echo e(route('notifications.index')); ?>" class="text-primary small">View all notifications</a>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="dropdown">
                    <button class="btn btn-link text-dark d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img src="<?php echo e(auth()->user()->profile_photo_url); ?>" alt="Avatar" class="rounded-circle" width="32" height="32" style="object-fit:cover;" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->full_name)); ?>&background=0d6efd&color=fff&size=32'">
                        <span class="d-none d-md-inline"><?php echo e(auth()->user()->first_name); ?></span>
                        <i class="fas fa-chevron-down fa-xs"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><i class="fas fa-user me-2"></i>My Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('password.change')); ?>"><i class="fas fa-key me-2"></i>Change Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="page-content">
            <!-- Flash Messages -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if(session('info')): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i><?php echo e(session('info')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<!-- App JS -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<script>
// Load notifications dropdown
document.addEventListener('DOMContentLoaded', function () {
    const notifDropdown = document.querySelector('.notification-dropdown');
    if (notifDropdown) {
        document.querySelector('[data-bs-toggle="dropdown"]')?.addEventListener('show.bs.dropdown', loadNotifications);
    }
});

function loadNotifications() {
    fetch('<?php echo e(route("notifications.recent")); ?>')
        .then(r => r.json())
        .then(data => {
            const list = document.getElementById('notification-list');
            if (!data.length) {
                list.innerHTML = '<div class="text-center py-3 text-muted small">No notifications</div>';
                return;
            }
            list.innerHTML = data.map(n => `
                <a href="<?php echo e(route('notifications.index')); ?>" class="dropdown-item py-2 px-3 border-bottom ${n.is_read ? '' : 'bg-light'}">
                    <div class="small fw-semibold">${n.message}</div>
                    <div class="text-muted" style="font-size:0.75rem;">${n.created_at}</div>
                </a>
            `).join('');
        });
}
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/layouts/app.blade.php ENDPATH**/ ?>