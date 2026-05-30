<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SCC ReportHub — Campus Facility Management</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{
  --white:#ffffff;
  --off:#f9fafb;
  --gray50:#f8fafc;
  --gray100:#f1f5f9;
  --gray200:#e2e8f0;
  --gray400:#94a3b8;
  --gray600:#475569;
  --gray800:#1e293b;
  --gray900:#0f172a;
  --blue:#2563eb;
  --blue-d:#1d4ed8;
  --blue-l:#eff6ff;
  --sky:#0ea5e9;
  --teal:#0d9488;
  --emerald:#059669;
  --violet:#7c3aed;
  --amber:#d97706;
  --rose:#e11d48;
  --ink:#111827;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Outfit',system-ui,sans-serif;background:var(--white);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased;overflow-x:hidden}
a{text-decoration:none;color:inherit}

/* ── NAV ── */
.nav{position:fixed;top:0;left:0;right:0;z-index:900;height:60px;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--gray200);display:flex;align-items:center}
.nav-i{display:flex;align-items:center;justify-content:space-between;width:100%}
.brand{display:flex;align-items:center;gap:9px}
.brand img{width:30px;height:30px;border-radius:8px;object-fit:contain;background:var(--blue-l);padding:3px;border:1px solid var(--gray200)}
.brand-name{font-size:0.95rem;font-weight:800;color:var(--blue);letter-spacing:-0.3px}
.brand-sub{font-size:0.5rem;font-weight:500;color:var(--gray400);text-transform:uppercase;letter-spacing:1px;display:block}
.nav-links{display:flex;gap:28px}
.nav-links a{font-size:0.85rem;font-weight:500;color:var(--gray600);transition:color .15s}
.nav-links a:hover{color:var(--blue)}
.btn-si{background:transparent;border:1.5px solid var(--gray200);color:var(--gray600);border-radius:8px;padding:6px 16px;font-size:0.82rem;font-weight:600;transition:all .15s;font-family:'Outfit',sans-serif}
.btn-si:hover{border-color:var(--blue);color:var(--blue)}
.btn-su{background:var(--blue);color:#fff;border:none;border-radius:8px;padding:6px 16px;font-size:0.82rem;font-weight:700;transition:background .15s,transform .15s;font-family:'Outfit',sans-serif}
.btn-su:hover{background:var(--blue-d);transform:translateY(-1px);color:#fff}

/* ── MOBILE MENU ── */
.mm{display:none;position:fixed;inset:0;z-index:1100;background:#fff;flex-direction:column;align-items:center;justify-content:center}
.mm.on{display:flex}
.mm-x{position:absolute;top:18px;right:18px;background:none;border:none;font-size:1.3rem;color:var(--gray600);cursor:pointer}
.mm a.ml{display:block;font-size:1.1rem;font-weight:600;color:var(--ink);padding:14px 0;width:100%;text-align:center;border-bottom:1px solid var(--gray200);transition:color .15s}
.mm a.ml:hover{color:var(--blue)}
.mm-cta{display:flex;flex-direction:column;gap:10px;width:72%;max-width:260px;margin-top:24px}
.mm-cta .btn-su,.mm-cta .btn-si{width:100%;text-align:center;padding:12px;font-size:0.9rem;border-radius:10px}

/* ── HERO ── */
.hero{padding-top:60px;background:var(--white);overflow:hidden;position:relative}
.hero-bg{position:absolute;inset:0;pointer-events:none;background:linear-gradient(135deg,var(--blue-l) 0%,rgba(14,165,233,0.06) 40%,transparent 70%)}
.hero-inner{padding:72px 0 0;position:relative;z-index:1}

.hero-tag{display:inline-flex;align-items:center;gap:6px;background:var(--blue-l);color:var(--blue);border-radius:6px;padding:4px 12px;font-size:0.68rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:20px}

.hero-h{font-size:clamp(2.2rem,5vw,3.8rem);font-weight:900;color:var(--ink);line-height:1.05;letter-spacing:-1px;margin-bottom:18px}
.hero-h .blue{color:var(--blue)}
.hero-h .sky{color:var(--sky)}

.hero-p{font-size:1.05rem;color:var(--gray600);line-height:1.7;margin-bottom:32px;max-width:460px;font-weight:400}

.btn-cta{display:inline-flex;align-items:center;gap:8px;background:var(--blue);color:#fff;border:none;border-radius:10px;padding:14px 30px;font-size:0.95rem;font-weight:700;box-shadow:0 4px 16px rgba(37,99,235,0.3);transition:background .15s,transform .15s,box-shadow .15s;font-family:'Outfit',sans-serif}
.btn-cta:hover{background:var(--blue-d);transform:translateY(-2px);box-shadow:0 8px 24px rgba(37,99,235,0.4);color:#fff}
.btn-ghost{display:inline-flex;align-items:center;gap:8px;background:transparent;color:var(--gray600);border:1.5px solid var(--gray200);border-radius:10px;padding:14px 24px;font-size:0.95rem;font-weight:500;transition:border-color .15s,color .15s;font-family:'Outfit',sans-serif}
.btn-ghost:hover{border-color:var(--blue);color:var(--blue)}

/* Hero image panel */
.hero-panel{background:var(--gray50);border:1px solid var(--gray200);border-radius:16px 16px 0 0;overflow:hidden;margin-top:48px;box-shadow:0 -8px 40px rgba(0,0,0,0.08)}
.panel-bar{background:var(--white);border-bottom:1px solid var(--gray200);padding:10px 16px;display:flex;align-items:center;gap:6px}
.p-dot{width:10px;height:10px;border-radius:50%}
.p-url{flex:1;background:var(--gray100);border-radius:4px;padding:3px 10px;font-size:0.62rem;color:var(--gray400);margin:0 8px;font-family:monospace}
.panel-body{padding:18px}
.panel-title{font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray400);margin-bottom:10px}
.p-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:14px}
.p-stat{background:var(--white);border:1px solid var(--gray200);border-radius:10px;padding:10px 12px}
.p-stat-n{font-size:1.2rem;font-weight:800;line-height:1;letter-spacing:-0.3px}
.p-stat-l{font-size:0.58rem;color:var(--gray400);text-transform:uppercase;letter-spacing:0.05em;margin-top:3px;font-weight:500}
.p-table{width:100%;border-collapse:collapse;font-size:0.7rem}
.p-table th{text-align:left;padding:6px 8px;color:var(--gray400);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;border-bottom:1px solid var(--gray200);font-size:0.62rem}
.p-table td{padding:8px;color:var(--gray600);border-bottom:1px solid var(--gray100)}
.p-table tr:last-child td{border-bottom:none}
.p-badge{font-size:0.58rem;font-weight:700;padding:2px 8px;border-radius:20px}

/* ── LOGOS STRIP ── */
.logos{background:var(--gray50);border-top:1px solid var(--gray200);border-bottom:1px solid var(--gray200);padding:24px 0}
.logos-label{font-size:0.65rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:var(--gray400);margin-bottom:16px}
.logos-row{display:flex;align-items:center;justify-content:center;gap:32px;flex-wrap:wrap}
.logo-chip{display:flex;align-items:center;gap:7px;font-size:0.78rem;font-weight:600;color:var(--gray600)}
.logo-chip i{font-size:1rem}

/* ── SECTIONS ── */
.sec{padding:88px 0}
.sec-alt{background:var(--gray50);border-top:1px solid var(--gray200);border-bottom:1px solid var(--gray200)}
.sec-tag{font-size:0.67rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--blue);margin-bottom:8px}
.sec-h{font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;color:var(--ink);line-height:1.15;letter-spacing:-0.4px}
.sec-p{font-size:0.9rem;color:var(--gray600);max-width:520px;margin:0 auto;line-height:1.7}

/* Feature cards — bento style */
.bento{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.bcard{background:var(--white);border:1px solid var(--gray200);border-radius:16px;padding:28px;transition:transform .2s,box-shadow .2s,border-color .2s;position:relative;overflow:hidden}
.bcard::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;opacity:0;transition:opacity .2s}
.bcard:hover{transform:translateY(-4px);box-shadow:0 12px 36px rgba(0,0,0,0.08);border-color:var(--blue)}
.bcard:hover::after{opacity:1}
.bcard.c1::after{background:linear-gradient(90deg,var(--blue),var(--sky))}
.bcard.c2::after{background:linear-gradient(90deg,var(--teal),var(--emerald))}
.bcard.c3::after{background:linear-gradient(90deg,var(--amber),var(--rose))}
.bcard.c4::after{background:linear-gradient(90deg,var(--violet),var(--blue))}
.bcard.c5::after{background:linear-gradient(90deg,var(--sky),var(--teal))}
.bcard.c6::after{background:linear-gradient(90deg,var(--rose),var(--amber))}
.bcard-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:16px}
.bcard-h{font-size:0.9rem;font-weight:700;color:var(--ink);margin-bottom:7px}
.bcard-p{font-size:0.82rem;color:var(--gray600);line-height:1.65}

/* Steps — horizontal numbered */
.steps-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:0;position:relative}
.steps-grid::before{content:'';position:absolute;top:20px;left:10%;right:10%;height:1px;background:linear-gradient(90deg,var(--blue),var(--sky));opacity:0.2}
.step{text-align:center;padding:0 16px;position:relative;z-index:1}
.step-n{width:42px;height:42px;border-radius:50%;background:var(--blue);color:#fff;font-size:0.9rem;font-weight:800;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;box-shadow:0 4px 14px rgba(37,99,235,0.3)}
.step-h{font-size:0.875rem;font-weight:700;color:var(--ink);margin-bottom:6px}
.step-p{font-size:0.78rem;color:var(--gray600);line-height:1.6}

/* Role cards — horizontal layout */
.rcard{background:var(--white);border:1px solid var(--gray200);border-radius:16px;padding:32px 26px;height:100%;transition:transform .2s,box-shadow .2s,border-color .2s;position:relative;overflow:hidden}
.rcard::before{content:'';position:absolute;top:0;left:0;right:0;height:4px}
.rcard.r1::before{background:linear-gradient(90deg,var(--blue),var(--sky))}
.rcard.r2::before{background:linear-gradient(90deg,var(--violet),var(--blue))}
.rcard.r3::before{background:linear-gradient(90deg,var(--teal),var(--emerald))}
.rcard:hover{transform:translateY(-4px);box-shadow:0 12px 36px rgba(0,0,0,0.08)}
.rcard.r1:hover{border-color:var(--blue)}
.rcard.r2:hover{border-color:var(--violet)}
.rcard.r3:hover{border-color:var(--teal)}
.rcard-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:18px}
.rcard-h{font-size:1rem;font-weight:700;color:var(--ink);margin-bottom:8px}
.rcard-p{font-size:0.835rem;color:var(--gray600);line-height:1.65;margin-bottom:16px}
.rcard-tag{font-size:0.65rem;font-weight:600;padding:3px 9px;border-radius:6px;display:inline-block;margin:2px}

