<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;0,14..32,800;0,14..32,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --navy:   #0a0e1a;
            --navy2:  #0f1629;
            --navy3:  #141d35;
            --blue:   #1e40af;
            --blue2:  #2563eb;
            --cyan:   #06b6d4;
            --indigo: #4f46e5;
            --violet: #7c3aed;
            --border: rgba(255,255,255,0.08);
            --border2:rgba(255,255,255,0.12);
            --t1:     #f8fafc;
            --t2:     #94a3b8;
            --t3:     #475569;
            --ok:     #10b981;
            --warn:   #f59e0b;
            --err:    #ef4444;
            --card-bg:rgba(255,255,255,0.04);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--navy);
            color: var(--t1);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }

        /* ── NAVBAR ─────────────────────────────────────────── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 900;
            height: 64px;
            background: rgba(10,14,26,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
        }
        .nav-inner { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .nav-brand { display: flex; align-items: center; gap: 10px; }
        .nav-brand img { width: 32px; height: 32px; border-radius: 8px; object-fit: contain; background: rgba(255,255,255,0.1); padding: 3px; }
        .nav-brand-name {
            font-size: 0.95rem; font-weight: 700; letter-spacing: -0.3px;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .nav-brand-sub { font-size: 0.52rem; font-weight: 500; color: var(--t3); text-transform: uppercase; letter-spacing: 0.8px; display: block; }
        .nav-links { display: flex; gap: 32px; }
        .nav-links a { font-size: 0.82rem; font-weight: 500; color: var(--t2); transition: color 0.15s; }
        .nav-links a:hover { color: var(--t1); }
        .btn-nav-si {
            background: transparent; border: 1px solid var(--border2);
            color: var(--t2); border-radius: 8px; padding: 7px 18px;
            font-size: 0.82rem; font-weight: 500; transition: all 0.15s;
        }
        .btn-nav-si:hover { border-color: rgba(255,255,255,0.25); color: var(--t1); }
        .btn-nav-su {
            background: linear-gradient(135deg, var(--blue2), var(--indigo));
            color: #fff; border: none; border-radius: 8px; padding: 7px 18px;
            font-size: 0.82rem; font-weight: 600;
            box-shadow: 0 0 20px rgba(37,99,235,0.4);
            transition: opacity 0.15s, transform 0.15s;
        }
        .btn-nav-su:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

        /* ── MOBILE MENU ─────────────────────────────────────── */
        .mm { display: none; position: fixed; inset: 0; z-index: 1100; background: var(--navy2); flex-direction: column; align-items: center; justify-content: center; }
        .mm.on { display: flex; }
        .mm-x { position: absolute; top: 18px; right: 18px; background: none; border: none; font-size: 1.3rem; color: var(--t2); cursor: pointer; }
        .mm a.ml { display: block; font-size: 1.1rem; font-weight: 600; color: var(--t1); padding: 14px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); transition: color 0.15s; }
        .mm a.ml:hover { color: #60a5fa; }
        .mm-cta { display: flex; flex-direction: column; gap: 10px; width: 72%; max-width: 260px; margin-top: 28px; }
        .mm-cta .btn-nav-su, .mm-cta .btn-nav-si { width: 100%; text-align: center; padding: 13px; font-size: 0.9rem; border-radius: 10px; }

        /* ── HERO ────────────────────────────────────────────── */
        .hero {
            padding-top: 64px;
            min-height: 100vh;
            background:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(37,99,235,0.35) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 90% 80%, rgba(124,58,237,0.2) 0%, transparent 55%),
                radial-gradient(ellipse 40% 40% at 10% 90%, rgba(6,182,212,0.15) 0%, transparent 55%),
                var(--navy);
            display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        /* Subtle grid overlay */
        .hero::before {
            content: '';
            position: absolute; inset: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 0%, transparent 100%);
        }
        .hero-inner { padding: 80px 0 72px; position: relative; z-index: 1; width: 100%; }

        /* Eyebrow */
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(37,99,235,0.15);
            border: 1px solid rgba(96,165,250,0.3);
            border-radius: 50px; padding: 5px 14px;
            font-size: 0.7rem; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase;
            color: #93c5fd; margin-bottom: 24px;
        }
        .hero-eyebrow-dot { width: 6px; height: 6px; border-radius: 50%; background: #60a5fa; animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }

        .hero-h {
            font-size: clamp(2.4rem, 5.5vw, 4rem);
            font-weight: 800; color: var(--t1);
            line-height: 1.08; letter-spacing: -0.8px; margin-bottom: 20px;
        }
        .hero-h .grad {
            background: linear-gradient(135deg, #60a5fa 0%, #a78bfa 50%, #67e8f9 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-p { font-size: 1.05rem; color: var(--t2); line-height: 1.75; margin-bottom: 36px; max-width: 480px; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--blue2), var(--indigo));
            color: #fff; border: none; border-radius: 10px;
            padding: 14px 32px; font-size: 0.95rem; font-weight: 600;
            box-shadow: 0 0 30px rgba(37,99,235,0.5);
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.15s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 0 40px rgba(37,99,235,0.65); opacity: 0.95; color: #fff; }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--t2);
            border: 1px solid var(--border2); border-radius: 10px;
            padding: 14px 28px; font-size: 0.95rem; font-weight: 500;
            transition: border-color 0.15s, color 0.15s;
        }
        .btn-outline:hover { border-color: rgba(255,255,255,0.3); color: var(--t1); }

        /* Hero mockup */
        .mockup-wrap {
            position: relative;
        }
        .mockup-glow {
            position: absolute; inset: -20px;
            background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(37,99,235,0.2) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }
        .mockup {
            background: rgba(15,22,41,0.9);
            border: 1px solid var(--border2);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 24px 64px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05);
            position: relative; z-index: 1;
        }
        .mockup-bar {
            background: rgba(255,255,255,0.04);
            border-bottom: 1px solid var(--border);
            padding: 11px 16px; display: flex; align-items: center; gap: 6px;
        }
        .m-dot { width: 10px; height: 10px; border-radius: 50%; }
        .m-url {
            flex: 1; background: rgba(255,255,255,0.06); border: 1px solid var(--border);
            border-radius: 5px; padding: 3px 10px; font-size: 0.62rem; color: var(--t3);
            margin: 0 10px; font-family: monospace;
        }
        .mockup-body { padding: 18px; }
        .m-header { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--t3); margin-bottom: 12px; }
        .m-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 8px; margin-bottom: 14px; }
        .m-stat { background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 10px; padding: 10px 12px; }
        .m-stat-n { font-size: 1.2rem; font-weight: 800; line-height: 1; letter-spacing: -0.3px; }
        .m-stat-l { font-size: 0.58rem; color: var(--t3); text-transform: uppercase; letter-spacing: 0.05em; margin-top: 3px; font-weight: 500; }
        .m-table { width: 100%; border-collapse: collapse; font-size: 0.7rem; }
        .m-table th { text-align: left; padding: 6px 8px; color: var(--t3); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border); font-size: 0.62rem; }
        .m-table td { padding: 8px; color: var(--t2); border-bottom: 1px solid rgba(255,255,255,0.04); }
        .m-table tr:last-child td { border-bottom: none; }
        .m-badge { font-size: 0.58rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; }

        /* ── TRUST BAR ───────────────────────────────────────── */
        .trust { background: rgba(255,255,255,0.02); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 28px 0; }
        .trust-label { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--t3); margin-bottom: 18px; }
        .trust-items { display: flex; align-items: center; justify-content: center; gap: 36px; flex-wrap: wrap; }
        .trust-item { display: flex; align-items: center; gap: 8px; font-size: 0.78rem; font-weight: 500; color: var(--t2); }
        .trust-item i { font-size: 1rem; }

        /* ── SECTIONS ────────────────────────────────────────── */
        .sec { padding: 96px 0; }
        .sec-alt { background: rgba(255,255,255,0.02); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .sec-label { font-size: 0.67rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #60a5fa; margin-bottom: 10px; }
        .sec-h { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; color: var(--t1); line-height: 1.2; letter-spacing: -0.3px; }
        .sec-p { font-size: 0.9rem; color: var(--t2); max-width: 520px; margin: 0 auto; line-height: 1.7; }

        /* Feature cards */
        .fc {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px; padding: 26px; height: 100%;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
            position: relative; overflow: hidden;
        }
        .fc::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); }
        .fc:hover { transform: translateY(-4px); border-color: rgba(96,165,250,0.3); box-shadow: 0 16px 40px rgba(0,0,0,0.3); }
        .fc-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; margin-bottom: 16px; }
        .fc-h { font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 8px; }
        .fc-p { font-size: 0.82rem; color: var(--t2); line-height: 1.65; }

        /* How it works */
        .how-card {
            background: var(--card-bg); border: 1px solid var(--border);
            border-radius: 12px; padding: 22px; display: flex; gap: 16px;
            transition: border-color 0.2s; position: relative;
        }
        .how-card:hover { border-color: rgba(96,165,250,0.3); }
        .how-arrow { display: none; position: absolute; right: -18px; top: 50%; transform: translateY(-50%); z-index: 2; color: var(--t3); font-size: 0.75rem; }
        @media(min-width:768px){ .col-md-6:nth-child(odd) .how-arrow { display: block; } }
        .how-n { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; background: linear-gradient(135deg, var(--blue2), var(--indigo)); color: #fff; font-size: 0.82rem; font-weight: 700; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(37,99,235,0.4); }
        .how-h { font-size: 0.845rem; font-weight: 700; color: var(--t1); margin-bottom: 4px; }
        .how-p { font-size: 0.78rem; color: var(--t2); line-height: 1.6; }

        /* Role cards */
        .rocard {
            background: var(--card-bg); border: 1px solid var(--border);
            border-radius: 16px; padding: 30px 24px; height: 100%;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
            position: relative; overflow: hidden;
        }
        .rocard::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent); }
        .rocard:hover { transform: translateY(-4px); border-color: rgba(96,165,250,0.3); box-shadow: 0 16px 40px rgba(0,0,0,0.3); }
        .ro-icon { width: 54px; height: 54px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; margin-bottom: 18px; }
        .ro-h { font-size: 0.95rem; font-weight: 700; color: var(--t1); margin-bottom: 8px; }
        .ro-p { font-size: 0.82rem; color: var(--t2); line-height: 1.65; margin-bottom: 16px; }
        .ro-tag { font-size: 0.65rem; font-weight: 600; padding: 3px 9px; border-radius: 20px; display: inline-block; margin: 2px; background: rgba(255,255,255,0.06); color: var(--t2); border: 1px solid var(--border); }

        /* CTA */
        .cta-wrap {
            background: linear-gradient(135deg, rgba(37,99,235,0.15) 0%, rgba(124,58,237,0.1) 50%, rgba(6,182,212,0.08) 100%);
            border: 1px solid rgba(96,165,250,0.2);
            border-radius: 20px; padding: 72px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-wrap::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(96,165,250,0.5), transparent); }
        .cta-wrap::after { content: ''; position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%); top: -150px; right: -100px; pointer-events: none; }

        /* Footer */
        footer { background: var(--navy2); border-top: 1px solid var(--border); padding: 48px 0 28px; font-size: 0.82rem; color: var(--t3); position: relative; }
        footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(96,165,250,0.4), transparent); }
        .ft-name { font-size: 0.9rem; font-weight: 700; color: var(--t1); }
        .ft-link { color: var(--t3); transition: color 0.15s; display: block; margin-bottom: 8px; }
        .ft-link:hover { color: var(--t1); }
        .ft-col-h { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--t3); margin-bottom: 14px; opacity: 0.6; }
        footer hr { border-color: var(--border) !important; margin: 28px 0 20px; }

        /* Animation */
        .fu { opacity: 0; transform: translateY(16px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .fu.in { opacity: 1; transform: translateY(0); }

        /* Responsive */
        @media(max-width:991px) {
            .hero-inner { padding: 56px 0 52px; }
        }
        @media(max-width:767px) {
            .hero-inner { padding: 32px 0 44px; }
            .hero-h { font-size: 2rem; letter-spacing: -0.4px; }
            .hero-p { font-size: 0.9rem; margin-bottom: 28px; }
            .btn-primary, .btn-outline { padding: 13px 24px; font-size: 0.875rem; }
            .m-stats { grid-template-columns: repeat(2,1fr); }
            .sec { padding: 60px 0; }
            .sec-h { font-size: 1.5rem; }
            .fc { padding: 22px; }
            .fc-icon { width: 40px; height: 40px; font-size: 1rem; margin-bottom: 12px; }
            .how-card { padding: 18px; gap: 12px; }
            .rocard { padding: 24px 20px; }
            .ro-icon { width: 46px; height: 46px; font-size: 1.15rem; margin-bottom: 14px; }
            .cta-wrap { padding: 44px 24px; border-radius: 14px; }
            .trust-items { gap: 20px; }
            footer { padding: 36px 0 20px; }
            footer .col-md-3, footer .col-md-4 { text-align: center !important; }
        }
        @media(max-width:480px) {
            .hero-h { font-size: 1.75rem; }
            .nav-brand-sub { display: none; }
        }
    </style>
</head>
<body>

<!-- MOBILE MENU -->
<div class="mm" id="mm">
    <button class="mm-x" id="mmX"><i class="fas fa-xmark"></i></button>
    <a href="#features" class="ml">Features</a>
    <a href="#how-it-works" class="ml">How It Works</a>
    <a href="#roles" class="ml">Who It's For</a>
    <div class="mm-cta">
        <a href="{{ route('register') }}" class="btn-nav-su">Sign Up</a>
        <a href="{{ route('login') }}" class="btn-nav-si">Sign In</a>
    </div>
</div>

<!-- NAVBAR -->
<nav class="nav">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('landing') }}" class="nav-brand">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" onerror="this.style.display='none'">
                <div>
                    <span class="nav-brand-name">SCC ReportHub</span>
                    <span class="nav-brand-sub">Southern Christian College</span>
                </div>
            </a>
            <div class="nav-links d-none d-lg-flex">
                <a href="#features">Features</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#roles">Who It's For</a>
            </div>
            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-nav-si">Sign In</a>
                <a href="{{ route('register') }}" class="btn-nav-su">Sign Up</a>
            </div>
            <div class="d-flex d-md-none">
                <button class="btn btn-link p-1" id="mmO" style="color:var(--t2);font-size:1.15rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-inner">
            <div class="row align-items-center g-5">

                <!-- Left -->
                <div class="col-lg-5">
                    <div class="hero-eyebrow">
                        <span class="hero-eyebrow-dot"></span>
                        Campus Facility Management System
                    </div>
                    <h1 class="hero-h">
                        Report. Track.<br>
                        <span class="grad">Resolve Faster.</span>
                    </h1>
                    <p class="hero-p">SCC ReportHub connects faculty, administrators, and maintenance staff in one streamlined platform — making campus facility management effortless.</p>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn-primary">
                            <i class="fas fa-rocket"></i> Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn-outline">
                            Sign In <i class="fas fa-arrow-right fa-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Right: mockup -->
                <div class="col-lg-7">
                    <div class="mockup-wrap">
                        <div class="mockup-glow"></div>
                        <div class="mockup">
                            <div class="mockup-bar">
                                <div class="m-dot" style="background:#ff5f57;"></div>
                                <div class="m-dot" style="background:#febc2e;"></div>
                                <div class="m-dot" style="background:#28c840;"></div>
                                <div class="m-url">scc-reporthub-production.up.railway.app/admin/dashboard</div>
                            </div>
                            <div class="mockup-body">
                                <div class="m-header">Dashboard Overview</div>
                                <div class="m-stats">
                                    <div class="m-stat"><div class="m-stat-n" style="color:#60a5fa;">24</div><div class="m-stat-l">Total</div></div>
                                    <div class="m-stat"><div class="m-stat-n" style="color:#fbbf24;">8</div><div class="m-stat-l">Pending</div></div>
                                    <div class="m-stat"><div class="m-stat-n" style="color:#67e8f9;">10</div><div class="m-stat-l">Ongoing</div></div>
                                    <div class="m-stat"><div class="m-stat-n" style="color:#34d399;">12</div><div class="m-stat-l">Resolved</div></div>
                                </div>
                                <table class="m-table">
                                    <thead><tr><th>Issue</th><th>Location</th><th>Priority</th><th>Status</th></tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>Electrical outlet</td><td>Room 204</td>
                                            <td><span class="m-badge" style="background:rgba(239,68,68,0.15);color:#fca5a5;">Urgent</span></td>
                                            <td><span class="m-badge" style="background:rgba(251,191,36,0.15);color:#fcd34d;">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>Leaking faucet</td><td>Comfort Room B</td>
                                            <td><span class="m-badge" style="background:rgba(251,191,36,0.15);color:#fcd34d;">High</span></td>
                                            <td><span class="m-badge" style="background:rgba(103,232,249,0.15);color:#67e8f9;">Ongoing</span></td>
                                        </tr>
                                        <tr>
                                            <td>AC unit repair</td><td>Faculty Lounge</td>
                                            <td><span class="m-badge" style="background:rgba(52,211,153,0.15);color:#6ee7b7;">Normal</span></td>
                                            <td><span class="m-badge" style="background:rgba(52,211,153,0.15);color:#6ee7b7;">Completed</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- TRUST BAR -->
