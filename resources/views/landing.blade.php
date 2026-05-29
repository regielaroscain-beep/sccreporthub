<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --p: #4f46e5; --pd: #3730a3; --ac: #06b6d4;
            --ok: #10b981; --warn: #f59e0b; --err: #ef4444;
            --bg: #f1f5f9; --card: #fff; --border: #e2e8f0;
            --t1: #0f172a; --t2: #475569; --t3: #94a3b8;
            --dark: #0f172a;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--t1); line-height: 1.6; -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        a { text-decoration: none; color: var(--p); }

        /* NAV */
        nav.top {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999; height: 60px;
            background: rgba(255,255,255,0.92); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
        }
        .nav-wrap { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .brand { display: flex; align-items: center; gap: 9px; }
        .brand img { width: 32px; height: 32px; border-radius: 50%; object-fit: contain; background: #fff; padding: 2px; border: 1px solid var(--border); }
        .brand-name { font-size: 0.9rem; font-weight: 800; background: linear-gradient(135deg,var(--p),var(--ac)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .brand-sub { font-size: 0.55rem; font-weight: 600; color: var(--t3); text-transform: uppercase; letter-spacing: .8px; display: block; }
        .nav-links { display: flex; gap: 28px; }
        .nav-links a { font-size: 0.82rem; font-weight: 500; color: var(--t2); transition: color .15s; }
        .nav-links a:hover { color: var(--p); }
        .btn-si { border: 1.5px solid var(--border); color: var(--t2); background: #fff; border-radius: 8px; padding: 6px 16px; font-size: 0.82rem; font-weight: 600; transition: all .15s; }
        .btn-si:hover { border-color: var(--p); color: var(--p); }
        .btn-su { background: var(--p); color: #fff; border: none; border-radius: 8px; padding: 6px 16px; font-size: 0.82rem; font-weight: 600; box-shadow: 0 2px 8px rgba(79,70,229,.3); transition: background .15s, transform .15s; }
        .btn-su:hover { background: var(--pd); transform: translateY(-1px); color: #fff; }

        /* MOBILE MENU */
        .mob { display: none; position: fixed; inset: 0; z-index: 1100; background: #fff; flex-direction: column; align-items: center; justify-content: center; }
        .mob.on { display: flex; }
        .mob-x { position: absolute; top: 18px; right: 18px; background: none; border: none; font-size: 1.4rem; color: var(--t2); cursor: pointer; }
        .mob a.ml { display: block; font-size: 1.15rem; font-weight: 700; color: var(--t1); padding: 14px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); transition: color .15s; }
        .mob a.ml:hover { color: var(--p); }
        .mob-btns { display: flex; flex-direction: column; gap: 10px; width: 72%; max-width: 240px; margin-top: 24px; }
        .mob-btns .btn-su, .mob-btns .btn-si { width: 100%; text-align: center; padding: 12px; font-size: 0.875rem; border-radius: 10px; }

        /* HERO — full dark */
        .hero {
            padding-top: 60px;
            min-height: 100vh;
            background: linear-gradient(145deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
            display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 60% 60% at 80% 30%, rgba(79,70,229,.4) 0%, transparent 65%),
                radial-gradient(ellipse 40% 40% at 15% 80%, rgba(6,182,212,.2) 0%, transparent 65%);
        }
        .hero-body { padding: 80px 0; position: relative; z-index: 1; width: 100%; }
        .hero-pill {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(79,70,229,.2); border: 1px solid rgba(129,140,248,.4);
            color: #a5b4fc; border-radius: 50px; padding: 5px 14px;
            font-size: 0.68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
            margin-bottom: 28px;
        }
        .hero-h1 { font-size: clamp(2.6rem, 5.5vw, 4rem); font-weight: 900; color: #fff; line-height: 1.08; letter-spacing: -.8px; margin-bottom: 20px; }
        .hero-h1 span { background: linear-gradient(135deg, #818cf8, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-p { font-size: 1.05rem; color: rgba(255,255,255,.65); line-height: 1.75; margin-bottom: 36px; max-width: 560px; }
        .btn-cta {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--p), var(--pd));
            color: #fff; border: none; border-radius: 10px;
            padding: 14px 36px; font-size: 0.95rem; font-weight: 700;
            box-shadow: 0 4px 18px rgba(79,70,229,.5);
            transition: transform .15s, box-shadow .15s, opacity .15s;
        }
        .btn-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(79,70,229,.6); opacity: .95; color: #fff; }
        .hero-trust { display: flex; align-items: center; gap: 24px; margin-top: 28px; flex-wrap: wrap; }
        .hero-trust span { font-size: 0.78rem; color: rgba(255,255,255,.45); display: flex; align-items: center; gap: 6px; }
        .hero-trust i { color: var(--ok); }

        /* FEATURES */
        .sec { padding: 96px 0; }
        .sec-alt { background: var(--card); }
        .sec-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: var(--p); margin-bottom: 10px; }
        .sec-h { font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 800; color: var(--t1); line-height: 1.2; letter-spacing: -.3px; }
        .sec-p { font-size: 0.95rem; color: var(--t2); max-width: 520px; margin: 0 auto; line-height: 1.7; }

        .fc {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; padding: 28px; height: 100%;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
            transition: transform .2s, box-shadow .2s, border-color .2s;
            position: relative; overflow: hidden;
        }
        .fc::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--p), var(--ac)); transform: scaleX(0); transform-origin: left; transition: transform .25s; }
        .fc:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(79,70,229,.1); border-color: #c7d2fe; }
        .fc:hover::after { transform: scaleX(1); }
        .fc-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 18px; }
        .fc-title { font-size: 0.9rem; font-weight: 700; color: var(--t1); margin-bottom: 8px; }
        .fc-desc { font-size: 0.835rem; color: var(--t2); line-height: 1.65; }

        /* HOW IT WORKS — horizontal timeline */
        .timeline-row { display: flex; align-items: flex-start; gap: 0; position: relative; }
        .timeline-row::before { content: ''; position: absolute; top: 23px; left: 24px; right: 24px; height: 2px; background: linear-gradient(90deg, var(--p), var(--ac)); opacity: .2; z-index: 0; }
        .titem { flex: 1; text-align: center; padding: 0 12px; position: relative; z-index: 1; }
        .tnum { width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, var(--p), var(--ac)); color: #fff; font-size: 1rem; font-weight: 800; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; box-shadow: 0 4px 16px rgba(79,70,229,.3); }
        .ttitle { font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 6px; }
        .tdesc { font-size: 0.8rem; color: var(--t2); line-height: 1.6; }

        /* ROLES */
        .rocard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 18px; padding: 36px 28px; height: 100%;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
            transition: transform .2s, box-shadow .2s;
            text-align: center;
        }
        .rocard:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(79,70,229,.1); }
        .ro-icon { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 20px; }
        .ro-title { font-size: 1rem; font-weight: 700; color: var(--t1); margin-bottom: 10px; }
        .ro-desc { font-size: 0.845rem; color: var(--t2); line-height: 1.65; margin-bottom: 18px; }
        .ro-tag { font-size: 0.67rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; display: inline-block; margin: 2px; }

        /* CTA */
        .cta-wrap {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
            border-radius: 20px; padding: 72px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-wrap::before { content: ''; position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(79,70,229,.3) 0%, transparent 70%); top: -120px; right: -120px; pointer-events: none; }
        .cta-wrap::after { content: ''; position: absolute; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(6,182,212,.2) 0%, transparent 70%); bottom: -80px; left: -80px; pointer-events: none; }
        .btn-cta-light { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: var(--p); border: none; border-radius: 10px; padding: 14px 36px; font-size: 0.95rem; font-weight: 700; box-shadow: 0 4px 16px rgba(0,0,0,.15); transition: transform .15s, box-shadow .15s; }
        .btn-cta-light:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,.2); color: var(--pd); }

        /* FOOTER */
        footer { background: var(--dark); color: rgba(255,255,255,.4); padding: 52px 0 28px; font-size: 0.82rem; }
        .ft-brand { font-size: 0.95rem; font-weight: 800; color: #fff; }
        .ft-link { color: rgba(255,255,255,.4); transition: color .15s; display: block; margin-bottom: 8px; }
        .ft-link:hover { color: rgba(255,255,255,.85); }
        .ft-col-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.2); margin-bottom: 14px; }
        footer hr { border-color: rgba(255,255,255,.07) !important; margin: 32px 0 20px; }

        /* FADE ANIMATION */
        .fu { opacity: 0; transform: translateY(18px); transition: opacity .5s ease, transform .5s ease; }
        .fu.in { opacity: 1; transform: translateY(0); }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .hero-body { padding: 60px 0; }
        }
        @media (max-width: 767px) {
            .hero-body { padding: 40px 0 48px; }
            .hero-h1 { font-size: 2rem; }
            .hero-p { font-size: 0.9rem; margin-bottom: 24px; }
            .btn-cta { padding: 13px 28px; font-size: 0.9rem; }
            .hero-trust { gap: 14px; }
            .sec { padding: 60px 0; }
            .sec-h { font-size: 1.45rem; }
            .fc { padding: 22px; }
            .fc-icon { width: 42px; height: 42px; font-size: 1rem; margin-bottom: 14px; }
            .titem { padding: 0 6px; }
            .tnum { width: 40px; height: 40px; font-size: 0.9rem; }
            .ttitle { font-size: 0.8rem; }
            .tdesc { font-size: 0.75rem; }
            .rocard { padding: 28px 20px; }
            .ro-icon { width: 52px; height: 52px; font-size: 1.3rem; margin-bottom: 14px; }
            .cta-wrap { padding: 48px 24px; border-radius: 16px; }
            .cta-wrap .sec-h { font-size: 1.4rem; }
            footer { padding: 40px 0 24px; }
            footer .col-md-3, footer .col-md-4 { text-align: center !important; }
            footer .ft-link { display: inline-block; margin: 0 8px 8px; }
        }
        @media (max-width: 480px) {
            .hero-h1 { font-size: 1.75rem; }
            .brand-sub { display: none; }
        }
    </style>