/* CTA */
.cta-section{background:var(--blue);padding:88px 0;position:relative;overflow:hidden}
.cta-section::before{content:'';position:absolute;width:600px;height:600px;border-radius:50%;background:rgba(255,255,255,0.05);top:-200px;right:-200px;pointer-events:none}
.cta-section::after{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(14,165,233,0.2);bottom:-150px;left:-100px;pointer-events:none}

/* Footer */
footer{background:var(--gray900);color:rgba(255,255,255,0.4);padding:48px 0 28px;font-size:0.82rem}
.ft-name{font-size:0.9rem;font-weight:700;color:#fff}
.ft-link{color:rgba(255,255,255,0.4);transition:color .15s;display:block;margin-bottom:8px}
.ft-link:hover{color:rgba(255,255,255,0.85)}
.ft-col-h{font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.2);margin-bottom:14px}
footer hr{border-color:rgba(255,255,255,0.07)!important;margin:28px 0 20px}

/* Animate */
.fu{opacity:0;transform:translateY(16px);transition:opacity .5s ease,transform .5s ease}
.fu.in{opacity:1;transform:translateY(0)}

/* Responsive */
@media(max-width:991px){
  .hero-inner{padding:52px 0 0}
  .bento{grid-template-columns:repeat(2,1fr)}
  .steps-grid{grid-template-columns:repeat(2,1fr);gap:20px}
  .steps-grid::before{display:none}
}
@media(max-width:767px){
  .hero-inner{padding:28px 0 0}
  .hero-h{font-size:2rem;letter-spacing:-0.5px}
  .hero-p{font-size:0.9rem;margin-bottom:24px}
  .btn-cta,.btn-ghost{padding:12px 22px;font-size:0.875rem}
  .hero-panel{margin-top:28px}
  .p-stats{grid-template-columns:repeat(2,1fr)}
  .bento{grid-template-columns:1fr}
  .steps-grid{grid-template-columns:1fr 1fr}
  .sec{padding:60px 0}
  .sec-h{font-size:1.5rem}
  .bcard{padding:22px}
  .bcard-icon{width:38px;height:38px;font-size:0.95rem;margin-bottom:12px}
  .rcard{padding:26px 20px}
  .rcard-icon{width:48px;height:48px;font-size:1.2rem;margin-bottom:14px}
  .cta-section{padding:60px 0}
  footer{padding:36px 0 20px}
  footer .col-md-3,footer .col-md-4{text-align:center!important}
  .logos-row{gap:18px}
}
@media(max-width:480px){
  .hero-h{font-size:1.75rem}
  .brand-sub{display:none}
  .p-table{display:none}
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

<!-- NAV -->
<nav class="nav">
  <div class="container">
    <div class="nav-i">
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
      <div class="d-flex d-md-none">
        <button class="btn btn-link p-1" id="mmO" style="color:var(--gray600);font-size:1.15rem;"><i class="fas fa-bars"></i></button>
      </div>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="container">
    <div class="hero-inner">
      <div class="row align-items-center g-5">

        <div class="col-lg-5">
          <div class="hero-tag"><i class="fas fa-building-columns"></i> Campus Facility System</div>
          <h1 class="hero-h">
            Smarter<br>
            <span class="blue">facility</span><br>
            <span class="sky">management.</span>
          </h1>
          <p class="hero-p">SCC ReportHub gives faculty, administrators, and maintenance staff a single platform to report, track, and resolve campus facility issues — fast.</p>
          <div class="d-flex align-items-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn-cta"><i class="fas fa-arrow-right"></i> Get Started Free</a>
            <a href="{{ route('login') }}" class="btn-ghost">Sign In</a>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="hero-panel">
            <div class="panel-bar">
              <div class="p-dot" style="background:#ff5f57"></div>
              <div class="p-dot" style="background:#febc2e"></div>
              <div class="p-dot" style="background:#28c840"></div>
              <div class="p-url">scc-reporthub-production.up.railway.app/admin/dashboard</div>
            </div>
            <div class="panel-body">
              <div class="panel-title">Dashboard Overview</div>
              <div class="p-stats">
                <div class="p-stat"><div class="p-stat-n" style="color:var(--blue)">24</div><div class="p-stat-l">Total</div></div>
                <div class="p-stat"><div class="p-stat-n" style="color:var(--amber)">8</div><div class="p-stat-l">Pending</div></div>
                <div class="p-stat"><div class="p-stat-n" style="color:var(--sky)">10</div><div class="p-stat-l">Ongoing</div></div>
                <div class="p-stat"><div class="p-stat-n" style="color:var(--emerald)">12</div><div class="p-stat-l">Resolved</div></div>
              </div>
              <table class="p-table">
                <thead><tr><th>Issue</th><th>Location</th><th>Priority</th><th>Status</th></tr></thead>
                <tbody>
                  <tr><td>Electrical outlet</td><td>Room 204</td><td><span class="p-badge" style="background:#fef2f2;color:var(--rose)">Urgent</span></td><td><span class="p-badge" style="background:#fffbeb;color:var(--amber)">Pending</span></td></tr>
                  <tr><td>Leaking faucet</td><td>Comfort Room B</td><td><span class="p-badge" style="background:#fffbeb;color:var(--amber)">High</span></td><td><span class="p-badge" style="background:#f0fdfa;color:var(--teal)">Ongoing</span></td></tr>
                  <tr><td>AC unit repair</td><td>Faculty Lounge</td><td><span class="p-badge" style="background:#f0fdf4;color:var(--emerald)">Normal</span></td><td><span class="p-badge" style="background:#eff6ff;color:var(--blue)">Completed</span></td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- LOGOS STRIP -->
<div class="logos">
  <div class="container text-center">
    <div class="logos-label">Designed for Southern Christian College</div>
    <div class="logos-row">
      <div class="logo-chip"><i class="fas fa-ticket" style="color:var(--blue)"></i> Ticket Management</div>
      <div class="logo-chip"><i class="fas fa-bell" style="color:var(--amber)"></i> Live Notifications</div>
      <div class="logo-chip"><i class="fas fa-chart-line" style="color:var(--emerald)"></i> Analytics</div>
      <div class="logo-chip"><i class="fas fa-lock" style="color:var(--violet)"></i> Role-Based Access</div>
      <div class="logo-chip"><i class="fas fa-cloud" style="color:var(--sky)"></i> Cloud Storage</div>
    </div>
  </div>
</div>

<!-- FEATURES — BENTO GRID -->
<section class="sec" id="features">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">Features</div>
      <h2 class="sec-h mb-3">Built for how your campus actually works</h2>
      <p class="sec-p">Every tool in ReportHub is designed around the real workflows of SCC faculty, admins, and maintenance staff.</p>
    </div>
    <div class="bento fu">
      <div class="bcard c1">
        <div class="bcard-icon" style="background:#eff6ff;color:var(--blue)"><i class="fas fa-paper-plane"></i></div>
        <div class="bcard-h">Quick Ticket Submission</div>
        <div class="bcard-p">Report any facility issue in under a minute — add photos, set priority, and pick the location.</div>
      </div>
      <div class="bcard c2">
        <div class="bcard-icon" style="background:#f0fdfa;color:var(--teal)"><i class="fas fa-satellite-dish"></i></div>
        <div class="bcard-h">Live Status Tracking</div>
        <div class="bcard-p">See exactly where your ticket stands — from submission to completion — in real time.</div>
      </div>
      <div class="bcard c3">
        <div class="bcard-icon" style="background:#fffbeb;color:var(--amber)"><i class="fas fa-bell"></i></div>
        <div class="bcard-h">Smart Notifications</div>
        <div class="bcard-p">Automatic alerts when your ticket is approved, assigned, or resolved. No chasing needed.</div>
      </div>
      <div class="bcard c4">
        <div class="bcard-icon" style="background:#f5f3ff;color:var(--violet)"><i class="fas fa-gauge-high"></i></div>
        <div class="bcard-h">Admin Control Center</div>
        <div class="bcard-p">Full visibility with charts, stats, and complete control over tickets, users, and facilities.</div>
      </div>
      <div class="bcard c5">
        <div class="bcard-icon" style="background:#f0f9ff;color:var(--sky)"><i class="fas fa-screwdriver-wrench"></i></div>
        <div class="bcard-h">Maintenance Workflow</div>
        <div class="bcard-p">Maintenance staff get a clear task queue, progress tools, and completion tracking.</div>
      </div>
      <div class="bcard c6">
        <div class="bcard-icon" style="background:#fff1f2;color:var(--rose)"><i class="fas fa-star"></i></div>
        <div class="bcard-h">Service Ratings</div>
        <div class="bcard-p">Faculty rate completed repairs — giving admins the data to improve service quality.</div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec sec-alt" id="how-it-works">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">How It Works</div>
      <h2 class="sec-h mb-3">From report to resolved — four steps.</h2>
    </div>
    <div class="steps-grid fu">
      <div class="step">
        <div class="step-n">1</div>
        <div class="step-h">Submit</div>
        <div class="step-p">Faculty reports the issue with details, priority, and a photo.</div>
      </div>
      <div class="step">
        <div class="step-n">2</div>
        <div class="step-h">Review & Assign</div>
        <div class="step-p">Admin approves and assigns to the right maintenance staff.</div>
      </div>
      <div class="step">
        <div class="step-n">3</div>
        <div class="step-h">Repair</div>
        <div class="step-p">Maintenance works on the task and logs real-time progress.</div>
      </div>
      <div class="step">
        <div class="step-n">4</div>
        <div class="step-h">Verify & Rate</div>
        <div class="step-p">Admin confirms completion. Faculty rates the service. Done.</div>
      </div>
    </div>
  </div>
</section>

<!-- ROLES -->
<section class="sec" id="roles">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">Who It's For</div>
      <h2 class="sec-h mb-3">One platform, three portals.</h2>
      <p class="sec-p">Each role gets a dedicated experience built around their specific responsibilities.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4 fu">
        <div class="rcard r1">
          <div class="rcard-icon" style="background:#eff6ff;color:var(--blue)"><i class="fas fa-user-tie"></i></div>
          <div class="rcard-h">Administrator</div>
          <div class="rcard-p">Oversee all tickets, manage users and facilities, assign maintenance staff, and monitor performance through analytics.</div>
          <div>
            <span class="rcard-tag" style="background:#eff6ff;color:var(--blue)">Ticket Control</span>
            <span class="rcard-tag" style="background:#eff6ff;color:var(--blue)">User Management</span>
            <span class="rcard-tag" style="background:#eff6ff;color:var(--blue)">Analytics</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 fu" style="transition-delay:.08s">
        <div class="rcard r2">
          <div class="rcard-icon" style="background:#f5f3ff;color:var(--violet)"><i class="fas fa-chalkboard-user"></i></div>
          <div class="rcard-h">Faculty & Staff</div>
          <div class="rcard-p">Submit facility issues, track repair status in real time, and rate the service quality once your request is resolved.</div>
          <div>
            <span class="rcard-tag" style="background:#f5f3ff;color:var(--violet)">Submit Issues</span>
            <span class="rcard-tag" style="background:#f5f3ff;color:var(--violet)">Track Status</span>
            <span class="rcard-tag" style="background:#f5f3ff;color:var(--violet)">Rate Service</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 fu" style="transition-delay:.16s">
        <div class="rcard r3">
          <div class="rcard-icon" style="background:#f0fdfa;color:var(--teal)"><i class="fas fa-helmet-safety"></i></div>
          <div class="rcard-h">Maintenance Staff</div>
          <div class="rcard-p">View your assigned task queue, log repair progress, and mark jobs complete — all from one clean interface.</div>
          <div>
            <span class="rcard-tag" style="background:#f0fdfa;color:var(--teal)">Task Queue</span>
            <span class="rcard-tag" style="background:#f0fdfa;color:var(--teal)">Log Progress</span>
            <span class="rcard-tag" style="background:#f0fdfa;color:var(--teal)">Job History</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="container text-center" style="position:relative;z-index:1;">
    <div class="fu">
      <div style="font-size:0.67rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:rgba(255,255,255,0.6);margin-bottom:10px;">Get Started Today</div>
      <h2 style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#fff;letter-spacing:-0.4px;margin-bottom:14px;">Ready to transform how<br>your campus handles repairs?</h2>
      <p style="font-size:0.95rem;color:rgba(255,255,255,0.7);max-width:480px;margin:0 auto 32px;line-height:1.7;">Free for all SCC faculty and staff. Create your account and start reporting facility issues in minutes.</p>
      <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--blue);border:none;border-radius:10px;padding:14px 32px;font-size:0.95rem;font-weight:700;box-shadow:0 4px 20px rgba(0,0,0,0.15);transition:transform .15s,box-shadow .15s;font-family:'Outfit',sans-serif;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 28px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.15)'">
        <i class="fas fa-user-plus"></i> Create an Account
      </a>
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
const mm=document.getElementById('mm');
const mmO=document.getElementById('mmO');
if(mmO) mmO.addEventListener('click',()=>{mm.classList.add('on');document.body.style.overflow='hidden'});
document.getElementById('mmX').addEventListener('click',()=>{mm.classList.remove('on');document.body.style.overflow=''});
mm.querySelectorAll('a.ml').forEach(l=>{
  l.addEventListener('click',e=>{
    if(l.getAttribute('href').startsWith('#')){
      e.preventDefault();mm.classList.remove('on');document.body.style.overflow='';
      setTimeout(()=>{const t=document.querySelector(l.getAttribute('href'));if(t)t.scrollIntoView({behavior:'smooth'})},260);
    }else{mm.classList.remove('on');document.body.style.overflow=''}
  });
});
document.querySelectorAll('a[href^="#"]').forEach(a=>{
  a.addEventListener('click',e=>{
    const t=document.querySelector(a.getAttribute('href'));
    if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth'})}
  });
});
const io=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}});
},{threshold:0.08});
document.querySelectorAll('.fu').forEach(el=>io.observe(el));
</script>
</body>
</html>
