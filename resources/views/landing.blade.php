<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SCC ReportHub — Campus Facility Management System for Southern Christian College. Submit, track, and resolve campus issues in real-time.">
    <title>SCC ReportHub — Campus Facility Management</title>

    <!-- Google Fonts: Space Grotesk + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome 6.5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ═══════════════════════════════════════
           GLOBAL RESET & BASE
        ═══════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:           #0a0a0f;
            --card-bg:      #111118;
            --surface:      #1a1a24;
            --border:       rgba(255,255,255,0.08);
            --primary:      #00d97e;
            --primary-dark: #00b566;
            --blue:         #3b82f6;
            --purple:       #8b5cf6;
            --text-primary: #f0f0f5;
            --text-sec:     #8888a4;
            --text-muted:   #555570;
            --radius-sm:    8px;
            --radius-md:    16px;
            --radius-lg:    24px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6,
        .nav-brand-name, .btn, .eyebrow {
            font-family: 'Space Grotesk', sans-serif;
        }

        ::selection { background: var(--primary); color: #000; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--surface); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

        /* ═══════════════════════════════════════
           REVEAL ANIMATIONS
        ═══════════════════════════════════════ */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* ═══════════════════════════════════════
           NAVBAR
        ═══════════════════════════════════════ */
        #mainNav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid transparent;
            transition: border-color 0.3s, box-shadow 0.3s;
            padding: 0 1.5rem;
            height: 64px;
            display: flex;
            align-items: center;
        }
        #mainNav.scrolled {
            border-bottom-color: var(--border);
            box-shadow: 0 4px 32px rgba(0,0,0,0.4);
        }
        .nav-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-brand img {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            object-fit: contain;
        }
        .nav-brand-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.3px;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-link-signin {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-sec);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            transition: color 0.2s;
        }
        .nav-link-signin:hover { color: var(--text-primary); }

        .btn-nav-cta {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            background: var(--primary);
            color: #000;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 100px;
            transition: background 0.2s, transform 0.15s;
            display: inline-block;
        }
        .btn-nav-cta:hover {
            background: var(--primary-dark);
            color: #000;
            transform: translateY(-1px);
        }

        /* Hamburger */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
        }
        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* Mobile Slide Panel */
        .mobile-panel {
            position: fixed;
            top: 0; right: 0;
            width: 280px;
            height: 100vh;
            background: var(--card-bg);
            border-left: 1px solid var(--border);
            z-index: 999;
            transform: translateX(100%);
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            display: flex;
            flex-direction: column;
            padding: 80px 28px 28px;
            gap: 16px;
        }
        .mobile-panel.open { transform: translateX(0); }
        .mobile-panel a {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text-sec);
            text-decoration: none;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
        }
        .mobile-panel a:hover { color: var(--text-primary); }
        .mobile-panel .btn-panel-cta {
            margin-top: 8px;
            background: var(--primary);
            color: #000;
            text-align: center;
            padding: 14px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            border-bottom: none;
        }
        .mobile-panel .btn-panel-cta:hover { background: var(--primary-dark); color: #000; }
        .panel-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s;
        }
        .panel-overlay.open { opacity: 1; pointer-events: all; }

        /* ═══════════════════════════════════════
           HERO SECTION
        ═══════════════════════════════════════ */
        #hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            padding: 120px 24px 80px;
        }

        /* Animated gradient mesh background */
        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(0,217,126,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 85% 90%, rgba(139,92,246,0.1) 0%, transparent 55%),
                radial-gradient(ellipse 40% 40% at 15% 80%, rgba(59,130,246,0.07) 0%, transparent 50%),
                var(--bg);
            animation: meshPulse 8s ease-in-out infinite alternate;
        }
        @keyframes meshPulse {
            0%   { background-position: 50% -10%, 85% 90%, 15% 80%; }
            100% { background-position: 52% -8%,  83% 88%, 17% 82%; }
        }

        /* Green glow orb top */
        .glow-orb-top {
            position: absolute;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(circle, rgba(0,217,126,0.15) 0%, transparent 65%);
            pointer-events: none;
            animation: orbFloat 6s ease-in-out infinite alternate;
        }
        /* Purple glow orb bottom-right */
        .glow-orb-br {
            position: absolute;
            bottom: -80px;
            right: -100px;
            width: 500px;
            height: 400px;
            background: radial-gradient(circle, rgba(139,92,246,0.12) 0%, transparent 65%);
            pointer-events: none;
            animation: orbFloat 8s ease-in-out infinite alternate-reverse;
        }
        @keyframes orbFloat {
            0%   { transform: translateX(-50%) translateY(0) scale(1); }
            100% { transform: translateX(-50%) translateY(-20px) scale(1.05); }
        }
        .glow-orb-br { animation: orbFloatBR 8s ease-in-out infinite alternate-reverse; }
        @keyframes orbFloatBR {
            0%   { transform: translateY(0) scale(1); }
            100% { transform: translateY(-15px) scale(1.04); }
        }

        .hero-content { position: relative; z-index: 2; max-width: 780px; }

        .eyebrow-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0,217,126,0.1);
            border: 1px solid rgba(0,217,126,0.25);
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }
        .eyebrow-badge .dot {
            width: 7px;
            height: 7px;
            background: var(--primary);
            border-radius: 50%;
            animation: blink 2s ease-in-out infinite;
            flex-shrink: 0;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero-h1 {
            font-size: clamp(2.6rem, 6vw, 4.2rem);
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -1.5px;
            color: var(--text-primary);
            margin-bottom: 20px;
        }
        .hero-h1 .accent { color: var(--primary); }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.15rem);
            color: var(--text-sec);
            max-width: 560px;
            margin: 0 auto 36px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .btn-hero-primary {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            background: var(--primary);
            color: #000;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 100px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-hero-primary:hover {
            background: var(--primary-dark);
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0,217,126,0.3);
        }

        .btn-hero-outline {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            background: transparent;
            color: var(--text-primary);
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 100px;
            border: 1px solid rgba(255,255,255,0.2);
            transition: border-color 0.2s, background 0.2s, transform 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-hero-outline:hover {
            border-color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.05);
            color: var(--text-primary);
            transform: translateY(-2px);
        }

        .hero-trust {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
        }
        .trust-item {
            font-size: 0.82rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .trust-item .check { color: var(--primary); font-weight: 700; }
        .trust-sep {
            width: 4px;
            height: 4px;
            background: var(--text-muted);
            border-radius: 50%;
            opacity: 0.4;
        }

        /* ═══════════════════════════════════════
           MARQUEE STRIP
        ═══════════════════════════════════════ */
        #marquee-strip {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
            padding: 18px 0;
            overflow: hidden;
            white-space: nowrap;
        }
        .marquee-track {
            display: inline-flex;
            animation: marqueeScroll 28s linear infinite;
        }
        .marquee-track:hover { animation-play-state: paused; }
        @keyframes marqueeScroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-item {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0 24px;
        }
        .marquee-dot {
            color: var(--primary);
            font-size: 1rem;
            vertical-align: middle;
        }

        /* ═══════════════════════════════════════
           SECTION COMMONS
        ═══════════════════════════════════════ */
        .section-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 24px;
        }
        .section-label {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            display: block;
        }
        .section-title {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.8px;
            line-height: 1.15;
            margin-bottom: 16px;
        }
        .section-subtitle {
            font-size: 1rem;
            color: var(--text-sec);
            max-width: 520px;
            line-height: 1.7;
        }
        .section-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 0;
        }

        /* ═══════════════════════════════════════
           FEATURES SECTION
        ═══════════════════════════════════════ */
        #features { background: var(--bg); }
        .features-header {
            text-align: center;
            margin-bottom: 56px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-left: 3px solid var(--primary);
            border-radius: var(--radius-md);
            padding: 32px;
            transition: transform 0.25s, box-shadow 0.25s, border-left-color 0.25s;
            cursor: default;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0,217,126,0.08), 0 0 0 1px rgba(0,217,126,0.1);
            border-left-color: var(--primary);
        }
        .feature-icon-wrap {
            width: 48px;
            height: 48px;
            background: rgba(0,217,126,0.1);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: var(--primary);
        }
        .feature-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }
        .feature-card p {
            font-size: 0.9rem;
            color: var(--text-sec);
            line-height: 1.65;
        }

        /* ═══════════════════════════════════════
           HOW IT WORKS
        ═══════════════════════════════════════ */
        #how-it-works {
            background: var(--card-bg);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .hiw-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        .hiw-left .section-subtitle { max-width: 400px; }
        .hiw-badge {
            display: inline-block;
            background: rgba(0,217,126,0.1);
            border: 1px solid rgba(0,217,126,0.2);
            border-radius: 100px;
            padding: 4px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .steps-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .step-item {
            display: flex;
            gap: 20px;
            position: relative;
        }
        .step-left {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
        }
        .step-number {
            width: 40px;
            height: 40px;
            background: rgba(0,217,126,0.15);
            border: 1.5px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary);
            flex-shrink: 0;
            z-index: 1;
        }
        .step-connector {
            width: 1.5px;
            flex: 1;
            min-height: 32px;
            background: linear-gradient(to bottom, rgba(0,217,126,0.3), rgba(0,217,126,0.05));
            margin: 4px 0;
        }
        .step-item:last-child .step-connector { display: none; }
        .step-content {
            padding-bottom: 32px;
        }
        .step-item:last-child .step-content { padding-bottom: 0; }
        .step-content h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 6px;
            letter-spacing: -0.2px;
        }
        .step-content p {
            font-size: 0.875rem;
            color: var(--text-sec);
            line-height: 1.6;
        }

        /* ═══════════════════════════════════════
           USER ROLES
        ═══════════════════════════════════════ */
        #user-roles { background: var(--bg); }
        .roles-header {
            text-align: center;
            margin-bottom: 56px;
        }
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .role-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-lg);
            padding: 36px 28px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: transform 0.25s, box-shadow 0.25s;
            text-align: center;
        }
        .role-card:hover { transform: translateY(-4px); box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .role-icon {
            font-size: 2.8rem;
            margin-bottom: 16px;
            display: block;
        }
        .role-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 10px;
        }
        .role-card p {
            font-size: 0.875rem;
            color: var(--text-sec);
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .role-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: center;
        }
        .role-tag {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 100px;
            letter-spacing: 0.3px;
        }
        .tag-blue  { background: rgba(59,130,246,0.12);  color: #60a5fa;  border: 1px solid rgba(59,130,246,0.2); }
        .tag-green { background: rgba(0,217,126,0.1);    color: var(--primary); border: 1px solid rgba(0,217,126,0.2); }
        .tag-purple{ background: rgba(139,92,246,0.12);  color: #a78bfa;  border: 1px solid rgba(139,92,246,0.2); }

        .role-accent-blue   { border-top: 3px solid var(--blue); }
        .role-accent-green  { border-top: 3px solid var(--primary); }
        .role-accent-purple { border-top: 3px solid var(--purple); }

        /* ═══════════════════════════════════════
           STATISTICS
        ═══════════════════════════════════════ */
        #statistics {
            background: var(--card-bg);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
        }
        .stat-item {
            text-align: center;
            padding: 48px 24px;
            position: relative;
        }
        .stat-item::after {
            content: '';
            position: absolute;
            right: 0; top: 25%; bottom: 25%;
            width: 1px;
            background: var(--border);
        }
        .stat-item:last-child::after { display: none; }
        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.4rem, 4vw, 3.4rem);
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -1.5px;
            line-height: 1;
            margin-bottom: 8px;
        }
        .stat-number .stat-suffix { color: var(--primary); }
        .stat-label {
            font-size: 0.85rem;
            color: var(--text-sec);
            font-weight: 500;
        }

        /* ═══════════════════════════════════════
           CTA SECTION
        ═══════════════════════════════════════ */
        #cta { background: var(--bg); position: relative; overflow: hidden; }
        .cta-glow {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(circle, rgba(0,217,126,0.1) 0%, transparent 65%);
            pointer-events: none;
        }
        .cta-card {
            position: relative;
            z-index: 1;
            max-width: 680px;
            margin: 0 auto;
            text-align: center;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 64px 48px;
            background-image: linear-gradient(var(--card-bg), var(--card-bg)),
                              linear-gradient(135deg, var(--primary), var(--purple));
            background-clip: padding-box, border-box;
            background-origin: padding-box, border-box;
            border: 1px solid transparent;
        }
        .cta-card h2 {
            font-size: clamp(1.8rem, 3.5vw, 2.4rem);
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.8px;
            margin-bottom: 12px;
        }
        .cta-card p {
            color: var(--text-sec);
            margin-bottom: 32px;
            font-size: 1rem;
            line-height: 1.7;
        }
        .btn-cta-main {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            background: var(--primary);
            color: #000;
            text-decoration: none;
            padding: 15px 36px;
            border-radius: 100px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-cta-main:hover {
            background: var(--primary-dark);
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0,217,126,0.35);
        }

        /* ═══════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════ */
        #footer {
            background: var(--card-bg);
            border-top: 1px solid var(--border);
        }
        .footer-top {
            max-width: 1200px;
            margin: 0 auto;
            padding: 64px 24px 48px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 48px;
        }
        .footer-brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }
        .footer-brand-logo img {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            object-fit: contain;
        }
        .footer-brand-logo span {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-primary);
        }
        .footer-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 260px;
        }
        .footer-col h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-sec);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col ul li a {
            font-size: 0.875rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-col ul li a:hover { color: var(--text-primary); }
        .footer-col .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .footer-col .contact-item i {
            color: var(--primary);
            margin-top: 2px;
            flex-shrink: 0;
            font-size: 0.8rem;
        }
        .footer-bottom {
            border-top: 1px solid var(--border);
            padding: 20px 24px;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-bottom p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }
        .footer-bottom-links {
            display: flex;
            gap: 20px;
        }
        .footer-bottom-links a {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-bottom-links a:hover { color: var(--text-sec); }

        /* ═══════════════════════════════════════
           BACK TO TOP
        ═══════════════════════════════════════ */
        #backToTop {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 900;
            width: 42px;
            height: 42px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-sec);
            text-decoration: none;
            font-size: 0.9rem;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: opacity 0.3s, transform 0.3s, background 0.2s;
        }
        #backToTop.visible {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0);
        }
        #backToTop:hover {
            background: var(--primary);
            color: #000;
            border-color: var(--primary);
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 991px) {
            .features-grid,
            .roles-grid { grid-template-columns: 1fr 1fr; }
            .stats-grid  { grid-template-columns: repeat(2, 1fr); }
            .stat-item:nth-child(2)::after { display: none; }
            .stat-item:nth-child(3)::after { display: none; }
            .hiw-grid { grid-template-columns: 1fr; gap: 48px; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 767px) {
            .features-grid,
            .roles-grid,
            .stats-grid { grid-template-columns: 1fr; }
            .stat-item::after { display: none; }
            .hiw-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr; gap: 32px; }
            .cta-card { padding: 40px 24px; }
            .nav-actions { display: none; }
            .hamburger { display: flex; }
            .hero-trust { gap: 14px; }
            .section-wrap { padding: 72px 20px; }
        }

        @media (max-width: 480px) {
            .hero-h1 { letter-spacing: -0.8px; }
            .hero-actions { flex-direction: column; }
            .btn-hero-primary, .btn-hero-outline { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════
     NAVBAR
════════════════════════════════════════ -->
<nav id="mainNav" role="navigation" aria-label="Main navigation">
    <div class="nav-inner">
        <a href="{{ route('landing') }}" class="nav-brand" aria-label="SCC ReportHub Home">
            <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo">
            <span class="nav-brand-name">SCC ReportHub</span>
        </a>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="nav-link-signin">Sign In</a>
            <a href="{{ route('register') }}" class="btn-nav-cta">Get Started</a>
        </div>
        <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobilePanel">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Panel Overlay -->
<div class="panel-overlay" id="panelOverlay" aria-hidden="true"></div>

<!-- Mobile Slide Panel -->
<div class="mobile-panel" id="mobilePanel" role="dialog" aria-modal="true" aria-label="Navigation menu">
    <a href="{{ route('landing') }}"><i class="fas fa-home me-2" style="color:var(--primary)"></i>Home</a>
    <a href="#features">Features</a>
    <a href="#how-it-works">How It Works</a>
    <a href="#user-roles">User Roles</a>
    <a href="{{ route('login') }}">Sign In</a>
    <a href="{{ route('register') }}" class="btn-panel-cta">Get Started — It's Free</a>
</div>

<!-- ═══════════════════════════════════════
     HERO SECTION
════════════════════════════════════════ -->
<section id="hero" aria-labelledby="heroHeading">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="glow-orb-top" aria-hidden="true"></div>
    <div class="glow-orb-br" aria-hidden="true"></div>

    <div class="hero-content reveal">
        <div class="eyebrow-badge" role="text">
            <span class="dot" aria-hidden="true"></span>
            Campus Facility Management System
        </div>

        <h1 class="hero-h1" id="heroHeading">
            Report Campus Issues.<br>
            <span class="accent">Track. Resolve.</span>
        </h1>

        <p class="hero-subtitle">
            A web-based facility campus status report and monitoring system for
            Southern Christian College — empowering every member of the community.
        </p>

        <div class="hero-actions">
            <a href="{{ route('register') }}" class="btn-hero-primary">
                <i class="fas fa-rocket" aria-hidden="true"></i>
                Get Started — It's Free
            </a>
            <a href="{{ route('login') }}" class="btn-hero-outline">
                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                Sign In
            </a>
        </div>

        <div class="hero-trust" role="list">
            <span class="trust-item" role="listitem">
                <span class="check" aria-hidden="true">✓</span> Free for SCC
            </span>
            <span class="trust-sep" aria-hidden="true"></span>
            <span class="trust-item" role="listitem">
                <span class="check" aria-hidden="true">✓</span> Real-time tracking
            </span>
            <span class="trust-sep" aria-hidden="true"></span>
            <span class="trust-item" role="listitem">
                <span class="check" aria-hidden="true">✓</span> Secure platform
            </span>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════
     MARQUEE / TICKER STRIP
════════════════════════════════════════ -->
<div id="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        <!-- Set 1 -->
        <span class="marquee-item">Submit Ticket</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Track Status</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Admin Dashboard</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Maintenance Tasks</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Real-time Updates</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Issue Resolution</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Campus Safety</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Facility Reports</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Notifications</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Feedback System</span><span class="marquee-dot">●</span>
        <!-- Set 2 (duplicate for seamless loop) -->
        <span class="marquee-item">Submit Ticket</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Track Status</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Admin Dashboard</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Maintenance Tasks</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Real-time Updates</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Issue Resolution</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Campus Safety</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Facility Reports</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Notifications</span><span class="marquee-dot">●</span>
        <span class="marquee-item">Feedback System</span><span class="marquee-dot">●</span>
    </div>
</div>

<hr class="section-divider">

<!-- ═══════════════════════════════════════
     FEATURES SECTION
════════════════════════════════════════ -->
<section id="features" aria-labelledby="featuresHeading">
    <div class="section-wrap">
        <div class="features-header reveal">
            <span class="section-label">Core Capabilities</span>
            <h2 class="section-title" id="featuresHeading">Everything you need</h2>
            <p class="section-subtitle mx-auto">
                A complete toolkit designed to manage, track, and resolve campus facility issues efficiently and transparently.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal reveal-delay-1">
                <div class="feature-icon-wrap" aria-hidden="true">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <h3>Submit Ticket Requests</h3>
                <p>Faculty and staff can quickly submit facility issue reports with detailed descriptions, photos, and location info — directly from any device, anytime.</p>
            </div>

            <div class="feature-card reveal reveal-delay-2">
                <div class="feature-icon-wrap" aria-hidden="true">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3>Track Request Status</h3>
                <p>Stay informed with real-time status updates on every ticket. From submission to resolution, full transparency keeps everyone in the loop at every step.</p>
            </div>

            <div class="feature-card reveal reveal-delay-3">
                <div class="feature-icon-wrap" aria-hidden="true">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3>Maintenance Task Management</h3>
                <p>Maintenance staff receive assigned tasks with clear priorities and deadlines. Admins can monitor progress, reassign work, and close issues efficiently.</p>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ═══════════════════════════════════════
     HOW IT WORKS
════════════════════════════════════════ -->
<section id="how-it-works" aria-labelledby="hiwHeading">
    <div class="section-wrap">
        <div class="hiw-grid">
            <div class="hiw-left reveal">
                <span class="hiw-badge">Process</span>
                <h2 class="section-title" id="hiwHeading">Simple.<br>Fast.<br>Effective.</h2>
                <p class="section-subtitle">
                    From the moment an issue is spotted to the final resolution, SCC ReportHub keeps the entire workflow organized and visible.
                </p>
            </div>

            <div class="hiw-right reveal reveal-delay-1">
                <div class="steps-list" role="list">
                    <div class="step-item" role="listitem">
                        <div class="step-left">
                            <div class="step-number" aria-hidden="true">1</div>
                            <div class="step-connector" aria-hidden="true"></div>
                        </div>
                        <div class="step-content">
                            <h4>Submit a Report</h4>
                            <p>Faculty or staff spots an issue and files a ticket with a description, location, and optional photo attachment.</p>
                        </div>
                    </div>

                    <div class="step-item" role="listitem">
                        <div class="step-left">
                            <div class="step-number" aria-hidden="true">2</div>
                            <div class="step-connector" aria-hidden="true"></div>
                        </div>
                        <div class="step-content">
                            <h4>Admin Reviews &amp; Assigns</h4>
                            <p>The administrator reviews the ticket, sets the priority level, and assigns it to the appropriate maintenance team or staff member.</p>
                        </div>
                    </div>

                    <div class="step-item" role="listitem">
                        <div class="step-left">
                            <div class="step-number" aria-hidden="true">3</div>
                            <div class="step-connector" aria-hidden="true"></div>
                        </div>
                        <div class="step-content">
                            <h4>Maintenance Repairs</h4>
                            <p>The maintenance staff receives the task, carries out the repair, and logs progress updates throughout the process.</p>
                        </div>
                    </div>

                    <div class="step-item" role="listitem">
                        <div class="step-left">
                            <div class="step-number" aria-hidden="true">4</div>
                            <div class="step-connector" aria-hidden="true"></div>
                        </div>
                        <div class="step-content">
                            <h4>Resolved &amp; Closed</h4>
                            <p>Once completed, the ticket is marked resolved. The reporter receives a notification and may leave feedback on the service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ═══════════════════════════════════════
     USER ROLES SECTION
════════════════════════════════════════ -->
<section id="user-roles" aria-labelledby="rolesHeading">
    <div class="section-wrap">
        <div class="roles-header reveal">
            <span class="section-label">Who It's For</span>
            <h2 class="section-title" id="rolesHeading">Built for every role on campus</h2>
            <p class="section-subtitle mx-auto">
                SCC ReportHub is designed to serve three distinct user groups, each with a tailored experience and set of permissions.
            </p>
        </div>

        <div class="roles-grid">
            <!-- Faculty & Staff -->
            <div class="role-card role-accent-blue reveal reveal-delay-1">
                <span class="role-icon" aria-hidden="true" style="color:#60a5fa;">👩‍🏫</span>
                <h3>Faculty &amp; Staff</h3>
                <p>Report facility issues quickly and track the status of your requests. Stay informed with real-time notifications at every stage.</p>
                <div class="role-tags" role="list">
                    <span class="role-tag tag-blue" role="listitem">Submit Tickets</span>
                    <span class="role-tag tag-blue" role="listitem">Track Status</span>
                    <span class="role-tag tag-blue" role="listitem">Notifications</span>
                </div>
            </div>

            <!-- Maintenance Staff -->
            <div class="role-card role-accent-green reveal reveal-delay-2">
                <span class="role-icon" aria-hidden="true" style="color:var(--primary);">🔧</span>
                <h3>Maintenance Staff</h3>
                <p>View assigned tasks, update repair progress, and log completed work — all from one organized and easy-to-use interface.</p>
                <div class="role-tags" role="list">
                    <span class="role-tag tag-green" role="listitem">View Tasks</span>
                    <span class="role-tag tag-green" role="listitem">Log Progress</span>
                    <span class="role-tag tag-green" role="listitem">Mark Resolved</span>
                </div>
            </div>

            <!-- Administrator -->
            <div class="role-card role-accent-purple reveal reveal-delay-3">
                <span class="role-icon" aria-hidden="true" style="color:#a78bfa;">🛡️</span>
                <h3>Administrator</h3>
                <p>Full oversight of all tickets, user management, assignments, and analytics. Control the entire workflow from one powerful dashboard.</p>
                <div class="role-tags" role="list">
                    <span class="role-tag tag-purple" role="listitem">Full Dashboard</span>
                    <span class="role-tag tag-purple" role="listitem">User Management</span>
                    <span class="role-tag tag-purple" role="listitem">Analytics</span>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ═══════════════════════════════════════
     STATISTICS SECTION
════════════════════════════════════════ -->
<section id="statistics" aria-labelledby="statsHeading">
    <div class="section-wrap" style="padding-top: 0; padding-bottom: 0;">
        <h2 class="visually-hidden" id="statsHeading">Platform Statistics</h2>
        <div class="stats-grid reveal">
            <div class="stat-item">
                <div class="stat-number">
                    <span class="stat-count" data-target="248">0</span><span class="stat-suffix">+</span>
                </div>
                <div class="stat-label">Total Reports</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="stat-count" data-target="42">0</span><span class="stat-suffix">+</span>
                </div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="stat-count" data-target="189">0</span><span class="stat-suffix">+</span>
                </div>
                <div class="stat-label">Resolved</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="stat-count" data-target="156">0</span><span class="stat-suffix">+</span>
                </div>
                <div class="stat-label">Active Users</div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ═══════════════════════════════════════
     CTA SECTION
════════════════════════════════════════ -->
<section id="cta" aria-labelledby="ctaHeading">
    <div class="cta-glow" aria-hidden="true"></div>
    <div class="section-wrap">
        <div class="cta-card reveal">
            <h2 id="ctaHeading">Ready to get started?</h2>
            <p>
                Join the SCC ReportHub community today. Submit your first ticket,
                track maintenance requests, and help keep Southern Christian College
                facilities in top shape — completely free.
            </p>
            <a href="{{ route('register') }}" class="btn-cta-main">
                <i class="fas fa-user-plus" aria-hidden="true"></i>
                Create Your Account
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════
     FOOTER
════════════════════════════════════════ -->
<footer id="footer" role="contentinfo">
    <div class="footer-top">
        <!-- Brand Column -->
        <div>
            <div class="footer-brand-logo">
                <img src="{{ asset('images/scc-logo.png') }}" alt="SCC Logo">
                <span>SCC ReportHub</span>
            </div>
            <p class="footer-desc">
                A campus facility management platform built for Southern Christian College.
                Submit, track, and resolve facility issues with clarity and speed.
            </p>
        </div>

        <!-- Quick Links -->
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('landing') }}">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#user-roles">User Roles</a></li>
                <li><a href="{{ route('register') }}">Create Account</a></li>
                <li><a href="{{ route('login') }}">Sign In</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div class="footer-col">
            <h4>Contact</h4>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                <span>Southern Christian College, Midsayap, Cotabato, Philippines</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <span>reporthub@scc.edu.ph</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone" aria-hidden="true"></i>
                <span>(064) 229-8243</span>
            </div>
        </div>
    </div>

    <div class="footer-bottom" style="border-top: 1px solid var(--border); padding: 20px 24px; max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <p>&copy; {{ date('Y') }} SCC ReportHub — Southern Christian College. All rights reserved.</p>
        <div class="footer-bottom-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" id="backToTop" aria-label="Back to top" title="Back to top">
    <i class="fas fa-chevron-up" aria-hidden="true"></i>
