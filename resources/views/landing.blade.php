<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub – Southern Christian College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ── Same tokens as dashboard ── */
        :root {
            --p:      #4f46e5;
            --pd:     #3730a3;
            --pl:     #818cf8;
            --ac:     #06b6d4;
            --ok:     #10b981;
            --warn:   #f59e0b;
            --err:    #ef4444;
            --bg:     #f1f5f9;
            --card:   #ffffff;
            --border: #e2e8f0;
            --t1:     #0f172a;
            --t2:     #64748b;
            --t3:     #94a3b8;
            --dark:   #0f172a;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg); color: var(--t1);
            font-size: 0.875rem; line-height: 1.6;
            -webkit-font-smoothing: antialiased; overflow-x: hidden;
        }
        a { text-decoration: none; color: var(--p); }

        /* ── NAVBAR — exact dashboard topbar style ── */
        .lnav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 900;
            height: 64px; background: var(--card);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            display: flex; align-items: center;
        }
        .lnav-i { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .lnav-brand { display: flex; align-items: center; gap: 10px; }
        .lnav-brand img { width: 34px; height: 34px; border-radius: 50%; object-fit: contain; background: #fff; padding: 2px; border: 1px solid var(--border); }
        .lnav-brand-name {
            font-size: 1rem; font-weight: 800; letter-spacing: -.3px;
            background: linear-gradient(135deg, var(--p), var(--ac));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .lnav-brand-sub { font-size: 0.58rem; font-weight: 600; color: var(--t3); text-transform: uppercase; letter-spacing: .8px; display: block; }
        .lnav-links { display: flex; gap: 28px; }
        .lnav-links a { font-size: 0.845rem; font-weight: 500; color: var(--t2); transition: color .15s; }
        .lnav-links a:hover { color: var(--p); }
        .btn-si { border: 1.5px solid #c7d2fe; color: var(--p); background: #eef2ff; border-radius: 8px; padding: 7px 18px; font-size: 0.845rem; font-weight: 600; transition: all .15s; display: inline-flex; align-items: center; }
        .btn-si:hover { background: #e0e7ff; border-color: var(--p); color: var(--pd); }
        .btn-su { background: linear-gradient(135deg, var(--p), var(--ac)); color: #fff; border: none; border-radius: 8px; padding: 7px 18px; font-size: 0.845rem; font-weight: 600; box-shadow: 0 2px 8px rgba(79,70,229,.3); transition: opacity .15s, transform .15s; display: inline-flex; align-items: center; }
        .btn-su:hover { opacity: .9; transform: translateY(-1px); color: #fff; }

        /* ── MOBILE MENU ── */
        .mm { display: none; position: fixed; inset: 0; z-index: 1100; background: var(--card); flex-direction: column; align-items: center; justify-content: center; }
        .mm.on { display: flex; }
        .mm-x { position: absolute; top: 18px; right: 18px; background: none; border: none; font-size: 1.3rem; color: var(--t2); cursor: pointer; }
        .mm a.ml { display: block; font-size: 1.05rem; font-weight: 600; color: var(--t1); padding: 14px 0; width: 100%; text-align: center; border-bottom: 1px solid var(--border); transition: color .15s; }
        .mm a.ml:hover { color: var(--p); }
        .mm-cta { display: flex; flex-direction: column; gap: 10px; width: 70%; max-width: 240px; margin-top: 24px; }
        .mm-cta .btn-su, .mm-cta .btn-si { width: 100%; justify-content: center; padding: 12px; font-size: 0.875rem; border-radius: 10px; }

        /* ── HERO ── */
        .hero {
            padding-top: 64px;
            background: linear-gradient(160deg, #fff 0%, #f8faff 50%, #eef2ff 100%);
            border-bottom: 1px solid var(--border);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 55% 50% at 85% 20%, rgba(79,70,229,.07) 0%, transparent 60%),
                radial-gradient(ellipse 35% 35% at 10% 85%, rgba(6,182,212,.05) 0%, transparent 55%);
        }
        .hero-body { padding: 48px 0 0; position: relative; z-index: 1; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0;
            background: none; border: none; padding: 0;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.18em; text-transform: uppercase;
            background: linear-gradient(135deg, var(--p), var(--ac));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            margin-bottom: 22px;
        }
        .hero-badge-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: linear-gradient(135deg, var(--p), var(--ac));
            flex-shrink: 0;
        }
        .hero-h {
            font-size: clamp(2rem, 4vw, 3rem); font-weight: 800;
            color: var(--t1); line-height: 1.12; letter-spacing: -.5px; margin-bottom: 16px;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0;
            background: none; border: none; padding: 0 0 6px 0;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.18em; text-transform: uppercase;
            background: linear-gradient(135deg, var(--p), var(--ac));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            margin-bottom: 22px;
            position: relative;
        }
        .hero-badge::after {
            content: '';
            position: absolute; bottom: 0; left: 0;
            width: 100%; height: 2px;
            background: linear-gradient(90deg, var(--p), var(--ac));
            border-radius: 2px;
        }
        .hero-h span {
            background: linear-gradient(135deg, var(--p), var(--ac));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-p { font-size: 0.975rem; color: var(--t2); line-height: 1.75; margin-bottom: 28px; max-width: 420px; }
        .btn-hero {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--p), var(--ac));
            color: #fff; border: none; border-radius: 8px;
            padding: 12px 26px; font-size: 0.875rem; font-weight: 600;
            box-shadow: 0 2px 12px rgba(79,70,229,.3);
            transition: opacity .15s, transform .15s, box-shadow .15s;
        }
        .btn-hero:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,.4); color: #fff; }
        .btn-hero2 {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--card); color: var(--t2);
            border: 1.5px solid var(--border); border-radius: 8px;
            padding: 12px 22px; font-size: 0.875rem; font-weight: 500;
            transition: border-color .15s, color .15s;
        }
        .btn-hero2:hover { border-color: var(--p); color: var(--p); }

        /* Dashboard preview */
        .preview-wrap {
            position: relative;
            padding: 0 0 0 24px;
        }
        .preview-wrap::before {
            content: ''; position: absolute;
            top: 20px; left: 0; right: -20px; bottom: -20px;
            background: linear-gradient(135deg, #eef2ff, #e0f2fe);
            border-radius: 16px; z-index: 0;
        }
        .preview-card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(79,70,229,.12), 0 2px 8px rgba(0,0,0,.06);
            overflow: hidden; margin-top: 40px;
            position: relative; z-index: 1;
        }
        .preview-topbar {
            background: var(--bg); border-bottom: 1px solid var(--border);
            padding: 10px 16px; display: flex; align-items: center; gap: 6px;
        }
        .ptb-dot { width: 10px; height: 10px; border-radius: 50%; }
        .ptb-url { flex: 1; background: var(--card); border: 1px solid var(--border); border-radius: 4px; padding: 3px 10px; font-size: 0.65rem; color: var(--t3); margin: 0 8px; }
        .preview-body { padding: 18px; }
        .preview-header { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--t3); margin-bottom: 12px; }
        .pstat-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 8px; margin-bottom: 14px; }
        .pstat { background: var(--bg); border: 1px solid var(--border); border-radius: 10px; padding: 10px 12px; }
        .pstat-n { font-size: 1.2rem; font-weight: 800; color: var(--t1); letter-spacing: -.3px; line-height: 1; }
        .pstat-l { font-size: 0.6rem; color: var(--t3); text-transform: uppercase; letter-spacing: .05em; margin-top: 3px; font-weight: 500; }
        .ptable { width: 100%; border-collapse: collapse; font-size: 0.72rem; }
        .ptable th { text-align: left; padding: 6px 8px; color: var(--t3); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); font-size: 0.65rem; }
        .ptable td { padding: 8px; color: var(--t2); border-bottom: 1px solid #f1f5f9; }
        .ptable tr:last-child td { border-bottom: none; }
        .pbadge { font-size: 0.6rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; }

        /* ── SECTIONS ── */
        .sec { padding: 80px 0; }
        .sec-w { background: var(--card); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .sec-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--p); margin-bottom: 8px; }
        .sec-h { font-size: clamp(1.5rem, 2.8vw, 2rem); font-weight: 800; color: var(--t1); line-height: 1.2; letter-spacing: -.3px; }
        .sec-p { font-size: 0.9rem; color: var(--t2); max-width: 500px; margin: 0 auto; line-height: 1.7; }

        /* Feature cards — colored left border */
        .fc {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; padding: 24px; height: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
            transition: transform .2s, box-shadow .2s, border-color .2s;
            border-left: 3px solid transparent;
        }
        .fc:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(79,70,229,.09); border-color: #c7d2fe; }
        .fc:nth-child(1) .fc-inner, .fc:nth-child(4) .fc-inner { border-left-color: var(--p); }
        .fc-left-p { border-left-color: var(--p) !important; }
        .fc-left-ok { border-left-color: var(--ok) !important; }
        .fc-left-warn { border-left-color: var(--warn) !important; }
        .fc-left-err { border-left-color: var(--err) !important; }
        .fc-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; margin-bottom: 14px; }
        .fc-h { font-size: 0.875rem; font-weight: 700; color: var(--t1); margin-bottom: 6px; }
        .fc-p { font-size: 0.82rem; color: var(--t2); line-height: 1.65; }

        /* How it works — with arrows */
        .how-card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 12px; padding: 22px; display: flex; gap: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
            transition: border-color .2s; position: relative;
        }
        .how-card:hover { border-color: #c7d2fe; }
        .how-arrow {
            display: none;
            position: absolute; right: -18px; top: 50%;
            transform: translateY(-50%); z-index: 2;
            color: var(--t3); font-size: 0.75rem;
        }
        @media (min-width: 768px) {
            .col-md-6:nth-child(odd) .how-arrow { display: block; }
        }
        .how-n { width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0; background: linear-gradient(135deg, var(--p), var(--ac)); color: #fff; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
        .how-h { font-size: 0.845rem; font-weight: 700; color: var(--t1); margin-bottom: 4px; }
        .how-p { font-size: 0.78rem; color: var(--t2); line-height: 1.6; }

        /* Social proof */
        .social-proof {
            display: flex; align-items: center; gap: 8px; margin-top: 20px;
            font-size: 0.75rem; color: var(--t3);
        }
        .social-proof img { width: 20px; height: 20px; border-radius: 50%; object-fit: contain; background: #fff; border: 1px solid var(--border); padding: 1px; }

        /* Role cards */
        .rocard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; padding: 28px 22px; height: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .rocard:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(79,70,229,.09); border-color: #c7d2fe; }
        .ro-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px; }
        .ro-h { font-size: 0.9rem; font-weight: 700; color: var(--t1); margin-bottom: 6px; }
        .ro-p { font-size: 0.82rem; color: var(--t2); line-height: 1.65; margin-bottom: 14px; }
        .ro-tag { font-size: 0.65rem; font-weight: 600; padding: 2px 8px; border-radius: 20px; display: inline-block; margin: 2px; }

        /* CTA */
        .cta-box {
            background: linear-gradient(135deg, var(--dark) 0%, #1e1b4b 50%, #312e81 100%);
            border-radius: 16px; padding: 60px 40px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-box::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 60% 60% at 50% 0%, rgba(79,70,229,.3) 0%, transparent 65%); pointer-events: none; }

        /* Footer */
        footer {
            background: var(--dark); color: rgba(255,255,255,.4);
            padding: 44px 0 24px; font-size: 0.82rem;
            position: relative;
        }
        footer::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--p), var(--ac));
        }
        .ft-name { font-size: 0.9rem; font-weight: 800; color: #fff; }
        .ft-link { color: rgba(255,255,255,.4); transition: color .15s; display: block; margin-bottom: 8px; }
        .ft-link:hover { color: rgba(255,255,255,.8); }
        .ft-col-h { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.2); margin-bottom: 12px; }
        footer hr { border-color: rgba(255,255,255,.07) !important; margin: 24px 0 18px; }

        /* Animation */
        .fu { opacity: 0; transform: translateY(14px); transition: opacity .45s ease, transform .45s ease; }
        .fu.in { opacity: 1; transform: translateY(0); }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-body { padding: 52px 0 0; }
            .preview-wrap { padding: 0; }
            .preview-wrap::before { display: none; }
        }
        @media (max-width: 767px) {
            .hero-body { padding: 24px 0 0; }
            .hero-h { font-size: 1.65rem; }
            .hero-p { font-size: 0.875rem; margin-bottom: 22px; }
            .preview-card { margin-top: 28px; }
            .pstat-row { grid-template-columns: repeat(2,1fr); }
            .sec { padding: 56px 0; }
            .sec-h { font-size: 1.4rem; }
            .fc { padding: 20px; }
            .fc-icon { width: 38px; height: 38px; font-size: 0.95rem; margin-bottom: 10px; }
            .how-card { padding: 18px; }
            .rocard { padding: 22px 18px; }
            .ro-icon { width: 44px; height: 44px; font-size: 1.1rem; margin-bottom: 12px; }
            .cta-box { padding: 40px 20px; border-radius: 12px; }
            footer { padding: 32px 0 18px; }
            footer .col-md-3, footer .col-md-4 { text-align: center !important; }
        }
        @media (max-width: 480px) {
            .hero-h { font-size: 1.65rem; }
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
<nav class="lnav">
    <div class="container">
        <div class="lnav-i">
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
                <a href="{{ route('login') }}" class="btn-si">Sign In</a>
                <a href="{{ route('register') }}" class="btn-su">Sign Up</a>
            </div>
            <div class="d-flex d-md-none align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-si" style="padding:5px 12px;font-size:0.78rem;">Sign In</a>
                <button class="btn btn-link p-1" id="mmO" style="color:var(--t2);font-size:1.1rem;"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-body">
            <div class="row align-items-end g-5">
                <div class="col-lg-5">
                    <div class="hero-badge">Campus Facility Management System</div>
                    <h1 class="hero-h">Report issues.<br><span>Resolve faster.</span></h1>
                    <p class="hero-p">SCC ReportHub connects faculty, admins, and maintenance staff in one platform. Submit tickets, track repairs, and keep the campus running smoothly.</p>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn-hero">Get Started Free</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="preview-wrap">
                        <div class="preview-card">
                        <div class="preview-topbar">
                            <div class="ptb-dot" style="background:#ff5f57;"></div>
                            <div class="ptb-dot" style="background:#febc2e;"></div>
                            <div class="ptb-dot" style="background:#28c840;"></div>
                            <div class="ptb-url">scc-reporthub.up.railway.app/admin/dashboard</div>
                        </div>
                        <div class="preview-body">
                            <div class="preview-header">Dashboard Overview</div>
                            <div class="pstat-row">
                                <div class="pstat">
                                    <div class="pstat-n" style="color:var(--p);">24</div>
                                    <div class="pstat-l">Total</div>
                                </div>
                                <div class="pstat">
                                    <div class="pstat-n" style="color:var(--warn);">8</div>
                                    <div class="pstat-l">Pending</div>
                                </div>
                                <div class="pstat">
                                    <div class="pstat-n" style="color:var(--ac);">10</div>
                                    <div class="pstat-l">Ongoing</div>
                                </div>
                                <div class="pstat">
                                    <div class="pstat-n" style="color:var(--ok);">12</div>
                                    <div class="pstat-l">Resolved</div>
                                </div>
                            </div>
                            <table class="ptable">
                                <thead>
                                    <tr>
                                        <th>Issue</th>
                                        <th>Location</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Electrical outlet</td>
                                        <td>Room 204</td>
                                        <td><span class="pbadge" style="background:#fef2f2;color:var(--err);">Urgent</span></td>
                                        <td><span class="pbadge" style="background:#fffbeb;color:#92400e;">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Leaking faucet</td>
                                        <td>Comfort Room B</td>
                                        <td><span class="pbadge" style="background:#fffbeb;color:#92400e;">High</span></td>
                                        <td><span class="pbadge" style="background:#ecfdf5;color:#065f46;">Ongoing</span></td>
                                    </tr>
                                    <tr>
                                        <td>AC unit repair</td>
                                        <td>Faculty Lounge</td>
                                        <td><span class="pbadge" style="background:#ecfdf5;color:#065f46;">Normal</span></td>
                                        <td><span class="pbadge" style="background:#eef2ff;color:var(--pd);">Completed</span></td>
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

<!-- FEATURES -->
<section class="sec" id="features">
    <div class="container">
        <div class="row align-items-end g-4 mb-5">
            <div class="col-md-6 fu">
                <div class="sec-label">Features</div>
                <h2 class="sec-h">Everything you need,<br>nothing extra.</h2>
            </div>
            <div class="col-md-6 fu" style="transition-delay:.06s">
                <p class="sec-p" style="margin:0;">A focused set of tools built specifically for campus facility management at Southern Christian College.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4 fu">
                <div class="fc fc-left-p">
                    <div class="fc-icon" style="background:#eef2ff;color:var(--p);"><i class="fas fa-ticket-alt"></i></div>
                    <div class="fc-h">Ticket Submission</div>
                    <div class="fc-p">Report issues in seconds — attach photos, set priority, and choose the affected area.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc fc-left-ok">
                    <div class="fc-icon" style="background:#ecfdf5;color:var(--ok);"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <div class="fc-h">Real-Time Monitoring</div>
                    <div class="fc-p">Track every ticket from submission to completion. Know who's working on it and the current status.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc fc-left-warn">
                    <div class="fc-icon" style="background:#fffbeb;color:var(--warn);"><i class="fas fa-bell"></i></div>
                    <div class="fc-h">Notifications</div>
                    <div class="fc-p">Get notified when your ticket is approved, assigned, or resolved — no follow-up needed.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
                <div class="fc fc-left-p">
                    <div class="fc-icon" style="background:#eef2ff;color:var(--p);"><i class="fas fa-chart-pie"></i></div>
                    <div class="fc-h">Admin Dashboard</div>
                    <div class="fc-p">Charts, stats, and full control over tickets, users, and facilities in one view.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
                <div class="fc fc-left-ok">
                    <div class="fc-icon" style="background:#ecfdf5;color:var(--ok);"><i class="fas fa-screwdriver-wrench"></i></div>
                    <div class="fc-h">Maintenance Tasks</div>
                    <div class="fc-p">Maintenance staff see assigned tasks, update progress, and mark jobs complete.</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fu" style="transition-delay:.18s">
                <div class="fc fc-left-err">
                    <div class="fc-icon" style="background:#fef2f2;color:var(--err);"><i class="fas fa-star"></i></div>
                    <div class="fc-h">Feedback & Ratings</div>
                    <div class="fc-p">Faculty rate resolved tickets — helping admins improve maintenance quality over time.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec sec-w" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5 fu">
            <div class="sec-label">How It Works</div>
            <h2 class="sec-h mb-2">Four steps, start to finish.</h2>
            <p class="sec-p">Simple process, fast results.</p>
        </div>
        <div class="row g-3 fu">
            <div class="col-md-6" style="position:relative;">
                <div class="how-card">
                    <div class="how-n">1</div>
                    <div>
                        <div class="how-h">Submit a Ticket</div>
                        <div class="how-p">Describe the issue, set priority, and attach a photo. Takes under a minute.</div>
                    </div>
                </div>
                <div class="how-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="col-md-6" style="position:relative;">
                <div class="how-card">
                    <div class="how-n">2</div>
                    <div>
                        <div class="how-h">Admin Reviews & Assigns</div>
                        <div class="how-p">Admin approves and assigns it to the right maintenance staff.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="position:relative;">
                <div class="how-card">
                    <div class="how-n">3</div>
                    <div>
                        <div class="how-h">Repair in Progress</div>
                        <div class="how-p">Maintenance staff works on the task and updates progress in real time.</div>
                    </div>
                </div>
                <div class="how-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="col-md-6">
                <div class="how-card">
                    <div class="how-n">4</div>
                    <div>
                        <div class="how-h">Verified & Rated</div>
                        <div class="how-p">Admin verifies completion. Faculty rates the service. Ticket closed.</div>
                    </div>
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
            <h2 class="sec-h mb-2">A portal for every role.</h2>
            <p class="sec-p">Three dedicated portals, each built around how that role works.</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 fu">
                <div class="rocard">
                    <div class="ro-icon" style="background:#eef2ff;color:var(--p);"><i class="fas fa-user-shield"></i></div>
                    <div class="ro-h">Admin</div>
                    <div class="ro-p">Full control over tickets, users, and facilities. Approve requests, assign staff, and view analytics.</div>
                    <div>
                        <span class="ro-tag" style="background:#eef2ff;color:var(--pd);">Dashboard</span>
                        <span class="ro-tag" style="background:#eef2ff;color:var(--pd);">Users</span>
                        <span class="ro-tag" style="background:#eef2ff;color:var(--pd);">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.08s">
                <div class="rocard">
                    <div class="ro-icon" style="background:#ecfdf5;color:var(--ok);"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="ro-h">Faculty / Staff</div>
                    <div class="ro-p">Report facility issues, track ticket status in real time, and rate the service once resolved.</div>
                    <div>
                        <span class="ro-tag" style="background:#ecfdf5;color:#065f46;">Submit</span>
                        <span class="ro-tag" style="background:#ecfdf5;color:#065f46;">Track</span>
                        <span class="ro-tag" style="background:#ecfdf5;color:#065f46;">Feedback</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fu" style="transition-delay:.16s">
                <div class="rocard">
                    <div class="ro-icon" style="background:#fffbeb;color:var(--warn);"><i class="fas fa-hard-hat"></i></div>
                    <div class="ro-h">Maintenance Staff</div>
                    <div class="ro-p">View assigned tasks, update repair progress, and mark jobs complete — all in one place.</div>
                    <div>
                        <span class="ro-tag" style="background:#fffbeb;color:#92400e;">Tasks</span>
                        <span class="ro-tag" style="background:#fffbeb;color:#92400e;">Progress</span>
                        <span class="ro-tag" style="background:#fffbeb;color:#92400e;">History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="sec sec-w">
    <div class="container">
        <div class="cta-box fu">
            <div style="position:relative;z-index:1;">
                <div class="sec-label" style="color:#a5b4fc;display:flex;justify-content:center;">Get Started</div>
                <h2 class="sec-h mt-2 mb-3" style="color:#fff;">Ready to get started?</h2>
                <p class="sec-p mb-4" style="color:rgba(255,255,255,.55);">Free for all SCC faculty and staff. Create your account and start reporting in minutes.</p>
                <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--p);border:none;border-radius:8px;padding:12px 28px;font-size:0.9rem;font-weight:700;box-shadow:0 2px 12px rgba(0,0,0,.15);transition:transform .15s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
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
                    <img src="{{ asset('images/scc-logo.png') }}" alt="SCC" width="26" height="26" style="border-radius:50%;object-fit:contain;background:#fff;padding:2px;" onerror="this.style.display='none'">
                    <span class="ft-name">SCC ReportHub</span>
                </div>
                <p style="font-size:0.78rem;line-height:1.6;max-width:260px;">Campus Facility Status Report &amp; Monitoring System — Southern Christian College, Midsayap, Cotabato.</p>
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
