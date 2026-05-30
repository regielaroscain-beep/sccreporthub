<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SCC ReportHub — Campus Facility Management</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{
  --v1:#6d28d9; --v2:#7c3aed; --v3:#8b5cf6; --v4:#a78bfa;
  --b1:#2563eb; --b2:#3b82f6;
  --ink:#1e1b4b; --ink2:#4c4f7a; --ink3:#9ca3af;
  --white:#fff; --off:#f8f7ff; --border:#e5e7eb;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Nunito',system-ui,sans-serif;background:var(--white);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased;overflow-x:hidden}
a{text-decoration:none;color:inherit}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:900;height:64px;background:rgba(255,255,255,0.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);display:flex;align-items:center}
.nav-i{display:flex;align-items:center;justify-content:space-between;width:100%}
.brand{display:flex;align-items:center;gap:10px}
.brand img{width:32px;height:32px;border-radius:8px;object-fit:contain;background:var(--off);padding:3px;border:1px solid var(--border)}
.brand-name{font-size:0.95rem;font-weight:800;color:var(--v1);letter-spacing:-0.3px}
.brand-sub{font-size:0.52rem;font-weight:600;color:var(--ink3);text-transform:uppercase;letter-spacing:.8px;display:block}
.nav-links{display:flex;gap:28px}
.nav-links a{font-size:0.85rem;font-weight:600;color:var(--ink2);transition:color .15s}
.nav-links a:hover{color:var(--v1)}
.btn-si{background:transparent;border:2px solid var(--border);color:var(--ink2);border-radius:50px;padding:7px 20px;font-size:0.82rem;font-weight:700;transition:all .15s;font-family:'Nunito',sans-serif}
.btn-si:hover{border-color:var(--v1);color:var(--v1)}
.btn-su{background:linear-gradient(135deg,var(--v1),var(--b1));color:#fff;border:none;border-radius:50px;padding:7px 20px;font-size:0.82rem;font-weight:700;box-shadow:0 4px 14px rgba(109,40,217,0.35);transition:opacity .15s,transform .15s;font-family:'Nunito',sans-serif}
.btn-su:hover{opacity:.9;transform:translateY(-1px);color:#fff}

/* MOBILE MENU */
.mm{display:none;position:fixed;inset:0;z-index:1100;background:#fff;flex-direction:column;align-items:center;justify-content:center}
.mm.on{display:flex}
.mm-x{position:absolute;top:18px;right:18px;background:none;border:none;font-size:1.3rem;color:var(--ink2);cursor:pointer}
.mm a.ml{display:block;font-size:1.1rem;font-weight:700;color:var(--ink);padding:14px 0;width:100%;text-align:center;border-bottom:1px solid var(--border);transition:color .15s}
.mm a.ml:hover{color:var(--v1)}
.mm-cta{display:flex;flex-direction:column;gap:10px;width:72%;max-width:260px;margin-top:24px}
.mm-cta .btn-su,.mm-cta .btn-si{width:100%;text-align:center;padding:13px;font-size:0.9rem}

/* HERO — split layout */
.hero{padding-top:64px;min-height:100vh;display:grid;grid-template-columns:1fr 1fr;overflow:hidden}

/* Left: white */
.hero-left{background:var(--white);display:flex;align-items:center;padding:80px 0 80px 0;position:relative}
.hero-left::after{content:'';position:absolute;top:0;bottom:0;right:-1px;width:60px;background:var(--white);clip-path:polygon(0 0,0 100%,100% 100%);z-index:2}
.hero-left-inner{max-width:480px;margin-left:auto;padding-right:60px;position:relative;z-index:3}

.hero-eyebrow{display:inline-flex;align-items:center;gap:7px;color:var(--v1);font-size:0.72rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:20px}
.hero-eyebrow-dot{width:8px;height:8px;border-radius:50%;background:linear-gradient(135deg,var(--v1),var(--b2))}

.hero-h{font-size:clamp(2.2rem,3.5vw,3.4rem);font-weight:900;color:var(--ink);line-height:1.1;letter-spacing:-0.8px;margin-bottom:14px}
.hero-h-sub{font-size:clamp(1.1rem,2vw,1.5rem);font-weight:700;background:linear-gradient(135deg,var(--v1),var(--b2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:20px;line-height:1.3}
.hero-p{font-size:0.95rem;color:var(--ink2);line-height:1.75;margin-bottom:32px;max-width:400px}

.btn-cta{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--v1),var(--b1));color:#fff;border:none;border-radius:50px;padding:14px 32px;font-size:0.9rem;font-weight:800;box-shadow:0 6px 20px rgba(109,40,217,0.35);transition:transform .15s,box-shadow .15s,opacity .15s;font-family:'Nunito',sans-serif}
.btn-cta:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(109,40,217,0.45);opacity:.95;color:#fff}

.hero-trust{display:flex;align-items:center;gap:16px;margin-top:24px;flex-wrap:wrap}
.hero-trust-item{display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:600;color:var(--ink3)}
.hero-trust-item i{color:var(--v3);font-size:0.8rem}

/* Right: violet blob */
.hero-right{background:linear-gradient(145deg,#7c3aed 0%,#6d28d9 30%,#4f46e5 65%,#2563eb 100%);position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden}
.hero-right::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.06);top:-100px;right:-100px}
.hero-right::after{content:'';position:absolute;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04);bottom:-80px;left:-60px}

/* Floating blobs */
.blob{position:absolute;border-radius:50%;background:rgba(255,255,255,0.07);pointer-events:none}
.blob1{width:180px;height:180px;top:10%;left:5%}
.blob2{width:120px;height:120px;bottom:15%;right:8%}
.blob3{width:80px;height:80px;top:55%;left:15%}

/* Phone mockup */
.phone-wrap{position:relative;z-index:2;padding:40px 20px}
.phone{width:240px;background:#1a1a2e;border-radius:36px;padding:12px;box-shadow:0 32px 80px rgba(0,0,0,0.4),0 0 0 1px rgba(255,255,255,0.1),inset 0 0 0 2px rgba(255,255,255,0.05);position:relative}
.phone::before{content:'';position:absolute;top:14px;left:50%;transform:translateX(-50%);width:60px;height:6px;background:rgba(255,255,255,0.15);border-radius:3px}
.phone-screen{background:#0f172a;border-radius:26px;overflow:hidden;padding:20px 14px 14px}
.phone-status{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
.phone-status-title{font-size:0.6rem;font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:.08em}
.phone-status-badge{font-size:0.5rem;font-weight:700;background:rgba(109,40,217,0.4);color:#c4b5fd;border-radius:20px;padding:2px 7px;border:1px solid rgba(167,139,250,0.3)}

/* Ticket card on phone */
.phone-ticket{background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:10px 12px;margin-bottom:8px;backdrop-filter:blur(8px)}
.phone-ticket:last-child{margin-bottom:0}
.pt-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:4px}
.pt-title{font-size:0.6rem;font-weight:700;color:#f1f5f9}
.pt-badge{font-size:0.48rem;font-weight:700;padding:2px 6px;border-radius:20px}
.pt-meta{font-size:0.52rem;color:rgba(255,255,255,0.4);display:flex;align-items:center;gap:4px}
.pt-meta i{font-size:0.5rem}
.pt-progress{height:3px;background:rgba(255,255,255,0.1);border-radius:2px;margin-top:6px;overflow:hidden}
.pt-progress-bar{height:100%;border-radius:2px}

/* Floating hologram cards */
.holo-card{position:absolute;background:rgba(255,255,255,0.12);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,0.2);border-radius:14px;padding:12px 16px;box-shadow:0 8px 32px rgba(0,0,0,0.2),inset 0 1px 0 rgba(255,255,255,0.2);z-index:3}
.holo-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,0.15) 0%,transparent 50%);border-radius:14px;pointer-events:none}
.hc1{top:12%;right:-20px;animation:float1 4s ease-in-out infinite}
.hc2{bottom:18%;left:-24px;animation:float2 5s ease-in-out infinite}
@keyframes float1{0%,100%{transform:translateY(0) rotate(-2deg)}50%{transform:translateY(-10px) rotate(-2deg)}}
@keyframes float2{0%,100%{transform:translateY(0) rotate(2deg)}50%{transform:translateY(-8px) rotate(2deg)}}
.hc-label{font-size:0.52rem;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px}
.hc-value{font-size:1rem;font-weight:900;color:#fff;line-height:1}
.hc-sub{font-size:0.5rem;color:rgba(255,255,255,0.5);margin-top:2px}
.hc-icon{font-size:1.1rem;margin-bottom:4px}

/* SECTIONS */
.sec{padding:88px 0}
.sec-alt{background:var(--off);border-top:1px solid var(--border);border-bottom:1px solid var(--border)}
.sec-tag{font-size:0.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:var(--v1);margin-bottom:8px}
.sec-h{font-size:clamp(1.6rem,3vw,2.2rem);font-weight:900;color:var(--ink);line-height:1.15;letter-spacing:-0.4px}
.sec-p{font-size:0.9rem;color:var(--ink2);max-width:520px;margin:0 auto;line-height:1.7}

/* Feature cards */
.fc{background:var(--white);border:1.5px solid var(--border);border-radius:18px;padding:28px;height:100%;transition:transform .2s,box-shadow .2s,border-color .2s}
.fc:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(109,40,217,0.1);border-color:var(--v4)}
.fc-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:16px}
.fc-h{font-size:0.9rem;font-weight:800;color:var(--ink);margin-bottom:7px}
.fc-p{font-size:0.82rem;color:var(--ink2);line-height:1.65}

/* Steps */
.step-card{background:var(--white);border:1.5px solid var(--border);border-radius:16px;padding:24px;display:flex;gap:16px;transition:border-color .2s}
.step-card:hover{border-color:var(--v4)}
.step-n{width:36px;height:36px;border-radius:10px;flex-shrink:0;background:linear-gradient(135deg,var(--v1),var(--b1));color:#fff;font-size:0.85rem;font-weight:900;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(109,40,217,0.35)}
.step-h{font-size:0.875rem;font-weight:800;color:var(--ink);margin-bottom:4px}
.step-p{font-size:0.78rem;color:var(--ink2);line-height:1.6}

/* Role cards */
.rcard{background:var(--white);border:1.5px solid var(--border);border-radius:20px;padding:32px 26px;height:100%;transition:transform .2s,box-shadow .2s;overflow:hidden;position:relative}
.rcard::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--v1),var(--b2))}
.rcard.r2::before{background:linear-gradient(90deg,var(--b1),var(--v3))}
.rcard.r3::before{background:linear-gradient(90deg,#0d9488,#059669)}
.rcard:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(109,40,217,0.1)}
.rcard-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:18px}
.rcard-h{font-size:1rem;font-weight:800;color:var(--ink);margin-bottom:8px}
.rcard-p{font-size:0.835rem;color:var(--ink2);line-height:1.65;margin-bottom:16px}
.rcard-tag{font-size:0.65rem;font-weight:700;padding:3px 10px;border-radius:50px;display:inline-block;margin:2px}

