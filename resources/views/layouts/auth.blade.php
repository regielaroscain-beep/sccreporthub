<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SCC ReportHub') – Southern Christian College</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <style>
        /* ── Mobile: full white, no scroll, no blue sides ── */
        @media (max-width: 768px) {
            html, body.auth-body {
                height: 100% !important;
                min-height: 100% !important;
                overflow: hidden !important;
                background: #ffffff !important;
                padding: 0 !important;
            }
            body.auth-body::before,
            body.auth-body::after {
                display: none !important;
            }
            .auth-wrapper {
                width: 100% !important;
                max-width: 100% !important;
                height: 100% !important;
                display: flex !important;
                align-items: flex-start !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .auth-card {
                width: 100% !important;
                height: 100% !important;
                min-height: 100vh !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                padding: 24px 20px !important;
                overflow-y: auto !important;
                background: #ffffff !important;
            }
        }
    </style>
</head>
<body class="auth-body" id="authBody">

<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Auth pages are always light mode regardless of dashboard preference --}}
@stack('scripts')
</body>
</html>