<div class="trust">
    <div class="container text-center">
        <div class="trust-label">Built for Southern Christian College</div>
        <div class="trust-items">
            <div class="trust-item"><i class="fas fa-ticket-alt" style="color:#60a5fa;"></i> Ticket Management</div>
            <div class="trust-item"><i class="fas fa-bell" style="color:#fbbf24;"></i> Real-time Alerts</div>
            <div class="trust-item"><i class="fas fa-chart-line" style="color:#34d399;"></i> Analytics</div>
            <div class="trust-item"><i class="fas fa-shield-halved" style="color:#a78bfa;"></i> Role-Based Access</div>
            <div class="trust-item"><i class="fas fa-cloud-arrow-up" style="color:#67e8f9;"></i> Cloud Storage</div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<section class="sec" id="features">
    <div class="container">
        <div class="row align-items-end g-4 mb-5">
            <div class="col-md-6 fu">
                <div class="sec-label">Features</div>
                <h2 class="sec-h">Everything you need,<br>nothing you don't.</h2>
            </div>
            <div class="col-md-6 fu" style="transition-delay:.06s">
                <p class="sec-p" style="margin:0;">A focused set of tools built specifically for campus facility management at Southern Christian College.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4 fu">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(96,165,250,0.12);color:#60a5fa;"><i class="fas fa-paper-plane"></i></div>
                    <div class="fc-h">Easy Ticket Submission</div>
                    <div class="fc-p">Report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(52,211,153,0.12);color:#34d399;"><i class="fas fa-satellite-dish"></i></div>
                    <div class="fc-h">Real-Time Monitoring</div>
                    <div class="fc-p">Track every ticket from submission to completion. Know who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(251,191,36,0.12);color:#fbbf24;"><i class="fas fa-bell-ring"></i></div>
                    <div class="fc-h">Instant Notifications</div>
                    <div class="fc-p">Get notified when your ticket is approved, assigned, or resolved — no manual follow-up needed.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(167,139,250,0.12);color:#a78bfa;"><i class="fas fa-gauge-high"></i></div>
                    <div class="fc-h">Admin Dashboard</div>
                    <div class="fc-p">Charts, stats, and full control over tickets, users, and facilities in one powerful view.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(103,232,249,0.12);color:#67e8f9;"><i class="fas fa-wrench"></i></div>
                    <div class="fc-h">Maintenance Tasks</div>
                    <div class="fc-p">Maintenance staff see assigned tasks, update progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.18s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(249,115,22,0.12);color:#fb923c;"><i class="fas fa-star-half-stroke"></i></div>
                    <div class="fc-h">Feedback & Ratings</div>
                    <div class="fc-p">Faculty rate resolved tickets — helping admins continuously improve maintenance quality.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec sec-alt" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">How It Works</div>
            <h2 class="sec-h mb-3">Four steps, start to finish.</h2>
            <p class="sec-p">Simple process, fast results — from reporting to resolution.</p>
        </div>
        <div class="row g-3 fu">
            <div class="col-md-6" style="position:relative;">
                <div class="how-card">
                    <div class="how-n">1</div>
                    <div><div class="how-h">Submit a Ticket</div><div class="how-p">Describe the issue, set priority, and attach a photo. Takes under a minute.</div></div>
                </div>
                <div class="how-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="col-md-6">
                <div class="how-card">
                    <div class="how-n">2</div>
                    <div><div class="how-h">Admin Reviews & Assigns</div><div class="how-p">Admin approves and assigns it to the right maintenance staff based on specialization.</div></div>
                </div>
            </div>
            <div class="col-md-6" style="position:relative;">
                <div class="how-card">
                    <div class="how-n">3</div>
                    <div><div class="how-h">Repair in Progress</div><div class="how-p">Maintenance staff works on the task and updates progress in real time.</div></div>
                </div>
                <div class="how-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="col-md-6">
                <div class="how-card">
                    <div class="how-n">4</div>
                    <div><div class="how-h">Verified & Rated</div><div class="how-p">Admin verifies completion. Faculty rates the service quality. Ticket closed.</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section class="sec" id="roles">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">Who It's For</div>
            <h2 class="sec-h mb-3">A portal for every role.</h2>
            <p class="sec-p">Three dedicated portals, each tailored to how that role interacts with facility management.</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 fu">
                <div class="rocard">
                    <div class="ro-icon" style="background:rgba(96,165,250,0.12);color:#60a5fa;"><i class="fas fa-user-shield"></i></div>
                    <div class="ro-h">Admin</div>
                    <div class="ro-p">Full control over tickets, users, and facilities. Approve requests, assign staff, and view analytics.</div>
                    <div>
                        <span class="ro-tag">Dashboard</span>
                        <span class="ro-tag">User Management</span>
                        <span class="ro-tag">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.08s">
                <div class="rocard">
                    <div class="ro-icon" style="background:rgba(167,139,250,0.12);color:#a78bfa;"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="ro-h">Faculty / Staff</div>
                    <div class="ro-p">Report facility issues, track ticket status in real time, and rate the service once resolved.</div>
                    <div>
                        <span class="ro-tag">Submit Tickets</span>
                        <span class="ro-tag">Track Status</span>
                        <span class="ro-tag">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.16s">
                <div class="rocard">
                    <div class="ro-icon" style="background:rgba(52,211,153,0.12);color:#34d399;"><i class="fas fa-hard-hat"></i></div>
                    <div class="ro-h">Maintenance Staff</div>
                    <div class="ro-p">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
                    <div>
                        <span class="ro-tag">Task Queue</span>
                        <span class="ro-tag">Progress Updates</span>
                        <span class="ro-tag">History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="sec sec-alt">
    <div class="container">
        <div class="cta-wrap fu">
            <div style="position:relative;z-index:1;">
                <div class="sec-label" style="display:flex;justify-content:center;">Get Started Today</div>
                <h2 class="sec-h mt-2 mb-3">Ready to streamline your campus?</h2>
                <p class="sec-p mb-4" style="color:var(--t2);">Free for all SCC faculty and staff. Create your account and start reporting facility issues in minutes.</p>
                <a href="{{ route('register') }}" class="btn-primary">
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
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="26" height="26" style="border-radius:8px;object-fit:contain;background:rgba(255,255,255,0.1);padding:2px;" onerror="this.style.display='none'">
                    <span class="ft-name">SCC ReportHub</span>
                </div>
                <p style="font-size:0.78rem;line-height:1.65;max-width:260px;">Campus Facility Status Report &amp; Monitoring System — Southern Christian College, Midsayap, Cotabato.</p>
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="font-size:0.74rem;">
            <span>&copy; {{ date('Y') }} Southern Christian College. All rights reserved.</span>
            <span>Midsayap, Cotabato, Philippines</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const mm = document.getElementById('mm');
    const mmO = document.getElementById('mmO');
    if(mmO) mmO.addEventListener('click', () => { mm.classList.add('on'); document.body.style.overflow = 'hidden'; });
    document.getElementById('mmX').addEventListener('click', () => { mm.classList.remove('on'); document.body.style.overflow = ''; });
    mm.querySelectorAll('a.ml').forEach(l => {
        l.addEventListener('click', e => {
            if(l.getAttribute('href').startsWith('#')) {
                e.preventDefault(); mm.classList.remove('on'); document.body.style.overflow = '';
                setTimeout(() => { const t = document.querySelector(l.getAttribute('href')); if(t) t.scrollIntoView({ behavior: 'smooth' }); }, 260);
            } else { mm.classList.remove('on'); document.body.style.overflow = ''; }
        });
    });
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href'));
            if(t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if(e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.08 });
    document.querySelectorAll('.fu').forEach(el => io.observe(el));
</script>
</body>
</html>
