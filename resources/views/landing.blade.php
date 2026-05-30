<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SCC ReportHub — Campus Facility Management</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{
  --sky:#e8f4fd;
  --sky2:#d0eaf9;
  --sky3:#b8dff5;
  --blue:#1a73e8;
  --blue2:#1557b0;
  --blue3:#4a9edd;
  --gold:#f5a623;
  --gold2:#e8941a;
  --gold3:#ffc947;
  --gold-l:#fff8e7;
  --white:#ffffff;
  --ink:#1a2332;
  --ink2:#4a5568;
  --ink3:#8a9ab0;
  --border:#dde8f5;
  --card:#ffffff;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Poppins',system-ui,sans-serif;background:var(--sky);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased;overflow-x:hidden}
a{text-decoration:none;color:inherit}

/* ── NAV ── */
.nav{position:fixed;top:0;left:0;right:0;z-index:900;height:66px;background:rgba(255,255,255,0.95);backdrop-filter:blur(16px);border-bottom:2px solid var(--border);display:flex;align-items:center;box-shadow:0 2px 20px rgba(26,115,232,0.08)}
.nav-i{display:flex;align-items:center;justify-content:space-between;width:100%}
.brand{display:flex;align-items:center;gap:10px}
.brand img{width:36px;height:36px;border-radius:10px;object-fit:contain;background:var(--sky);padding:3px;border:2px solid var(--border)}
.brand-name{font-size:1rem;font-weight:800;color:var(--blue);letter-spacing:-0.3px}
.brand-sub{font-size:0.52rem;font-weight:600;color:var(--ink3);text-transform:uppercase;letter-spacing:.8px;display:block}
.nav-links{display:flex;gap:28px}
.nav-links a{font-size:0.85rem;font-weight:600;color:var(--ink2);transition:color .15s}
.nav-links a:hover{color:var(--blue)}
.btn-si{background:transparent;border:2px solid var(--border);color:var(--ink2);border-radius:50px;padding:7px 20px;font-size:0.82rem;font-weight:700;transition:all .15s;font-family:'Poppins',sans-serif}
.btn-si:hover{border-color:var(--blue);color:var(--blue)}
.btn-su{background:linear-gradient(135deg,var(--gold),var(--gold2));color:#fff;border:none;border-radius:50px;padding:7px 20px;font-size:0.82rem;font-weight:700;box-shadow:0 4px 14px rgba(245,166,35,0.4);transition:opacity .15s,transform .15s;font-family:'Poppins',sans-serif}
.btn-su:hover{opacity:.9;transform:translateY(-1px);color:#fff}

/* ── MOBILE MENU ── */
.mm{display:none;position:fixed;inset:0;z-index:1100;background:#fff;flex-direction:column;align-items:center;justify-content:center}
.mm.on{display:flex}
.mm-x{position:absolute;top:18px;right:18px;background:none;border:none;font-size:1.3rem;color:var(--ink2);cursor:pointer}
.mm a.ml{display:block;font-size:1.1rem;font-weight:700;color:var(--ink);padding:14px 0;width:100%;text-align:center;border-bottom:1px solid var(--border);transition:color .15s}
.mm a.ml:hover{color:var(--blue)}
.mm-cta{display:flex;flex-direction:column;gap:10px;width:72%;max-width:260px;margin-top:24px}
.mm-cta .btn-su,.mm-cta .btn-si{width:100%;text-align:center;padding:13px;font-size:0.9rem}

/* ── HERO ── */
.hero{padding-top:66px;background:linear-gradient(160deg,var(--white) 0%,var(--sky) 40%,var(--sky2) 100%);min-height:100vh;display:flex;align-items:center;position:relative;overflow:hidden}

/* Decorative circles */
.deco-circle{position:absolute;border-radius:50%;pointer-events:none}
.dc1{width:500px;height:500px;background:radial-gradient(circle,rgba(26,115,232,0.06) 0%,transparent 70%);top:-150px;right:-100px}
.dc2{width:300px;height:300px;background:radial-gradient(circle,rgba(245,166,35,0.08) 0%,transparent 70%);bottom:-80px;left:-60px}
.dc3{width:200px;height:200px;background:radial-gradient(circle,rgba(26,115,232,0.05) 0%,transparent 70%);top:40%;left:40%}

.hero-inner{padding:60px 0 40px;position:relative;z-index:1;width:100%}

/* Left copy */
.hero-tag{display:inline-flex;align-items:center;gap:8px;background:var(--gold-l);border:2px solid rgba(245,166,35,0.3);color:var(--gold2);border-radius:50px;padding:5px 16px;font-size:0.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;margin-bottom:22px}
.hero-tag i{font-size:0.8rem}

.hero-h{font-size:clamp(2.2rem,5vw,3.6rem);font-weight:900;color:var(--ink);line-height:1.08;letter-spacing:-1px;margin-bottom:8px}
.hero-h .gold{color:var(--gold)}
.hero-h .blue{color:var(--blue)}

.hero-sub{font-size:1.1rem;font-weight:600;color:var(--blue3);margin-bottom:18px}
.hero-p{font-size:0.95rem;color:var(--ink2);line-height:1.75;margin-bottom:32px;max-width:440px}

.btn-hero{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff;border:none;border-radius:50px;padding:14px 32px;font-size:0.95rem;font-weight:700;box-shadow:0 6px 20px rgba(26,115,232,0.35);transition:transform .15s,box-shadow .15s,opacity .15s;font-family:'Poppins',sans-serif}
.btn-hero:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(26,115,232,0.45);opacity:.95;color:#fff}
.btn-hero-out{display:inline-flex;align-items:center;gap:8px;background:transparent;color:var(--blue);border:2px solid var(--blue3);border-radius:50px;padding:14px 28px;font-size:0.95rem;font-weight:600;transition:all .15s;font-family:'Poppins',sans-serif}
.btn-hero-out:hover{background:var(--blue);color:#fff;border-color:var(--blue)}

/* Hero right — illustration area */
.hero-right{position:relative;display:flex;align-items:center;justify-content:center}

/* SVG Cartoon character */
.cartoon-wrap{position:relative;z-index:2}

/* Floating stat cards */
.stat-float{position:absolute;background:var(--white);border-radius:16px;padding:14px 18px;box-shadow:0 8px 32px rgba(26,115,232,0.15);border:2px solid var(--border);z-index:3;animation:floatUp 3s ease-in-out infinite}
.stat-float:nth-child(2){animation-delay:.8s}
.stat-float:nth-child(3){animation-delay:1.6s}
@keyframes floatUp{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
.sf1{top:5%;left:-10%}
.sf2{bottom:15%;right:-8%}
.sf3{top:45%;right:-15%}
.sf-icon{font-size:1.4rem;margin-bottom:4px}
.sf-val{font-size:1.3rem;font-weight:900;color:var(--ink);line-height:1;letter-spacing:-0.5px}
.sf-label{font-size:0.6rem;font-weight:600;color:var(--ink3);text-transform:uppercase;letter-spacing:.06em;margin-top:2px}

/* ── WAVE DIVIDER ── */
.wave{display:block;width:100%;overflow:hidden;line-height:0}
.wave svg{display:block}

/* ── FEATURES ── */
.sec-features{background:var(--white);padding:88px 0}
.sec-tag{font-size:0.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:var(--gold2);margin-bottom:8px}
.sec-h{font-size:clamp(1.6rem,3vw,2.2rem);font-weight:900;color:var(--ink);line-height:1.15;letter-spacing:-0.4px}
.sec-p{font-size:0.9rem;color:var(--ink2);max-width:520px;margin:0 auto;line-height:1.7}

.fc{background:var(--sky);border:2px solid var(--border);border-radius:20px;padding:28px;height:100%;transition:transform .2s,box-shadow .2s,border-color .2s,background .2s}
.fc:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(26,115,232,0.12);border-color:var(--blue3);background:var(--white)}
.fc-icon{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:16px}
.fc-h{font-size:0.9rem;font-weight:800;color:var(--ink);margin-bottom:7px}
.fc-p{font-size:0.82rem;color:var(--ink2);line-height:1.65}

/* ── HOW IT WORKS ── */
.sec-how{background:linear-gradient(135deg,var(--sky) 0%,var(--sky2) 100%);padding:88px 0;border-top:2px solid var(--border);border-bottom:2px solid var(--border)}
.step-wrap{text-align:center;padding:0 12px}
.step-num{width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--blue3));color:#fff;font-size:1.1rem;font-weight:900;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;box-shadow:0 6px 18px rgba(26,115,232,0.35)}
.step-h{font-size:0.9rem;font-weight:800;color:var(--ink);margin-bottom:6px}
.step-p{font-size:0.8rem;color:var(--ink2);line-height:1.6}
.step-connector{display:none}
@media(min-width:768px){
  .step-connector{display:block;position:absolute;top:26px;left:calc(50% + 32px);right:calc(-50% + 32px);height:2px;background:linear-gradient(90deg,var(--blue3),var(--gold3));opacity:.4}
}

/* ── ROLES ── */
.sec-roles{background:var(--white);padding:88px 0}
.rcard{border-radius:24px;padding:36px 28px;height:100%;transition:transform .2s,box-shadow .2s;position:relative;overflow:hidden}
.rcard.r1{background:linear-gradient(145deg,#e8f4fd,#d0eaf9);border:2px solid #b8dff5}
.rcard.r2{background:linear-gradient(145deg,#fff8e7,#ffefc4);border:2px solid #ffd980}
.rcard.r3{background:linear-gradient(145deg,#e8fdf4,#c8f5e4);border:2px solid #86efca}
.rcard:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(0,0,0,0.1)}
.rcard-icon{width:60px;height:60px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:18px;box-shadow:0 4px 14px rgba(0,0,0,0.1)}
.rcard-h{font-size:1rem;font-weight:800;color:var(--ink);margin-bottom:8px}
.rcard-p{font-size:0.835rem;color:var(--ink2);line-height:1.65;margin-bottom:16px}
.rcard-tag{font-size:0.65rem;font-weight:700;padding:4px 10px;border-radius:50px;display:inline-block;margin:2px;background:rgba(255,255,255,0.7);color:var(--ink2);border:1px solid rgba(0,0,0,0.08)}

/* ── CTA ── */
.sec-cta{background:linear-gradient(135deg,var(--blue) 0%,#1557b0 50%,#0d47a1 100%);padding:88px 0;position:relative;overflow:hidden}
.sec-cta::before{content:'';position:absolute;width:600px;height:600px;border-radius:50%;background:rgba(255,255,255,0.04);top:-200px;right:-200px}
.sec-cta::after{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(245,166,35,0.08);bottom:-150px;left:-100px}
.btn-cta-gold{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--gold),var(--gold2));color:#fff;border:none;border-radius:50px;padding:15px 36px;font-size:0.95rem;font-weight:800;box-shadow:0 6px 20px rgba(245,166,35,0.4);transition:transform .15s,box-shadow .15s;font-family:'Poppins',sans-serif}
.btn-cta-gold:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(245,166,35,0.5);color:#fff}

/* ── FOOTER ── */
footer{background:#0d1b2e;color:rgba(255,255,255,0.4);padding:48px 0 28px;font-size:0.82rem}
.ft-name{font-size:0.9rem;font-weight:800;color:#fff}
.ft-link{color:rgba(255,255,255,0.4);transition:color .15s;display:block;margin-bottom:8px}
.ft-link:hover{color:rgba(255,255,255,0.85)}
.ft-col-h{font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.2);margin-bottom:14px}
footer hr{border-color:rgba(255,255,255,0.07)!important;margin:28px 0 20px}

/* ── ANIMATE ── */
.fu{opacity:0;transform:translateY(16px);transition:opacity .5s ease,transform .5s ease}
.fu.in{opacity:1;transform:translateY(0)}

/* ── RESPONSIVE ── */
@media(max-width:991px){
  .hero-inner{padding:44px 0 32px}
  .sf1,.sf2,.sf3{display:none}
}
@media(max-width:767px){
  .hero-inner{padding:28px 0 24px}
  .hero-h{font-size:2rem;letter-spacing:-0.5px}
  .hero-sub{font-size:0.95rem}
  .hero-p{font-size:0.875rem;margin-bottom:24px}
  .btn-hero,.btn-hero-out{padding:12px 24px;font-size:0.875rem}
  .sec-features,.sec-how,.sec-roles,.sec-cta{padding:60px 0}
  .sec-h{font-size:1.5rem}
  .fc{padding:22px}
  .rcard{padding:28px 22px}
  footer{padding:36px 0 20px}
  footer .col-md-3,footer .col-md-4{text-align:center!important}
}
@media(max-width:480px){
  .hero-h{font-size:1.75rem}
  .brand-sub{display:none}
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
        <a href="{{ route('register') }}" class="btn-su">Sign Up ✨</a>
      </div>
      <div class="d-flex d-md-none">
        <button class="btn btn-link p-1" id="mmO" style="color:var(--ink2);font-size:1.15rem;"><i class="fas fa-bars"></i></button>
      </div>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="deco-circle dc1"></div>
  <div class="deco-circle dc2"></div>
  <div class="deco-circle dc3"></div>

  <div class="container">
    <div class="hero-inner">
      <div class="row align-items-center g-5">

        <!-- LEFT -->
        <div class="col-lg-6">
          <div class="hero-tag"><i class="fas fa-star"></i> Campus Facility Management System</div>
          <h1 class="hero-h">
            Report. Track.<br>
            <span class="gold">Resolve</span> <span class="blue">Faster.</span>
          </h1>
          <div class="hero-sub">Smarter campus maintenance for SCC 🏫</div>
          <p class="hero-p">SCC ReportHub connects faculty, administrators, and maintenance staff in one easy platform. Submit tickets, track repairs, and keep Southern Christian College running at its best.</p>
          <div class="d-flex align-items-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn-hero">
              <i class="fas fa-rocket"></i> Get Started Free
            </a>
            <a href="{{ route('login') }}" class="btn-hero-out">
              Sign In <i class="fas fa-arrow-right fa-xs"></i>
            </a>
          </div>
        </div>

        <!-- RIGHT: cartoon + floating cards -->
        <div class="col-lg-6 hero-right">

          <!-- Floating stat cards -->
          <div class="stat-float sf1">
            <div class="sf-icon">🎫</div>
            <div class="sf-val">24</div>
            <div class="sf-label">Active Tickets</div>
          </div>
          <div class="stat-float sf2">
            <div class="sf-icon">✅</div>
            <div class="sf-val">12</div>
            <div class="sf-label">Resolved Today</div>
          </div>
          <div class="stat-float sf3">
            <div class="sf-icon">⚡</div>
            <div class="sf-val">3</div>
            <div class="sf-label">Urgent</div>
          </div>

          <!-- SVG Cartoon Character — maintenance worker -->
          <div class="cartoon-wrap">
            <svg viewBox="0 0 400 420" width="100%" style="max-width:420px;filter:drop-shadow(0 20px 40px rgba(26,115,232,0.15))" xmlns="http://www.w3.org/2000/svg">
              <!-- Ground shadow -->
              <ellipse cx="200" cy="410" rx="120" ry="12" fill="rgba(26,115,232,0.08)"/>

              <!-- Body / shirt (blue) -->
              <rect x="130" y="220" width="140" height="130" rx="20" fill="#1a73e8"/>
              <!-- Shirt collar -->
              <polygon points="200,220 175,250 200,240 225,250" fill="#1557b0"/>
              <!-- Shirt pocket -->
              <rect x="155" y="250" width="35" height="28" rx="6" fill="#1557b0"/>
              <line x1="172" y1="250" x2="172" y2="278" stroke="#1a73e8" stroke-width="1.5"/>

              <!-- Pants (dark blue) -->
              <rect x="130" y="330" width="60" height="80" rx="10" fill="#1557b0"/>
              <rect x="210" y="330" width="60" height="80" rx="10" fill="#1557b0"/>
              <!-- Belt -->
              <rect x="130" y="325" width="140" height="14" rx="4" fill="#0d47a1"/>
              <rect x="188" y="326" width="24" height="12" rx="3" fill="#f5a623"/>

              <!-- Shoes -->
              <ellipse cx="160" cy="408" rx="36" ry="12" fill="#0d1b2e"/>
              <ellipse cx="240" cy="408" rx="36" ry="12" fill="#0d1b2e"/>

              <!-- Arms -->
              <rect x="80" y="225" width="55" height="28" rx="14" fill="#1a73e8" transform="rotate(20,80,225)"/>
              <rect x="265" y="225" width="55" height="28" rx="14" fill="#1a73e8" transform="rotate(-20,320,225)"/>

              <!-- Hands -->
              <circle cx="88" cy="278" r="18" fill="#fdbcb4"/>
              <circle cx="312" cy="278" r="18" fill="#fdbcb4"/>

              <!-- Wrench in right hand -->
              <rect x="302" y="260" width="10" height="40" rx="5" fill="#94a3b8" transform="rotate(30,307,280)"/>
              <rect x="296" y="256" width="22" height="10" rx="4" fill="#64748b" transform="rotate(30,307,261)"/>
              <rect x="296" y="282" width="22" height="10" rx="4" fill="#64748b" transform="rotate(30,307,287)"/>

              <!-- Clipboard in left hand -->
              <rect x="62" y="262" width="44" height="56" rx="6" fill="#fff" stroke="#e2e8f0" stroke-width="2"/>
              <rect x="68" y="256" width="32" height="10" rx="4" fill="#94a3b8"/>
              <rect x="68" y="276" width="32" height="3" rx="2" fill="#e2e8f0"/>
              <rect x="68" y="284" width="24" height="3" rx="2" fill="#e2e8f0"/>
              <rect x="68" y="292" width="28" height="3" rx="2" fill="#e2e8f0"/>
              <rect x="68" y="300" width="20" height="3" rx="2" fill="#1a73e8"/>

              <!-- Neck -->
              <rect x="182" y="195" width="36" height="30" rx="8" fill="#fdbcb4"/>

              <!-- Head -->
              <ellipse cx="200" cy="165" rx="62" ry="68" fill="#fdbcb4"/>

              <!-- Hair (hard hat) -->
              <ellipse cx="200" cy="118" rx="68" ry="22" fill="#f5a623"/>
              <rect x="132" y="108" width="136" height="28" rx="8" fill="#f5a623"/>
              <rect x="122" y="126" width="156" height="12" rx="6" fill="#e8941a"/>
              <!-- Hard hat brim -->
              <ellipse cx="200" cy="136" rx="76" ry="10" fill="#e8941a"/>
              <!-- Hard hat logo -->
              <circle cx="200" cy="118" r="12" fill="#1a73e8"/>
              <text x="200" y="123" text-anchor="middle" font-size="10" font-weight="900" fill="#fff" font-family="Poppins,sans-serif">SCC</text>

              <!-- Eyes -->
              <ellipse cx="178" cy="168" rx="10" ry="11" fill="#fff"/>
              <ellipse cx="222" cy="168" rx="10" ry="11" fill="#fff"/>
              <circle cx="180" cy="170" r="6" fill="#1a2332"/>
              <circle cx="224" cy="170" r="6" fill="#1a2332"/>
              <circle cx="182" cy="168" r="2" fill="#fff"/>
              <circle cx="226" cy="168" r="2" fill="#fff"/>

              <!-- Eyebrows -->
              <path d="M168 155 Q178 149 188 155" stroke="#8b6914" stroke-width="3" fill="none" stroke-linecap="round"/>
              <path d="M212 155 Q222 149 232 155" stroke="#8b6914" stroke-width="3" fill="none" stroke-linecap="round"/>

              <!-- Smile -->
              <path d="M182 188 Q200 202 218 188" stroke="#c97b4b" stroke-width="3" fill="none" stroke-linecap="round"/>

              <!-- Cheeks -->
              <ellipse cx="168" cy="185" rx="12" ry="8" fill="rgba(255,150,100,0.25)"/>
              <ellipse cx="232" cy="185" rx="12" ry="8" fill="rgba(255,150,100,0.25)"/>

              <!-- Speech bubble -->
              <rect x="240" y="60" width="140" height="60" rx="16" fill="#fff" stroke="#dde8f5" stroke-width="2"/>
              <polygon points="255,120 265,120 260,135" fill="#fff" stroke="#dde8f5" stroke-width="2"/>
              <polygon points="255,120 265,120 260,133" fill="#fff"/>
              <text x="310" y="84" text-anchor="middle" font-size="11" font-weight="700" fill="#1a73e8" font-family="Poppins,sans-serif">Need a repair?</text>
              <text x="310" y="100" text-anchor="middle" font-size="10" font-weight="600" fill="#4a5568" font-family="Poppins,sans-serif">Report it in seconds!</text>
              <text x="310" y="114" text-anchor="middle" font-size="13" font-family="Poppins,sans-serif">🔧 ✅ 🏫</text>
            </svg>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- WAVE -->
<div class="wave">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height:60px;width:100%">
    <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#ffffff"/>
  </svg>
</div>

<!-- FEATURES -->
<section class="sec-features" id="features">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">✨ Features</div>
      <h2 class="sec-h mb-3">Everything your campus needs 🏫</h2>
      <p class="sec-p">A focused set of tools built specifically for campus facility management at Southern Christian College.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4 fu">
        <div class="fc">
          <div class="fc-icon" style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:#1a73e8">🎫</div>
          <div class="fc-h">Quick Ticket Submission</div>
          <div class="fc-p">Report any facility issue in under a minute — add photos, set priority, and pick the location.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
        <div class="fc">
          <div class="fc-icon" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);color:#059669">📡</div>
          <div class="fc-h">Live Status Tracking</div>
          <div class="fc-p">See exactly where your ticket stands — from submission to completion — in real time.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
        <div class="fc">
          <div class="fc-icon" style="background:linear-gradient(135deg,#fef3c7,#fde68a);color:#d97706">🔔</div>
          <div class="fc-h">Smart Notifications</div>
          <div class="fc-p">Automatic alerts when your ticket is approved, assigned, or resolved. No chasing needed.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.06s">
        <div class="fc">
          <div class="fc-icon" style="background:linear-gradient(135deg,#ede9fe,#ddd6fe);color:#7c3aed">📊</div>
          <div class="fc-h">Admin Control Center</div>
          <div class="fc-p">Full visibility with charts, stats, and complete control over tickets, users, and facilities.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.12s">
        <div class="fc">
          <div class="fc-icon" style="background:linear-gradient(135deg,#e0f2fe,#bae6fd);color:#0284c7">🔧</div>
          <div class="fc-h">Maintenance Workflow</div>
          <div class="fc-p">Maintenance staff get a clear task queue, progress tools, and completion tracking.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 fu" style="transition-delay:.18s">
        <div class="fc">
          <div class="fc-icon" style="background:linear-gradient(135deg,#ffe4e6,#fecdd3);color:#e11d48">⭐</div>
          <div class="fc-h">Service Ratings</div>
          <div class="fc-p">Faculty rate completed repairs — giving admins the data to improve service quality.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec-how" id="how-it-works">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">🗺️ How It Works</div>
      <h2 class="sec-h mb-3">Four simple steps 🚀</h2>
    </div>
    <div class="row g-4 fu">
      <div class="col-6 col-md-3">
        <div class="step-wrap position-relative">
          <div class="step-connector"></div>
          <div class="step-num">1</div>
          <div class="step-h">Submit 📝</div>
          <div class="step-p">Faculty reports the issue with details, priority, and a photo.</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="step-wrap position-relative">
          <div class="step-connector"></div>
          <div class="step-num">2</div>
          <div class="step-h">Review 👀</div>
          <div class="step-p">Admin approves and assigns to the right maintenance staff.</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="step-wrap position-relative">
          <div class="step-connector"></div>
          <div class="step-num">3</div>
          <div class="step-h">Repair 🔨</div>
          <div class="step-p">Maintenance works on the task and logs real-time progress.</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="step-wrap">
          <div class="step-num">4</div>
          <div class="step-h">Done! ✅</div>
          <div class="step-p">Admin confirms. Faculty rates the service. Ticket closed.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ROLES -->
<section class="sec-roles" id="roles">
  <div class="container">
    <div class="text-center mb-5 fu">
      <div class="sec-tag">👥 Who It's For</div>
      <h2 class="sec-h mb-3">One platform, three portals 🎯</h2>
      <p class="sec-p">Each role gets a dedicated experience built around their specific responsibilities.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4 fu">
        <div class="rcard r1">
          <div class="rcard-icon" style="background:linear-gradient(135deg,#1a73e8,#1557b0);color:#fff">👨‍💼</div>
          <div class="rcard-h">Administrator</div>
          <div class="rcard-p">Oversee all tickets, manage users and facilities, assign maintenance staff, and monitor performance through analytics.</div>
          <div>
            <span class="rcard-tag">🎫 Ticket Control</span>
            <span class="rcard-tag">👥 User Management</span>
            <span class="rcard-tag">📊 Analytics</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 fu" style="transition-delay:.08s">
        <div class="rcard r2">
          <div class="rcard-icon" style="background:linear-gradient(135deg,#f5a623,#e8941a);color:#fff">👩‍🏫</div>
          <div class="rcard-h">Faculty & Staff</div>
          <div class="rcard-p">Submit facility issues, track repair status in real time, and rate the service quality once your request is resolved.</div>
          <div>
            <span class="rcard-tag">📝 Submit Issues</span>
            <span class="rcard-tag">📡 Track Status</span>
            <span class="rcard-tag">⭐ Rate Service</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 fu" style="transition-delay:.16s">
        <div class="rcard r3">
          <div class="rcard-icon" style="background:linear-gradient(135deg,#059669,#047857);color:#fff">👷</div>
          <div class="rcard-h">Maintenance Staff</div>
          <div class="rcard-p">View your assigned task queue, log repair progress, and mark jobs complete — all from one clean interface.</div>
          <div>
            <span class="rcard-tag">📋 Task Queue</span>
            <span class="rcard-tag">🔧 Log Progress</span>
            <span class="rcard-tag">📁 Job History</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="sec-cta">
  <div class="container text-center" style="position:relative;z-index:1;">
    <div class="fu">
      <div style="font-size:2rem;margin-bottom:12px;">🎉</div>
      <div style="font-size:0.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:rgba(255,255,255,0.6);margin-bottom:10px;">Get Started Today</div>
      <h2 style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;color:#fff;letter-spacing:-0.5px;margin-bottom:14px;">Ready to transform your campus? 🏫</h2>
      <p style="font-size:0.95rem;color:rgba(255,255,255,0.75);max-width:480px;margin:0 auto 32px;line-height:1.7;">Free for all SCC faculty and staff. Create your account and start reporting facility issues in minutes.</p>
      <a href="{{ route('register') }}" class="btn-cta-gold">
        🚀 Create an Account — It's Free
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
      <span>Midsayap, Cotabato, Philippines 🇵🇭</span>
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
