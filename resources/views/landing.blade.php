<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ── Design tokens (same as dashboard) ── */
        :root {
            --primary:       #4f46e5;
            --primary-dark:  #3730a3;
            --primary-light: #818cf8;
            --accent:        #06b6d4;
            --success:       #10b981;
            --warning:       #f59e0b;
            --danger:        #ef4444;
            --body-bg:       #f1f5f9;
            --card-bg:       #ffffff;
            --border:        #e2e8f0;
            --text:          #0f172a;
            --text-sec:      #64748b;
            --text-muted:    #94a3b8;
            --sidebar-bg:    #0f172a;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            font-size: 0.875rem;
            background: var(--body-bg);
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a { color: var(--primary); text-decoration: none; }

        /* ══ NAVBAR ══════════════════════════════════════════════ */
        .landing-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-brand img {
            width: 36px; height: 36px;
            object-fit: contain;
            border-radius: 50%;
            background: #fff;
            padding: 2px;
            border: 1px solid var(--border);
        }
        .nav-brand-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1.1;
            letter-spacing: -0.3px;
        }
        .nav-brand-sub {
            font-size: 0.6rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }
        .nav-links a {
            color: var(--text-sec);
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.15s;
        }
        .nav-links a:hover { color: var(--primary); }

        .btn-nav-login {
            border: 1.5px solid var(--border);
            color: var(--text-sec);
            background: #fff;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-nav-login:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #fafbff;
        }
        .btn-nav-signup {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background 0.15s, transform 0.15s, box-shadow 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(79,70,229,0.25);
        }
        .btn-nav-signup:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(79,70,229,0.35); color: #fff; }

        /* Mobile overlay menu */
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1100;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(8px);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0;
        }
        .mobile-menu-overlay.open { display: flex; }
        .mobile-menu-close {
            position: absolute;
            top: 18px; right: 20px;
            background: none; border: none;
            color: var(--text-sec);
            font-size: 1.5rem;
            cursor: pointer;
        }
        .mobile-nav-link {
            color: var(--text);
            font-size: 1.3rem;
            font-weight: 600;
            padding: 14px 0;
            width: 100%;
            text-align: center;
            border-bottom: 1px solid var(--border);
            transition: color 0.15s;
            display: block;
        }
        .mobile-nav-link:hover { color: var(--primary); }
        .mobile-menu-cta {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 80%;
            max-width: 300px;
            margin-top: 28px;
        }
        .mobile-menu-cta .btn-nav-login,
        .mobile-menu-cta .btn-nav-signup {
            width: 100%;
            justify-content: center;
            padding: 13px 20px;
            font-size: 0.95rem;
            border-radius: 10px;
        }

        /* ══ HERO ════════════════════════════════════════════════ */
        .hero-section {
            padding-top: 64px;
            min-height: 100vh;
            background: linear-gradient(160deg, #fff 0%, #f1f5f9 50%, #eef2ff 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(79,70,229,0.07) 0%, transparent 70%);
            top: -100px; right: -100px;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(6,182,212,0.06) 0%, transparent 70%);
            bottom: -100px; left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            color: var(--primary);
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            margin-bottom: 20px;
        }
        .hero-title {
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 800;
            color: var(--text);
            line-height: 1.15;
            letter-spacing: -0.5px;
            margin-bottom: 18px;
        }
        .hero-title .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-desc {
            font-size: 1rem;
            color: var(--text-sec);
            line-height: 1.7;
            max-width: 500px;
            margin-bottom: 32px;
        }
        .btn-hero-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px 32px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s, box-shadow 0.15s, transform 0.15s;
            box-shadow: 0 2px 8px rgba(79,70,229,0.25);
            letter-spacing: 0.01em;
        }
        .btn-hero-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(79,70,229,0.35);
            transform: translateY(-1px);
            color: #fff;
        }
        .btn-hero-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid #c7d2fe;
            border-radius: 10px;
            padding: 14px 32px;
            font-size: 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.15s;
        }
        .btn-hero-outline:hover { background: #eef2ff; border-color: var(--primary); color: var(--primary-dark); }
        .btn-hero-secondary {
            background: #fff;
            color: var(--text);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 13px 28px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: border-color 0.15s, color 0.15s;
        }
        .btn-hero-secondary:hover { border-color: var(--primary); color: var(--primary); }

        /* ══ HOLOGRAM ROLE CARDS ═════════════════════════════════ */
        .holo-stack {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .holo-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 16px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow:
                0 4px 24px rgba(79,70,229,0.08),
                0 1px 4px rgba(0,0,0,0.04),
                inset 0 1px 0 rgba(255,255,255,0.8);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .holo-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, transparent 60%);
            pointer-events: none;
        }
        .holo-card:hover {
            transform: translateY(-3px) translateX(4px);
            box-shadow:
                0 12px 40px rgba(79,70,229,0.14),
                0 2px 8px rgba(0,0,0,0.06),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }
        .holo-card:nth-child(1) { transform: translateX(0px); }
        .holo-card:nth-child(2) { transform: translateX(16px); }
        .holo-card:nth-child(3) { transform: translateX(8px); }
        .holo-card:nth-child(1):hover { transform: translateX(4px) translateY(-3px); }
        .holo-card:nth-child(2):hover { transform: translateX(20px) translateY(-3px); }
        .holo-card:nth-child(3):hover { transform: translateX(12px) translateY(-3px); }
        .holo-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .holo-info { flex: 1; }
        .holo-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }
        .holo-desc {
            font-size: 0.75rem;
            color: var(--text-sec);
            line-height: 1.4;
        }
        .holo-glow {
            position: absolute;
            width: 120px; height: 120px;
            border-radius: 50%;
            opacity: 0.12;
            right: -20px; top: -20px;
            pointer-events: none;
        }

        /* ══ SECTIONS ════════════════════════════════════════════ */
        .section-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 10px;
        }
        .section-title {
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
            letter-spacing: -0.3px;
        }
        .section-desc { color: var(--text-sec); font-size: 0.95rem; max-width: 540px; margin: 0 auto; }

        /* ══ FEATURES ════════════════════════════════════════════ */
        .features-section { background: var(--body-bg); padding: 80px 0; }
        .feature-card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 26px;
            height: 100%;
            border: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(79,70,229,0.1);
            border-color: #c7d2fe;
        }
        .feature-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 16px;
        }
        .feature-title { font-size: 0.95rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
        .feature-desc { font-size: 0.845rem; color: var(--text-sec); line-height: 1.6; }

        /* ══ HOW IT WORKS ════════════════════════════════════════ */
        .how-section { padding: 80px 0; background: var(--card-bg); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .step-wrap { text-align: center; }
        .step-number {
            width: 48px; height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            font-size: 1.1rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            box-shadow: 0 4px 14px rgba(79,70,229,0.3);
        }
        .step-title { font-size: 0.9rem; font-weight: 700; color: var(--text); margin-bottom: 6px; }
        .step-desc { font-size: 0.82rem; color: var(--text-sec); }

        /* ══ ROLES ═══════════════════════════════════════════════ */
        .roles-section { padding: 80px 0; background: var(--body-bg); }
        .role-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px 24px;
            text-align: center;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .role-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(79,70,229,0.1);
            border-color: #c7d2fe;
        }
        .role-icon {
            width: 60px; height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 18px;
        }
        .role-title { font-size: 1rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
        .role-desc { font-size: 0.845rem; color: var(--text-sec); line-height: 1.6; }
        .role-tag {
            font-size: 0.68rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
            display: inline-block;
            margin: 2px;
        }

        /* ══ CTA ═════════════════════════════════════════════════ */
        .cta-section { padding: 80px 0; background: var(--card-bg); border-top: 1px solid var(--border); }
        .cta-inner {
            background: linear-gradient(135deg, #eef2ff 0%, #f0fdff 100%);
            border: 1px solid #c7d2fe;
            border-radius: 20px;
            padding: 56px 40px;
            text-align: center;
        }

        /* ══ FOOTER ══════════════════════════════════════════════ */
        .landing-footer {
            background: var(--sidebar-bg);
            color: rgba(255,255,255,0.45);
            padding: 36px 0;
            font-size: 0.82rem;
        }
        .footer-brand-title {
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
        }
        .footer-link { color: rgba(255,255,255,0.45); transition: color 0.15s; }
        .footer-link:hover { color: #fff; }

        /* ══ ANIMATIONS ══════════════════════════════════════════ */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* ══ RESPONSIVE ══════════════════════════════════════════ */
        @media (max-width: 767px) {
            .hero-section {
                padding-top: 64px;
                min-height: auto;
                padding-bottom: 40px;
            }
            .hero-section .container {
                padding-top: 28px !important;
                padding-bottom: 32px !important;
            }
            .hero-badge {
                font-size: 0.7rem;
                padding: 4px 12px;
                margin-bottom: 14px;
            }
            .hero-title {
                font-size: 1.75rem;
                margin-bottom: 12px;
                letter-spacing: -0.3px;
            }
            .hero-desc {
                font-size: 0.875rem;
                margin-bottom: 22px;
                line-height: 1.6;
            }
            .btn-hero-primary {
                width: 100%;
                justify-content: center;
                padding: 12px 24px;
                font-size: 0.9rem;
            }
            .hero-checks {
                font-size: 0.75rem !important;
                gap: 10px !important;
            }
            .hero-visual {
                margin-top: 8px;
            }
            .hero-card {
                padding: 18px;
            }
            .cat-item {
                padding: 8px 10px;
            }
            .cat-label {
                font-size: 0.75rem;
            }
            .cat-icon {
                width: 28px; height: 28px;
                font-size: 0.72rem;
            }
            .stats-strip { padding: 28px 0; }
            .stat-number { font-size: 1.7rem; }
            .stat-label { font-size: 0.72rem; }
            .features-section,
            .how-section,
            .roles-section,
            .cta-section { padding: 48px 0; }
            .section-title { font-size: 1.35rem; }
            .section-desc { font-size: 0.875rem; }
            .feature-card { padding: 20px; }
            .feature-icon { width: 42px; height: 42px; font-size: 1rem; margin-bottom: 12px; }
            .feature-title { font-size: 0.875rem; }
            .feature-desc { font-size: 0.8rem; }
            .step-number { width: 40px; height: 40px; font-size: 1rem; }
            .step-title { font-size: 0.82rem; }
            .step-desc { font-size: 0.78rem; }
            .role-card { padding: 22px 18px; }
            .role-icon { width: 50px; height: 50px; font-size: 1.3rem; margin-bottom: 14px; }
            .role-title { font-size: 0.9rem; }
            .role-desc { font-size: 0.8rem; }
            .cta-inner { padding: 32px 20px; border-radius: 16px; }
            .cta-inner .section-title { font-size: 1.3rem; }
            .cta-inner .btn-hero-primary { width: 100%; justify-content: center; }
            .landing-footer { padding: 28px 0; }
            .landing-footer .row > div { text-align: center !important; }
            .landing-footer .d-flex { justify-content: center !important; }
        }

        @media (max-width: 480px) {
            .hero-title { font-size: 1.55rem; }
            .nav-brand-sub { display: none; }
        }
    </style>
</head>
<body>

<!-- ══ MOBILE OVERLAY ══════════════════════════════════════════ -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close"><i class="fas fa-xmark"></i></button>
    <a href="#features" class="mobile-nav-link">Features</a>
    <a href="#how-it-works" class="mobile-nav-link">How It Works</a>
    <a href="#roles" class="mobile-nav-link">Who It's For</a>
    <div class="mobile-menu-cta">
        <a href="{{ route('register') }}" class="btn-nav-signup" style="width:100%;justify-content:center;padding:13px 20px;font-size:0.95rem;border-radius:10px;">
            Sign Up
        </a>
        <a href="{{ route('login') }}" class="btn-nav-login" style="width:100%;justify-content:center;padding:13px 20px;font-size:0.95rem;border-radius:10px;">
            Sign In
        </a>
    </div>
</div>

<!-- ══ NAVBAR ═════════════════════════════════════════════════ -->
<nav class="landing-nav">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('landing') }}" class="nav-brand">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo" onerror="this.style.display='none'">
                <div>
                    <span class="nav-brand-title">SCC ReportHub</span>
                    <span class="nav-brand-sub">Southern Christian College</span>
                </div>
            </a>

            <div class="nav-links d-none d-lg-flex">
                <a href="#features">Features</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#roles">Who It's For</a>
            </div>

            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-nav-login">Sign In</a>
                <a href="{{ route('register') }}" class="btn-nav-signup">Sign Up</a>
            </div>

            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-nav-login" style="padding:6px 12px;font-size:0.8rem;">
                    Sign In
                </a>
                <button class="btn btn-link p-1" id="mobileMenuBtn" style="color:var(--text-sec);font-size:1.2rem;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- ══ HERO ═══════════════════════════════════════════════════ -->
<section class="hero-section">
    <div class="container position-relative" style="z-index:1;padding-top:48px;padding-bottom:64px;">
        <div class="row align-items-center g-5">

            <!-- Left -->
            <div class="col-lg-6 col-12">
                <div class="hero-badge">
                    <i class="fas fa-building"></i> Campus Facility Management System
                </div>
                <h1 class="hero-title">
                    Report. Track.<br>
                    <span class="gradient-text">Resolve Faster.</span>
                </h1>
                <p class="hero-desc">
                    SCC ReportHub streamlines facility issue reporting at Southern Christian College.
                    Submit tickets, monitor repairs in real time, and keep the campus running smoothly.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-3">
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        Get Started
                    </a>
                </div>

            </div>

            <!-- Right: hologram role cards -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                <div class="holo-stack" style="width:100%;max-width:380px;">
                    <div class="holo-card">
                        <div class="holo-glow" style="background:#4f46e5;"></div>
                        <div class="holo-icon" style="background:#eef2ff;color:#4f46e5;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="holo-info">
                            <div class="holo-title">Admin</div>
                            <div class="holo-desc">Manage tickets, users, facilities, and view analytics.</div>
                        </div>
                    </div>
                    <div class="holo-card">
                        <div class="holo-glow" style="background:#3b82f6;"></div>
                        <div class="holo-icon" style="background:#eff6ff;color:#3b82f6;">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                        <div class="holo-info">
                            <div class="holo-title">Faculty / Staff</div>
                            <div class="holo-desc">Submit tickets and track repair status in real time.</div>
                        </div>
                    </div>
                    <div class="holo-card">
                        <div class="holo-glow" style="background:#10b981;"></div>
                        <div class="holo-icon" style="background:#ecfdf5;color:#10b981;">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <div class="holo-info">
                            <div class="holo-title">Maintenance Staff</div>
                            <div class="holo-desc">View assigned tasks and update repair progress.</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══ FEATURES ═══════════════════════════════════════════════ -->
<section class="features-section" id="features">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label">Features</div>
            <h2 class="section-title mb-3">Everything you need to manage campus facilities</h2>
            <p class="section-desc">From ticket submission to resolution, ReportHub covers the full maintenance lifecycle.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-ticket-alt"></i></div>
                    <div class="feature-title">Easy Ticket Submission</div>
                    <div class="feature-desc">Faculty and staff report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.1s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="feature-title">Real-Time Monitoring</div>
                    <div class="feature-desc">Track every ticket from submission to completion. Know exactly who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.2s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fffbeb;color:#f59e0b;"><i class="fas fa-bell"></i></div>
                    <div class="feature-title">Instant Notifications</div>
                    <div class="feature-desc">Get notified when your ticket is approved, assigned, or resolved — no need to follow up manually.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.1s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chart-pie"></i></div>
                    <div class="feature-title">Admin Dashboard</div>
                    <div class="feature-desc">Admins get a full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.2s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fdf4ff;color:#a855f7;"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="feature-title">Maintenance Task Management</div>
                    <div class="feature-desc">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.3s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fef2f2;color:#ef4444;"><i class="fas fa-star"></i></div>
                    <div class="feature-title">Feedback & Ratings</div>
                    <div class="feature-desc">After a ticket is resolved, faculty can rate the service — helping admins improve maintenance quality.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ HOW IT WORKS ═══════════════════════════════════════════ -->
<section class="how-section" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label">How It Works</div>
            <h2 class="section-title mb-3">From report to resolution in four steps</h2>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3 fade-up">
                <div class="step-wrap">
                    <div class="step-number">1</div>
                    <div class="step-title">Submit a Ticket</div>
                    <div class="step-desc">Describe the issue, set priority, and attach a photo if needed.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.1s;">
                <div class="step-wrap">
                    <div class="step-number">2</div>
                    <div class="step-title">Admin Reviews</div>
                    <div class="step-desc">Admin approves and assigns it to the right maintenance staff.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.2s;">
                <div class="step-wrap">
                    <div class="step-number">3</div>
                    <div class="step-title">Repair in Progress</div>
                    <div class="step-desc">Maintenance staff works on the task and updates progress.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.3s;">
                <div class="step-wrap">
                    <div class="step-number">4</div>
                    <div class="step-title">Resolved & Rated</div>
                    <div class="step-desc">Admin verifies completion. Faculty rates the service. Done.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ ROLES ══════════════════════════════════════════════════ -->
<section class="roles-section" id="roles">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label">Who It's For</div>
            <h2 class="section-title mb-3">Built for every role in the campus</h2>
            <p class="section-desc">Three distinct portals, each tailored to how that role interacts with facility management.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fade-up">
                <div class="role-card">
                    <div class="role-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-user-shield"></i></div>
                    <div class="role-title">Admin</div>
                    <div class="role-desc mb-3">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="role-tag" style="background:#eef2ff;color:#3730a3;">Dashboard</span>
                        <span class="role-tag" style="background:#eef2ff;color:#3730a3;">User Management</span>
                        <span class="role-tag" style="background:#eef2ff;color:#3730a3;">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:0.1s;">
                <div class="role-card">
                    <div class="role-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="role-title">Faculty / Staff</div>
                    <div class="role-desc mb-3">Report facility issues, track your ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="role-tag" style="background:#eff6ff;color:#1e40af;">Submit Tickets</span>
                        <span class="role-tag" style="background:#eff6ff;color:#1e40af;">Track Status</span>
                        <span class="role-tag" style="background:#eff6ff;color:#1e40af;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:0.2s;">
                <div class="role-card">
                    <div class="role-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                    <div class="role-title">Maintenance Staff</div>
                    <div class="role-desc mb-3">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
                    <div>
                        <span class="role-tag" style="background:#ecfdf5;color:#065f46;">Task Queue</span>
                        <span class="role-tag" style="background:#ecfdf5;color:#065f46;">Progress Updates</span>
                        <span class="role-tag" style="background:#ecfdf5;color:#065f46;">History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ CTA ════════════════════════════════════════════════════ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-inner fade-up">
            <div class="section-label" style="justify-content:center;display:flex;">Get Started</div>
            <h2 class="section-title mb-3">Ready to keep your campus in top shape?</h2>
            <p class="section-desc mb-4" style="margin:0 auto 28px;">Join the SCC community on ReportHub. Create your account and start reporting facility issues in minutes.</p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="{{ route('register') }}" class="btn-hero-primary">Create an Account</a>
            </div>
    </div>
</section>

<!-- ══ FOOTER ═════════════════════════════════════════════════ -->
<footer class="landing-footer">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="26" height="26"
                         style="border-radius:50%;object-fit:contain;background:#fff;padding:2px;"
                         onerror="this.style.display='none'">
                    <span class="footer-brand-title">SCC ReportHub</span>
                </div>
                <p class="mb-0" style="font-size:0.75rem;">Campus Facility Status Report &amp; Monitoring System</p>
            </div>
            <div class="col-md-4 text-md-center">
                <div class="d-flex gap-3 justify-content-md-center flex-wrap">
                    <a href="#features" class="footer-link">Features</a>
                    <a href="#how-it-works" class="footer-link">How It Works</a>
                    <a href="#roles" class="footer-link">Roles</a>
                    <a href="{{ route('login') }}" class="footer-link">Login</a>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="mb-0" style="font-size:0.75rem;">&copy; {{ date('Y') }} Southern Christian College. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- ══ SCRIPTS ════════════════════════════════════════════════ -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile menu
    const overlay   = document.getElementById('mobileMenuOverlay');
    const closeBtn  = document.getElementById('mobileMenuClose');
    const openBtn   = document.getElementById('mobileMenuBtn');

    openBtn.addEventListener('click', () => { overlay.classList.add('open'); document.body.style.overflow='hidden'; });
    function closeMenu() { overlay.classList.remove('open'); document.body.style.overflow=''; }
    closeBtn.addEventListener('click', closeMenu);
    overlay.querySelectorAll('a.mobile-nav-link').forEach(l => {
        l.addEventListener('click', e => {
            const h = l.getAttribute('href');
            if (h.startsWith('#')) {
                e.preventDefault(); closeMenu();
                setTimeout(() => { const t = document.querySelector(h); if(t) t.scrollIntoView({behavior:'smooth'}); }, 280);
            } else closeMenu();
        });
    });

    // Smooth scroll desktop
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({behavior:'smooth'}); }
        });
    });

    // Fade-up on scroll
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
</script>
</body>
</html>
