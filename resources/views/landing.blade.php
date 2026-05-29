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
        :root {
            --primary:      #4f46e5;
            --primary-dark: #3730a3;
            --accent:       #06b6d4;
            --success:      #10b981;
            --body-bg:      #f8fafc;
            --card-bg:      #ffffff;
            --border:       #e2e8f0;
            --text:         #0f172a;
            --text-sec:     #64748b;
            --text-muted:   #94a3b8;
            --sidebar-bg:   #0f172a;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.875rem;
            background: var(--body-bg);
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        a { color: var(--primary); text-decoration: none; }

        /* ── NAVBAR ─────────────────────────────────────────────── */
        .landing-nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 1000; height: 64px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            display: flex; align-items: center;
        }
        .nav-inner { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand img { width: 34px; height: 34px; object-fit: contain; border-radius: 50%; background: #fff; padding: 2px; border: 1px solid var(--border); }
        .nav-brand-title {
            font-size: 0.95rem; font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, #6366f1 50%, var(--accent) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            line-height: 1.1; letter-spacing: -0.3px;
        }
        .nav-brand-sub { font-size: 0.58rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; display: block; }
        .nav-links { display: flex; align-items: center; gap: 28px; }
        .nav-links a { color: var(--text-sec); font-size: 0.875rem; font-weight: 500; transition: color 0.15s; }
        .nav-links a:hover { color: var(--primary); }
        .btn-nav-login {
            border: 1.5px solid var(--border); color: var(--text-sec); background: #fff;
            border-radius: 8px; padding: 7px 18px; font-size: 0.875rem; font-weight: 600;
            transition: all 0.15s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-nav-login:hover { border-color: var(--primary); color: var(--primary); background: #fafbff; }
        .btn-nav-signup {
            background: var(--primary); color: #fff; border: none;
            border-radius: 8px; padding: 7px 18px; font-size: 0.875rem; font-weight: 600;
            transition: background 0.15s, transform 0.15s, box-shadow 0.15s;
            display: inline-flex; align-items: center; gap: 6px;
            box-shadow: 0 2px 8px rgba(79,70,229,0.25);
        }
        .btn-nav-signup:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(79,70,229,0.35); color: #fff; }

        /* ── MOBILE OVERLAY ─────────────────────────────────────── */
        .mobile-menu-overlay {
            display: none; position: fixed; inset: 0; z-index: 1100;
            background: rgba(255,255,255,0.98); backdrop-filter: blur(8px);
            flex-direction: column; align-items: center; justify-content: center;
        }
        .mobile-menu-overlay.open { display: flex; }
        .mobile-menu-close { position: absolute; top: 18px; right: 20px; background: none; border: none; color: var(--text-sec); font-size: 1.5rem; cursor: pointer; }
        .mobile-nav-link {
            color: var(--text); font-size: 1.25rem; font-weight: 600;
            padding: 14px 0; width: 100%; text-align: center;
            border-bottom: 1px solid var(--border); transition: color 0.15s; display: block;
        }
        .mobile-nav-link:hover { color: var(--primary); }
        .mobile-menu-cta { display: flex; flex-direction: column; gap: 10px; width: 80%; max-width: 280px; margin-top: 28px; }
        .mobile-menu-cta .btn-nav-login,
        .mobile-menu-cta .btn-nav-signup { width: 100%; justify-content: center; padding: 12px 20px; font-size: 0.9rem; border-radius: 10px; }

        /* ── HERO ───────────────────────────────────────────────── */
        .hero-section {
            padding-top: 64px;
            min-height: 100vh;
            background: linear-gradient(150deg, #ffffff 0%, #f8fafc 40%, #eef2ff 100%);
            display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        .hero-section::after {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(79,70,229,0.06) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 20% 80%, rgba(6,182,212,0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-inner { padding-top: 56px; padding-bottom: 72px; position: relative; z-index: 1; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 7px;
            background: #eef2ff; border: 1px solid #c7d2fe; color: var(--primary);
            border-radius: 50px; padding: 5px 14px; font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.04em; margin-bottom: 22px;
        }
        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 800; color: var(--text);
            line-height: 1.12; letter-spacing: -0.6px; margin-bottom: 18px;
        }
        .hero-title .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-desc { font-size: 1rem; color: var(--text-sec); line-height: 1.75; max-width: 480px; margin-bottom: 36px; }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #6366f1 50%, var(--accent) 100%);
            color: #fff;
            border: none;
            border-radius: 9px; padding: 13px 36px; font-size: 0.95rem; font-weight: 600;
            display: inline-flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(79,70,229,0.35);
            transition: opacity 0.15s, transform 0.15s, box-shadow 0.15s;
            letter-spacing: 0.01em;
        }
        .btn-hero-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79,70,229,0.45);
            color: #fff;
        }

        /* ── HOLO WRAPPER BOX ───────────────────────────────────── */
        .holo-wrapper {
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.85);
            border-radius: 24px;
            padding: 20px;
            box-shadow:
                0 8px 32px rgba(79,70,229,0.08),
                0 2px 8px rgba(0,0,0,0.04),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }

        /* ── HOLO CARDS ─────────────────────────────────────────── */
        .holo-stack { display: flex; flex-direction: column; gap: 14px; }
        .holo-card {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.95);
            border-radius: 16px; padding: 18px 22px;
            display: flex; align-items: center; gap: 16px;
            box-shadow: 0 4px 20px rgba(79,70,229,0.07), 0 1px 3px rgba(0,0,0,0.04), inset 0 1px 0 rgba(255,255,255,0.8);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            position: relative; overflow: hidden;
        }
        .holo-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.5) 0%, transparent 55%);
            pointer-events: none;
        }
        .holo-card:nth-child(1) { transform: none; }
        .holo-card:nth-child(2) { transform: none; }
        .holo-card:nth-child(3) { transform: none; }
        .holo-card:hover { box-shadow: 0 10px 36px rgba(79,70,229,0.13), 0 2px 8px rgba(0,0,0,0.05); transform: translateY(-2px); }
        .holo-card:nth-child(1):hover { transform: translateY(-2px); }
        .holo-card:nth-child(2):hover { transform: translateY(-2px); }
        .holo-card:nth-child(3):hover { transform: translateY(-2px); }

        @media (min-width: 992px) {
            .holo-card:nth-child(1) { transform: translateX(0); }
            .holo-card:nth-child(2) { transform: translateX(20px); }
            .holo-card:nth-child(3) { transform: translateX(10px); }
            .holo-card:nth-child(1):hover { transform: translateX(4px) translateY(-2px); }
            .holo-card:nth-child(2):hover { transform: translateX(24px) translateY(-2px); }
            .holo-card:nth-child(3):hover { transform: translateX(14px) translateY(-2px); }
        }
        .holo-glow { position: absolute; width: 100px; height: 100px; border-radius: 50%; opacity: 0.1; right: -16px; top: -16px; pointer-events: none; }
        .holo-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0; }
        .holo-info { flex: 1; }
        .holo-title { font-size: 0.875rem; font-weight: 700; color: var(--text); margin-bottom: 2px; }
        .holo-desc { font-size: 0.73rem; color: var(--text-sec); line-height: 1.4; }

        /* ── SECTION COMMONS ────────────────────────────────────── */
        .section-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--primary); margin-bottom: 10px; }
        .section-title { font-size: clamp(1.5rem, 3vw, 2.1rem); font-weight: 800; color: var(--text); line-height: 1.2; letter-spacing: -0.3px; }
        .section-desc { color: var(--text-sec); font-size: 0.95rem; max-width: 520px; margin: 0 auto; line-height: 1.7; }

        /* ── FEATURES ───────────────────────────────────────────── */
        .features-section { background: var(--body-bg); padding: 88px 0; }
        .feature-card {
            background: var(--card-bg); border-radius: 14px; padding: 28px;
            height: 100%; border: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .feature-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(79,70,229,0.09); border-color: #c7d2fe; }
        .feature-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; margin-bottom: 16px; }
        .feature-title { font-size: 0.9rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
        .feature-desc { font-size: 0.835rem; color: var(--text-sec); line-height: 1.65; }

        /* ── HOW IT WORKS ───────────────────────────────────────── */
        .how-section { padding: 88px 0; background: var(--card-bg); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .step-wrap { text-align: center; padding: 0 8px; }
        .step-number {
            width: 46px; height: 46px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff; font-size: 1rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px; box-shadow: 0 4px 14px rgba(79,70,229,0.28);
        }
        .step-title { font-size: 0.875rem; font-weight: 700; color: var(--text); margin-bottom: 6px; }
        .step-desc { font-size: 0.8rem; color: var(--text-sec); line-height: 1.55; }

        /* ── ROLES ──────────────────────────────────────────────── */
        .roles-section { padding: 88px 0; background: var(--body-bg); }
        .role-card {
            background: var(--card-bg); border: 1px solid var(--border);
            border-radius: 16px; padding: 32px 24px; text-align: center; height: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .role-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(79,70,229,0.09); border-color: #c7d2fe; }
        .role-icon { width: 58px; height: 58px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin: 0 auto 18px; }
        .role-title { font-size: 0.95rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
        .role-desc { font-size: 0.835rem; color: var(--text-sec); line-height: 1.65; margin-bottom: 16px; }
        .role-tag { font-size: 0.67rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; display: inline-block; margin: 2px; }

        /* ── CTA ────────────────────────────────────────────────── */
        .cta-section { padding: 88px 0; background: var(--card-bg); border-top: 1px solid var(--border); }
        .cta-inner {
            background: linear-gradient(135deg, #eef2ff 0%, #f0fdff 100%);
            border: 1px solid #c7d2fe; border-radius: 20px;
            padding: 64px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-inner::before {
            content: ''; position: absolute;
            width: 300px; height: 300px; border-radius: 50%;
            background: radial-gradient(circle, rgba(79,70,229,0.08) 0%, transparent 70%);
            top: -80px; right: -80px; pointer-events: none;
        }

        /* ── FOOTER ─────────────────────────────────────────────── */
        .landing-footer { background: var(--sidebar-bg); color: rgba(255,255,255,0.4); padding: 40px 0; font-size: 0.82rem; }
        .footer-brand-title { font-size: 0.95rem; font-weight: 800; color: #fff; }
        .footer-link { color: rgba(255,255,255,0.4); transition: color 0.15s; }
        .footer-link:hover { color: rgba(255,255,255,0.85); }
        .footer-divider { border-color: rgba(255,255,255,0.08) !important; margin: 24px 0 20px; }

        /* ── ANIMATIONS ─────────────────────────────────────────── */
        .fade-up { opacity: 0; transform: translateY(22px); transition: opacity 0.55s ease, transform 0.55s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 767px) {
            .hero-section { align-items: flex-start; min-height: auto; }
            .hero-inner { padding-top: 32px; padding-bottom: 36px; }
            .hero-badge { font-size: 0.68rem; padding: 4px 12px; margin-bottom: 14px; }
            .hero-title { font-size: 1.85rem; margin-bottom: 14px; }
            .hero-desc { font-size: 0.875rem; margin-bottom: 24px; }
            .btn-hero-primary { padding: 12px 28px; }
            .holo-stack { gap: 10px; margin-top: 4px; }
            .holo-card { padding: 13px 15px; gap: 12px; }
            .holo-icon { width: 36px; height: 36px; font-size: 0.95rem; border-radius: 9px; }
            .holo-title { font-size: 0.82rem; }
            .holo-desc { font-size: 0.7rem; }
            .features-section, .how-section, .roles-section, .cta-section { padding: 56px 0; }
            .section-title { font-size: 1.4rem; }
            .section-desc { font-size: 0.875rem; }
            .feature-card { padding: 20px; }
            .feature-icon { width: 40px; height: 40px; font-size: 1rem; margin-bottom: 12px; }
            .feature-title { font-size: 0.875rem; }
            .feature-desc { font-size: 0.8rem; }
            .step-number { width: 40px; height: 40px; font-size: 0.95rem; }
            .step-title { font-size: 0.82rem; }
            .step-desc { font-size: 0.77rem; }
            .role-card { padding: 24px 18px; }
            .role-icon { width: 48px; height: 48px; font-size: 1.25rem; margin-bottom: 14px; }
            .role-title { font-size: 0.9rem; }
            .role-desc { font-size: 0.8rem; }
            .cta-inner { padding: 40px 24px; border-radius: 16px; }
            .cta-inner .section-title { font-size: 1.3rem; }
            .cta-inner .btn-hero-primary { padding: 12px 28px; }
            .landing-footer { padding: 32px 0; }
            .landing-footer .col-md-4 { text-align: center !important; }
            .landing-footer .d-flex { justify-content: center !important; }
        }
        @media (max-width: 480px) {
            .hero-title { font-size: 1.65rem; }
        }
    </style>
</head>
<body>

<!-- MOBILE OVERLAY -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close"><i class="fas fa-xmark"></i></button>
    <a href="#features" class="mobile-nav-link">Features</a>
    <a href="#how-it-works" class="mobile-nav-link">How It Works</a>
    <a href="#roles" class="mobile-nav-link">Who It's For</a>
    <div class="mobile-menu-cta">
        <a href="{{ route('register') }}" class="btn-nav-signup">Sign Up</a>
        <a href="{{ route('login') }}" class="btn-nav-login">Sign In</a>
    </div>
</div>

<!-- NAVBAR -->
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
                <a href="{{ route('login') }}" class="btn-nav-login" style="padding:6px 14px;font-size:0.8rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mobileMenuBtn" style="color:var(--text-sec);font-size:1.2rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="container hero-inner">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6 col-12">
                <div class="hero-badge"><i class="fas fa-building"></i> Campus Facility Management System</div>
                <h1 class="hero-title">Report. Track.<br><span class="gradient-text">Resolve Faster.</span></h1>
                <p class="hero-desc">SCC ReportHub streamlines facility issue reporting at Southern Christian College. Submit tickets, monitor repairs in real time, and keep the campus running smoothly.</p>
                <a href="{{ route('register') }}" class="btn-hero-primary">Get Started</a>
            </div>
            <div class="col-lg-6 col-12">
                <div class="holo-wrapper">
                    <div class="holo-stack">
                        <div class="holo-card">
                            <div class="holo-glow" style="background:#4f46e5;"></div>
                            <div class="holo-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-user-shield"></i></div>
                            <div class="holo-info">
                                <div class="holo-title">Admin</div>
                                <div class="holo-desc">Manage tickets, users, facilities, and view analytics.</div>
                            </div>
                        </div>
                        <div class="holo-card">
                            <div class="holo-glow" style="background:#3b82f6;"></div>
                            <div class="holo-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chalkboard-user"></i></div>
                            <div class="holo-info">
                                <div class="holo-title">Faculty / Staff</div>
                                <div class="holo-desc">Submit tickets and track repair status in real time.</div>
                            </div>
                        </div>
                        <div class="holo-card">
                            <div class="holo-glow" style="background:#10b981;"></div>
                            <div class="holo-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                            <div class="holo-info">
                                <div class="holo-title">Maintenance Staff</div>
                                <div class="holo-desc">View assigned tasks and update repair progress.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
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
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.08s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="feature-title">Real-Time Monitoring</div>
                    <div class="feature-desc">Track every ticket from submission to completion. Know exactly who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.16s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fffbeb;color:#f59e0b;"><i class="fas fa-bell"></i></div>
                    <div class="feature-title">Instant Notifications</div>
                    <div class="feature-desc">Get notified when your ticket is approved, assigned, or resolved — no need to follow up manually.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.08s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chart-pie"></i></div>
                    <div class="feature-title">Admin Dashboard</div>
                    <div class="feature-desc">Admins get a full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.16s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fdf4ff;color:#a855f7;"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="feature-title">Maintenance Task Management</div>
                    <div class="feature-desc">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:0.24s;">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fef2f2;color:#ef4444;"><i class="fas fa-star"></i></div>
                    <div class="feature-title">Feedback & Ratings</div>
                    <div class="feature-desc">After a ticket is resolved, faculty can rate the service — helping admins improve maintenance quality.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
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
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.08s;">
                <div class="step-wrap">
                    <div class="step-number">2</div>
                    <div class="step-title">Admin Reviews</div>
                    <div class="step-desc">Admin approves and assigns it to the right maintenance staff.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.16s;">
                <div class="step-wrap">
                    <div class="step-number">3</div>
                    <div class="step-title">Repair in Progress</div>
                    <div class="step-desc">Maintenance staff works on the task and updates progress.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:0.24s;">
                <div class="step-wrap">
                    <div class="step-number">4</div>
                    <div class="step-title">Resolved & Rated</div>
                    <div class="step-desc">Admin verifies completion. Faculty rates the service. Done.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
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
                    <div class="role-desc">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="role-tag" style="background:#eef2ff;color:#3730a3;">Dashboard</span>
                        <span class="role-tag" style="background:#eef2ff;color:#3730a3;">User Management</span>
                        <span class="role-tag" style="background:#eef2ff;color:#3730a3;">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:0.08s;">
                <div class="role-card">
                    <div class="role-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="role-title">Faculty / Staff</div>
                    <div class="role-desc">Report facility issues, track your ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="role-tag" style="background:#eff6ff;color:#1e40af;">Submit Tickets</span>
                        <span class="role-tag" style="background:#eff6ff;color:#1e40af;">Track Status</span>
                        <span class="role-tag" style="background:#eff6ff;color:#1e40af;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:0.16s;">
                <div class="role-card">
                    <div class="role-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                    <div class="role-title">Maintenance Staff</div>
                    <div class="role-desc">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
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

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-inner fade-up">
            <div class="section-label" style="display:flex;justify-content:center;">Get Started</div>
            <h2 class="section-title mt-2 mb-3">Ready to keep your campus in top shape?</h2>
            <p class="section-desc mb-4">Join the SCC community on ReportHub. Create your account and start reporting facility issues in minutes.</p>
            <a href="{{ route('register') }}" class="btn-hero-primary">Create an Account</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="landing-footer">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="24" height="24"
                         style="border-radius:50%;object-fit:contain;background:#fff;padding:2px;"
                         onerror="this.style.display='none'">
                    <span class="footer-brand-title">SCC ReportHub</span>
                </div>
                <p class="mb-0" style="font-size:0.75rem;">Campus Facility Status Report &amp; Monitoring System</p>
            </div>
            <div class="col-md-4 text-md-center">
                <div class="d-flex gap-4 justify-content-md-center flex-wrap">
                    <a href="#features" class="footer-link">Features</a>
                    <a href="#how-it-works" class="footer-link">How It Works</a>
                    <a href="#roles" class="footer-link">Roles</a>
                    <a href="{{ route('login') }}" class="footer-link">Sign In</a>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="mb-0" style="font-size:0.75rem;">&copy; {{ date('Y') }} Southern Christian College.<br class="d-md-none"> All rights reserved.</p>
            </div>
        </div>
        <hr class="footer-divider">
        <p class="text-center mb-0" style="font-size:0.72rem;">Southern Christian College · Midsayap, Cotabato, Philippines</p>
    </div>
</footer>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const overlay  = document.getElementById('mobileMenuOverlay');
    const closeBtn = document.getElementById('mobileMenuClose');
    const openBtn  = document.getElementById('mobileMenuBtn');

    openBtn.addEventListener('click', () => { overlay.classList.add('open'); document.body.style.overflow = 'hidden'; });
    function closeMenu() { overlay.classList.remove('open'); document.body.style.overflow = ''; }
    closeBtn.addEventListener('click', closeMenu);
    overlay.querySelectorAll('a.mobile-nav-link').forEach(l => {
        l.addEventListener('click', e => {
            if (l.getAttribute('href').startsWith('#')) {
                e.preventDefault(); closeMenu();
                setTimeout(() => { const t = document.querySelector(l.getAttribute('href')); if (t) t.scrollIntoView({ behavior: 'smooth' }); }, 280);
            } else closeMenu();
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
        });
    });

    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
</script>
</body>
</html>