</head>
<body>

<!-- MOBILE MENU -->
<div class="mob" id="mob">
    <button class="mob-x" id="mobX"><i class="fas fa-xmark"></i></button>
    <a href="#features" class="ml">Features</a>
    <a href="#how-it-works" class="ml">How It Works</a>
    <a href="#roles" class="ml">Who It's For</a>
    <div class="mob-btns">
        <a href="{{ route('register') }}" class="btn-su">Sign Up</a>
        <a href="{{ route('login') }}" class="btn-si">Sign In</a>
    </div>
</div>

<!-- NAVBAR -->
<nav class="top">
    <div class="container">
        <div class="nav-wrap">
            <a href="{{ route('landing') }}" class="brand">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" onerror="this.style.display='none'">
                <div>
                    <span class="brand-name">SCC ReportHub</span>
                    <span class="brand-sub">Southern Christian College</span>
                </div>
            </a>
            <div class="nav-links d-none d-lg-flex">
                <a href="#features">Features</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#roles">Who It's For</a>
            </div>
            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-si">Sign In</a>
                <a href="{{ route('register') }}" class="btn-su">Sign Up</a>
            </div>
            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-si" style="padding:5px 12px;font-size:0.78rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mobO" style="color:var(--t2);font-size:1.15rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO — full dark -->