</a>

<!-- Bootstrap 5.3.2 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Navbar scroll effect ──────────────────────────────
    const nav = document.getElementById('mainNav');
    const onNavScroll = () => {
        nav.classList.toggle('scrolled', window.scrollY > 20);
    };
    window.addEventListener('scroll', onNavScroll, { passive: true });
    onNavScroll();

    // ── Mobile hamburger / panel ──────────────────────────
    const hamburger    = document.getElementById('hamburger');
    const mobilePanel  = document.getElementById('mobilePanel');
    const panelOverlay = document.getElementById('panelOverlay');

    function openPanel() {
        hamburger.classList.add('open');
        mobilePanel.classList.add('open');
        panelOverlay.classList.add('open');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }
    function closePanel() {
        hamburger.classList.remove('open');
        mobilePanel.classList.remove('open');
        panelOverlay.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    hamburger.addEventListener('click', () => {
        mobilePanel.classList.contains('open') ? closePanel() : openPanel();
    });
    panelOverlay.addEventListener('click', closePanel);

    // Close panel when a link inside it is clicked
    mobilePanel.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closePanel);
    });

    // ── Reveal on scroll (IntersectionObserver) ───────────
    const revealEls = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach(el => revealObserver.observe(el));

    // ── Counter animation ─────────────────────────────────
    function animateCounter(el, target, duration) {
        const start = performance.now();
        const update = (now) => {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // Ease out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target);
            if (progress < 1) requestAnimationFrame(update);
            else el.textContent = target;
        };
        requestAnimationFrame(update);
    }

    const statsSection = document.getElementById('statistics');
    let countersFired = false;
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !countersFired) {
                countersFired = true;
                document.querySelectorAll('.stat-count').forEach(el => {
                    animateCounter(el, parseInt(el.dataset.target, 10), 1800);
                });
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    if (statsSection) counterObserver.observe(statsSection);

    // ── Back to top button ────────────────────────────────
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
        backToTop.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
    backToTop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ── Smooth anchor scroll (for mobile panel links) ─────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const hash = this.getAttribute('href');
            if (hash === '#') return;
            const target = document.querySelector(hash);
            if (target) {
                e.preventDefault();
                const offset = 72; // navbar height
                const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

});
</script>
</body>
</html>