/* CTA */
.cta-sec{background:linear-gradient(135deg,var(--v1) 0%,#4f46e5 50%,var(--b1) 100%);padding:88px 0;position:relative;overflow:hidden}
.cta-sec::before{content:'';position:absolute;width:500px;height:500px;border-radius:50%;background:rgba(255,255,255,0.05);top:-200px;right:-150px}
.cta-sec::after{content:'';position:absolute;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04);bottom:-100px;left:-80px}
.btn-cta-w{display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--v1);border:none;border-radius:50px;padding:14px 36px;font-size:0.95rem;font-weight:800;box-shadow:0 6px 20px rgba(0,0,0,0.15);transition:transform .15s,box-shadow .15s;font-family:'Nunito',sans-serif}
.btn-cta-w:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(0,0,0,0.2);color:var(--v1)}

/* Footer */
footer{background:#0f0a1e;color:rgba(255,255,255,0.4);padding:48px 0 28px;font-size:0.82rem}
.ft-name{font-size:0.9rem;font-weight:800;color:#fff}
.ft-link{color:rgba(255,255,255,0.4);transition:color .15s;display:block;margin-bottom:8px}
.ft-link:hover{color:rgba(255,255,255,0.85)}
.ft-col-h{font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.2);margin-bottom:14px}
footer hr{border-color:rgba(255,255,255,0.07)!important;margin:28px 0 20px}

/* Animate */
.fu{opacity:0;transform:translateY(16px);transition:opacity .5s ease,transform .5s ease}
.fu.in{opacity:1;transform:translateY(0)}

/* Responsive */
@media(max-width:991px){
  .hero{grid-template-columns:1fr;min-height:auto}
  .hero-left{padding:56px 0 40px}
  .hero-left::after{display:none}
  .hero-left-inner{margin:0 auto;padding:0 24px;max-width:600px}
  .hero-right{min-height:480px;padding:40px 0}
  .hc1{right:10px}
  .hc2{left:10px}
}
@media(max-width:767px){
  .hero-left{padding:32px 0 28px}
  .hero-h{font-size:2rem;letter-spacing:-0.5px}
  .hero-h-sub{font-size:1.1rem}
  .hero-p{font-size:0.875rem;margin-bottom:24px}
  .btn-cta{padding:13px 26px;font-size:0.875rem}
  .hero-right{min-height:400px}
  .phone{width:200px}
  .sec{padding:60px 0}
  .sec-h{font-size:1.5rem}
  .fc{padding:22px}
  .rcard{padding:26px 20px}
  .cta-sec{padding:60px 0}
  footer{padding:36px 0 20px}
  footer .col-md-3,footer .col-md-4{text-align:center!important}
}
@media(max-width:480px){
  .hero-h{font-size:1.75rem}
  .brand-sub{display:none}
  .hc1,.hc2{display:none}
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
        <button class="btn btn-link p-1" id="mmO" style="color:var(--ink2);font-size:1.15rem;"><i class="fas fa-bars"></i></button>
      </div>
    </div>
  </div>
</nav>

<!-- HERO — SPLIT -->
<section class="hero">

  <!-- LEFT: white side -->
  <div class="hero-left">
    <div class="hero-left-inner">
      <div class="hero-eyebrow">
        <span class="hero-eyebrow-dot"></span>
        Campus Facility Management System
      </div>
      <h1 class="hero-h">Report. Track.<br>Resolve.</h1>
      <div class="hero-h-sub">Smarter facility management<br>for Southern Christian College.</div>
      <p class="hero-p">SCC ReportHub connects faculty, administrators, and maintenance staff in one streamlined platform — making campus repairs faster and more transparent.</p>
      <a href="{{ route('register') }}" class="btn-cta">
        <i class="fas fa-rocket"></i> Get Started Free
      </a>
      <div class="hero-trust">
        <div class="hero-trust-item"><i class="fas fa-check-circle"></i> Free for SCC Faculty</div>
        <div class="hero-trust-item"><i class="fas fa-check-circle"></i> No App Needed</div>
        <div class="hero-trust-item"><i class="fas fa-check-circle"></i> Real-time Updates</div>
      </div>
    </div>
  </div>

  <!-- RIGHT: violet blob + phone -->
  <div class="hero-right">
    <div class="blob blob1"></div>
    <div class="blob blob2"></div>
    <div class="blob blob3"></div>

    <!-- Hologram card 1 -->
    <div class="holo-card hc1">
      <div class="hc-label">Active Tickets</div>
      <div class="hc-value">24</div>
      <div class="hc-sub">↑ 3 new today</div>
    </div>

    <!-- Hologram card 2 -->
    <div class="holo-card hc2">
      <div class="hc-icon" style="color:#34d399;">✓</div>
      <div class="hc-label">Resolved</div>
      <div class="hc-value">12</div>
    </div>

    <!-- Phone mockup -->
    <div class="phone-wrap">
      <div class="phone">
        <div class="phone-screen">
          <div class="phone-status">
            <div class="phone-status-title">Ticket Reports</div>
            <div class="phone-status-badge">Live</div>
          </div>

          <!-- Ticket 1 -->
          <div class="phone-ticket">
            <div class="pt-row">
              <div class="pt-title">Electrical Outlet</div>
              <div class="pt-badge" style="background:rgba(239,68,68,0.2);color:#fca5a5;">Urgent</div>
            </div>
            <div class="pt-meta">
              <i class="fas fa-location-dot"></i> Room 204 · Science Bldg
            </div>
            <div class="pt-progress"><div class="pt-progress-bar" style="width:30%;background:linear-gradient(90deg,#ef4444,#f87171)"></div></div>
          </div>

          <!-- Ticket 2 -->
          <div class="phone-ticket">
            <div class="pt-row">
              <div class="pt-title">Leaking Faucet</div>
              <div class="pt-badge" style="background:rgba(251,191,36,0.2);color:#fcd34d;">Ongoing</div>
            </div>
            <div class="pt-meta">
              <i class="fas fa-location-dot"></i> Comfort Room B
            </div>
            <div class="pt-progress"><div class="pt-progress-bar" style="width:65%;background:linear-gradient(90deg,#f59e0b,#fbbf24)"></div></div>
          </div>

          <!-- Ticket 3 -->
          <div class="phone-ticket">
            <div class="pt-row">
              <div class="pt-title">AC Unit Repair</div>
              <div class="pt-badge" style="background:rgba(52,211,153,0.2);color:#6ee7b7;">Done</div>
            </div>
            <div class="pt-meta">
              <i class="fas fa-location-dot"></i> Faculty Lounge
            </div>
            <div class="pt-progress"><div class="pt-progress-bar" style="width:100%;background:linear-gradient(90deg,#10b981,#34d399)"></div></div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>

<!-- FEATURES -->
<section class="sec" id="features">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">Features</div>
      <h2 class="sec-h mb-3">Built for how your campus works</h2>
      <p class="sec-p">Every tool in ReportHub is designed around the real workflows of SCC faculty, admins, and maintenance staff.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4 fu">
        <div class="fc">
          <div class="fc-icon" style="background:#ede9fe;color:var(--v1)"><i class="fas fa-paper-plane"></i></div>
          <div class="fc-h">Quick Ticket Submission</div>
          <div class="fc-p">Report any facility issue in under a minute — add photos, set priority, and pick the location.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
        <div class="fc">
          <div class="fc-icon" style="background:#dbeafe;color:var(--b1)"><i class="fas fa-satellite-dish"></i></div>
          <div class="fc-h">Live Status Tracking</div>
          <div class="fc-p">See exactly where your ticket stands — from submission to completion — in real time.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
        <div class="fc">
          <div class="fc-icon" style="background:#fef3c7;color:#d97706"><i class="fas fa-bell"></i></div>
          <div class="fc-h">Smart Notifications</div>
          <div class="fc-p">Automatic alerts when your ticket is approved, assigned, or resolved. No chasing needed.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
        <div class="fc">
          <div class="fc-icon" style="background:#ede9fe;color:var(--v2)"><i class="fas fa-gauge-high"></i></div>
          <div class="fc-h">Admin Control Center</div>
          <div class="fc-p">Full visibility with charts, stats, and complete control over tickets, users, and facilities.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
        <div class="fc">
          <div class="fc-icon" style="background:#d1fae5;color:#059669"><i class="fas fa-screwdriver-wrench"></i></div>
          <div class="fc-h">Maintenance Workflow</div>
          <div class="fc-p">Maintenance staff get a clear task queue, progress tools, and completion tracking.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.18s">
        <div class="fc">
          <div class="fc-icon" style="background:#ffe4e6;color:#e11d48"><i class="fas fa-star"></i></div>
          <div class="fc-h">Service Ratings</div>
          <div class="fc-p">Faculty rate completed repairs — giving admins the data to improve service quality.</div>
        </div>
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
    <div class="row g-3 fu">
      <div class="col-md-6">
        <div class="step-card">
          <div class="step-n">1</div>
          <div><div class="step-h">Submit a Ticket</div><div class="step-p">Faculty reports the issue with details, priority, and a photo. Takes under a minute.</div></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="step-card">
          <div class="step-n">2</div>
          <div><div class="step-h">Admin Reviews & Assigns</div><div class="step-p">Admin approves and assigns to the right maintenance staff based on specialization.</div></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="step-card">
          <div class="step-n">3</div>
          <div><div class="step-h">Repair in Progress</div><div class="step-p">Maintenance staff works on the task and logs real-time progress updates.</div></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="step-card">
          <div class="step-n">4</div>
          <div><div class="step-h">Verified & Rated</div><div class="step-p">Admin confirms completion. Faculty rates the service quality. Ticket closed.</div></div>
        </div>
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
          <div class="rcard-icon" style="background:#ede9fe;color:var(--v1)"><i class="fas fa-user-tie"></i></div>
          <div class="rcard-h">Administrator</div>
          <div class="rcard-p">Oversee all tickets, manage users and facilities, assign maintenance staff, and monitor performance through analytics.</div>
          <div>
            <span class="rcard-tag" style="background:#ede9fe;color:var(--v1)">Ticket Control</span>
            <span class="rcard-tag" style="background:#ede9fe;color:var(--v1)">User Management</span>
            <span class="rcard-tag" style="background:#ede9fe;color:var(--v1)">Analytics</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 fu" style="transition-delay:.08s">
        <div class="rcard r2">
          <div class="rcard-icon" style="background:#dbeafe;color:var(--b1)"><i class="fas fa-chalkboard-user"></i></div>
          <div class="rcard-h">Faculty & Staff</div>
          <div class="rcard-p">Submit facility issues, track repair status in real time, and rate the service quality once your request is resolved.</div>
          <div>
            <span class="rcard-tag" style="background:#dbeafe;color:var(--b1)">Submit Issues</span>
            <span class="rcard-tag" style="background:#dbeafe;color:var(--b1)">Track Status</span>
            <span class="rcard-tag" style="background:#dbeafe;color:var(--b1)">Rate Service</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 fu" style="transition-delay:.16s">
        <div class="rcard r3">
          <div class="rcard-icon" style="background:#d1fae5;color:#059669"><i class="fas fa-helmet-safety"></i></div>
          <div class="rcard-h">Maintenance Staff</div>
          <div class="rcard-p">View your assigned task queue, log repair progress, and mark jobs complete — all from one clean interface.</div>
          <div>
            <span class="rcard-tag" style="background:#d1fae5;color:#059669">Task Queue</span>
            <span class="rcard-tag" style="background:#d1fae5;color:#059669">Log Progress</span>
            <span class="rcard-tag" style="background:#d1fae5;color:#059669">Job History</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-sec">
  <div class="container text-center" style="position:relative;z-index:1;">
    <div class="fu">
      <div style="font-size:0.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:rgba(255,255,255,0.6);margin-bottom:10px;">Get Started Today</div>
      <h2 style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;color:#fff;letter-spacing:-0.5px;margin-bottom:14px;">Ready to transform how<br>your campus handles repairs?</h2>
      <p style="font-size:0.95rem;color:rgba(255,255,255,0.7);max-width:480px;margin:0 auto 32px;line-height:1.7;">Free for all SCC faculty and staff. Create your account and start reporting facility issues in minutes.</p>
      <a href="{{ route('register') }}" class="btn-cta-w">
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
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="font-size:.74rem;">
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