<section class="hero">
    <div class="container hero-body">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 text-center text-lg-start">
                <div class="hero-pill"><i class="fas fa-shield-halved"></i> Campus Facility Management</div>
                <h1 class="hero-h1">
                    Report. Track.<br>
                    <span>Resolve Faster.</span>
                </h1>
                <p class="hero-p mx-auto mx-lg-0">SCC ReportHub streamlines facility issue reporting at Southern Christian College. Submit tickets, monitor repairs in real time, and keep the campus running smoothly.</p>
                <a href="{{ route('register') }}" class="btn-cta">
                    <i class="fas fa-rocket"></i> Get Started Free
                </a>
                <div class="hero-trust justify-content-center justify-content-lg-start">
                    <span><i class="fas fa-check-circle"></i> Free for SCC Faculty</span>
                    <span><i class="fas fa-check-circle"></i> No App Needed</span>
                    <span><i class="fas fa-check-circle"></i> Real-time Updates</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="sec" id="features">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">Features</div>
            <h2 class="sec-h mb-3">Everything you need to manage campus facilities</h2>
            <p class="sec-p">From ticket submission to resolution, ReportHub covers the full maintenance lifecycle.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 fu">
                <div class="fc">
                    <div class="fc-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-ticket-alt"></i></div>
                    <div class="fc-title">Easy Ticket Submission</div>
                    <div class="fc-desc">Faculty and staff report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.08s">
                <div class="fc">
                    <div class="fc-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="fc-title">Real-Time Monitoring</div>
                    <div class="fc-desc">Track every ticket from submission to completion. Know exactly who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.16s">
                <div class="fc">
                    <div class="fc-icon" style="background:#fffbeb;color:#f59e0b;"><i class="fas fa-bell"></i></div>
                    <div class="fc-title">Instant Notifications</div>
                    <div class="fc-desc">Get notified when your ticket is approved, assigned, or resolved — no need to follow up manually.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.08s">
                <div class="fc">
                    <div class="fc-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chart-pie"></i></div>
                    <div class="fc-title">Admin Dashboard</div>
                    <div class="fc-desc">Admins get a full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.16s">
                <div class="fc">
                    <div class="fc-icon" style="background:#fdf4ff;color:#a855f7;"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="fc-title">Maintenance Task Management</div>
                    <div class="fc-desc">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.24s">
                <div class="fc">
                    <div class="fc-icon" style="background:#fef2f2;color:#ef4444;"><i class="fas fa-star"></i></div>
                    <div class="fc-title">Feedback & Ratings</div>
                    <div class="fc-desc">After a ticket is resolved, faculty can rate the service — helping admins improve maintenance quality.</div>
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
            <h2 class="sec-h mb-3">From report to resolution in four steps</h2>
        </div>
        <div class="timeline-row fu">
            <div class="titem">
                <div class="tnum">1</div>
                <div class="ttitle">Submit a Ticket</div>
                <div class="tdesc">Describe the issue, set priority, and attach a photo if needed.</div>
            </div>
            <div class="titem">
                <div class="tnum">2</div>
                <div class="ttitle">Admin Reviews</div>
                <div class="tdesc">Admin approves and assigns it to the right maintenance staff.</div>
            </div>
            <div class="titem">
                <div class="tnum">3</div>
                <div class="ttitle">Repair in Progress</div>
                <div class="tdesc">Maintenance staff works on the task and updates progress.</div>
            </div>
            <div class="titem">
                <div class="tnum">4</div>
                <div class="ttitle">Resolved & Rated</div>
                <div class="tdesc">Admin verifies completion. Faculty rates the service. Done.</div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section class="sec" id="roles">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">Who It's For</div>
            <h2 class="sec-h mb-3">Built for every role in the campus</h2>
            <p class="sec-p">Three distinct portals, each tailored to how that role interacts with facility management.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fu">
                <div class="rocard">
                    <div class="ro-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-user-shield"></i></div>
                    <div class="ro-title">Admin</div>
                    <div class="ro-desc">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="ro-tag" style="background:#eef2ff;color:#3730a3;">Dashboard</span>
                        <span class="ro-tag" style="background:#eef2ff;color:#3730a3;">User Management</span>
                        <span class="ro-tag" style="background:#eef2ff;color:#3730a3;">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.08s">
                <div class="rocard">
                    <div class="ro-icon" style="background:#eff6ff;color:#3b82f6;"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="ro-title">Faculty / Staff</div>
                    <div class="ro-desc">Report facility issues, track your ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="ro-tag" style="background:#eff6ff;color:#1e40af;">Submit Tickets</span>
                        <span class="ro-tag" style="background:#eff6ff;color:#1e40af;">Track Status</span>
                        <span class="ro-tag" style="background:#eff6ff;color:#1e40af;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.16s">
                <div class="rocard">
                    <div class="ro-icon" style="background:#ecfdf5;color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                    <div class="ro-title">Maintenance Staff</div>
                    <div class="ro-desc">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
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
<section class="sec sec-alt">
    <div class="container">
        <div class="cta-wrap fu">
            <div style="position:relative;z-index:1;">
                <div class="sec-label" style="color:#a5b4fc;display:flex;justify-content:center;">Get Started Today</div>
                <h2 class="sec-h mt-2 mb-3" style="color:#fff;">Ready to keep your campus in top shape?</h2>
                <p class="sec-p mb-4" style="color:rgba(255,255,255,.6);">Join the SCC community on ReportHub. Create your account and start reporting facility issues in minutes.</p>
                <a href="{{ route('register') }}" class="btn-cta-light">
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
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="28" height="28" style="border-radius:50%;object-fit:contain;background:#fff;padding:2px;" onerror="this.style.display='none'">
                    <span class="ft-brand">SCC ReportHub</span>
                </div>
                <p style="font-size:0.8rem;line-height:1.65;max-width:280px;">Campus Facility Status Report &amp; Monitoring System for Southern Christian College, Midsayap, Cotabato.</p>
            </div>
            <div class="col-6 col-md-3 offset-md-1">
                <div class="ft-col-label">Navigation</div>
                <a href="#features" class="ft-link">Features</a>
                <a href="#how-it-works" class="ft-link">How It Works</a>
                <a href="#roles" class="ft-link">Who It's For</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="ft-col-label">Account</div>
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
    const mob = document.getElementById('mob');
    document.getElementById('mobO').addEventListener('click', () => { mob.classList.add('on'); document.body.style.overflow = 'hidden'; });
    document.getElementById('mobX').addEventListener('click', () => { mob.classList.remove('on'); document.body.style.overflow = ''; });
    mob.querySelectorAll('a.ml').forEach(l => {
        l.addEventListener('click', e => {
            if (l.getAttribute('href').startsWith('#')) {
                e.preventDefault(); mob.classList.remove('on'); document.body.style.overflow = '';
                setTimeout(() => { const t = document.querySelector(l.getAttribute('href')); if (t) t.scrollIntoView({ behavior: 'smooth' }); }, 250);
            } else { mob.classList.remove('on'); document.body.style.overflow = ''; }
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
