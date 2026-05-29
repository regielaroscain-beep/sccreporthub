<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ── TOKENS ─────────────────────────────────────────────── */
        :root {
            --p:        #4f46e5;
            --pd:       #3730a3;
            --pl:       #818cf8;
            --ac:       #06b6d4;
            --ok:       #10b981;
            --warn:     #f59e0b;
            --err:      #ef4444;
            --bg:       #f8fafc;
            --card:     #ffffff;
            --border:   #e2e8f0;
            --t1:       #0f172a;
            --t2:       #475569;
            --t3:       #94a3b8;
            --dark:     #0f172a;
            --r-sm:     10px;
            --r-md:     14px;
            --r-lg:     20px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.875rem;
            background: var(--bg);
            color: var(--t1);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        a { color: var(--p); text-decoration: none; }

        /* ── NAVBAR ─────────────────────────────────────────────── */
        .lnav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 900;
            height: 64px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
        }
        .lnav-inner { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .lnav-brand { display: flex; align-items: center; gap: 10px; }
        .lnav-brand img { width: 34px; height: 34px; border-radius: 50%; object-fit: contain; background: #fff; padding: 2px; border: 1px solid var(--border); }
        .lnav-brand-name {
            font-size: 0.95rem; font-weight: 800; letter-spacing: -0.3px;
            background: linear-gradient(135deg, var(--p), var(--ac));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .lnav-brand-sub { font-size: 0.57rem; font-weight: 600; color: var(--t3); text-transform: uppercase; letter-spacing: 0.8px; display: block; }
        .lnav-links { display: flex; align-items: center; gap: 32px; }
        .lnav-links a { color: var(--t2); font-size: 0.85rem; font-weight: 500; transition: color 0.15s; }
        .lnav-links a:hover { color: var(--p); }
        .btn-ln-out {
            border: 1.5px solid var(--border); color: var(--t2); background: #fff;
            border-radius: var(--r-sm); padding: 7px 18px; font-size: 0.85rem; font-weight: 600;
            transition: all 0.15s; display: inline-flex; align-items: center;
        }
        .btn-ln-out:hover { border-color: var(--p); color: var(--p); }
        .btn-ln-in {
            background: var(--p); color: #fff; border: none;
            border-radius: var(--r-sm); padding: 7px 18px; font-size: 0.85rem; font-weight: 600;
            transition: background 0.15s, transform 0.15s;
            display: inline-flex; align-items: center;
            box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        }
        .btn-ln-in:hover { background: var(--pd); transform: translateY(-1px); color: #fff; }

        /* ── MOBILE OVERLAY ─────────────────────────────────────── */
        .mob-overlay {
            display: none; position: fixed; inset: 0; z-index: 1000;
            background: rgba(255,255,255,0.97); backdrop-filter: blur(12px);
            flex-direction: column; align-items: center; justify-content: center;
        }
        .mob-overlay.open { display: flex; }
        .mob-close { position: absolute; top: 20px; right: 20px; background: none; border: none; color: var(--t2); font-size: 1.4rem; cursor: pointer; }
        .mob-link { color: var(--t1); font-size: 1.2rem; font-weight: 700; padding: 16px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); display: block; transition: color 0.15s; }
        .mob-link:hover { color: var(--p); }
        .mob-cta { display: flex; flex-direction: column; gap: 10px; width: 75%; max-width: 260px; margin-top: 28px; }
        .mob-cta .btn-ln-in, .mob-cta .btn-ln-out { width: 100%; justify-content: center; padding: 13px; font-size: 0.9rem; border-radius: 12px; }

        /* ── HERO ───────────────────────────────────────────────── */
        .hero {
            padding-top: 64px;
            background: linear-gradient(145deg, #fff 0%, #f8fafc 45%, #eef2ff 100%);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 55% 55% at 85% 25%, rgba(79,70,229,0.07) 0%, transparent 65%),
                radial-gradient(ellipse 40% 40% at 15% 85%, rgba(6,182,212,0.05) 0%, transparent 65%);
        }
        .hero-body { padding: 64px 0 72px; position: relative; z-index: 1; }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 7px;
            background: #eef2ff; border: 1px solid #c7d2fe; color: var(--p);
            border-radius: 50px; padding: 5px 14px; font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 24px;
        }
        .hero-h1 {
            font-size: clamp(2.4rem, 5.5vw, 3.8rem);
            font-weight: 900; color: var(--t1);
            line-height: 1.08; letter-spacing: -0.8px; margin-bottom: 20px;
        }
        .hero-h1 .grad {
            background: linear-gradient(135deg, var(--p) 0%, var(--ac) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-sub { font-size: 1.05rem; color: var(--t2); line-height: 1.75; max-width: 460px; margin-bottom: 36px; }
        .btn-hero {
            background: linear-gradient(135deg, var(--p), var(--pd));
            color: #fff; border: none; border-radius: var(--r-sm);
            padding: 14px 36px; font-size: 0.95rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 16px rgba(79,70,229,0.35);
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.15s;
            letter-spacing: 0.01em;
        }
        .btn-hero:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,0.45); opacity: 0.95; color: #fff; }

        /* Role cards */
        .role-stack { display: flex; flex-direction: column; gap: 12px; }
        .rcard {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: var(--r-md); padding: 18px 20px;
            display: flex; align-items: center; gap: 14px;
            box-shadow: 0 2px 16px rgba(79,70,229,0.06), inset 0 1px 0 rgba(255,255,255,0.8);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative; overflow: hidden;
        }
        .rcard::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.45) 0%, transparent 50%);
            pointer-events: none;
        }
        .rcard:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(79,70,229,0.1); }
        .rcard-glow { position: absolute; width: 80px; height: 80px; border-radius: 50%; opacity: 0.1; right: -12px; top: -12px; pointer-events: none; }
        .rcard-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; position: relative; z-index: 1; }
        .rcard-body { flex: 1; position: relative; z-index: 1; }
        .rcard-title { font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 2px; }
        .rcard-desc { font-size: 0.72rem; color: var(--t2); line-height: 1.4; }

        /* ── DIVIDER STRIP ──────────────────────────────────────── */
        .strip {
            background: var(--card);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 36px 0;
        }
        .strip-item { text-align: center; }
        .strip-num {
            font-size: 2rem; font-weight: 900; letter-spacing: -0.5px;
            background: linear-gradient(135deg, var(--p), var(--ac));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            line-height: 1;
        }
        .strip-label { font-size: 0.72rem; font-weight: 600; color: var(--t3); text-transform: uppercase; letter-spacing: 0.06em; margin-top: 4px; }

        /* ── SECTION COMMONS ────────────────────────────────────── */
        .sec-eyebrow { font-size: 0.68rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--p); margin-bottom: 10px; }
        .sec-h2 { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; color: var(--t1); line-height: 1.2; letter-spacing: -0.4px; }
        .sec-sub { color: var(--t2); font-size: 0.95rem; max-width: 520px; margin: 0 auto; line-height: 1.7; }

        /* ── FEATURES ───────────────────────────────────────────── */
        .sec-features { background: var(--bg); padding: 96px 0; }
        .fcard {
            background: var(--card); border-radius: var(--r-md); padding: 28px;
            height: 100%; border: 1px solid var(--border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .fcard:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(79,70,229,0.1); border-color: #c7d2fe; }
        .fcard-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 18px; }
        .fcard-title { font-size: 0.9rem; font-weight: 700; color: var(--t1); margin-bottom: 8px; }
        .fcard-desc { font-size: 0.835rem; color: var(--t2); line-height: 1.65; }

        /* ── HOW IT WORKS ───────────────────────────────────────── */
        .sec-how { padding: 96px 0; background: var(--card); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .step { text-align: center; padding: 0 12px; }
        .step-num {
            width: 48px; height: 48px; border-radius: 50%;
            background: linear-gradient(135deg, var(--p), var(--ac));
            color: #fff; font-size: 1rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px; box-shadow: 0 4px 16px rgba(79,70,229,0.3);
        }
        .step-title { font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 6px; }
        .step-desc { font-size: 0.8rem; color: var(--t2); line-height: 1.6; }

        /* ── ROLES SECTION ──────────────────────────────────────── */
        .sec-roles { padding: 96px 0; background: var(--bg); }
        .rocard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r-lg); padding: 36px 28px; text-align: center; height: 100%;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .rocard:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(79,70,229,0.1); border-color: #c7d2fe; }
        .rocard-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 20px; }
        .rocard-title { font-size: 1rem; font-weight: 700; color: var(--t1); margin-bottom: 10px; }
        .rocard-desc { font-size: 0.845rem; color: var(--t2); line-height: 1.65; margin-bottom: 18px; }
        .rtag { font-size: 0.67rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; display: inline-block; margin: 2px; }

        /* ── CTA ────────────────────────────────────────────────── */
        .sec-cta { padding: 96px 0; background: var(--card); border-top: 1px solid var(--border); }
        .cta-box {
            background: linear-gradient(135deg, #eef2ff 0%, #f0fdff 100%);
            border: 1px solid #c7d2fe; border-radius: var(--r-lg);
            padding: 72px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-box::before {
            content: ''; position: absolute;
            width: 320px; height: 320px; border-radius: 50%;
            background: radial-gradient(circle, rgba(79,70,229,0.07) 0%, transparent 70%);
            top: -80px; right: -80px; pointer-events: none;
        }
        .cta-box::after {
            content: ''; position: absolute;
            width: 200px; height: 200px; border-radius: 50%;
            background: radial-gradient(circle, rgba(6,182,212,0.06) 0%, transparent 70%);
            bottom: -60px; left: -60px; pointer-events: none;
        }

        /* ── FOOTER ─────────────────────────────────────────────── */
        .lfooter { background: var(--dark); color: rgba(255,255,255,0.4); padding: 48px 0 32px; font-size: 0.82rem; }
        .lfooter-brand { font-size: 0.95rem; font-weight: 800; color: #fff; }
        .lfooter-link { color: rgba(255,255,255,0.4); transition: color 0.15s; }
        .lfooter-link:hover { color: rgba(255,255,255,0.85); }
        .lfooter hr { border-color: rgba(255,255,255,0.07) !important; margin: 28px 0 20px; }

        /* ── ANIMATIONS ─────────────────────────────────────────── */
        .fade-up { opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .fade-up.in { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 991px) {
            .hero-body { padding: 48px 0 56px; }
        }
        @media (max-width: 767px) {
            .hero { min-height: auto; }
            .hero-body { padding: 28px 0 40px; }
            .hero-eyebrow { font-size: 0.65rem; padding: 4px 12px; margin-bottom: 16px; }
            .hero-h1 { font-size: 2rem; margin-bottom: 14px; letter-spacing: -0.4px; }
            .hero-sub { font-size: 0.9rem; margin-bottom: 24px; }
            .btn-hero { padding: 13px 28px; font-size: 0.9rem; }
            .role-stack { gap: 10px; margin-top: 8px; }
            .rcard { padding: 14px 16px; gap: 12px; }
            .rcard-icon { width: 36px; height: 36px; font-size: 0.95rem; border-radius: 9px; }
            .rcard-title { font-size: 0.82rem; }
            .rcard-desc { font-size: 0.7rem; }
            .strip { padding: 24px 0; }
            .strip-num { font-size: 1.6rem; }
            .strip-label { font-size: 0.65rem; }
            .sec-features, .sec-how, .sec-roles, .sec-cta { padding: 60px 0; }
            .sec-h2 { font-size: 1.45rem; }
            .sec-sub { font-size: 0.875rem; }
            .fcard { padding: 22px; }
            .fcard-icon { width: 42px; height: 42px; font-size: 1rem; margin-bottom: 14px; }
            .fcard-title { font-size: 0.875rem; }
            .fcard-desc { font-size: 0.8rem; }
            .step-num { width: 42px; height: 42px; font-size: 0.95rem; }
            .step-title { font-size: 0.82rem; }
            .step-desc { font-size: 0.77rem; }
            .rocard { padding: 28px 20px; }
            .rocard-icon { width: 50px; height: 50px; font-size: 1.25rem; margin-bottom: 14px; }
            .rocard-title { font-size: 0.9rem; }
            .rocard-desc { font-size: 0.8rem; }
            .cta-box { padding: 44px 24px; border-radius: 16px; }
            .cta-box .sec-h2 { font-size: 1.35rem; }
            .cta-box .btn-hero { padding: 13px 28px; }
            .lfooter { padding: 36px 0 24px; }
            .lfooter .col-md-4 { text-align: center !important; }
            .lfooter .d-flex { justify-content: center !important; }
        }
        @media (max-width: 480px) {
            .hero-h1 { font-size: 1.75rem; }
            .lnav-brand-sub { display: none; }
        }
    </style>
</head>
<body>

<!-- MOBILE OVERLAY -->
<div class="mob-overlay" id="mobOverlay">
    <button class="mob-close" id="mobClose"><i class="fas fa-xmark"></i></button>
    <a href="#features" class="mob-link">Features</a>
    <a href="#how-it-works" class="mob-link">How It Works</a>
    <a href="#roles" class="mob-link">Who It's For</a>
    <div class="mob-cta">
        <a href="{{ route('register') }}" class="btn-ln-in">Sign Up</a>
        <a href="{{ route('login') }}" class="btn-ln-out">Sign In</a>
    </div>
</div>

<!-- NAVBAR -->
<nav class="lnav">
    <div class="container">
        <div class="lnav-inner">
            <a href="{{ route('landing') }}" class="lnav-brand">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" onerror="this.style.display='none'">
                <div>
                    <span class="lnav-brand-name">SCC ReportHub</span>
                    <span class="lnav-brand-sub">Southern Christian College</span>
                </div>
            </a>
            <div class="lnav-links d-none d-lg-flex">
                <a href="#features">Features</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#roles">Who It's For</a>
            </div>
            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-ln-out">Sign In</a>
                <a href="{{ route('register') }}" class="btn-ln-in">Sign Up</a>
            </div>
            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-ln-out" style="padding:6px 14px;font-size:0.8rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mobOpen" style="color:var(--t2);font-size:1.2rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container hero-body">
        <div class="row align-items-center g-4 g-lg-5">

            <!-- Left -->
            <div class="col-lg-6">
                <div class="hero-eyebrow"><i class="fas fa-building"></i> Campus Facility Management System</div>
                <h1 class="hero-h1">
                    Report. Track.<br>
                    <span class="grad">Resolve Faster.</span>
                </h1>
                <p class="hero-sub">SCC ReportHub streamlines facility issue reporting at Southern Christian College. Submit tickets, monitor repairs in real time, and keep the campus running smoothly.</p>
                <a href="{{ route('register') }}" class="btn-hero">
                    <i class="fas fa-rocket"></i> Get Started
                </a>
            </div>

            <!-- Right: Role cards -->
            <div class="col-lg-6">
                <div class="role-stack">
                    <div class="rcard">
                        <div class="rcard-glow" style="background:#4f46e5;"></div>
                        <div class="rcard-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-user-shield"></i></div>
                        <div class="rcard-body">
                            <div class="rcard-title">Admin</div>
                            <div class="rcard-desc">Manage tickets, users, facilities, and view analytics.</div>
                        </div>
                    </div>
                    <div class="rcard">
                        <div class="rcard-glow" style="background:#3b82f6;"></div>
                        <div class="rcard-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chalkboard-user"></i></div>
                        <div class="rcard-body">
                            <div class="rcard-title">Faculty / Staff</div>
                            <div class="rcard-desc">Submit tickets and track repair status in real time.</div>
                        </div>
                    </div>
                    <div class="rcard">
                        <div class="rcard-glow" style="background:#10b981;"></div>
                        <div class="rcard-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                        <div class="rcard-body">
                            <div class="rcard-title">Maintenance Staff</div>
                            <div class="rcard-desc">View assigned tasks and update repair progress.</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STRIP -->
<div class="strip">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3 strip-item fade-up">
                <div class="strip-num">8</div>
                <div class="strip-label">Issue Categories</div>
            </div>
            <div class="col-6 col-md-3 strip-item fade-up" style="transition-delay:.08s">
                <div class="strip-num">3</div>
                <div class="strip-label">User Roles</div>
            </div>
            <div class="col-6 col-md-3 strip-item fade-up" style="transition-delay:.16s">
                <div class="strip-num">6</div>
                <div class="strip-label">Ticket Statuses</div>
            </div>
            <div class="col-6 col-md-3 strip-item fade-up" style="transition-delay:.24s">
                <div class="strip-num">100%</div>
                <div class="strip-label">Web-Based</div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<section class="sec-features" id="features">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-eyebrow">Features</div>
            <h2 class="sec-h2 mb-3">Everything you need to manage<br class="d-none d-md-block"> campus facilities</h2>
            <p class="sec-sub">From ticket submission to resolution, ReportHub covers the full maintenance lifecycle.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="fcard">
                    <div class="fcard-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-ticket-alt"></i></div>
                    <div class="fcard-title">Easy Ticket Submission</div>
                    <div class="fcard-desc">Faculty and staff report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:.08s">
                <div class="fcard">
                    <div class="fcard-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="fcard-title">Real-Time Monitoring</div>
                    <div class="fcard-desc">Track every ticket from submission to completion. Know exactly who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:.16s">
                <div class="fcard">
                    <div class="fcard-icon" style="background:#fffbeb;color:#f59e0b;"><i class="fas fa-bell"></i></div>
                    <div class="fcard-title">Instant Notifications</div>
                    <div class="fcard-desc">Get notified when your ticket is approved, assigned, or resolved — no need to follow up manually.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:.08s">
                <div class="fcard">
                    <div class="fcard-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chart-pie"></i></div>
                    <div class="fcard-title">Admin Dashboard</div>
                    <div class="fcard-desc">Admins get a full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:.16s">
                <div class="fcard">
                    <div class="fcard-icon" style="background:#fdf4ff;color:#a855f7;"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="fcard-title">Maintenance Task Management</div>
                    <div class="fcard-desc">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up" style="transition-delay:.24s">
                <div class="fcard">
                    <div class="fcard-icon" style="background:#fef2f2;color:#ef4444;"><i class="fas fa-star"></i></div>
                    <div class="fcard-title">Feedback & Ratings</div>
                    <div class="fcard-desc">After a ticket is resolved, faculty can rate the service — helping admins improve maintenance quality.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec-how" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-eyebrow">How It Works</div>
            <h2 class="sec-h2 mb-3">From report to resolution in four steps</h2>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3 fade-up">
                <div class="step">
                    <div class="step-num">1</div>
                    <div class="step-title">Submit a Ticket</div>
                    <div class="step-desc">Describe the issue, set priority, and attach a photo if needed.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:.08s">
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="step-title">Admin Reviews</div>
                    <div class="step-desc">Admin approves and assigns it to the right maintenance staff.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:.16s">
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="step-title">Repair in Progress</div>
                    <div class="step-desc">Maintenance staff works on the task and updates progress.</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up" style="transition-delay:.24s">
                <div class="step">
                    <div class="step-num">4</div>
                    <div class="step-title">Resolved & Rated</div>
                    <div class="step-desc">Admin verifies completion. Faculty rates the service. Done.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section class="sec-roles" id="roles">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-eyebrow">Who It's For</div>
            <h2 class="sec-h2 mb-3">Built for every role in the campus</h2>
            <p class="sec-sub">Three distinct portals, each tailored to how that role interacts with facility management.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fade-up">
                <div class="rocard">
                    <div class="rocard-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-user-shield"></i></div>
                    <div class="rocard-title">Admin</div>
                    <div class="rocard-desc">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="rtag" style="background:#eef2ff;color:#3730a3;">Dashboard</span>
                        <span class="rtag" style="background:#eef2ff;color:#3730a3;">User Management</span>
                        <span class="rtag" style="background:#eef2ff;color:#3730a3;">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:.08s">
                <div class="rocard">
                    <div class="rocard-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="rocard-title">Faculty / Staff</div>
                    <div class="rocard-desc">Report facility issues, track your ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="rtag" style="background:#eff6ff;color:#1e40af;">Submit Tickets</span>
                        <span class="rtag" style="background:#eff6ff;color:#1e40af;">Track Status</span>
                        <span class="rtag" style="background:#eff6ff;color:#1e40af;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay:.16s">
                <div class="rocard">
                    <div class="rocard-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                    <div class="rocard-title">Maintenance Staff</div>
                    <div class="rocard-desc">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
                    <div>
                        <span class="rtag" style="background:#ecfdf5;color:#065f46;">Task Queue</span>
                        <span class="rtag" style="background:#ecfdf5;color:#065f46;">Progress Updates</span>
                        <span class="rtag" style="background:#ecfdf5;color:#065f46;">History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="sec-cta">
    <div class="container">
        <div class="cta-box fade-up">
            <div style="position:relative;z-index:1;">
                <div class="sec-eyebrow" style="display:flex;justify-content:center;">Get Started</div>
                <h2 class="sec-h2 mt-2 mb-3">Ready to keep your campus in top shape?</h2>
                <p class="sec-sub mb-4">Join the SCC community on ReportHub. Create your account and start reporting facility issues in minutes.</p>
                <a href="{{ route('register') }}" class="btn-hero">
                    <i class="fas fa-user-plus"></i> Create an Account
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="lfooter">
    <div class="container">
        <div class="row align-items-start g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="26" height="26"
                         style="border-radius:50%;object-fit:contain;background:#fff;padding:2px;"
                         onerror="this.style.display='none'">
                    <span class="lfooter-brand">SCC ReportHub</span>
                </div>
                <p class="mb-0" style="font-size:0.78rem;line-height:1.6;">Campus Facility Status Report &amp; Monitoring System<br>Southern Christian College</p>
            </div>
            <div class="col-md-4 text-md-center">
                <p class="mb-2" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:rgba(255,255,255,0.25);">Navigation</p>
                <div class="d-flex flex-column gap-2">
                    <a href="#features" class="lfooter-link">Features</a>
                    <a href="#how-it-works" class="lfooter-link">How It Works</a>
                    <a href="#roles" class="lfooter-link">Who It's For</a>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="mb-2" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:rgba(255,255,255,0.25);">Account</p>
                <div class="d-flex flex-column gap-2 align-items-md-end">
                    <a href="{{ route('login') }}" class="lfooter-link">Sign In</a>
                    <a href="{{ route('register') }}" class="lfooter-link">Create Account</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="font-size:0.75rem;">
            <span>&copy; {{ date('Y') }} Southern Christian College. All rights reserved.</span>
            <span>Midsayap, Cotabato, Philippines</span>
        </div>
    </div>
</footer>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile menu
    const overlay = document.getElementById('mobOverlay');
    document.getElementById('mobOpen').addEventListener('click', () => { overlay.classList.add('open'); document.body.style.overflow = 'hidden'; });
    document.getElementById('mobClose').addEventListener('click', () => { overlay.classList.remove('open'); document.body.style.overflow = ''; });
    overlay.querySelectorAll('a.mob-link').forEach(l => {
        l.addEventListener('click', e => {
            if (l.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                overlay.classList.remove('open'); document.body.style.overflow = '';
                setTimeout(() => { const t = document.querySelector(l.getAttribute('href')); if (t) t.scrollIntoView({ behavior: 'smooth' }); }, 260);
            } else { overlay.classList.remove('open'); document.body.style.overflow = ''; }
        });
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
        });
    });

    // Fade-up on scroll
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
</script>
</body>
</html>
