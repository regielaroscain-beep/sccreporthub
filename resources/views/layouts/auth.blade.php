<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SCC ReportHub') – Southern Christian College</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <style>
        * { font-family: 'Inter', sans-serif; }

        body.auth-body {
            min-height: 100vh;
            background: #f0f4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 960px;
            min-height: 580px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(79, 70, 229, 0.12);
            overflow: hidden;
            display: flex;
        }

        /* ── Left Panel ── */
        .auth-left {
            width: 42%;
            background: linear-gradient(145deg, #4f46e5 0%, #3730a3 50%, #1e1b4b 100%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .auth-left::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }

        .auth-left-logo img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }

        .auth-left-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
            margin-top: 24px;
        }

        .auth-left-subtitle {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.65);
            margin-top: 8px;
            line-height: 1.6;
        }

        .auth-left-features {
            margin-top: auto;
            padding-top: 32px;
        }

        .auth-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .auth-feature-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.12);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a5b4fc;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .auth-feature-text {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.4;
        }

        .auth-left-footer {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.35);
            margin-top: 32px;
        }

        /* ── Right Panel ── */
        .auth-right {
            flex: 1;
            padding: 48px 44px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-flash {
            margin-bottom: 20px;
        }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            body.auth-body {
                padding: 0;
                background: #fff;
                align-items: flex-start;
            }

            .auth-container {
                flex-direction: column;
                border-radius: 0;
                box-shadow: none;
                min-height: 100vh;
            }

            .auth-left {
                width: 100%;
                padding: 28px 24px 24px;
                min-height: auto;
                flex-direction: row;
                align-items: center;
                gap: 16px;
            }

            .auth-left::before,
            .auth-left::after { display: none; }

            .auth-left-logo img { width: 48px; height: 48px; }
            .auth-left-title { font-size: 1.1rem; margin-top: 0; }
            .auth-left-subtitle { font-size: 0.75rem; margin-top: 4px; }
            .auth-left-features,
            .auth-left-footer { display: none; }

            .auth-right {
                padding: 28px 24px 40px;
                flex: 1;
            }
        }
    </style>
</head>
<body class="auth-body" id="authBody">

<div class="auth-container">
    {{-- Left Panel --}}
    <div class="auth-left">
        <div>
            <div class="auth-left-logo">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo" onerror="this.style.display='none'">
            </div>
            <div class="auth-left-title">SCC ReportHub</div>
            <div class="auth-left-subtitle">Southern Christian College<br>Campus Facility Status Report & Monitoring System</div>
        </div>

        <div class="auth-left-features">
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="fas fa-ticket"></i></div>
                <div class="auth-feature-text">Submit and track facility issue reports in real-time</div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="fas fa-wrench"></i></div>
                <div class="auth-feature-text">Coordinate maintenance tasks efficiently</div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="auth-feature-text">Monitor campus facility status at a glance</div>
            </div>
        </div>

        <div class="auth-left-footer">© {{ date('Y') }} Southern Christian College. All rights reserved.</div>
    </div>

    {{-- Right Panel --}}
    <div class="auth-right">
        <div class="auth-flash">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
if (localStorage.getItem('darkMode') === 'true') {
    document.body.classList.add('dark-mode');
}
</script>
@stack('scripts')
</body>
</html>
