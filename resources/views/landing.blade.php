<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --accent: #06b6d4;
        }

        /* ── Navbar ── */
        .landing-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 12px 0;
            transition: background 0.3s, box-shadow 0.3s;
            background: rgba(15,23,42,0.85);
            backdrop-filter: blur(12px);
        }
        .landing-nav.scrolled {
            background: rgba(15,23,42,0.97);
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-brand img { width: 36px; height: 36px; object-fit: contain; border-radius: 50%; }
        .nav-brand-text .brand-title {
            font-size: 1rem;
            font-weight: 800;
            background: linear-gradient(135deg, #818cf8, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }
        .nav-brand-text .brand-sub {
            font-size: 0.6rem;
            color: rgba(255,255,255,0.5);
            display: block;
            letter-spacing: 0.05em;
        }
        .nav-links a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
            padding: 6px 4px;
        }
        .nav-links a:hover { color: #fff; }
        .btn-nav-login {
            border: 1.5px solid rgba(255,255,255,0.3);
            color: #fff;
            background: transparent;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-nav-login:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.6);
            color: #fff;
        }
        .btn-nav-signup {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: opacity 0.2s, transform 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-nav-signup:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

        /* ── Mobile fullscreen menu ── */
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(15,23,42,0.98);
            backdrop-filter: blur(16px);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0;
        }
        .mobile-menu-overlay.open { display: flex; }
        .mobile-menu-close {
            position: absolute;
            top: 18px; right: 20px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
            line-height: 1;
        }
        .mobile-menu-overlay a.mobile-nav-link {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 1.4rem;
            font-weight: 600;
            padding: 14px 0;
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            transition: color 0.2s;
        }
        .mobile-menu-overlay a.mobile-nav-link:hover { color: #fff; }
        .mobile-menu-cta {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 80%;
            max-width: 300px;
            margin-top: 32px;
        }
        .mobile-menu-cta .btn-nav-login,
        .mobile-menu-cta .btn-nav-signup {
            width: 100%;
            justify-content: center;
            padding: 14px 20px;
            font-size: 1rem;
            border-radius: 12px;
        }

        /* ── Hero ── */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #312e81 70%, #4f46e5 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(79,70,229,0.35) 0%, transparent 70%);
            top: -200px; right: -200px;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(6,182,212,0.2) 0%, transparent 70%);
            bottom: -150px; left: -150px;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(79,70,229,0.2);
            border: 1px solid rgba(79,70,229,0.4);
            color: #a5b4fc;
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            margin-bottom: 20px;
        }
        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 20px;
        }
        .hero-title .gradient-text {
            background: linear-gradient(135deg, #818cf8, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-desc {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
            max-width: 520px;
            margin-bottom: 36px;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 25px rgba(79,70,229,0.4);
        }
        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(79,70,229,0.5);
            color: #fff;
        }
        .btn-hero-secondary {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 12px;
            padding: 14px 32px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.5);
            color: #fff;
        }

        /* Hero visual card */
        .hero-visual {
            position: relative;
            z-index: 1;
        }
        .hero-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 28px;
            color: #fff;
        }
        .hero-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .hero-card-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }
        .ticket-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            margin-bottom: 10px;
            border: 1px solid rgba(255,255,255,0.07);
        }
        .ticket-icon {
            width: 36px; height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .ticket-info { flex: 1; min-width: 0; }
        .ticket-title { font-size: 0.8rem; font-weight: 600; color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .ticket-meta { font-size: 0.7rem; color: rgba(255,255,255,0.45); }
        .ticket-badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 50px;
            white-space: nowrap;
        }

        /* ── Stats strip ── */
        .stats-strip {
            background: #fff;
            padding: 48px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .stat-item { text-align: center; }
        .stat-number {
            font-size: 2.4rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }
        .stat-label { font-size: 0.85rem; color: #64748b; margin-top: 6px; font-weight: 500; }

        /* ── Features ── */
        .features-section {
            background: #f8fafc;
            padding: 90px 0;
        }
        .section-label {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 12px;
        }
        .section-title {
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }
        .section-desc { color: #64748b; font-size: 1rem; max-width: 560px; margin: 0 auto; }
        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            height: 100%;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(79,70,229,0.1);
            border-color: #c7d2fe;
        }
        .feature-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 18px;
        }
        .feature-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .feature-desc { font-size: 0.875rem; color: #64748b; line-height: 1.6; }

        /* ── How it works ── */
        .how-section { padding: 90px 0; background: #fff; }
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
            margin: 0 auto 16px;
            box-shadow: 0 6px 20px rgba(79,70,229,0.35);
        }
        .step-connector {
            position: absolute;
            top: 24px;
            left: calc(50% + 30px);
            right: calc(-50% + 30px);
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            opacity: 0.3;
        }

        /* ── Roles ── */
        .roles-section {
            padding: 90px 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
        }
        .role-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 32px 28px;
            text-align: center;
            transition: transform 0.2s, background 0.2s;
            height: 100%;
        }
        .role-card:hover {
            transform: translateY(-4px);
            background: rgba(255,255,255,0.1);
        }
        .role-icon {
            width: 64px; height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 20px;
        }
        .role-title { font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 10px; }
        .role-desc { font-size: 0.875rem; color: rgba(255,255,255,0.6); line-height: 1.6; }

        /* ── CTA ── */
        .cta-section {
            padding: 90px 0;
            background: #f8fafc;
        }
        .cta-card {
            background: linear-gradient(135deg, var(--primary) 0%, #312e81 50%, #0f172a 100%);
            border-radius: 24px;
            padding: 64px 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-card::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(6,182,212,0.2) 0%, transparent 70%);
            top: -100px; right: -100px;
            border-radius: 50%;
        }

        /* ── Footer ── */
        .landing-footer {
            background: #0f172a;
            color: rgba(255,255,255,0.5);
            padding: 40px 0;
            font-size: 0.85rem;
        }
        .footer-brand .brand-title {
            font-size: 1.1rem;
            font-weight: 800;
            background: linear-gradient(135deg, #818cf8, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .footer-link { color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.2s; }
        .footer-link:hover { color: #fff; }

        /* ── Mobile nav ── */
        .navbar-toggler-icon-custom { display: none; }

        /* Scroll animation */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body style="font-family:'Inter','Segoe UI',system-ui,sans-serif;">

<!-- ══════════════════════════════════════════════════════════
     MOBILE FULLSCREEN MENU OVERLAY
══════════════════════════════════════════════════════════ -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close menu">
        <i class="fas fa-xmark"></i>
    </button>
    <a href="#features" class="mobile-nav-link">Features</a>
    <a href="#how-it-works" class="mobile-nav-link">How It Works</a>
    <a href="#roles" class="mobile-nav-link">Who It's For</a>
    <div class="mobile-menu-cta">
        <a href="{{ route('login') }}" class="btn-nav-login">
            <i class="fas fa-arrow-right-to-bracket"></i> Log In
        </a>
        <a href="{{ route('register') }}" class="btn-nav-signup">
            <i class="fas fa-user-plus"></i> Sign Up
        </a>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════════════════ -->
<nav class="landing-nav scrolled" id="landingNav">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">

            <!-- Brand -->
            <a href="{{ route('landing') }}" class="nav-brand">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo"
                     onerror="this.style.display='none'">
                <div class="nav-brand-text">
                    <span class="brand-title">SCC ReportHub</span>
                    <span class="brand-sub">Southern Christian College</span>
                </div>
            </a>

            <!-- Desktop nav links -->
            <div class="nav-links d-none d-lg-flex align-items-center gap-4">
                <a href="#features">Features</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#roles">Who It's For</a>
            </div>

            <!-- Desktop CTA buttons -->
            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-nav-login">
                    <i class="fas fa-arrow-right-to-bracket"></i> Log In
                </a>
                <a href="{{ route('register') }}" class="btn-nav-signup">
                    <i class="fas fa-user-plus"></i> Sign Up
                </a>
            </div>

            <!-- Mobile: Login + hamburger -->
            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-nav-login" style="padding:6px 14px;font-size:0.8rem;">
                    <i class="fas fa-arrow-right-to-bracket"></i> Log In
                </a>
                <button class="btn btn-link p-1" id="mobileMenuBtn" aria-label="Open menu"
                        style="color:rgba(255,255,255,0.85);font-size:1.3rem;line-height:1;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</nav>

<!-- ══════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════ -->
<section class="hero-section">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-5">

            <!-- Left: copy -->
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="fas fa-circle-check" style="color:#06b6d4;"></i>
                    Campus Facility Management System
                </div>
                <h1 class="hero-title">
                    Report. Track.<br>
                    <span class="gradient-text">Resolve Faster.</span>
                </h1>
                <p class="hero-desc">
                    SCC ReportHub streamlines facility issue reporting at Southern Christian College.
                    Submit tickets, monitor repairs in real time, and keep the campus running smoothly.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        <i class="fas fa-rocket"></i> Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary">
                        <i class="fas fa-arrow-right-to-bracket"></i> Sign In
                    </a>
                </div>
                <div class="d-flex align-items-center gap-4 mt-4" style="color:rgba(255,255,255,0.5);font-size:0.8rem;">
                    <span><i class="fas fa-check me-1" style="color:#10b981;"></i> Free for SCC Faculty</span>
                    <span><i class="fas fa-check me-1" style="color:#10b981;"></i> Real-time Updates</span>
                    <span><i class="fas fa-check me-1" style="color:#10b981;"></i> No App Needed</span>
                </div>
            </div>

            <!-- Right: mock dashboard card -->
            <div class="col-lg-6 hero-visual">
                <div class="hero-card">
                    <div class="hero-card-header">
                        <div class="hero-card-dot" style="background:#ef4444;"></div>
                        <div class="hero-card-dot" style="background:#f59e0b;"></div>
                        <div class="hero-card-dot" style="background:#10b981;"></div>
                        <span style="font-size:0.78rem;color:rgba(255,255,255,0.5);margin-left:8px;">Active Tickets</span>
                        <span class="ms-auto" style="font-size:0.75rem;color:rgba(255,255,255,0.4);">Live</span>
                        <span style="width:8px;height:8px;background:#10b981;border-radius:50%;display:inline-block;animation:pulse 1.5s infinite;"></span>
                    </div>

                    <div class="ticket-item">
                        <div class="ticket-icon" style="background:rgba(239,68,68,0.15);color:#ef4444;">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="ticket-info">
                            <div class="ticket-title">Electrical outlet not working – Room 204</div>
                            <div class="ticket-meta">Submitted 10 mins ago · Science Building</div>
                        </div>
                        <span class="ticket-badge" style="background:rgba(239,68,68,0.15);color:#ef4444;">Urgent</span>
                    </div>

                    <div class="ticket-item">
                        <div class="ticket-icon" style="background:rgba(6,182,212,0.15);color:#06b6d4;">
                            <i class="fas fa-faucet"></i>
                        </div>
                        <div class="ticket-info">
                            <div class="ticket-title">Leaking faucet in comfort room</div>
                            <div class="ticket-meta">Assigned to Juan D. · 2 hrs ago</div>
                        </div>
                        <span class="ticket-badge" style="background:rgba(6,182,212,0.15);color:#06b6d4;">Ongoing</span>
                    </div>

                    <div class="ticket-item">
                        <div class="ticket-icon" style="background:rgba(16,185,129,0.15);color:#10b981;">
                            <i class="fas fa-wind"></i>
                        </div>
                        <div class="ticket-info">
                            <div class="ticket-title">AC unit not cooling – Faculty Lounge</div>
                            <div class="ticket-meta">Resolved yesterday · Admin Building</div>
                        </div>
                        <span class="ticket-badge" style="background:rgba(16,185,129,0.15);color:#10b981;">Completed</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.08);">
                        <span style="font-size:0.75rem;color:rgba(255,255,255,0.4);">Showing 3 of 24 active tickets</span>
                        <span style="font-size:0.75rem;color:#818cf8;cursor:pointer;">View all →</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     STATS STRIP
══════════════════════════════════════════════════════════ -->
<section class="stats-strip">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3 stat-item fade-up">
                <div class="stat-number">500+</div>
                <div class="stat-label">Tickets Resolved</div>
            </div>
            <div class="col-6 col-md-3 stat-item fade-up" style="transition-delay:0.1s;">
                <div class="stat-number">3</div>
                <div class="stat-label">User Roles Supported</div>
            </div>
            <div class="col-6 col-md-3 stat-item fade-up" style="transition-delay:0.2s;">
                <div class="stat-number">24/7</div>
                <div class="stat-label">System Availability</div>
            </div>
            <div class="col-6 col-md-3 stat-item fade-up" style="transition-delay:0.3s;">
                <div class="stat-number">100%</div>
                <div class="stat-label">Web-Based, No Install</div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     FEATURES
══════════════════════════════════════════════════════════ -->
<section class="features-section" id="features">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label">Features</div>
            <h2 class="section-title mb-3">Everything you need to manage<br>campus facilities</h2>
            <p class="section-desc">From ticket submission to resolution, ReportHub covers the full maintenance lifecycle.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eef2ff;color:#4f46e5;">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="feature-title">Easy Ticket Submission</div>
                    <div class="feature-desc">Faculty and staff can report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.1s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#ecfdf5;color:#10b981;">
                        <i class="fas fa-magnifying-glass-chart"></i>
                    </div>
                    <div class="feature-title">Real-Time Monitoring</div>
                    <div class="feature-desc">Track every ticket from submission to completion. Know exactly who's working on it and when it'll be done.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.2s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fff7ed;color:#f59e0b;">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="feature-title">Instant Notifications</div>
                    <div class="feature-desc">Get notified when your ticket is approved, assigned, or resolved — no need to follow up manually.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.1s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eff6ff;color:#3b82f6;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="feature-title">Admin Dashboard</div>
                    <div class="feature-desc">Admins get a bird's-eye view with charts, stats, and full control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.2s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fdf4ff;color:#a855f7;">
                        <i class="fas fa-screwdriver-wrench"></i>
                    </div>
                    <div class="feature-title">Maintenance Task Management</div>
                    <div class="feature-desc">Maintenance staff see their assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.3s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fff1f2;color:#ef4444;">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="feature-title">Feedback & Ratings</div>
                    <div class="feature-desc">After a ticket is resolved, faculty can rate the service — helping admins improve maintenance quality over time.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════════════════════════ -->
<section class="how-section" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label">How It Works</div>
            <h2 class="section-title mb-3">From report to resolution<br>in four simple steps</h2>
        </div>

        <div class="row g-4 text-center">
            <div class="col-6 col-md-3 fade-up">
                <div class="step-number">1</div>
                <h6 class="fw-700 mb-2" style="font-weight:700;">Submit a Ticket</h6>
                <p class="text-muted small">Describe the issue, set priority, and attach a photo if needed.</p>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.1s;">
                <div class="step-number">2</div>
                <h6 class="fw-700 mb-2" style="font-weight:700;">Admin Reviews</h6>
                <p class="text-muted small">Admin approves the ticket and assigns it to the right maintenance staff.</p>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.2s;">
                <div class="step-number">3</div>
                <h6 class="fw-700 mb-2" style="font-weight:700;">Repair in Progress</h6>
                <p class="text-muted small">Maintenance staff works on the task and updates progress in real time.</p>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.3s;">
                <div class="step-number">4</div>
                <h6 class="fw-700 mb-2" style="font-weight:700;">Resolved & Rated</h6>
                <p class="text-muted small">Admin verifies completion. Faculty rates the service. Done.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     ROLES
══════════════════════════════════════════════════════════ -->
<section class="roles-section" id="roles">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label" style="color:#a5b4fc;">Who It's For</div>
            <h2 class="section-title mb-3" style="color:#fff;">Built for every role<br>in the campus</h2>
            <p class="section-desc" style="color:rgba(255,255,255,0.6);">Three distinct portals, each tailored to how that role interacts with facility management.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 fade-up">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(79,70,229,0.2);color:#818cf8;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="role-title">Admin</div>
                    <div class="role-desc">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
                        <span style="font-size:0.7rem;background:rgba(79,70,229,0.2);color:#a5b4fc;padding:4px 10px;border-radius:50px;">Dashboard</span>
                        <span style="font-size:0.7rem;background:rgba(79,70,229,0.2);color:#a5b4fc;padding:4px 10px;border-radius:50px;">User Management</span>
                        <span style="font-size:0.7rem;background:rgba(79,70,229,0.2);color:#a5b4fc;padding:4px 10px;border-radius:50px;">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:0.1s;">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(6,182,212,0.2);color:#67e8f9;">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <div class="role-title">Faculty / Staff</div>
                    <div class="role-desc">Report facility issues, track your ticket status in real time, and rate the service once your request is resolved.</div>
                    <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
                        <span style="font-size:0.7rem;background:rgba(6,182,212,0.2);color:#67e8f9;padding:4px 10px;border-radius:50px;">Submit Tickets</span>
                        <span style="font-size:0.7rem;background:rgba(6,182,212,0.2);color:#67e8f9;padding:4px 10px;border-radius:50px;">Track Status</span>
                        <span style="font-size:0.7rem;background:rgba(6,182,212,0.2);color:#67e8f9;padding:4px 10px;border-radius:50px;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:0.2s;">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(16,185,129,0.2);color:#6ee7b7;">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div class="role-title">Maintenance Staff</div>
                    <div class="role-desc">View assigned tasks, update repair progress, and mark jobs complete. Everything you need to stay on top of your workload.</div>
                    <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
                        <span style="font-size:0.7rem;background:rgba(16,185,129,0.2);color:#6ee7b7;padding:4px 10px;border-radius:50px;">Task Queue</span>
                        <span style="font-size:0.7rem;background:rgba(16,185,129,0.2);color:#6ee7b7;padding:4px 10px;border-radius:50px;">Progress Updates</span>
                        <span style="font-size:0.7rem;background:rgba(16,185,129,0.2);color:#6ee7b7;padding:4px 10px;border-radius:50px;">History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     CTA
══════════════════════════════════════════════════════════ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card fade-up">
            <div class="position-relative" style="z-index:1;">
                <div class="section-label" style="color:#a5b4fc;justify-content:center;display:flex;">Get Started Today</div>
                <h2 style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#fff;margin-bottom:16px;">
                    Ready to keep your campus<br>in top shape?
                </h2>
                <p style="color:rgba(255,255,255,0.65);font-size:1rem;max-width:480px;margin:0 auto 36px;">
                    Join the SCC community on ReportHub. Create your account and start reporting facility issues in minutes.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('register') }}" class="btn-hero-primary" style="font-size:1rem;">
                        <i class="fas fa-user-plus"></i> Create an Account
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary" style="font-size:1rem;">
                        <i class="fas fa-arrow-right-to-bracket"></i> Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════════════════ -->
<footer class="landing-footer">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-4">
                <div class="footer-brand d-flex align-items-center gap-2">
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="28" height="28"
                         style="border-radius:50%;object-fit:contain;"
                         onerror="this.style.display='none'">
                    <span class="brand-title">SCC ReportHub</span>
                </div>
                <p class="mt-2 mb-0" style="font-size:0.78rem;">Campus Facility Status Report &amp; Monitoring System</p>
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
                <p class="mb-0" style="font-size:0.78rem;">
                    &copy; {{ date('Y') }} Southern Christian College. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- ══════════════════════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════════════════════ -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar scroll effect
    const nav = document.getElementById('landingNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
    });

    // Mobile fullscreen menu
    const mobileBtn     = document.getElementById('mobileMenuBtn');
    const mobileOverlay = document.getElementById('mobileMenuOverlay');
    const mobileClose   = document.getElementById('mobileMenuClose');

    mobileBtn.addEventListener('click', () => {
        mobileOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    });

    function closeMenu() {
        mobileOverlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    mobileClose.addEventListener('click', closeMenu);

    // Close on nav link click and smooth scroll
    mobileOverlay.querySelectorAll('a.mobile-nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                closeMenu();
                setTimeout(() => {
                    const target = document.querySelector(href);
                    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 300);
            } else {
                closeMenu();
            }
        });
    });

    // Smooth scroll for desktop anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Scroll-triggered fade-up animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    // Pulse animation for live dot
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }
    `;
    document.head.appendChild(style);
</script>
</body>
</html>
