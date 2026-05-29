<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --cream:  #faf8f5;
            --white:  #ffffff;
            --sand:   #f0ebe3;
            --border: #e8e2d9;
            --ink:    #1a1a2e;
            --ink2:   #4a4a6a;
            --ink3:   #9090a8;
            --blue:   #2d5be3;
            --blue-l: #eef2fd;
            --teal:   #0d9488;
            --teal-l: #f0fdfa;
            --amber:  #d97706;
            --amber-l:#fffbeb;
            --rose:   #e11d48;
            --rose-l: #fff1f2;
            --violet: #7c3aed;
            --violet-l:#f5f3ff;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--cream); color: var(--ink);
            line-height: 1.65; -webkit-font-smoothing: antialiased; overflow-x: hidden;
        }
        h1,h2,h3 { font-family: 'DM Serif Display', Georgia, serif; font-weight: 400; }
        a { text-decoration: none; color: var(--blue); }

        /* ── NAV ─────────────────────────────────────────────── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 900;
            height: 64px; background: rgba(250,248,245,0.92);
            backdrop-filter: blur(12px); border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
        }
        .nav-i { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .nbrand { display: flex; align-items: center; gap: 10px; }
        .nbrand img { width: 34px; height: 34px; border-radius: 8px; object-fit: contain; background: #fff; padding: 2px; border: 1px solid var(--border); }
        .nbrand-name { font-family: 'DM Sans', sans-serif; font-size: 0.92rem; font-weight: 700; color: var(--ink); letter-spacing: -.2px; }
        .nbrand-sub { font-size: 0.54rem; font-weight: 500; color: var(--ink3); text-transform: uppercase; letter-spacing: .7px; display: block; }
        .nlinks { display: flex; gap: 28px; }
        .nlinks a { font-size: 0.85rem; font-weight: 500; color: var(--ink2); transition: color .15s; }
        .nlinks a:hover { color: var(--blue); }
        .btn-si { background: transparent; border: 1.5px solid var(--border); color: var(--ink2); border-radius: 8px; padding: 7px 18px; font-size: 0.85rem; font-weight: 600; transition: all .15s; }
        .btn-si:hover { border-color: var(--blue); color: var(--blue); }
        .btn-su { background: var(--ink); color: #fff; border: none; border-radius: 8px; padding: 7px 18px; font-size: 0.85rem; font-weight: 600; transition: background .15s, transform .15s; }
        .btn-su:hover { background: #2d2d4e; transform: translateY(-1px); color: #fff; }

        /* ── MOBILE MENU ─────────────────────────────────────── */
        .mm { display: none; position: fixed; inset: 0; z-index: 1100; background: var(--white); flex-direction: column; align-items: center; justify-content: center; }
        .mm.on { display: flex; }
        .mm-x { position: absolute; top: 18px; right: 18px; background: none; border: none; font-size: 1.3rem; color: var(--ink2); cursor: pointer; }
        .mm a.ml { display: block; font-size: 1.1rem; font-weight: 600; color: var(--ink); padding: 14px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); transition: color .15s; }
        .mm a.ml:hover { color: var(--blue); }
        .mm-cta { display: flex; flex-direction: column; gap: 10px; width: 70%; max-width: 240px; margin-top: 24px; }
        .mm-cta .btn-su, .mm-cta .btn-si { width: 100%; text-align: center; padding: 12px; font-size: 0.875rem; border-radius: 10px; }

        /* ── HERO ────────────────────────────────────────────── */
        .hero {
            padding-top: 64px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }
        .hero-inner { padding: 72px 0 0; }
        .hero-kicker {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--blue-l); color: var(--blue);
            border-radius: 6px; padding: 5px 12px;
            font-size: 0.72rem; font-weight: 600; letter-spacing: .04em;
            margin-bottom: 20px;
        }
        .hero-h {
            font-size: clamp(2.4rem, 5vw, 3.8rem); color: var(--ink);
            line-height: 1.12; letter-spacing: -.5px; margin-bottom: 18px;
        }
        .hero-p { font-size: 1.05rem; color: var(--ink2); line-height: 1.75; margin-bottom: 32px; max-width: 480px; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--blue); color: #fff; border: none; border-radius: 8px;
            padding: 13px 28px; font-size: 0.9rem; font-weight: 600;
            box-shadow: 0 2px 12px rgba(45,91,227,.3);
            transition: background .15s, transform .15s, box-shadow .15s;
        }
        .btn-primary:hover { background: #1e4bd4; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(45,91,227,.4); color: #fff; }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--ink2); border: 1.5px solid var(--border);
            border-radius: 8px; padding: 13px 24px; font-size: 0.9rem; font-weight: 500;
            transition: border-color .15s, color .15s;
        }
        .btn-secondary:hover { border-color: var(--ink); color: var(--ink); }

        /* Hero image area */
        .hero-img-wrap {
            background: var(--cream);
            border: 1px solid var(--border);
            border-bottom: none;
            border-radius: 12px 12px 0 0;
            padding: 20px 20px 0;
            margin-top: 48px;
            box-shadow: 0 -4px 24px rgba(0,0,0,.06);
            overflow: hidden;
        }
        .hero-img-bar {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 8px 8px 0 0; padding: 10px 16px;
            display: flex; align-items: center; gap: 8px;
            border-bottom: 1px solid var(--border);
        }
        .hib-dot { width: 10px; height: 10px; border-radius: 50%; }
        .hib-url { flex: 1; background: var(--cream); border: 1px solid var(--border); border-radius: 4px; padding: 4px 10px; font-size: 0.68rem; color: var(--ink3); margin: 0 8px; }
        .hero-img-body { background: var(--white); padding: 20px; }
        /* Mini dashboard inside */
        .mini-dash { display: grid; grid-template-columns: repeat(4,1fr); gap: 10px; margin-bottom: 16px; }
        .mini-stat { background: var(--cream); border: 1px solid var(--border); border-radius: 8px; padding: 12px; }
        .mini-stat-n { font-size: 1.3rem; font-weight: 700; color: var(--ink); font-family: 'DM Sans', sans-serif; }
        .mini-stat-l { font-size: 0.62rem; color: var(--ink3); text-transform: uppercase; letter-spacing: .05em; margin-top: 2px; }
        .mini-table { width: 100%; border-collapse: collapse; font-size: 0.72rem; }
        .mini-table th { text-align: left; padding: 6px 8px; color: var(--ink3); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); }
        .mini-table td { padding: 8px; color: var(--ink2); border-bottom: 1px solid var(--border); }
        .mini-table tr:last-child td { border-bottom: none; }
        .mbadge { font-size: 0.6rem; font-weight: 600; padding: 2px 7px; border-radius: 4px; }

        /* ── FEATURES ────────────────────────────────────────── */
        .sec { padding: 88px 0; }
        .sec-alt { background: var(--white); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .sec-label { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--blue); margin-bottom: 10px; }
        .sec-h { font-size: clamp(1.7rem, 3vw, 2.3rem); color: var(--ink); line-height: 1.2; letter-spacing: -.2px; }
        .sec-p { font-size: 0.95rem; color: var(--ink2); max-width: 520px; margin: 0 auto; line-height: 1.7; }

        .fc {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 12px; padding: 26px; height: 100%;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .fc:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.07); border-color: #c8d8f8; }
        .fc-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; margin-bottom: 16px; }
        .fc-h { font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 700; color: var(--ink); margin-bottom: 7px; }
        .fc-p { font-size: 0.835rem; color: var(--ink2); line-height: 1.65; }

        /* ── HOW IT WORKS ────────────────────────────────────── */
        .how-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 20px; }
        .how-card {
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 12px; padding: 24px; display: flex; gap: 16px;
            transition: border-color .2s;
        }
        .how-card:hover { border-color: #c8d8f8; }
        .how-num {
            width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
            background: var(--blue); color: #fff;
            font-family: 'DM Sans', sans-serif; font-size: 0.8rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
        }
        .how-h { font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
        .how-p { font-size: 0.8rem; color: var(--ink2); line-height: 1.6; }

        /* ── ROLES ───────────────────────────────────────────── */
        .rocard {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 14px; padding: 32px 24px; height: 100%;
            transition: transform .2s, box-shadow .2s;
        }
        .rocard:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.07); }
        .ro-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 18px; }
        .ro-h { font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
        .ro-p { font-size: 0.835rem; color: var(--ink2); line-height: 1.65; margin-bottom: 16px; }
        .ro-tag { font-size: 0.67rem; font-weight: 600; padding: 3px 9px; border-radius: 5px; display: inline-block; margin: 2px; }

        /* ── CTA ─────────────────────────────────────────────── */
        .cta-wrap {
            background: var(--ink); border-radius: 16px;
            padding: 64px 48px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-wrap::before {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background: radial-gradient(ellipse 60% 60% at 50% 0%, rgba(45,91,227,.25) 0%, transparent 65%);
        }

        /* ── FOOTER ──────────────────────────────────────────── */
        footer { background: var(--ink); color: rgba(255,255,255,.4); padding: 48px 0 28px; font-size: 0.82rem; border-top: 1px solid rgba(255,255,255,.06); }
        .ft-name { font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 700; color: #fff; }
        .ft-link { color: rgba(255,255,255,.4); transition: color .15s; display: block; margin-bottom: 8px; }
        .ft-link:hover { color: rgba(255,255,255,.85); }
        .ft-col-h { font-size: 0.62rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.2); margin-bottom: 14px; }
        footer hr { border-color: rgba(255,255,255,.07) !important; margin: 28px 0 20px; }

        /* ── ANIMATION ───────────────────────────────────────── */
        .fu { opacity: 0; transform: translateY(16px); transition: opacity .5s ease, transform .5s ease; }
        .fu.in { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 991px) {
            .hero-inner { padding: 56px 0 0; }
            .how-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 767px) {
            .hero-inner { padding: 36px 0 0; }
            .hero-h { font-size: 2rem; }
            .hero-p { font-size: 0.9rem; margin-bottom: 24px; }
            .btn-primary, .btn-secondary { padding: 12px 22px; font-size: 0.875rem; }
            .hero-img-wrap { margin-top: 32px; padding: 14px 14px 0; }
            .mini-dash { grid-template-columns: repeat(2,1fr); }
            .sec { padding: 60px 0; }
            .sec-h { font-size: 1.5rem; }
            .fc { padding: 20px; }
            .fc-icon { width: 38px; height: 38px; font-size: 0.95rem; margin-bottom: 12px; }
            .how-card { padding: 18px; gap: 12px; }
            .rocard { padding: 24px 18px; }
            .ro-icon { width: 48px; height: 48px; font-size: 1.2rem; margin-bottom: 14px; }
            .cta-wrap { padding: 44px 24px; border-radius: 12px; }
            .cta-wrap .sec-h { font-size: 1.4rem; }
            footer { padding: 36px 0 20px; }
            footer .col-md-3, footer .col-md-4 { text-align: center !important; }
        }
        @media (max-width: 480px) {
            .hero-h { font-size: 1.75rem; }
            .nbrand-sub { display: none; }
            .mini-table { display: none; }
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
                <a href="{{ route('login') }}" class="btn-si" style="padding:5px 12px;font-size:0.78rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mmO" style="color:var(--ink2);font-size:1.1rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-inner">
            <div class="row align-items-end g-5">

                <!-- Left -->
                <div class="col-lg-6">
                    <div class="hero-kicker"><i class="fas fa-building"></i> Campus Facility Management</div>
                    <h1 class="hero-h">
                        Keep your campus<br>running smoothly.
                    </h1>
                    <p class="hero-p">SCC ReportHub makes it easy for faculty to report facility issues, for admins to manage repairs, and for maintenance staff to stay on top of their work.</p>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn-primary">Get Started Free</a>
                        <a href="{{ route('login') }}" class="btn-secondary">Sign In <i class="fas fa-arrow-right fa-xs"></i></a>
                    </div>
                </div>

                <!-- Right: browser mockup -->
                <div class="col-lg-6">
                    <div class="hero-img-wrap">
                        <div class="hero-img-bar">
                            <div class="hib-dot" style="background:#ff5f57;"></div>
                            <div class="hib-dot" style="background:#febc2e;"></div>
                            <div class="hib-dot" style="background:#28c840;"></div>
                            <div class="hib-url">scc-reporthub.up.railway.app/admin/dashboard</div>
                        </div>
                        <div class="hero-img-body">
                            <div style="font-size:0.7rem;font-weight:600;color:var(--ink3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:10px;">Dashboard Overview</div>
                            <div class="mini-dash">
                                <div class="mini-stat">
                                    <div class="mini-stat-n" style="color:var(--blue);">24</div>
                                    <div class="mini-stat-l">Total</div>
                                </div>
                                <div class="mini-stat">
                                    <div class="mini-stat-n" style="color:var(--amber);">8</div>
                                    <div class="mini-stat-l">Pending</div>
                                </div>
                                <div class="mini-stat">
                                    <div class="mini-stat-n" style="color:var(--teal);">10</div>
                                    <div class="mini-stat-l">Ongoing</div>
                                </div>
                                <div class="mini-stat">
                                    <div class="mini-stat-n" style="color:var(--blue);">12</div>
                                    <div class="mini-stat-l">Resolved</div>
                                </div>
                            </div>
                            <table class="mini-table">
                                <thead>
                                    <tr>
                                        <th>Issue</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Electrical outlet</td>
                                        <td>Room 204</td>
                                        <td><span class="mbadge" style="background:var(--rose-l);color:var(--rose);">Urgent</span></td>
                                    </tr>
                                    <tr>
                                        <td>Leaking faucet</td>
                                        <td>Comfort Room B</td>
                                        <td><span class="mbadge" style="background:var(--blue-l);color:var(--blue);">Ongoing</span></td>
                                    </tr>
                                    <tr>
                                        <td>AC unit repair</td>
                                        <td>Faculty Lounge</td>
                                        <td><span class="mbadge" style="background:var(--teal-l);color:var(--teal);">Done</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="sec" id="features">
    <div class="container">
        <div class="row align-items-center g-5 mb-5">
            <div class="col-md-6 fu">
                <div class="sec-label">Features</div>
                <h2 class="sec-h">Everything the campus needs in one place</h2>
            </div>
            <div class="col-md-6 fu" style="transition-delay:.08s">
                <p class="sec-p" style="margin:0;">From ticket submission to resolution, ReportHub covers the full maintenance lifecycle for Southern Christian College.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4 fu">
                <div class="fc">
                    <div class="fc-icon" style="background:var(--blue-l);color:var(--blue);"><i class="fas fa-ticket-alt"></i></div>
                    <div class="fc-h">Easy Ticket Submission</div>
                    <div class="fc-p">Report facility issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc">
                    <div class="fc-icon" style="background:var(--teal-l);color:var(--teal);"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="fc-h">Real-Time Monitoring</div>
                    <div class="fc-p">Track every ticket from submission to completion. Know who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc">
                    <div class="fc-icon" style="background:var(--amber-l);color:var(--amber);"><i class="fas fa-bell"></i></div>
                    <div class="fc-h">Instant Notifications</div>
                    <div class="fc-p">Get notified when your ticket is approved, assigned, or resolved — no manual follow-up needed.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc">
                    <div class="fc-icon" style="background:var(--violet-l);color:var(--violet);"><i class="fas fa-chart-pie"></i></div>
                    <div class="fc-h">Admin Dashboard</div>
                    <div class="fc-p">Full overview with charts, stats, and complete control over tickets, users, and facilities.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc">
                    <div class="fc-icon" style="background:var(--blue-l);color:var(--blue);"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="fc-h">Maintenance Task Management</div>
                    <div class="fc-p">Maintenance staff see assigned tasks, update repair progress, and mark jobs complete.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.18s">
                <div class="fc">
                    <div class="fc-icon" style="background:var(--rose-l);color:var(--rose);"><i class="fas fa-star"></i></div>
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
            <h2 class="sec-h mb-3">Simple process, fast results</h2>
            <p class="sec-p">Four straightforward steps from reporting an issue to getting it resolved.</p>
        </div>
        <div class="how-grid fu">
            <div class="how-card">
                <div class="how-num">1</div>
                <div>
                    <div class="how-h">Submit a Ticket</div>
                    <div class="how-p">Describe the issue, set priority level, and attach a photo if needed. Takes less than a minute.</div>
                </div>
            </div>
            <div class="how-card">
                <div class="how-num">2</div>
                <div>
                    <div class="how-h">Admin Reviews & Assigns</div>
                    <div class="how-p">Admin approves the ticket and assigns it to the right maintenance staff based on specialization.</div>
                </div>
            </div>
            <div class="how-card">
                <div class="how-num">3</div>
                <div>
                    <div class="how-h">Repair in Progress</div>
                    <div class="how-p">Maintenance staff works on the task, logs updates, and marks progress in real time.</div>
                </div>
            </div>
            <div class="how-card">
                <div class="how-num">4</div>
                <div>
                    <div class="how-h">Verified & Rated</div>
                    <div class="how-p">Admin verifies completion. Faculty rates the service quality. Ticket closed.</div>
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
            <h2 class="sec-h mb-3">A portal for every role</h2>
            <p class="sec-p">Three dedicated portals, each built around how that role works with facility management.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fu">
                <div class="rocard">
                    <div class="ro-icon" style="background:var(--blue-l);color:var(--blue);"><i class="fas fa-user-shield"></i></div>
                    <div class="ro-h">Admin</div>
                    <div class="ro-p">Full control over tickets, users, and facilities. Approve requests, assign staff, monitor progress, and view analytics.</div>
                    <div>
                        <span class="ro-tag" style="background:var(--blue-l);color:var(--blue);">Dashboard</span>
                        <span class="ro-tag" style="background:var(--blue-l);color:var(--blue);">User Management</span>
                        <span class="ro-tag" style="background:var(--blue-l);color:var(--blue);">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.08s">
                <div class="rocard">
                    <div class="ro-icon" style="background:var(--violet-l);color:var(--violet);"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="ro-h">Faculty / Staff</div>
                    <div class="ro-p">Report facility issues, track ticket status in real time, and rate the service once your request is resolved.</div>
                    <div>
                        <span class="ro-tag" style="background:var(--violet-l);color:var(--violet);">Submit Tickets</span>
                        <span class="ro-tag" style="background:var(--violet-l);color:var(--violet);">Track Status</span>
                        <span class="ro-tag" style="background:var(--violet-l);color:var(--violet);">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.16s">
                <div class="rocard">
                    <div class="ro-icon" style="background:var(--teal-l);color:var(--teal);"><i class="fas fa-hard-hat"></i></div>
                    <div class="ro-h">Maintenance Staff</div>
                    <div class="ro-p">View assigned tasks, update repair progress, and mark jobs complete — everything in one place.</div>
                    <div>
                        <span class="ro-tag" style="background:var(--teal-l);color:var(--teal);">Task Queue</span>
                        <span class="ro-tag" style="background:var(--teal-l);color:var(--teal);">Progress Updates</span>
                        <span class="ro-tag" style="background:var(--teal-l);color:var(--teal);">History</span>
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
                <div class="sec-label" style="color:#93c5fd;display:flex;justify-content:center;">Get Started</div>
                <h2 class="sec-h mt-2 mb-3" style="color:#fff;font-family:'DM Serif Display',serif;">Ready to get started?</h2>
                <p class="sec-p mb-4" style="color:rgba(255,255,255,.55);">Create your account and start reporting facility issues in minutes. Free for all SCC faculty and staff.</p>
                <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--blue);border:none;border-radius:8px;padding:13px 32px;font-size:0.9rem;font-weight:700;box-shadow:0 4px 14px rgba(0,0,0,.15);transition:transform .15s,box-shadow .15s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.2)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 14px rgba(0,0,0,.15)'">
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
