<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ─── TOKENS ──────────────────────────────────────────── */
        :root {
            --ink:    #0a0f1e;
            --ink2:   #3d4a6b;
            --ink3:   #8896b3;
            --bg:     #f5f7ff;
            --white:  #ffffff;
            --border: #e4e9f5;
            --blue:   #2563eb;
            --blue-d: #1d4ed8;
            --teal:   #0891b2;
            --violet: #7c3aed;
            --green:  #059669;
            --amber:  #d97706;
            --red:    #dc2626;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--bg); color: var(--ink);
            line-height: 1.6; -webkit-font-smoothing: antialiased; overflow-x: hidden;
        }
        a { text-decoration: none; color: var(--blue); }

        /* ─── NAVBAR ──────────────────────────────────────────── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 900;
            height: 62px; background: rgba(255,255,255,0.88);
            backdrop-filter: blur(16px); border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
        }
        .nav-i { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .nbrand { display: flex; align-items: center; gap: 9px; }
        .nbrand img { width: 32px; height: 32px; border-radius: 8px; object-fit: contain; background: #fff; padding: 2px; border: 1px solid var(--border); }
        .nbrand-name { font-size: 0.9rem; font-weight: 800; color: var(--ink); letter-spacing: -.3px; }
        .nbrand-sub { font-size: 0.54rem; font-weight: 600; color: var(--ink3); text-transform: uppercase; letter-spacing: .8px; display: block; }
        .nlinks { display: flex; gap: 28px; }
        .nlinks a { font-size: 0.82rem; font-weight: 500; color: var(--ink2); transition: color .15s; }
        .nlinks a:hover { color: var(--blue); }
        .btn-out { border: 1.5px solid var(--border); color: var(--ink2); background: #fff; border-radius: 8px; padding: 6px 16px; font-size: 0.82rem; font-weight: 600; transition: all .15s; }
        .btn-out:hover { border-color: var(--blue); color: var(--blue); }
        .btn-in { background: var(--blue); color: #fff; border: none; border-radius: 8px; padding: 6px 16px; font-size: 0.82rem; font-weight: 600; box-shadow: 0 2px 8px rgba(37,99,235,.3); transition: background .15s, transform .15s; }
        .btn-in:hover { background: var(--blue-d); transform: translateY(-1px); color: #fff; }

        /* ─── MOBILE MENU ─────────────────────────────────────── */
        .mmenu { display: none; position: fixed; inset: 0; z-index: 1100; background: #fff; flex-direction: column; align-items: center; justify-content: center; }
        .mmenu.on { display: flex; }
        .mmenu-x { position: absolute; top: 18px; right: 18px; background: none; border: none; font-size: 1.4rem; color: var(--ink2); cursor: pointer; }
        .mmenu a.ml { display: block; font-size: 1.1rem; font-weight: 700; color: var(--ink); padding: 14px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); transition: color .15s; }
        .mmenu a.ml:hover { color: var(--blue); }
        .mmenu-cta { display: flex; flex-direction: column; gap: 10px; width: 70%; max-width: 240px; margin-top: 24px; }
        .mmenu-cta .btn-in, .mmenu-cta .btn-out { width: 100%; text-align: center; padding: 12px; font-size: 0.875rem; border-radius: 10px; }

        /* ─── HERO ────────────────────────────────────────────── */
        .hero {
            padding-top: 62px;
            background: var(--white);
            position: relative; overflow: hidden;
        }
        .hero-bg {
            position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 70% 60% at 50% -10%, rgba(37,99,235,.08) 0%, transparent 65%),
                radial-gradient(ellipse 40% 40% at 90% 80%, rgba(124,58,237,.06) 0%, transparent 60%);
        }
        .hero-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            align-items: center; gap: 64px;
            padding: 80px 0 72px; position: relative; z-index: 1;
        }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 6px;
            background: #eff6ff; border: 1px solid #bfdbfe; color: var(--blue);
            border-radius: 50px; padding: 4px 12px; font-size: 0.68rem; font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase; margin-bottom: 22px;
        }
        .hero-h {
            font-size: clamp(2.2rem, 4vw, 3.4rem); font-weight: 800; color: var(--ink);
            line-height: 1.1; letter-spacing: -.6px; margin-bottom: 18px;
        }
        .hero-h em { font-style: normal; color: var(--blue); }
        .hero-p { font-size: 1rem; color: var(--ink2); line-height: 1.75; margin-bottom: 32px; max-width: 440px; }
        .hero-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--blue); color: #fff; border: none; border-radius: 9px;
            padding: 13px 28px; font-size: 0.9rem; font-weight: 700;
            box-shadow: 0 4px 16px rgba(37,99,235,.35);
            transition: background .15s, transform .15s, box-shadow .15s;
        }
        .btn-primary:hover { background: var(--blue-d); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,99,235,.45); color: #fff; }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--ink2); border: 1.5px solid var(--border);
            border-radius: 9px; padding: 13px 24px; font-size: 0.9rem; font-weight: 600;
            transition: border-color .15s, color .15s;
        }
        .btn-ghost:hover { border-color: var(--blue); color: var(--blue); }

        /* Hero right — dashboard mockup */
        .hero-mockup {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 20px 60px rgba(10,15,30,.1), 0 4px 16px rgba(10,15,30,.06);
            overflow: hidden;
        }
        .mock-bar {
            background: #f8faff; border-bottom: 1px solid var(--border);
            padding: 12px 16px; display: flex; align-items: center; gap: 8px;
        }
        .mock-dot { width: 10px; height: 10px; border-radius: 50%; }
        .mock-title { font-size: 0.72rem; font-weight: 600; color: var(--ink3); margin-left: 6px; }
        .mock-body { padding: 20px; }
        .mock-stat-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 16px; }
        .mock-stat {
            background: var(--bg); border-radius: 10px; padding: 12px;
            border: 1px solid var(--border);
        }
        .mock-stat-n { font-size: 1.3rem; font-weight: 800; color: var(--ink); letter-spacing: -.3px; }
        .mock-stat-l { font-size: 0.62rem; font-weight: 600; color: var(--ink3); text-transform: uppercase; letter-spacing: .05em; margin-top: 2px; }
        .mock-ticket {
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 10px; padding: 11px 14px;
            display: flex; align-items: center; gap: 10px; margin-bottom: 8px;
        }
        .mock-ticket:last-child { margin-bottom: 0; }
        .mock-dot2 { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .mock-ttext { flex: 1; font-size: 0.72rem; font-weight: 600; color: var(--ink); }
        .mock-tbadge { font-size: 0.6rem; font-weight: 700; padding: 2px 8px; border-radius: 50px; white-space: nowrap; }

        /* ─── LOGOS / TRUST BAR ───────────────────────────────── */
        .trust-bar {
            background: var(--bg); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
            padding: 28px 0;
        }
        .trust-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--ink3); margin-bottom: 20px; }
        .trust-items { display: flex; align-items: center; justify-content: center; gap: 40px; flex-wrap: wrap; }
        .trust-item { display: flex; align-items: center; gap: 8px; color: var(--ink3); font-size: 0.8rem; font-weight: 600; }
        .trust-item i { font-size: 1.1rem; }

        /* ─── SECTION BASE ────────────────────────────────────── */
        .s { padding: 96px 0; }
        .s-alt { background: var(--white); }
        .s-label { font-size: 0.67rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: var(--blue); margin-bottom: 10px; }
        .s-h { font-size: clamp(1.6rem, 2.8vw, 2.1rem); font-weight: 800; color: var(--ink); line-height: 1.2; letter-spacing: -.3px; }
        .s-p { font-size: 0.95rem; color: var(--ink2); max-width: 520px; margin: 0 auto; line-height: 1.7; }

        /* ─── FEATURES ────────────────────────────────────────── */
        .fc {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 14px; padding: 28px; height: 100%;
            transition: transform .2s, box-shadow .2s, border-color .2s;
            position: relative; overflow: hidden;
        }
        .fc::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--blue), var(--teal)); transform: scaleX(0); transform-origin: left; transition: transform .25s; border-radius: 14px 14px 0 0; }
        .fc:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(37,99,235,.1); border-color: #bfdbfe; }
        .fc:hover::before { transform: scaleX(1); }
        .fc-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 18px; }
        .fc-h { font-size: 0.9rem; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
        .fc-p { font-size: 0.835rem; color: var(--ink2); line-height: 1.65; }

        /* ─── HOW IT WORKS ────────────────────────────────────── */
        .steps { display: grid; grid-template-columns: repeat(4,1fr); gap: 0; position: relative; }
        .steps::before { content: ''; position: absolute; top: 22px; left: 12%; right: 12%; height: 2px; background: linear-gradient(90deg, var(--blue), var(--teal)); opacity: .2; }
        .step { text-align: center; padding: 0 16px; position: relative; z-index: 1; }
        .step-n { width: 46px; height: 46px; border-radius: 50%; background: var(--blue); color: #fff; font-size: 0.95rem; font-weight: 800; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; box-shadow: 0 4px 14px rgba(37,99,235,.35); }
        .step-h { font-size: 0.875rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
        .step-p { font-size: 0.8rem; color: var(--ink2); line-height: 1.6; }

        /* ─── ROLES ───────────────────────────────────────────── */
        .rocard {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 18px; padding: 36px 28px; height: 100%;
            transition: transform .2s, box-shadow .2s;
            text-align: center; position: relative; overflow: hidden;
        }
        .rocard::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px; }
        .rocard.r1::after { background: linear-gradient(90deg, var(--blue), #60a5fa); }
        .rocard.r2::after { background: linear-gradient(90deg, var(--teal), #22d3ee); }
        .rocard.r3::after { background: linear-gradient(90deg, var(--green), #34d399); }
        .rocard:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(10,15,30,.1); }
        .ro-icon { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 20px; }
        .ro-h { font-size: 1rem; font-weight: 700; color: var(--ink); margin-bottom: 10px; }
        .ro-p { font-size: 0.845rem; color: var(--ink2); line-height: 1.65; margin-bottom: 18px; }
        .ro-tag { font-size: 0.67rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; display: inline-block; margin: 2px; }

        /* ─── CTA ─────────────────────────────────────────────── */
        .cta-box {
            background: linear-gradient(135deg, #0a0f1e 0%, #1e3a8a 50%, #1d4ed8 100%);
            border-radius: 20px; padding: 72px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-box::before { content: ''; position: absolute; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(37,99,235,.3) 0%, transparent 70%); top: -150px; right: -150px; pointer-events: none; }
        .cta-box::after { content: ''; position: absolute; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(8,145,178,.2) 0%, transparent 70%); bottom: -80px; left: -80px; pointer-events: none; }
        .btn-cta-w { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: var(--blue); border: none; border-radius: 10px; padding: 14px 36px; font-size: 0.95rem; font-weight: 700; box-shadow: 0 4px 16px rgba(0,0,0,.15); transition: transform .15s, box-shadow .15s; }
        .btn-cta-w:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,.2); color: var(--blue-d); }

        /* ─── FOOTER ──────────────────────────────────────────── */
        footer { background: var(--ink); color: rgba(255,255,255,.4); padding: 52px 0 28px; font-size: 0.82rem; }
        .ft-name { font-size: 0.95rem; font-weight: 800; color: #fff; }
        .ft-link { color: rgba(255,255,255,.4); transition: color .15s; display: block; margin-bottom: 8px; }
        .ft-link:hover { color: rgba(255,255,255,.85); }
        .ft-col-h { font-size: 0.63rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.2); margin-bottom: 14px; }
        footer hr { border-color: rgba(255,255,255,.07) !important; margin: 32px 0 20px; }

        /* ─── ANIMATION ───────────────────────────────────────── */
        .fu { opacity: 0; transform: translateY(18px); transition: opacity .5s ease, transform .5s ease; }
        .fu.in { opacity: 1; transform: translateY(0); }

        /* ─── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 991px) {
            .hero-grid { grid-template-columns: 1fr; gap: 40px; padding: 60px 0 56px; }
            .hero-p { max-width: 100%; }
            .steps { grid-template-columns: repeat(2,1fr); gap: 32px; }
            .steps::before { display: none; }
        }
        @media (max-width: 767px) {
            .hero-grid { padding: 40px 0 44px; }
            .hero-h { font-size: 2rem; }
            .hero-p { font-size: 0.9rem; margin-bottom: 24px; }
            .btn-primary, .btn-ghost { padding: 12px 22px; font-size: 0.875rem; }
            .s { padding: 60px 0; }
            .s-h { font-size: 1.45rem; }
            .fc { padding: 22px; }
            .fc-icon { width: 42px; height: 42px; font-size: 1rem; margin-bottom: 14px; }
            .step-n { width: 40px; height: 40px; font-size: 0.875rem; }
            .rocard { padding: 28px 20px; }
            .ro-icon { width: 52px; height: 52px; font-size: 1.25rem; margin-bottom: 14px; }
            .cta-box { padding: 48px 24px; border-radius: 16px; }
            .trust-items { gap: 20px; }
            footer { padding: 40px 0 24px; }
            footer .col-md-3, footer .col-md-4 { text-align: center !important; }
        }
        @media (max-width: 480px) {
            .hero-h { font-size: 1.75rem; }
            .nbrand-sub { display: none; }
            .steps { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<!-- MOBILE MENU -->
<div class="mmenu" id="mm">
    <button class="mmenu-x" id="mmX"><i class="fas fa-xmark"></i></button>
    <a href="#features" class="ml">Features</a>
    <a href="#how-it-works" class="ml">How It Works</a>
    <a href="#roles" class="ml">Who It's For</a>
    <div class="mmenu-cta">
        <a href="{{ route('register') }}" class="btn-in">Sign Up</a>
        <a href="{{ route('login') }}" class="btn-out">Sign In</a>
    </div>
</div>

<!-- NAVBAR -->
<nav class="nav">
    <div class="container">
        <div class="nav-i">
            <a href="{{ route('landing') }}" class="nbrand">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" onerror="this.style.display='none'">
                <div>
                    <span class="nbrand-name">SCC ReportHub</span>
                    <span class="nbrand-sub">Southern Christian College</span>
                </div>
            </a>
            <div class="nlinks d-none d-lg-flex">
                <a href="#features">Features</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#roles">Who It's For</a>
            </div>
            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-out">Sign In</a>
                <a href="{{ route('register') }}" class="btn-in">Sign Up</a>
            </div>
            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-out" style="padding:5px 12px;font-size:0.78rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mmO" style="color:var(--ink2);font-size:1.15rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-grid">

            <!-- Left: copy -->
            <div>
                <div class="hero-tag"><i class="fas fa-building"></i> Campus Facility Management</div>
                <h1 class="hero-h">
                    The smarter way to<br>
                    manage <em>campus facilities</em>
                </h1>
                <p class="hero-p">SCC ReportHub connects faculty, administrators, and maintenance staff in one streamlined platform. Report issues, track repairs, and resolve problems faster.</p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i class="fas fa-rocket"></i> Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn-ghost">
                        Sign In <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Right: dashboard mockup -->
            <div>
                <div class="hero-mockup">
                    <div class="mock-bar">
                        <div class="mock-dot" style="background:#ef4444;"></div>
                        <div class="mock-dot" style="background:#f59e0b;"></div>
                        <div class="mock-dot" style="background:#10b981;"></div>
                        <span class="mock-title">SCC ReportHub — Dashboard</span>
                    </div>
                    <div class="mock-body">
                        <div class="mock-stat-row">
                            <div class="mock-stat">
                                <div class="mock-stat-n" style="color:#2563eb;">24</div>
                                <div class="mock-stat-l">Total Tickets</div>
                            </div>
                            <div class="mock-stat">
                                <div class="mock-stat-n" style="color:#d97706;">8</div>
                                <div class="mock-stat-l">Pending</div>
                            </div>
                            <div class="mock-stat">
                                <div class="mock-stat-n" style="color:#059669;">12</div>
                                <div class="mock-stat-l">Resolved</div>
                            </div>
                        </div>
                        <div style="font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink3);margin-bottom:10px;">Recent Tickets</div>
                        <div class="mock-ticket">
                            <div class="mock-dot2" style="background:#ef4444;"></div>
                            <div class="mock-ttext">Electrical outlet not working — Room 204</div>
                            <span class="mock-tbadge" style="background:#fef2f2;color:#dc2626;">Urgent</span>
                        </div>
                        <div class="mock-ticket">
                            <div class="mock-dot2" style="background:#2563eb;"></div>
                            <div class="mock-ttext">Leaking faucet — Comfort Room B</div>
                            <span class="mock-tbadge" style="background:#eff6ff;color:#2563eb;">Ongoing</span>
                        </div>
                        <div class="mock-ticket">
                            <div class="mock-dot2" style="background:#059669;"></div>
                            <div class="mock-ttext">AC unit repair — Faculty Lounge</div>
                            <span class="mock-tbadge" style="background:#ecfdf5;color:#059669;">Done</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
    <div class="container text-center">
        <div class="trust-label">Designed for Southern Christian College</div>
        <div class="trust-items">
            <div class="trust-item"><i class="fas fa-ticket-alt" style="color:var(--blue);"></i> Ticket Management</div>
            <div class="trust-item"><i class="fas fa-bell" style="color:var(--amber);"></i> Real-time Notifications</div>
            <div class="trust-item"><i class="fas fa-chart-bar" style="color:var(--teal);"></i> Analytics Dashboard</div>
            <div class="trust-item"><i class="fas fa-shield-halved" style="color:var(--violet);"></i> Role-Based Access</div>
            <div class="trust-item"><i class="fas fa-cloud-upload-alt" style="color:var(--green);"></i> Cloud Storage</div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<section class="s" id="features">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="s-label">Features</div>
            <h2 class="s-h mb-3">Everything you need, nothing you don't</h2>
            <p class="s-p">A focused set of tools built specifically for campus facility management.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 fu">
                <div class="fc">
                    <div class="fc-icon" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-ticket-alt"></i></div>
                    <div class="fc-h">Easy Ticket Submission</div>
                    <div class="fc-p">Faculty and staff report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.08s">
                <div class="fc">
                    <div class="fc-icon" style="background:#ecfdf5;color:#059669;"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="fc-h">Real-Time Monitoring</div>
                    <div class="fc-p">Track every ticket from submission to completion. Know exactly who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.16s">
                <div class="fc">
                    <div class="fc-icon" style="background:#fffbeb;color:#d97706;"><i class="fas fa-bell"></i></div>
                    <div class="fc-h">Instant Notifications</div>
                    <div class="fc-p">Get notified when your ticket is approved, assigned, or resolved — no need to follow up manually.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.08s">
                <div class="fc">
                    <div class="fc-icon" style="background:#f5f3ff;color:#7c3aed;"><i class="fas fa-chart-pie"></i></div>
                    <div class="fc-h">Admin Dashboard</div>
                    <div class="fc-p">Admins get a full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.16s">
                <div class="fc">
                    <div class="fc-icon" style="background:#f0fdfa;color:#0891b2;"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="fc-h">Maintenance Task Management</div>
                    <div class="fc-p">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.24s">
                <div class="fc">
                    <div class="fc-icon" style="background:#fef2f2;color:#dc2626;"><i class="fas fa-star"></i></div>
                    <div class="fc-h">Feedback & Ratings</div>
                    <div class="fc-p">After a ticket is resolved, faculty can rate the service — helping admins improve maintenance quality.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="s s-alt" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="s-label">How It Works</div>
            <h2 class="s-h mb-3">From report to resolution in four steps</h2>
        </div>
        <div class="steps fu">
            <div class="step">
                <div class="step-n">1</div>
                <div class="step-h">Submit a Ticket</div>
                <div class="step-p">Describe the issue, set priority, and attach a photo if needed.</div>
            </div>
            <div class="step">
                <div class="step-n">2</div>
                <div class="step-h">Admin Reviews</div>
                <div class="step-p">Admin approves and assigns it to the right maintenance staff.</div>
            </div>
            <div class="step">
                <div class="step-n">3</div>
                <div class="step-h">Repair in Progress</div>
                <div class="step-p">Maintenance staff works on the task and updates progress.</div>
            </div>
            <div class="step">
                <div class="step-n">4</div>
                <div class="step-h">Resolved & Rated</div>
                <div class="step-p">Admin verifies completion. Faculty rates the service. Done.</div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section class="s" id="roles">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="s-label">Who It's For</div>
            <h2 class="s-h mb-3">Built for every role in the campus</h2>
            <p class="s-p">Three distinct portals, each tailored to how that role interacts with facility management.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fu">
                <div class="rocard r1">
                    <div class="ro-icon" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-user-shield"></i></div>
                    <div class="ro-h">Admin</div>
                    <div class="ro-p">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="ro-tag" style="background:#eff6ff;color:#1d4ed8;">Dashboard</span>
                        <span class="ro-tag" style="background:#eff6ff;color:#1d4ed8;">User Management</span>
                        <span class="ro-tag" style="background:#eff6ff;color:#1d4ed8;">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.08s">
                <div class="rocard r2">
                    <div class="ro-icon" style="background:#f0fdfa;color:#0891b2;"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="ro-h">Faculty / Staff</div>
                    <div class="ro-p">Report facility issues, track your ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="ro-tag" style="background:#f0fdfa;color:#0e7490;">Submit Tickets</span>
                        <span class="ro-tag" style="background:#f0fdfa;color:#0e7490;">Track Status</span>
                        <span class="ro-tag" style="background:#f0fdfa;color:#0e7490;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.16s">
                <div class="rocard r3">
                    <div class="ro-icon" style="background:#ecfdf5;color:#059669;"><i class="fas fa-hard-hat"></i></div>
                    <div class="ro-h">Maintenance Staff</div>
                    <div class="ro-p">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
                    <div>
                        <span class="ro-tag" style="background:#ecfdf5;color:#065f46;">Task Queue</span>
                        <span class="ro-tag" style="background:#ecfdf5;color:#065f46;">Progress Updates</span>
                        <span class="ro-tag" style="background:#ecfdf5;color:#065f46;">History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="s s-alt">
    <div class="container">
        <div class="cta-box fu">
            <div style="position:relative;z-index:1;">
                <div class="s-label" style="color:#93c5fd;display:flex;justify-content:center;">Get Started Today</div>
                <h2 class="s-h mt-2 mb-3" style="color:#fff;">Ready to keep your campus in top shape?</h2>
                <p class="s-p mb-4" style="color:rgba(255,255,255,.6);">Join the SCC community on ReportHub. Create your account and start reporting facility issues in minutes.</p>
                <a href="{{ route('register') }}" class="btn-cta-w">
                    <i class="fas fa-user-plus"></i> Create an Account
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="28" height="28" style="border-radius:8px;object-fit:contain;background:#fff;padding:2px;" onerror="this.style.display='none'">
                    <span class="ft-name">SCC ReportHub</span>
                </div>
                <p style="font-size:0.8rem;line-height:1.65;max-width:280px;color:rgba(255,255,255,.4);">Campus Facility Status Report &amp; Monitoring System for Southern Christian College, Midsayap, Cotabato.</p>
            </div>
            <div class="col-6 col-md-3 offset-md-1">
                <div class="ft-col-h">Navigation</div>
                <a href="#features" class="ft-link">Features</a>
                <a href="#how-it-works" class="ft-link">How It Works</a>
                <a href="#roles" class="ft-link">Who It's For</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="ft-col-h">Account</div>
                <a href="{{ route('login') }}" class="ft-link">Sign In</a>
                <a href="{{ route('register') }}" class="ft-link">Create Account</a>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="font-size:0.75rem;">
            <span>&copy; {{ date('Y') }} Southern Christian College. All rights reserved.</span>
            <span>Midsayap, Cotabato, Philippines</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const mm = document.getElementById('mm');
    document.getElementById('mmO').addEventListener('click', () => { mm.classList.add('on'); document.body.style.overflow = 'hidden'; });
    document.getElementById('mmX').addEventListener('click', () => { mm.classList.remove('on'); document.body.style.overflow = ''; });
    mm.querySelectorAll('a.ml').forEach(l => {
        l.addEventListener('click', e => {
            if (l.getAttribute('href').startsWith('#')) {
                e.preventDefault(); mm.classList.remove('on'); document.body.style.overflow = '';
                setTimeout(() => { const t = document.querySelector(l.getAttribute('href')); if (t) t.scrollIntoView({ behavior: 'smooth' }); }, 250);
            } else { mm.classList.remove('on'); document.body.style.overflow = ''; }
        });
    });
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.08 });
    document.querySelectorAll('.fu').forEach(el => io.observe(el));
</script>
</body>
</html>
