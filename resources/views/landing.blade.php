<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCC ReportHub - Report, Track, and Resolve Campus Concerns</title>
    <meta name="description" content="SCC ReportHub empowers students, faculty, and administrators to report environmental issues and campus concerns in real-time.">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6.5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ===== CSS CUSTOM PROPERTIES ===== */
        :root {
            --blue-dark:    #1e40af;
            --blue-mid:     #2563eb;
            --blue-light:   #3b82f6;
            --purple-dark:  #7c3aed;
            --purple-light: #a855f7;
            --white:        #ffffff;
            --gray-50:      #f8fafc;
            --gray-100:     #f1f5f9;
            --gray-200:     #e2e8f0;
            --gray-600:     #475569;
            --gray-700:     #334155;
            --gray-900:     #0f172a;
            --gradient-main: linear-gradient(135deg, var(--blue-dark), var(--purple-dark));
            --gradient-light: linear-gradient(135deg, #eff6ff, #f5f3ff);
            --glass-bg:     rgba(255,255,255,0.1);
            --glass-border: rgba(255,255,255,0.2);
            --shadow-card:  0 8px 32px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 60px rgba(0,0,0,0.15);
            --radius-card:  16px;
            --radius-lg:    20px;
            --transition:   all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--gray-700);
            background: var(--white);
            overflow-x: hidden;
        }

        /* ===== UTILITY ===== */
        .gradient-text {
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-gradient {
            background: var(--gradient-main);
            color: var(--white);
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(30,64,175,0.4);
            color: var(--white);
        }

        .btn-outline-white {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255,255,255,0.6);
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-outline-white:hover {
            background: rgba(255,255,255,0.15);
            border-color: var(--white);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-outline-primary-custom {
            background: transparent;
            color: var(--blue-dark);
            border: 2px solid var(--blue-dark);
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-outline-primary-custom:hover {
            background: var(--blue-dark);
            color: var(--white);
            transform: translateY(-2px);
        }

        .section-padding { padding: 96px 0; }
        @media (max-width: 768px) { .section-padding { padding: 60px 0; } }

        /* ===== FADE-IN ANIMATION ===== */
        .fade-in-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .fade-in-up.delay-1 { transition-delay: 0.1s; }
        .fade-in-up.delay-2 { transition-delay: 0.2s; }
        .fade-in-up.delay-3 { transition-delay: 0.3s; }
        .fade-in-up.delay-4 { transition-delay: 0.4s; }
        .fade-in-up.delay-5 { transition-delay: 0.5s; }
        .fade-in-up.delay-6 { transition-delay: 0.6s; }
        .fade-in-up.delay-7 { transition-delay: 0.7s; }
        .fade-in-up.delay-8 { transition-delay: 0.8s; }

        /* ===== NAVBAR ===== */
        #mainNav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 14px 0;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.3);
            transition: var(--transition);
        }
        #mainNav.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
        }
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .navbar-brand-custom img {
            height: 40px;
            width: auto;
        }
        .navbar-brand-custom span {
            font-size: 1.2rem;
            font-weight: 800;
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link-custom {
            color: var(--gray-700) !important;
            font-weight: 500;
            font-size: 0.92rem;
            padding: 6px 14px !important;
            border-radius: 8px;
            transition: var(--transition);
            text-decoration: none;
        }
        .nav-link-custom:hover {
            color: var(--blue-dark) !important;
            background: rgba(30,64,175,0.06);
        }
        .navbar-toggler-custom {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            display: none;
        }
        .navbar-toggler-custom span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--gray-700);
            margin: 5px 0;
            transition: var(--transition);
            border-radius: 2px;
        }

        /* Mobile overlay menu */
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.97);
            z-index: 2000;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 28px;
        }
        .mobile-menu-overlay.open { display: flex; }
        .mobile-menu-overlay a {
            color: var(--white);
            font-size: 1.4rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }
        .mobile-menu-overlay a:hover { color: var(--blue-light); }
        .mobile-close-btn {
            position: absolute;
            top: 24px; right: 24px;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.8rem;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .navbar-toggler-custom { display: block; }
            .nav-links-desktop { display: none !important; }
        }

        /* ===== HERO ===== */
        #hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 50%, #eff6ff 100%);
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }
        .hero-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.12;
            animation: floatCircle 8s ease-in-out infinite;
        }
        .hero-circle-1 {
            width: 500px; height: 500px;
            background: var(--gradient-main);
            top: -150px; right: -100px;
            animation-delay: 0s;
        }
        .hero-circle-2 {
            width: 300px; height: 300px;
            background: linear-gradient(135deg, var(--blue-light), var(--purple-light));
            bottom: -80px; left: -80px;
            animation-delay: 3s;
        }
        .hero-circle-3 {
            width: 180px; height: 180px;
            background: var(--purple-light);
            top: 30%; left: 40%;
            animation-delay: 5s;
        }
        @keyframes floatCircle {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.03); }
        }
        .hero-headline {
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 900;
            line-height: 1.15;
            color: var(--gray-900);
            margin-bottom: 20px;
        }
        .hero-sub {
            font-size: 1.05rem;
            color: var(--gray-600);
            line-height: 1.75;
            margin-bottom: 36px;
            max-width: 520px;
        }
        .hero-cta-group { display: flex; gap: 14px; flex-wrap: wrap; }

        /* Dashboard Mockup */
        .dashboard-mockup {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: 0 30px 80px rgba(30,64,175,0.18);
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        .mockup-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--gray-100);
        }
        .mockup-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }
        .mockup-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-left: 6px;
        }
        .mockup-stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
        }
        .mockup-stat-card {
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }
        .mockup-stat-card .stat-num {
            font-size: 1.3rem;
            font-weight: 800;
            display: block;
        }
        .mockup-stat-card .stat-lbl {
            font-size: 0.65rem;
            font-weight: 500;
            opacity: 0.8;
        }
        .mockup-stat-card.blue  { background: linear-gradient(135deg,#dbeafe,#eff6ff); color: var(--blue-dark); }
        .mockup-stat-card.green { background: linear-gradient(135deg,#dcfce7,#f0fdf4); color: #166534; }
        .mockup-stat-card.amber { background: linear-gradient(135deg,#fef9c3,#fefce8); color: #92400e; }
        .mockup-stat-card.purple{ background: linear-gradient(135deg,#f3e8ff,#faf5ff); color: var(--purple-dark); }
        .mockup-ticket-list { display: flex; flex-direction: column; gap: 7px; }
        .mockup-ticket {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            background: var(--gray-50);
            border-radius: 8px;
            font-size: 0.72rem;
        }
        .mockup-ticket-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .mockup-ticket-text { flex: 1; color: var(--gray-700); font-weight: 500; }
        .mockup-badge {
            font-size: 0.6rem;
            padding: 2px 7px;
            border-radius: 20px;
            font-weight: 600;
        }
        .badge-resolved  { background: #dcfce7; color: #166534; }
        .badge-pending   { background: #fef9c3; color: #92400e; }
        .badge-open      { background: #dbeafe; color: var(--blue-dark); }

        /* ===== FEATURES ===== */
        #features { background: var(--gray-50); }
        .section-label {
            display: inline-block;
            background: linear-gradient(135deg, rgba(30,64,175,0.1), rgba(124,58,237,0.1));
            color: var(--blue-dark);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 14px;
        }
        .section-title {
            font-size: clamp(1.7rem, 3vw, 2.5rem);
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 14px;
            line-height: 1.2;
        }
        .section-sub {
            font-size: 1rem;
            color: var(--gray-600);
            max-width: 560px;
            margin: 0 auto 56px;
            line-height: 1.7;
        }
        .feature-card {
            background: var(--white);
            border-radius: var(--radius-card);
            padding: 32px 28px;
            box-shadow: var(--shadow-card);
            transition: var(--transition);
            height: 100%;
            border: 1px solid var(--gray-100);
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(59,130,246,0.2);
        }
        .feature-icon-wrap {
            width: 56px; height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            font-size: 1.3rem;
            color: var(--white);
        }
        .feature-card h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 10px;
        }
        .feature-card p {
            font-size: 0.88rem;
            color: var(--gray-600);
            line-height: 1.65;
            margin: 0;
        }

        /* ===== HOW IT WORKS ===== */
        #how-it-works { background: var(--white); }
        .steps-wrapper {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }
        .steps-line {
            position: absolute;
            top: 36px;
            left: 10%;
            right: 10%;
            height: 3px;
            background: linear-gradient(90deg, var(--blue-dark), var(--purple-dark));
            z-index: 0;
            border-radius: 2px;
        }
        .step-item {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .step-circle {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: var(--gradient-main);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 1.3rem;
            box-shadow: 0 8px 24px rgba(30,64,175,0.3);
            position: relative;
        }
        .step-num {
            position: absolute;
            top: -6px; right: -6px;
            width: 22px; height: 22px;
            background: var(--white);
            border: 2px solid var(--blue-dark);
            border-radius: 50%;
            font-size: 0.65rem;
            font-weight: 800;
            color: var(--blue-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .step-item h6 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 8px;
        }
        .step-item p {
            font-size: 0.8rem;
            color: var(--gray-600);
            line-height: 1.6;
        }
        @media (max-width: 768px) {
            .steps-wrapper { flex-direction: column; align-items: center; }
            .steps-line { display: none; }
            .step-item { width: 100%; max-width: 320px; }
        }

        /* ===== ABOUT ===== */
        #about { background: var(--gradient-light); }
        .about-visual {
            background: var(--gradient-main);
            border-radius: var(--radius-lg);
            padding: 40px 32px;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        .about-visual::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        .about-visual::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -30px;
            width: 250px; height: 250px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .about-stat-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 24px;
            position: relative;
            z-index: 1;
        }
        .about-stat-box {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
        }
        .about-stat-box .num {
            font-size: 1.6rem;
            font-weight: 800;
            display: block;
        }
        .about-stat-box .lbl {
            font-size: 0.75rem;
            opacity: 0.85;
        }
        .mission-quote {
            background: var(--white);
            border-left: 4px solid var(--blue-dark);
            border-radius: 0 12px 12px 0;
            padding: 20px 24px;
            margin-top: 28px;
            box-shadow: var(--shadow-card);
        }
        .mission-quote p {
            font-size: 0.95rem;
            font-style: italic;
            color: var(--gray-700);
            line-height: 1.7;
            margin: 0;
        }

        /* ===== STATISTICS ===== */
        #statistics {
            background: linear-gradient(135deg, var(--gray-900) 0%, #1e1b4b 50%, #1e3a5f 100%);
            position: relative;
            overflow: hidden;
        }
        #statistics::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .stat-counter-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: var(--radius-card);
            padding: 40px 28px;
            text-align: center;
            transition: var(--transition);
        }
        .stat-counter-card:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-6px);
        }
        .stat-icon {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: var(--gradient-main);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 1.4rem;
            color: var(--white);
        }
        .stat-number {
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--white);
            line-height: 1;
            margin-bottom: 6px;
        }
        .stat-suffix { color: var(--blue-light); }
        .stat-label {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.65);
            font-weight: 500;
        }

        /* ===== USER ROLES ===== */
        #roles { background: var(--gray-50); }
        .role-card {
            background: var(--white);
            border-radius: var(--radius-card);
            padding: 36px 28px;
            box-shadow: var(--shadow-card);
            transition: var(--transition);
            height: 100%;
            border-top: 4px solid transparent;
        }
        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }
        .role-card.student  { border-top-color: var(--blue-light); }
        .role-card.faculty  { border-top-color: var(--purple-dark); }
        .role-card.admin    { border-top-color: #059669; }
        .role-icon-wrap {
            width: 70px; height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.6rem;
        }
        .role-card.student .role-icon-wrap  { background: linear-gradient(135deg,#dbeafe,#eff6ff); color: var(--blue-dark); }
        .role-card.faculty .role-icon-wrap  { background: linear-gradient(135deg,#f3e8ff,#faf5ff); color: var(--purple-dark); }
        .role-card.admin   .role-icon-wrap  { background: linear-gradient(135deg,#dcfce7,#f0fdf4); color: #059669; }
        .role-card h4 { font-size: 1.15rem; font-weight: 800; color: var(--gray-900); margin-bottom: 10px; }
        .role-card .role-desc { font-size: 0.88rem; color: var(--gray-600); line-height: 1.65; margin-bottom: 20px; }
        .role-list { list-style: none; padding: 0; margin: 0; }
        .role-list li {
            font-size: 0.85rem;
            color: var(--gray-700);
            padding: 6px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--gray-100);
        }
        .role-list li:last-child { border-bottom: none; }
        .role-list li i { font-size: 0.75rem; color: var(--blue-light); }

        /* ===== TESTIMONIALS ===== */
        #testimonials { background: var(--white); }
        .testimonial-card {
            background: var(--white);
            border-radius: var(--radius-card);
            padding: 32px 28px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            border: 1px solid var(--gray-100);
            transition: var(--transition);
            height: 100%;
        }
        .testimonial-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }
        .quote-icon {
            font-size: 2.5rem;
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 16px;
        }
        .testimonial-text {
            font-size: 0.92rem;
            color: var(--gray-600);
            line-height: 1.75;
            font-style: italic;
            margin-bottom: 24px;
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .author-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            flex-shrink: 0;
        }
        .author-name { font-size: 0.9rem; font-weight: 700; color: var(--gray-900); }
        .author-role { font-size: 0.78rem; color: var(--gray-600); }

        /* ===== FOOTER ===== */
        #footer {
            background: var(--gray-900);
            color: rgba(255,255,255,0.75);
        }
        .footer-brand img { height: 44px; margin-bottom: 14px; }
        .footer-brand p { font-size: 0.88rem; line-height: 1.7; color: rgba(255,255,255,0.6); }
        .footer-heading {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 18px;
        }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.88rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .footer-links a:hover { color: var(--blue-light); padding-left: 4px; }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 0.88rem;
            color: rgba(255,255,255,0.6);
        }
        .footer-contact-item i { color: var(--blue-light); margin-top: 2px; flex-shrink: 0; }
        .social-icons { display: flex; gap: 10px; margin-top: 16px; }
        .social-icon {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        .social-icon:hover {
            background: var(--gradient-main);
            border-color: transparent;
            color: var(--white);
            transform: translateY(-3px);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 20px 0;
            margin-top: 48px;
            text-align: center;
            font-size: 0.83rem;
            color: rgba(255,255,255,0.4);
        }
        .footer-bottom a { color: var(--blue-light); text-decoration: none; }

        /* ===== BACK TO TOP ===== */
        #backToTop {
            position: fixed;
            bottom: 28px; right: 28px;
            width: 44px; height: 44px;
            background: var(--gradient-main);
            color: var(--white);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
            z-index: 999;
            box-shadow: 0 4px 16px rgba(30,64,175,0.4);
        }
        #backToTop.visible { opacity: 1; transform: translateY(0); }
        #backToTop:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

<!-- ===== BACK TO TOP ===== -->
<button id="backToTop" aria-label="Back to top"><i class="fas fa-chevron-up"></i></button>

<!-- ===== MOBILE MENU OVERLAY ===== -->
<div class="mobile-menu-overlay" id="mobileMenu">
    <button class="mobile-close-btn" id="mobileClose" aria-label="Close menu"><i class="fas fa-times"></i></button>
    <a href="#features" onclick="closeMobileMenu()">Features</a>
    <a href="#how-it-works" onclick="closeMobileMenu()">How It Works</a>
    <a href="#roles" onclick="closeMobileMenu()">Roles</a>
    <a href="#about" onclick="closeMobileMenu()">About</a>
    <div style="display:flex;gap:14px;margin-top:10px;flex-wrap:wrap;justify-content:center;">
        <a href="{{ route('login') }}" class="btn-outline-white">Sign In</a>
        <a href="{{ route('register') }}" class="btn-gradient">Get Started</a>
    </div>
</div>

<!-- ===== NAVBAR ===== -->
<nav id="mainNav">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Brand -->
            <a href="{{ route('landing') }}" class="navbar-brand-custom">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo">
                <span>SCC ReportHub</span>
            </a>

            <!-- Desktop Nav Links -->
            <div class="nav-links-desktop d-flex align-items-center gap-1">
                <a href="#features"    class="nav-link-custom">Features</a>
                <a href="#how-it-works" class="nav-link-custom">How It Works</a>
                <a href="#roles"       class="nav-link-custom">Roles</a>
                <a href="#about"       class="nav-link-custom">About</a>
            </div>

            <!-- Desktop CTA -->
            <div class="nav-links-desktop d-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-outline-primary-custom" style="padding:8px 22px;font-size:0.88rem;">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </a>
                <a href="{{ route('register') }}" class="btn-gradient" style="padding:8px 22px;font-size:0.88rem;">
                    <i class="fas fa-rocket"></i> Get Started
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button class="navbar-toggler-custom" id="mobileToggle" aria-label="Open menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section id="hero">
    <!-- Decorative circles -->
    <div class="hero-circle hero-circle-1"></div>
    <div class="hero-circle hero-circle-2"></div>
    <div class="hero-circle hero-circle-3"></div>

    <div class="container py-5">
        <div class="row align-items-center g-5">
            <!-- Left: Text -->
            <div class="col-lg-6">
                <div class="fade-in-up">
                    <span class="section-label"><i class="fas fa-shield-alt me-1"></i> Campus Issue Management</span>
                    <h1 class="hero-headline mt-2">
                        Report, Track, and Resolve
                        <span class="gradient-text"> Campus Concerns</span>
                        Efficiently
                    </h1>
                    <p class="hero-sub">
                        SCC ReportHub empowers students, faculty, and administrators to report environmental issues and campus concerns in real-time — keeping Southern Christian College safe, clean, and responsive.
                    </p>
                    <div class="hero-cta-group">
                        <a href="{{ route('register') }}" class="btn-gradient">
                            <i class="fas fa-rocket"></i> Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn-outline-primary-custom">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-4 mt-4" style="flex-wrap:wrap;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle" style="color:var(--blue-dark);"></i>
                            <span style="font-size:0.85rem;color:var(--gray-600);">Free to use</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle" style="color:var(--blue-dark);"></i>
                            <span style="font-size:0.85rem;color:var(--gray-600);">Real-time tracking</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle" style="color:var(--blue-dark);"></i>
                            <span style="font-size:0.85rem;color:var(--gray-600);">Secure & private</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Dashboard Mockup -->
            <div class="col-lg-6 fade-in-up delay-3">
                <div class="dashboard-mockup">
                    <div class="mockup-header">
                        <div class="mockup-dot" style="background:#ef4444;"></div>
                        <div class="mockup-dot" style="background:#f59e0b;"></div>
                        <div class="mockup-dot" style="background:#22c55e;"></div>
                        <span class="mockup-title"><i class="fas fa-tachometer-alt me-1" style="color:var(--blue-dark);"></i> Admin Dashboard — SCC ReportHub</span>
                    </div>
                    <div class="mockup-stat-grid">
                        <div class="mockup-stat-card blue">
                            <span class="stat-num">248</span>
                            <span class="stat-lbl"><i class="fas fa-ticket-alt me-1"></i>Total Reports</span>
                        </div>
                        <div class="mockup-stat-card green">
                            <span class="stat-num">189</span>
                            <span class="stat-lbl"><i class="fas fa-check-circle me-1"></i>Resolved</span>
                        </div>
                        <div class="mockup-stat-card amber">
                            <span class="stat-num">42</span>
                            <span class="stat-lbl"><i class="fas fa-clock me-1"></i>Pending</span>
                        </div>
                        <div class="mockup-stat-card purple">
                            <span class="stat-num">156</span>
                            <span class="stat-lbl"><i class="fas fa-users me-1"></i>Active Users</span>
                        </div>
                    </div>
                    <div style="font-size:0.72rem;font-weight:700;color:var(--gray-700);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">
                        <i class="fas fa-list me-1" style="color:var(--blue-dark);"></i> Recent Reports
                    </div>
                    <div class="mockup-ticket-list">
                        <div class="mockup-ticket">
                            <div class="mockup-ticket-dot" style="background:#22c55e;"></div>
                            <span class="mockup-ticket-text">Broken classroom projector — Rm 204</span>
                            <span class="mockup-badge badge-resolved">Resolved</span>
                        </div>
                        <div class="mockup-ticket">
                            <div class="mockup-ticket-dot" style="background:#f59e0b;"></div>
                            <span class="mockup-ticket-text">Leaking pipe near canteen area</span>
                            <span class="mockup-badge badge-pending">Pending</span>
                        </div>
                        <div class="mockup-ticket">
                            <div class="mockup-ticket-dot" style="background:#3b82f6;"></div>
                            <span class="mockup-ticket-text">Broken bench — Main Corridor</span>
                            <span class="mockup-badge badge-open">Open</span>
                        </div>
                        <div class="mockup-ticket">
                            <div class="mockup-ticket-dot" style="background:#22c55e;"></div>
                            <span class="mockup-ticket-text">Faulty electrical outlet — Lab 3</span>
                            <span class="mockup-badge badge-resolved">Resolved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURES ===== -->
<section id="features" class="section-padding">
    <div class="container">
        <div class="text-center fade-in-up">
            <span class="section-label"><i class="fas fa-star me-1"></i> Features</span>
            <h2 class="section-title">Everything You Need to Manage Campus Issues</h2>
            <p class="section-sub">A comprehensive platform built for Southern Christian College to streamline issue reporting, tracking, and resolution.</p>
        </div>
        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-1">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#1e40af,#3b82f6);">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5>Real-Time Issue Reporting</h5>
                    <p>Submit campus concerns instantly from any device. Reports are logged in real-time and immediately visible to administrators for swift action.</p>
                </div>
            </div>
            <!-- Feature 2 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-2">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h5>Complaint Tracking System</h5>
                    <p>Follow every report from submission to resolution. A transparent ticket system keeps all stakeholders informed at every stage of the process.</p>
                </div>
            </div>
            <!-- Feature 3 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-3">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#0891b2,#06b6d4);">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h5>Image Evidence Upload</h5>
                    <p>Attach photos directly to your reports to provide clear visual evidence. Images help administrators assess and prioritize issues more accurately.</p>
                </div>
            </div>
            <!-- Feature 4 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-4">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#059669,#10b981);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Status Monitoring</h5>
                    <p>Track the live status of every submitted report — Open, In Progress, or Resolved. Get notified when your report status changes.</p>
                </div>
            </div>
            <!-- Feature 5 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-5">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#dc2626,#ef4444);">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h5>Administrative Dashboard</h5>
                    <p>A powerful admin panel gives administrators a bird's-eye view of all reports, user activity, and facility status across the entire campus.</p>
                </div>
            </div>
            <!-- Feature 6 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-6">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#d97706,#f59e0b);">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h5>Analytics and Reports</h5>
                    <p>Generate detailed reports and visualize trends in campus issues. Data-driven insights help administrators make informed maintenance decisions.</p>
                </div>
            </div>
            <!-- Feature 7 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-7">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#7c3aed,#1e40af);">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h5>Multi-Role Access Management</h5>
                    <p>Distinct roles for Students, Faculty, and Administrators ensure each user sees only what's relevant to them, with appropriate permissions.</p>
                </div>
            </div>
            <!-- Feature 8 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-8">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#0f172a,#1e3a5f);">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Secure Data Storage</h5>
                    <p>All reports and user data are stored securely with encryption and access controls. Your information is protected and only accessible to authorized personnel.</p>
                </div>
            </div>
            <!-- Feature 9 - centered -->
            <div class="col-lg-4 col-md-6 mx-auto fade-in-up delay-1">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:linear-gradient(135deg,#0891b2,#7c3aed);">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h5>Instant Notifications</h5>
                    <p>Receive real-time notifications when your report is reviewed, updated, or resolved. Stay informed without having to manually check the system.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section id="how-it-works" class="section-padding">
    <div class="container">
        <div class="text-center fade-in-up">
            <span class="section-label"><i class="fas fa-map-signs me-1"></i> Process</span>
            <h2 class="section-title">How SCC ReportHub Works</h2>
            <p class="section-sub">A simple, transparent five-step process that takes your concern from submission to resolution.</p>
        </div>

        <div class="steps-wrapper fade-in-up delay-2">
            <!-- Connecting line (desktop only) -->
            <div class="steps-line"></div>

            <!-- Step 1 -->
            <div class="step-item">
                <div class="step-circle">
                    <i class="fas fa-file-alt"></i>
                    <span class="step-num">1</span>
                </div>
                <h6>Submit a Report</h6>
                <p>Fill out the report form with details about the issue, attach photos, and select the affected facility or area on campus.</p>
            </div>

            <!-- Step 2 -->
            <div class="step-item">
                <div class="step-circle">
                    <i class="fas fa-user-check"></i>
                    <span class="step-num">2</span>
                </div>
                <h6>Review by Administrator</h6>
                <p>An administrator receives and reviews your report, assessing the severity and assigning it to the appropriate maintenance team.</p>
            </div>

            <!-- Step 3 -->
            <div class="step-item">
                <div class="step-circle">
                    <i class="fas fa-search"></i>
                    <span class="step-num">3</span>
                </div>
                <h6>Verification Process</h6>
                <p>The maintenance team verifies the issue on-site, confirms the details, and updates the report status to "In Progress".</p>
            </div>

            <!-- Step 4 -->
            <div class="step-item">
                <div class="step-circle">
                    <i class="fas fa-tools"></i>
                    <span class="step-num">4</span>
                </div>
                <h6>Resolution and Updates</h6>
                <p>The issue is addressed and resolved. The reporter receives a notification and the report is marked as "Resolved" with notes.</p>
            </div>

            <!-- Step 5 -->
            <div class="step-item">
                <div class="step-circle">
                    <i class="fas fa-chart-line"></i>
                    <span class="step-num">5</span>
                </div>
                <h6>Status Tracking</h6>
                <p>All stakeholders can track the full history of any report at any time, ensuring complete transparency and accountability.</p>
            </div>
        </div>

        <!-- CTA below steps -->
        <div class="text-center mt-5 fade-in-up delay-4">
            <a href="{{ route('register') }}" class="btn-gradient">
                <i class="fas fa-rocket"></i> Start Reporting Now
            </a>
        </div>
    </div>
</section>

<!-- ===== ABOUT ===== -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left: Text -->
            <div class="col-lg-6 fade-in-up">
                <span class="section-label"><i class="fas fa-info-circle me-1"></i> About</span>
                <h2 class="section-title mt-2">A Centralized Platform for Campus Concerns</h2>
                <p style="color:var(--gray-600);line-height:1.8;margin-bottom:18px;">
                    SCC ReportHub is a dedicated issue management system developed for <strong>Southern Christian College</strong> in Midsayap, Cotabato. It bridges the gap between campus community members and administrators by providing a structured, transparent channel for reporting and resolving environmental and facility concerns.
                </p>
                <p style="color:var(--gray-600);line-height:1.8;margin-bottom:24px;">
                    Whether it's a broken classroom fixture, a safety hazard, or a maintenance request, SCC ReportHub ensures every concern is heard, tracked, and resolved — creating a safer and better-maintained campus for everyone.
                </p>
                <div class="mission-quote">
                    <p>"Our mission is to empower every member of the SCC community to actively participate in maintaining a safe, clean, and functional campus environment through technology-driven transparency and accountability."</p>
                </div>
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <a href="{{ route('register') }}" class="btn-gradient">
                        <i class="fas fa-user-plus"></i> Join the Community
                    </a>
                    <a href="#features" class="btn-outline-primary-custom">
                        <i class="fas fa-eye"></i> Explore Features
                    </a>
                </div>
            </div>

            <!-- Right: Visual -->
            <div class="col-lg-6 fade-in-up delay-3">
                <div class="about-visual">
                    <div style="position:relative;z-index:1;">
                        <div style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;opacity:0.8;margin-bottom:8px;">
                            <i class="fas fa-university me-2"></i>Southern Christian College
                        </div>
                        <h3 style="font-size:1.6rem;font-weight:800;margin-bottom:8px;">SCC ReportHub</h3>
                        <p style="font-size:0.9rem;opacity:0.85;line-height:1.7;margin-bottom:0;">
                            Transforming how campus issues are reported, managed, and resolved — one report at a time.
                        </p>
                    </div>
                    <div class="about-stat-row">
                        <div class="about-stat-box">
                            <span class="num">500+</span>
                            <span class="lbl">Registered Users</span>
                        </div>
                        <div class="about-stat-box">
                            <span class="num">1,200+</span>
                            <span class="lbl">Reports Submitted</span>
                        </div>
                        <div class="about-stat-box">
                            <span class="num">98%</span>
                            <span class="lbl">Resolution Rate</span>
                        </div>
                        <div class="about-stat-box">
                            <span class="num">24/7</span>
                            <span class="lbl">System Availability</span>
                        </div>
                    </div>
                    <div style="margin-top:24px;position:relative;z-index:1;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                            <div style="width:36px;height:36px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-check" style="font-size:0.85rem;"></i>
                            </div>
                            <span style="font-size:0.88rem;opacity:0.9;">Multi-role access for Students, Faculty & Admins</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                            <div style="width:36px;height:36px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-check" style="font-size:0.85rem;"></i>
                            </div>
                            <span style="font-size:0.88rem;opacity:0.9;">Real-time notifications and status updates</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-check" style="font-size:0.85rem;"></i>
                            </div>
                            <span style="font-size:0.88rem;opacity:0.9;">Secure, encrypted data storage and privacy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATISTICS ===== -->
<section id="statistics" class="section-padding">
    <div class="container" style="position:relative;z-index:1;">
        <div class="text-center fade-in-up mb-5">
            <span class="section-label" style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.9);border:1px solid rgba(255,255,255,0.2);">
                <i class="fas fa-chart-bar me-1"></i> By the Numbers
            </span>
            <h2 class="section-title mt-2" style="color:var(--white);">SCC ReportHub in Action</h2>
            <p class="section-sub" style="color:rgba(255,255,255,0.65);">Real impact across the Southern Christian College campus community.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 fade-in-up delay-1">
                <div class="stat-counter-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number">
                        <span class="counter" data-target="500">0</span><span class="stat-suffix">+</span>
                    </div>
                    <div class="stat-label">Registered Users</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in-up delay-2">
                <div class="stat-counter-card">
                    <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
                    <div class="stat-number">
                        <span class="counter" data-target="1200">0</span><span class="stat-suffix">+</span>
                    </div>
                    <div class="stat-label">Reports Submitted</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in-up delay-3">
                <div class="stat-counter-card">
                    <div class="stat-icon"><i class="fas fa-check-double"></i></div>
                    <div class="stat-number">
                        <span class="counter" data-target="980">0</span><span class="stat-suffix">+</span>
                    </div>
                    <div class="stat-label">Resolved Cases</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in-up delay-4">
                <div class="stat-counter-card">
                    <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
                    <div class="stat-number">
                        <span class="counter" data-target="320">0</span><span class="stat-suffix">+</span>
                    </div>
                    <div class="stat-label">Active Users</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== USER ROLES ===== -->
<section id="roles" class="section-padding">
    <div class="container">
        <div class="text-center fade-in-up">
            <span class="section-label"><i class="fas fa-id-badge me-1"></i> User Roles</span>
            <h2 class="section-title mt-2">Built for Every Campus Member</h2>
            <p class="section-sub">SCC ReportHub provides tailored experiences for each type of user, ensuring everyone has the right tools for their role.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Student -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-1">
                <div class="role-card student">
                    <div class="role-icon-wrap"><i class="fas fa-user-graduate"></i></div>
                    <h4>Student Reporter</h4>
                    <p class="role-desc">Students are the eyes and ears of the campus. They can quickly report any issue they encounter and track its progress until resolution.</p>
                    <ul class="role-list">
                        <li><i class="fas fa-chevron-right"></i> Submit campus issue reports with photos</li>
                        <li><i class="fas fa-chevron-right"></i> Track the status of submitted reports</li>
                        <li><i class="fas fa-chevron-right"></i> Receive notifications on report updates</li>
                        <li><i class="fas fa-chevron-right"></i> View history of all personal reports</li>
                    </ul>
                </div>
            </div>
            <!-- Faculty -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-2">
                <div class="role-card faculty">
                    <div class="role-icon-wrap"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h4>Faculty Member</h4>
                    <p class="role-desc">Faculty members can report issues in their classrooms and departments, and have visibility into reports relevant to their areas of responsibility.</p>
                    <ul class="role-list">
                        <li><i class="fas fa-chevron-right"></i> Report facility and equipment issues</li>
                        <li><i class="fas fa-chevron-right"></i> Monitor reports in assigned areas</li>
                        <li><i class="fas fa-chevron-right"></i> Provide additional context to reports</li>
                        <li><i class="fas fa-chevron-right"></i> Access departmental report summaries</li>
                    </ul>
                </div>
            </div>
            <!-- Admin -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-3">
                <div class="role-card admin">
                    <div class="role-icon-wrap"><i class="fas fa-user-shield"></i></div>
                    <h4>Administrator</h4>
                    <p class="role-desc">Administrators have full control over the system — managing reports, users, facilities, and generating insights to improve campus operations.</p>
                    <ul class="role-list">
                        <li><i class="fas fa-chevron-right"></i> Manage and resolve all campus reports</li>
                        <li><i class="fas fa-chevron-right"></i> Assign reports to maintenance teams</li>
                        <li><i class="fas fa-chevron-right"></i> Manage user accounts and permissions</li>
                        <li><i class="fas fa-chevron-right"></i> Generate analytics and export reports</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section id="testimonials" class="section-padding" style="background:var(--gray-50);">
    <div class="container">
        <div class="text-center fade-in-up">
            <span class="section-label"><i class="fas fa-comments me-1"></i> Testimonials</span>
            <h2 class="section-title mt-2">What the SCC Community Says</h2>
            <p class="section-sub">Hear from students, faculty, and administrators who use SCC ReportHub every day.</p>
        </div>
        <div class="row g-4">
            <!-- Testimonial 1 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-1">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">"SCC ReportHub has completely changed how I report issues on campus. I submitted a report about a broken chair in our classroom and it was fixed within two days. The real-time tracking feature is incredibly reassuring."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar" style="background:linear-gradient(135deg,#1e40af,#3b82f6);">M</div>
                        <div>
                            <div class="author-name">Maria Santos</div>
                            <div class="author-role">3rd Year Student, BSIT</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div class="col-lg-4 col-md-6 fade-in-up delay-2">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">"As a faculty member, I used to have to call multiple offices just to report a projector issue. Now I just open ReportHub, submit the report with a photo, and the maintenance team handles it. It's saved me so much time."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">R</div>
                        <div>
                            <div class="author-name">Prof. Roberto Cruz</div>
                            <div class="author-role">Faculty, College of Engineering</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div class="col-lg-4 col-md-6 mx-auto fade-in-up delay-3">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">"The administrative dashboard gives me a complete picture of all campus issues at a glance. The analytics help us identify recurring problems and plan preventive maintenance. This system has significantly improved our response time."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar" style="background:linear-gradient(135deg,#059669,#10b981);">A</div>
                        <div>
                            <div class="author-name">Admin. Ana Reyes</div>
                            <div class="author-role">Campus Facilities Administrator</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="background:var(--gradient-main);padding:72px 0;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-60px;right:-60px;width:300px;height:300px;background:rgba(255,255,255,0.05);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-80px;left:-40px;width:250px;height:250px;background:rgba(255,255,255,0.04);border-radius:50%;"></div>
    <div class="container text-center" style="position:relative;z-index:1;">
        <div class="fade-in-up">
            <h2 style="font-size:clamp(1.6rem,3vw,2.4rem);font-weight:800;color:var(--white);margin-bottom:14px;">
                Ready to Make Your Campus Better?
            </h2>
            <p style="font-size:1rem;color:rgba(255,255,255,0.85);max-width:520px;margin:0 auto 32px;line-height:1.7;">
                Join hundreds of SCC community members already using ReportHub to keep the campus safe, clean, and well-maintained.
            </p>
            <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('register') }}" style="background:var(--white);color:var(--blue-dark);padding:13px 32px;border-radius:50px;font-weight:700;font-size:0.95rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:var(--transition);"
                   onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 12px 35px rgba(0,0,0,0.2)'"
                   onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <i class="fas fa-rocket"></i> Get Started Free
                </a>
                <a href="{{ route('login') }}" class="btn-outline-white">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer id="footer" style="padding:64px 0 0;">
    <div class="container">
        <div class="row g-5">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;">
                        <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo" style="height:44px;">
                        <span style="font-size:1.1rem;font-weight:800;color:var(--white);">SCC ReportHub</span>
                    </div>
                    <p>A centralized campus issue management platform for Southern Christian College — empowering the community to report, track, and resolve concerns efficiently.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="#features"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Features</a></li>
                    <li><a href="#how-it-works"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> How It Works</a></li>
                    <li><a href="#roles"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> User Roles</a></li>
                    <li><a href="#about"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> About</a></li>
                    <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Sign In</a></li>
                    <li><a href="{{ route('register') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Register</a></li>
                </ul>
            </div>

            <!-- Platform -->
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Platform</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Student Portal</a></li>
                    <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Faculty Portal</a></li>
                    <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Admin Dashboard</a></li>
                    <li><a href="#statistics"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Statistics</a></li>
                    <li><a href="#testimonials"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Testimonials</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-heading">Contact & Location</h6>
                <div class="footer-contact-item">
                    <i class="fas fa-university"></i>
                    <span>Southern Christian College<br>Midsayap, Cotabato, Philippines</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Poblacion, Midsayap<br>North Cotabato, 9410</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>reporthub@scc.edu.ph</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>(064) 229-8888</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Mon – Fri: 7:00 AM – 5:00 PM</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <p style="margin:0;">
                &copy; {{ date('Y') }} <a href="{{ route('landing') }}">SCC ReportHub</a> — Southern Christian College, Midsayap, Cotabato.
                All rights reserved. Built with <i class="fas fa-heart" style="color:#ef4444;"></i> for the SCC Community.
            </p>
        </div>
    </div>
</footer>

<!-- ===== SCRIPTS ===== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ---- NAVBAR SCROLL ---- */
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
        document.getElementById('backToTop').classList.toggle('visible', window.scrollY > 400);
    });

    /* ---- BACK TO TOP ---- */
    document.getElementById('backToTop').addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ---- MOBILE MENU ---- */
    document.getElementById('mobileToggle').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.add('open');
        document.body.style.overflow = 'hidden';
    });
    document.getElementById('mobileClose').addEventListener('click', closeMobileMenu);

    /* ---- SMOOTH SCROLL for nav links ---- */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = 80;
                const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    /* ---- INTERSECTION OBSERVER: fade-in-up ---- */
    const fadeEls = document.querySelectorAll('.fade-in-up');
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    fadeEls.forEach(el => fadeObserver.observe(el));

    /* ---- ANIMATED COUNTERS ---- */
    const counters = document.querySelectorAll('.counter');
    let countersStarted = false;

    function animateCounters() {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        });
    }

    const statsSection = document.getElementById('statistics');
    if (statsSection) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !countersStarted) {
                    countersStarted = true;
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        statsObserver.observe(statsSection);
    }

    /* ---- ACTIVE NAV LINK on scroll ---- */
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link-custom');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 120;
            if (window.pageYOffset >= sectionTop) {
                current = section.getAttribute('id');
            }
        });
        navLinks.forEach(link => {
            link.style.color = '';
            link.style.background = '';
            if (link.getAttribute('href') === '#' + current) {
                link.style.color = 'var(--blue-dark)';
                link.style.background = 'rgba(30,64,175,0.06)';
            }
        });
    });
});

function closeMobileMenu() {
    document.getElementById('mobileMenu').classList.remove('open');
    document.body.style.overflow = '';
}
</script>
</body>
</html>
