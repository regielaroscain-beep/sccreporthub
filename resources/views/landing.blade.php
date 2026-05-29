<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg:     #0d1117;
            --bg2:    #161b22;
            --bg3:    #21262d;
            --border: rgba(255,255,255,0.08);
            --t1:     #f0f6fc;
            --t2:     #8b949e;
            --t3:     #484f58;
            --green:  #3fb950;
            --blue:   #58a6ff;
            --purple: #bc8cff;
            --orange: #ffa657;
            --red:    #ff7b72;
            --teal:   #39d353;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg); color: var(--t1);
            line-height: 1.6; -webkit-font-smoothing: antialiased; overflow-x: hidden;
        }
        h1,h2,h3,h4,h5 { font-family: 'Sora', system-ui, sans-serif; }
        a { text-decoration: none; color: var(--blue); }

        /* ── NAV ─────────────────────────────────────────────── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 900;
            height: 60px;
            background: rgba(13,17,23,0.85);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
        }
        .nav-i { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .nbrand { display: flex; align-items: center; gap: 9px; }
        .nbrand img { width: 30px; height: 30px; border-radius: 6px; object-fit: contain; background: #fff; padding: 2px; }
        .nbrand-name { font-family: 'Sora', sans-serif; font-size: 0.88rem; font-weight: 700; color: var(--t1); }
        .nbrand-sub { font-size: 0.52rem; font-weight: 500; color: var(--t3); text-transform: uppercase; letter-spacing: .8px; display: block; }
        .nlinks { display: flex; gap: 24px; }
        .nlinks a { font-size: 0.82rem; font-weight: 500; color: var(--t2); transition: color .15s; }
        .nlinks a:hover { color: var(--t1); }
        .btn-si { background: transparent; border: 1px solid var(--border); color: var(--t2); border-radius: 6px; padding: 6px 14px; font-size: 0.8rem; font-weight: 500; transition: all .15s; }
        .btn-si:hover { border-color: rgba(255,255,255,.2); color: var(--t1); }
        .btn-su { background: var(--green); color: #0d1117; border: none; border-radius: 6px; padding: 6px 14px; font-size: 0.8rem; font-weight: 700; transition: opacity .15s, transform .15s; }
        .btn-su:hover { opacity: .88; transform: translateY(-1px); color: #0d1117; }

        /* ── MOBILE MENU ─────────────────────────────────────── */
        .mm { display: none; position: fixed; inset: 0; z-index: 1100; background: var(--bg2); flex-direction: column; align-items: center; justify-content: center; }
        .mm.on { display: flex; }
        .mm-x { position: absolute; top: 18px; right: 18px; background: none; border: none; font-size: 1.3rem; color: var(--t2); cursor: pointer; }
        .mm a.ml { display: block; font-size: 1.1rem; font-weight: 600; color: var(--t1); padding: 14px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); transition: color .15s; }
        .mm a.ml:hover { color: var(--green); }
        .mm-cta { display: flex; flex-direction: column; gap: 10px; width: 70%; max-width: 240px; margin-top: 24px; }
        .mm-cta .btn-su, .mm-cta .btn-si { width: 100%; text-align: center; padding: 12px; font-size: 0.875rem; border-radius: 8px; }

        /* ── HERO ────────────────────────────────────────────── */
        .hero {
            padding-top: 60px; min-height: 100vh;
            display: flex; align-items: center;
            background: var(--bg);
            position: relative; overflow: hidden;
        }
        /* Animated grid background */
        .hero::before {
            content: '';
            position: absolute; inset: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .hero::after {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 60% 50% at 50% 0%, rgba(63,185,80,.12) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 80%, rgba(88,166,255,.08) 0%, transparent 55%);
        }
        .hero-inner { position: relative; z-index: 1; padding: 80px 0 72px; width: 100%; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(63,185,80,.1); border: 1px solid rgba(63,185,80,.3);
            color: var(--green); border-radius: 50px; padding: 4px 12px;
            font-size: 0.67rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
            margin-bottom: 24px;
        }
        .hero-badge span { width: 6px; height: 6px; border-radius: 50%; background: var(--green); display: inline-block; animation: blink 1.5s infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
        .hero-h {
            font-size: clamp(2.4rem, 5vw, 4rem); font-weight: 800; color: var(--t1);
            line-height: 1.08; letter-spacing: -.8px; margin-bottom: 20px;
        }
        .hero-h .hl { color: var(--green); }
        .hero-p { font-size: 1rem; color: var(--t2); line-height: 1.75; margin-bottom: 36px; max-width: 520px; }
        .btn-cta {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: #0d1117; border: none; border-radius: 8px;
            padding: 13px 28px; font-size: 0.9rem; font-weight: 700;
            transition: opacity .15s, transform .15s;
        }
        .btn-cta:hover { opacity: .88; transform: translateY(-2px); color: #0d1117; }
        .btn-cta2 {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--t2); border: 1px solid var(--border);
            border-radius: 8px; padding: 13px 24px; font-size: 0.9rem; font-weight: 500;
            transition: border-color .15s, color .15s;
        }
        .btn-cta2:hover { border-color: rgba(255,255,255,.2); color: var(--t1); }

        /* Terminal-style mockup */
        .terminal {
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 12px; overflow: hidden;
            box-shadow: 0 24px 64px rgba(0,0,0,.5);
        }
        .term-bar {
            background: var(--bg3); padding: 10px 16px;
            display: flex; align-items: center; gap: 6px;
            border-bottom: 1px solid var(--border);
        }
        .term-dot { width: 10px; height: 10px; border-radius: 50%; }
        .term-title { font-size: 0.7rem; color: var(--t3); margin-left: 8px; font-family: 'Sora', sans-serif; }
        .term-body { padding: 20px; font-family: 'Courier New', monospace; font-size: 0.78rem; }
        .tl { margin-bottom: 6px; display: flex; align-items: flex-start; gap: 8px; }
        .tl-prompt { color: var(--green); flex-shrink: 0; }
        .tl-cmd { color: var(--t1); }
        .tl-out { color: var(--t2); padding-left: 16px; }
        .tl-ok { color: var(--green); }
        .tl-warn { color: var(--orange); }
        .tl-err { color: var(--red); }
        .tl-info { color: var(--blue); }
        .tl-purple { color: var(--purple); }
        .cursor { display: inline-block; width: 8px; height: 14px; background: var(--green); animation: blink 1s infinite; vertical-align: middle; }

        /* ── STATS ROW ───────────────────────────────────────── */
        .stats-row {
            background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
            padding: 32px 0;
        }
        .stat-item { text-align: center; padding: 0 16px; }
        .stat-n { font-family: 'Sora', sans-serif; font-size: 1.8rem; font-weight: 800; color: var(--t1); letter-spacing: -.5px; line-height: 1; }
        .stat-l { font-size: 0.72rem; font-weight: 500; color: var(--t3); text-transform: uppercase; letter-spacing: .08em; margin-top: 4px; }
        .stat-divider { width: 1px; background: var(--border); align-self: stretch; }

        /* ── FEATURES ────────────────────────────────────────── */
        .sec { padding: 96px 0; }
        .sec-dark { background: var(--bg); }
        .sec-mid { background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .sec-label { font-size: 0.67rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: var(--green); margin-bottom: 10px; }
        .sec-h { font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 800; color: var(--t1); line-height: 1.2; letter-spacing: -.3px; }
        .sec-p { font-size: 0.95rem; color: var(--t2); max-width: 520px; margin: 0 auto; line-height: 1.7; }

        .fc {
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 12px; padding: 26px; height: 100%;
            transition: border-color .2s, transform .2s, box-shadow .2s;
            position: relative; overflow: hidden;
        }
        .fc::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; opacity: 0; transition: opacity .2s; }
        .fc:hover { border-color: rgba(63,185,80,.3); transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,.3); }
        .fc:hover::before { opacity: 1; background: linear-gradient(90deg, var(--green), var(--blue)); }
        .fc-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; margin-bottom: 16px; }
        .fc-h { font-family: 'Sora', sans-serif; font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 8px; }
        .fc-p { font-size: 0.82rem; color: var(--t2); line-height: 1.65; }

        /* ── HOW IT WORKS — numbered list style ──────────────── */
        .how-item {
            display: flex; gap: 20px; align-items: flex-start;
            padding: 24px; background: var(--bg3); border: 1px solid var(--border);
            border-radius: 12px; transition: border-color .2s;
        }
        .how-item:hover { border-color: rgba(88,166,255,.3); }
        .how-num {
            width: 36px; height: 36px; border-radius: 8px; flex-shrink: 0;
            background: rgba(63,185,80,.1); border: 1px solid rgba(63,185,80,.2);
            color: var(--green); font-family: 'Sora', sans-serif; font-size: 0.875rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
        }
        .how-h { font-family: 'Sora', sans-serif; font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 4px; }
        .how-p { font-size: 0.8rem; color: var(--t2); line-height: 1.6; }

        /* ── ROLES — horizontal cards ────────────────────────── */
        .rocard {
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 14px; padding: 28px 24px; height: 100%;
            transition: border-color .2s, transform .2s;
            position: relative; overflow: hidden;
        }
        .rocard::after { content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 3px; border-radius: 14px 0 0 14px; }
        .rocard.r1::after { background: var(--blue); }
        .rocard.r2::after { background: var(--purple); }
        .rocard.r3::after { background: var(--green); }
        .rocard:hover { transform: translateY(-3px); }
        .rocard.r1:hover { border-color: rgba(88,166,255,.3); }
        .rocard.r2:hover { border-color: rgba(188,140,255,.3); }
        .rocard.r3:hover { border-color: rgba(63,185,80,.3); }
        .ro-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px; }
        .ro-h { font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 700; color: var(--t1); margin-bottom: 8px; }
        .ro-p { font-size: 0.82rem; color: var(--t2); line-height: 1.65; margin-bottom: 16px; }
        .ro-tag { font-size: 0.65rem; font-weight: 600; padding: 2px 8px; border-radius: 4px; display: inline-block; margin: 2px; font-family: 'Courier New', monospace; }

        /* ── CTA ─────────────────────────────────────────────── */
        .cta-wrap {
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 16px; padding: 64px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-wrap::before {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 50% 60% at 50% 0%, rgba(63,185,80,.1) 0%, transparent 60%);
        }
        .cta-wrap::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, var(--green), transparent);
        }

        /* ── FOOTER ──────────────────────────────────────────── */
        footer { background: var(--bg2); border-top: 1px solid var(--border); padding: 48px 0 28px; font-size: 0.82rem; color: var(--t3); }
        .ft-name { font-family: 'Sora', sans-serif; font-size: 0.9rem; font-weight: 700; color: var(--t1); }
        .ft-link { color: var(--t3); transition: color .15s; display: block; margin-bottom: 8px; }
        .ft-link:hover { color: var(--t1); }
        .ft-col-h { font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--t3); margin-bottom: 14px; }
        footer hr { border-color: var(--border) !important; margin: 28px 0 20px; }

        /* ── ANIMATION ───────────────────────────────────────── */
        .fu { opacity: 0; transform: translateY(16px); transition: opacity .5s ease, transform .5s ease; }
        .fu.in { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 991px) {
            .hero-inner { padding: 56px 0 52px; }
            .hero-p { max-width: 100%; }
        }
        @media (max-width: 767px) {
            .hero-inner { padding: 36px 0 40px; }
            .hero-h { font-size: 1.9rem; letter-spacing: -.4px; }
            .hero-p { font-size: 0.875rem; margin-bottom: 24px; }
            .btn-cta, .btn-cta2 { padding: 12px 22px; font-size: 0.875rem; }
            .stats-row { padding: 24px 0; }
            .stat-n { font-size: 1.4rem; }
            .stat-l { font-size: 0.65rem; }
            .sec { padding: 60px 0; }
            .sec-h { font-size: 1.45rem; }
            .fc { padding: 20px; }
            .fc-icon { width: 38px; height: 38px; font-size: 0.95rem; margin-bottom: 12px; }
            .how-item { padding: 18px; gap: 14px; }
            .rocard { padding: 22px 18px; }
            .ro-icon { width: 44px; height: 44px; font-size: 1.1rem; margin-bottom: 12px; }
            .cta-wrap { padding: 40px 20px; border-radius: 12px; }
            .cta-wrap .sec-h { font-size: 1.35rem; }
            footer { padding: 36px 0 20px; }
            footer .col-md-3, footer .col-md-4 { text-align: center !important; }
        }
        @media (max-width: 480px) {
            .hero-h { font-size: 1.65rem; }
            .nbrand-sub { display: none; }
            .term-body { font-size: 0.7rem; padding: 14px; }
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
        <a href="{{ route('register') }}" class="btn-su">Sign Up</a>
        <a href="{{ route('login') }}" class="btn-si">Sign In</a>
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
                <a href="{{ route('login') }}" class="btn-si">Sign In</a>
                <a href="{{ route('register') }}" class="btn-su">Sign Up</a>
            </div>
            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-si" style="padding:5px 11px;font-size:0.76rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mmO" style="color:var(--t2);font-size:1.1rem;"><i class="fas fa-bars"></i></button>
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
                <div class="col-lg-6">
                    <div class="hero-badge"><span></span> Live System</div>
                    <h1 class="hero-h">
                        Campus facility<br>
                        issues, <span class="hl">resolved.</span>
                    </h1>
                    <p class="hero-p">SCC ReportHub connects faculty, administrators, and maintenance staff in one platform. Submit tickets, track repairs, and keep Southern Christian College running at its best.</p>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn-cta">
                            <i class="fas fa-rocket"></i> Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn-cta2">
                            Sign In <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Right: terminal mockup -->
                <div class="col-lg-6">
                    <div class="terminal">
                        <div class="term-bar">
                            <div class="term-dot" style="background:#ff5f57;"></div>
                            <div class="term-dot" style="background:#febc2e;"></div>
                            <div class="term-dot" style="background:#28c840;"></div>
                            <span class="term-title">scc-reporthub — ticket-monitor</span>
                        </div>
                        <div class="term-body">
                            <div class="tl"><span class="tl-prompt">$</span><span class="tl-cmd"> reporthub status</span></div>
                            <div class="tl tl-out"><span class="tl-ok">✓</span> System online — SCC ReportHub v1.0</div>
                            <div class="tl tl-out"><span class="tl-info">→</span> Connected to database</div>
                            <div class="tl tl-out"><span class="tl-ok">✓</span> 3 roles active: Admin, Faculty, Maintenance</div>
                            <div class="tl" style="margin-top:8px;"><span class="tl-prompt">$</span><span class="tl-cmd"> reporthub tickets --status=active</span></div>
                            <div class="tl tl-out"><span class="tl-warn">!</span> <span class="tl-warn">URGENT</span> — Electrical outlet, Room 204</div>
                            <div class="tl tl-out"><span class="tl-info">~</span> <span class="tl-info">ONGOING</span> — Leaking faucet, Comfort Room B</div>
                            <div class="tl tl-out"><span class="tl-ok">✓</span> <span class="tl-ok">RESOLVED</span> — AC unit repair, Faculty Lounge</div>
                            <div class="tl tl-out"><span class="tl-purple">i</span> <span class="tl-purple">PENDING</span> — Broken window, Room 108</div>
                            <div class="tl" style="margin-top:8px;"><span class="tl-prompt">$</span><span class="tl-cmd"> reporthub stats</span></div>
                            <div class="tl tl-out">Total: <span class="tl-ok">24</span> &nbsp; Pending: <span class="tl-warn">8</span> &nbsp; Resolved: <span class="tl-ok">12</span> &nbsp; Urgent: <span class="tl-err">3</span></div>
                            <div class="tl" style="margin-top:8px;"><span class="tl-prompt">$</span><span class="tl-cmd"> <span class="cursor"></span></span></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- STATS ROW -->
<div class="stats-row">
    <div class="container">
        <div class="d-flex align-items-center justify-content-center flex-wrap gap-0">
            <div class="stat-item fu">
                <div class="stat-n" style="color:var(--green);">8</div>
                <div class="stat-l">Issue Categories</div>
            </div>
            <div class="stat-divider d-none d-md-block mx-4" style="height:40px;"></div>
            <div class="stat-item fu" style="transition-delay:.08s">
                <div class="stat-n" style="color:var(--blue);">3</div>
                <div class="stat-l">User Roles</div>
            </div>
            <div class="stat-divider d-none d-md-block mx-4" style="height:40px;"></div>
            <div class="stat-item fu" style="transition-delay:.16s">
                <div class="stat-n" style="color:var(--purple);">6</div>
                <div class="stat-l">Ticket Statuses</div>
            </div>
            <div class="stat-divider d-none d-md-block mx-4" style="height:40px;"></div>
            <div class="stat-item fu" style="transition-delay:.24s">
                <div class="stat-n" style="color:var(--orange);">100%</div>
                <div class="stat-l">Web-Based</div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<section class="sec sec-dark" id="features">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">Features</div>
            <h2 class="sec-h mb-3">Built for real campus needs</h2>
            <p class="sec-p">Every feature is designed around how SCC faculty, admins, and maintenance staff actually work.</p>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4 fu">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(88,166,255,.1);color:var(--blue);"><i class="fas fa-ticket-alt"></i></div>
                    <div class="fc-h">Easy Ticket Submission</div>
                    <div class="fc-p">Report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(63,185,80,.1);color:var(--green);"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="fc-h">Real-Time Monitoring</div>
                    <div class="fc-p">Track every ticket from submission to completion. Know who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(255,166,87,.1);color:var(--orange);"><i class="fas fa-bell"></i></div>
                    <div class="fc-h">Instant Notifications</div>
                    <div class="fc-p">Get notified when your ticket is approved, assigned, or resolved — no manual follow-up needed.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(188,140,255,.1);color:var(--purple);"><i class="fas fa-chart-pie"></i></div>
                    <div class="fc-h">Admin Dashboard</div>
                    <div class="fc-p">Full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(88,166,255,.1);color:var(--blue);"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="fc-h">Maintenance Task Management</div>
                    <div class="fc-p">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.18s">
                <div class="fc">
                    <div class="fc-icon" style="background:rgba(255,123,114,.1);color:var(--red);"><i class="fas fa-star"></i></div>
                    <div class="fc-h">Feedback & Ratings</div>
                    <div class="fc-p">Faculty rate resolved tickets — helping admins continuously improve maintenance quality.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec sec-mid" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">How It Works</div>
            <h2 class="sec-h mb-3">Four steps from report to resolution</h2>
        </div>
        <div class="row g-3">
            <div class="col-md-6 fu">
                <div class="how-item">
                    <div class="how-num">01</div>
                    <div>
                        <div class="how-h">Submit a Ticket</div>
                        <div class="how-p">Describe the issue, set priority level, and attach a photo if needed. Takes less than a minute.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 fu" style="transition-delay:.08s">
                <div class="how-item">
                    <div class="how-num">02</div>
                    <div>
                        <div class="how-h">Admin Reviews & Assigns</div>
                        <div class="how-p">Admin approves the ticket and assigns it to the right maintenance staff based on specialization.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 fu" style="transition-delay:.16s">
                <div class="how-item">
                    <div class="how-num">03</div>
                    <div>
                        <div class="how-h">Repair in Progress</div>
                        <div class="how-p">Maintenance staff works on the task, logs updates, and marks progress in real time.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 fu" style="transition-delay:.24s">
                <div class="how-item">
                    <div class="how-num">04</div>
                    <div>
                        <div class="how-h">Verified & Rated</div>
                        <div class="how-p">Admin verifies completion. Faculty rates the service quality. Ticket closed.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section class="sec sec-dark" id="roles">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">Who It's For</div>
            <h2 class="sec-h mb-3">Three roles, one platform</h2>
            <p class="sec-p">Each role gets a dedicated portal tailored to their specific responsibilities.</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 fu">
                <div class="rocard r1">
                    <div class="ro-icon" style="background:rgba(88,166,255,.1);color:var(--blue);"><i class="fas fa-user-shield"></i></div>
                    <div class="ro-h">Admin</div>
                    <div class="ro-p">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="ro-tag" style="background:rgba(88,166,255,.1);color:var(--blue);">dashboard</span>
                        <span class="ro-tag" style="background:rgba(88,166,255,.1);color:var(--blue);">users</span>
                        <span class="ro-tag" style="background:rgba(88,166,255,.1);color:var(--blue);">analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.08s">
                <div class="rocard r2">
                    <div class="ro-icon" style="background:rgba(188,140,255,.1);color:var(--purple);"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="ro-h">Faculty / Staff</div>
                    <div class="ro-p">Report facility issues, track ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="ro-tag" style="background:rgba(188,140,255,.1);color:var(--purple);">submit</span>
                        <span class="ro-tag" style="background:rgba(188,140,255,.1);color:var(--purple);">track</span>
                        <span class="ro-tag" style="background:rgba(188,140,255,.1);color:var(--purple);">feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.16s">
                <div class="rocard r3">
                    <div class="ro-icon" style="background:rgba(63,185,80,.1);color:var(--green);"><i class="fas fa-hard-hat"></i></div>
                    <div class="ro-h">Maintenance Staff</div>
                    <div class="ro-p">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
                    <div>
                        <span class="ro-tag" style="background:rgba(63,185,80,.1);color:var(--green);">tasks</span>
                        <span class="ro-tag" style="background:rgba(63,185,80,.1);color:var(--green);">progress</span>
                        <span class="ro-tag" style="background:rgba(63,185,80,.1);color:var(--green);">history</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="sec sec-mid">
    <div class="container">
        <div class="cta-wrap fu">
            <div style="position:relative;z-index:1;">
                <div class="sec-label" style="display:flex;justify-content:center;">Get Started</div>
                <h2 class="sec-h mt-2 mb-3">Ready to streamline your campus?</h2>
                <p class="sec-p mb-4">Create your account and start reporting facility issues in minutes. Free for all SCC faculty and staff.</p>
                <a href="{{ route('register') }}" class="btn-cta">
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
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="26" height="26" style="border-radius:6px;object-fit:contain;background:#fff;padding:2px;" onerror="this.style.display='none'">
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
