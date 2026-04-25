<style>
    @php
        $tc = $site->config['theme_colors'] ?? [];
        $tc_surface          = $tc['surface']          ?? '#fcf9f4';
        $tc_surface_low      = $tc['surface_low']      ?? '#f6f3ee';
        $tc_surface_lowest   = $tc['surface_lowest']   ?? '#ffffff';
        $tc_surface_high     = $tc['surface_high']     ?? '#e5e2dd';
        $tc_on_surface       = $tc['on_surface']       ?? '#1c1c19';
        $tc_on_surface_muted = $tc['on_surface_muted'] ?? '#6b6b67';
        $tc_secondary        = $tc['secondary']        ?? '#D4A5A5';
        $tc_tertiary         = $tc['tertiary']         ?? '#a08060';
        $tc_outline          = $tc['outline']          ?? '#c8c4be';
        $tc_outline_variant = $tc['outline_variant'] ?? $tc_outline;
        $tc_radius_button   = $tc['radius_button']   ?? '6px';
        $tc_radius_card     = $tc['radius_card']     ?? '12px';
        $tc_glass_blur      = $tc['glass_blur']      ?? '14px';
        // Derivar shadow_color del on_surface
        $sc = ltrim($tc_on_surface, '#');
        $tc_shadow_color = hexdec(substr($sc,0,2)).','.hexdec(substr($sc,2,2)).','.hexdec(substr($sc,4,2));
        // Opacidades del nav (la paleta define la opacidad base)
        $tc_glass_opacity         = floatval($tc['glass_opacity'] ?? 0.85);
        $tc_glass_opacity_scrolled = min($tc_glass_opacity + 0.3, 0.97);
        $nr = hexdec(substr(ltrim($tc_surface, '#'), 0, 2));
        $ng = hexdec(substr(ltrim($tc_surface, '#'), 2, 2));
        $nb = hexdec(substr(ltrim($tc_surface, '#'), 4, 2));
    @endphp

    :root {
        --primary:           {{ $site->config['colors']['primary'] ?? '#C8A96E' }};
        --primary-container: {{ $site->config['colors']['primary_container'] ?? '#e3c285' }};
        --on-primary:        {{ $site->textOnPrimary() }};
        --font-heading:      '{{ $fontHeading }}', serif;
        --font-body:         '{{ $fontBody }}', sans-serif;

        --surface:           {{ $tc_surface }};
        --surface-low:       {{ $tc_surface_low }};
        --surface-lowest:    {{ $tc_surface_lowest }};
        --surface-high:      {{ $tc_surface_high }};
        --on-surface:        {{ $tc_on_surface }};
        --on-surface-muted:  {{ $tc_on_surface_muted }};
        --secondary:         {{ $tc_secondary }};
        --tertiary:          {{ $tc_tertiary }};
        --outline:           {{ $tc_outline }};
        --outline-variant: {{ $tc_outline_variant }};
        --radius-button:   {{ $tc_radius_button }};
        --radius-card:     {{ $tc_radius_card }};
        --glass-blur:      {{ $tc_glass_blur }};
        --shadow-color:    {{ $tc_shadow_color }};
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body { background: var(--surface); color: var(--on-surface); }
    h1,h2,h3,h4,h5,h6 { font-family: var(--font-heading); line-height: 1.2; }
    body,p,li,a,td,input,textarea,select { font-family: var(--font-body); }
    p { line-height: 1.7; color: var(--on-surface-muted); }
    img { display: block; max-width: 100%; }

    /* ── Nav ─────────────────────────────────────────── */
    .site-nav {
        position: sticky; top: 0; z-index: 100;
        background: rgba({{ $nr }},{{ $ng }},{{ $nb }},{{ $tc_glass_opacity }});
        backdrop-filter: blur(var(--glass-blur)); -webkit-backdrop-filter: blur(var(--glass-blur));
        transition: background .3s;
    }
    .site-nav.scrolled { background: rgba({{ $nr }},{{ $ng }},{{ $nb }},{{ $tc_glass_opacity_scrolled }}); }
    .nav-inner {
        display: flex; align-items: center; justify-content: space-between;
        max-width: 1200px; margin: 0 auto; padding: .9rem 1.5rem; gap: 1rem;
    }
    .nav-logo { height: 52px; width: auto; object-fit: contain; }
    .nav-logo-text { font-family: var(--font-heading); font-weight: 700; font-size: 1.15rem; color: var(--primary); text-decoration: none; letter-spacing: .1em; }
    .nav-links { display: flex; gap: .25rem; list-style: none; }
    .nav-links a {
        text-decoration: none; font-size: .8rem; font-weight: 600; font-family: var(--font-body);
        color: var(--on-surface-muted); padding: .4rem .9rem;
        letter-spacing: .05em; text-transform: uppercase;
        transition: color .2s;
    }
    .nav-links a:hover,
    .nav-links a.active { color: var(--primary); font-weight: 700; background: transparent; }
    .nav-hamburger { display: none; background: none; border: none; cursor: pointer; padding: .25rem; color: var(--on-surface); align-items: center; justify-content: center; flex-shrink: 0; }
    .nav-mobile { display: none; flex-direction: column; list-style: none; padding: .5rem 1.5rem 1rem; background: rgba({{ $nr }},{{ $ng }},{{ $nb }},.97); backdrop-filter: blur(14px); gap: 0; }
    .nav-mobile.open { display: flex; }
    .nav-mobile li a { display: block; text-decoration: none; font-size: .85rem; font-weight: 600; font-family: var(--font-body); color: var(--on-surface-muted); padding: .6rem .5rem; border-bottom: 1px solid var(--outline); transition: color .2s; text-transform: uppercase; letter-spacing: .05em; }
    .nav-mobile li:last-child a { border-bottom: none; }
    .nav-mobile li a:hover { color: var(--primary); font-weight: 700; }
    .nav-cta { display: inline-block; padding: .5rem 1.25rem; background: var(--primary); color: var(--on-primary); border-radius: 6px; font-family: var(--font-body); font-size: .875rem; font-weight: 600; text-decoration: none; white-space: nowrap; transition: opacity .2s; flex-shrink: 0; }
    .nav-cta:hover { opacity: .85; }
    @media (max-width: 767px) { .nav-links { display: none; } .nav-hamburger { display: flex; } }

    /* ── Sections ─────────────────────────────────────── */
    .section-wrap { padding: 6rem 1.5rem; }
    .section-inner { max-width: 1200px; margin: 0 auto; }
    .section-bg-surface  { background: var(--surface); }
    .section-bg-low      { background: var(--surface-low); }
    .section-bg-high     { background: var(--surface-high); }

    .section-label {
        display: block; font-size: .75rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: .25em;
        color: var(--primary); margin-bottom: 1rem;
    }
    .section-heading { margin-bottom: 3.5rem; }
    .section-heading.centered { text-align: center; }
    .section-heading h2 { font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; color: var(--on-surface); margin-bottom: .75rem; }
    .heading-line { width: 48px; height: 2px; background: var(--primary-container); margin: .5rem auto 0; }

    @media (max-width: 767px) { .section-wrap { padding: 4rem 1.25rem; } }

    /* ── Buttons ─────────────────────────────────────── */
    .btn-primary {
        display: inline-block; background: var(--primary); color: var(--on-primary);
        padding: .85rem 2rem; border-radius: .75rem; font-weight: 600;
        text-decoration: none; font-size: .9rem; letter-spacing: .05em;
        text-transform: uppercase; transition: opacity .2s, transform .2s;
        border: none; cursor: pointer;
    }
    .btn-primary:hover { opacity: .88; transform: translateY(-1px); }
    .btn-ghost {
        display: inline-block; background: rgba(255,255,255,.12);
        backdrop-filter: blur(8px); color: #fff;
        border: 1px solid rgba(255,255,255,.25);
        padding: .85rem 2rem; border-radius: .75rem; font-weight: 600;
        text-decoration: none; font-size: .9rem; letter-spacing: .05em;
        text-transform: uppercase; transition: background .2s;
    }
    .btn-ghost:hover { background: rgba(255,255,255,.2); }

    /* ── Hero ────────────────────────────────────────── */
    .salon-hero { position: relative; height: 100vh; min-height: 600px; overflow: hidden; }
    .hero-slides { position: absolute; inset: 0; }
    .hero-slide  { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 1s ease; }
    .hero-slide.active { opacity: 1; }
    .hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.32); }
    .hero-content {
        position: relative; z-index: 2; height: 100%;
        display: flex; flex-direction: column; align-items: center;
        justify-content: center; text-align: center; padding: 0 1.5rem;
    }
    .hero-content h1 {
        font-family: var(--font-heading); font-size: clamp(2.5rem, 7vw, 5.5rem);
        color: #fff; font-weight: 700; line-height: 1.1;
        max-width: 800px; margin-bottom: 1.25rem; letter-spacing: -.01em;
    }
    .hero-content h1 em { font-style: italic; }
    .hero-content p { color: rgba(255,255,255,.88); font-size: 1.1rem; max-width: 540px; margin-bottom: 2.5rem; line-height: 1.6; }
    .hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; }
    .hero-dots { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; gap: .75rem; z-index: 2; }
    .hero-dot { width: 40px; height: 3px; border-radius: 2px; background: rgba(255,255,255,.35); transition: background .3s; cursor: pointer; }
    .hero-dot.active { background: #fff; }

    /* ── About ────────────────────────────────────────── */
    .salon-about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; }
    .salon-about-img-wrap { position: relative; }
    .salon-about-img { width: 100%; aspect-ratio: 4/5; object-fit: cover; border-radius: .5rem; }
    .salon-about-img-placeholder { width: 100%; aspect-ratio: 4/5; background: var(--surface-high); border-radius: .5rem; }
    .salon-about-stat {
        position: absolute; bottom: -1.5rem; right: -1.5rem;
        background: var(--surface-lowest); padding: 1.5rem 2rem;
        box-shadow: 0 8px 32px rgba(0,0,0,.08);
    }
    .salon-about-stat-num { display: block; font-family: var(--font-heading); font-size: 2.5rem; color: var(--primary); line-height: 1; }
    .salon-about-stat-label { display: block; font-size: .7rem; text-transform: uppercase; letter-spacing: .2em; color: var(--on-surface-muted); margin-top: .25rem; }
    .salon-about-text h2 { font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1.5rem; }
    .salon-about-text p { margin-bottom: 1.25rem; font-size: 1rem; }
    @media (max-width: 767px) { .salon-about-grid { grid-template-columns: 1fr; gap: 3rem; } .salon-about-stat { right: .5rem; bottom: -.75rem; } }

    /* ── Services ─────────────────────────────────────── */
    .salon-services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; }
    .salon-service-card { }
    .salon-service-img-wrap { overflow: hidden; border-radius: .5rem; margin-bottom: 1.5rem; }
    .salon-service-img { width: 100%; aspect-ratio: 3/4; object-fit: cover; transition: transform .7s ease; }
    .salon-service-card:hover .salon-service-img { transform: scale(1.04); }
    .salon-service-img-placeholder { width: 100%; aspect-ratio: 3/4; background: var(--surface-high); border-radius: .5rem; margin-bottom: 1.5rem; }
    .salon-service-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: .6rem; }
    .salon-service-name { font-family: var(--font-heading); font-size: 1.4rem; color: var(--on-surface); }
    .salon-service-price { color: var(--primary); font-weight: 700; font-size: 1rem; }
    .salon-service-desc { color: var(--on-surface-muted); font-size: .9rem; line-height: 1.6; }
    @media (max-width: 900px) { .salon-services-grid { grid-template-columns: 1fr 1fr; gap: 2rem; } }
    @media (max-width: 600px) { .salon-services-grid { grid-template-columns: 1fr; } }

    /* ── Gallery ──────────────────────────────────────── */
    .salon-gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: .75rem; }
    .salon-gallery-item { position: relative; aspect-ratio: 1; overflow: hidden; }
    .salon-gallery-img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
    .salon-gallery-item:hover .salon-gallery-img { transform: scale(1.05); }
    .salon-gallery-overlay {
        position: absolute; inset: 0;
        background: rgba(28,28,25,.55);
        opacity: 0; transition: opacity .3s;
        display: flex; align-items: center; justify-content: center;
    }
    .salon-gallery-item:hover .salon-gallery-overlay { opacity: 1; }
    .salon-gallery-overlay svg { width: 28px; height: 28px; fill: #fff; }
    @media (hover: none) { .salon-gallery-overlay { display: none; } }
    @media (max-width: 767px) { .salon-gallery-grid { grid-template-columns: repeat(2, 1fr); } }

    /* ── Reviews ──────────────────────────────────────── */
    .salon-reviews-wrap { max-width: 760px; margin: 0 auto; text-align: center; }
    .salon-review-stars { display: flex; justify-content: center; gap: .25rem; margin-bottom: 1.5rem; color: var(--primary); font-size: 1.25rem; }
    .salon-review-quote { font-family: var(--font-heading); font-size: clamp(1.25rem, 3vw, 1.75rem); font-style: italic; color: var(--on-surface); line-height: 1.5; margin-bottom: 1.5rem; }
    .salon-review-author { font-size: .75rem; text-transform: uppercase; letter-spacing: .2em; color: var(--on-surface-muted); }
    .salon-reviews-dots { display: flex; justify-content: center; gap: .5rem; margin-top: 2.5rem; }
    .salon-reviews-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--outline); cursor: pointer; transition: background .2s; }
    .salon-reviews-dot.active { background: var(--primary); }

    /* ── Team ─────────────────────────────────────────── */
    .salon-team-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem; }
    .salon-team-card { text-align: center; }
    .salon-team-photo { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem; border: 3px solid var(--outline); }
    .salon-team-placeholder { width: 120px; height: 120px; border-radius: 50%; background: var(--surface-high); margin: 0 auto 1rem; border: 3px solid var(--outline); }
    .salon-team-name { font-family: var(--font-heading); font-size: 1.1rem; color: var(--on-surface); margin-bottom: .25rem; }
    .salon-team-role { font-size: .8rem; text-transform: uppercase; letter-spacing: .15em; color: var(--on-surface-muted); }
    @media (max-width: 600px) { .salon-team-grid { grid-template-columns: 1fr 1fr; } }

    /* ── Contact ──────────────────────────────────────── */
    .salon-contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start; }
    .salon-contact-item { display: flex; gap: 1.25rem; margin-bottom: 2rem; align-items: flex-start; }
    .salon-contact-icon { width: 44px; height: 44px; border-radius: .5rem; background: var(--surface-lowest); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .salon-contact-icon svg { width: 20px; height: 20px; fill: var(--primary); }
    .salon-contact-label { font-size: .7rem; text-transform: uppercase; letter-spacing: .15em; color: var(--on-surface-muted); margin-bottom: .2rem; }
    .salon-contact-value { font-size: .95rem; color: var(--on-surface); line-height: 1.5; }
    .salon-contact-value a { color: var(--on-surface); text-decoration: none; }
    .salon-contact-map { aspect-ratio: 4/3; background: var(--surface-high); border-radius: .5rem; overflow: hidden; }
    .salon-contact-map img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(40%); transition: filter .5s; }
    .salon-contact-map img:hover { filter: grayscale(0); }
    @media (hover: none) { .salon-contact-map img { filter: none; } }
    @media (max-width: 767px) { .salon-contact-grid { grid-template-columns: 1fr; } }

    /* ── Footer ───────────────────────────────────────── */
    .site-footer { background: var(--on-surface); padding: 3rem 1.5rem 1.5rem; }
    .footer-inner { display: flex; justify-content: space-between; align-items: flex-start; gap: 2rem; max-width: 960px; margin: 0 auto 2rem; }
    .footer-brand-name { font-family: var(--font-heading); color: rgba(255,255,255,.9); font-size: 1.1rem; letter-spacing: .15em; margin-bottom: .75rem; }
    .footer-contact { color: rgba(255,255,255,.5); font-size: .85rem; line-height: 1.8; margin: 0; }
    .footer-contact a { color: rgba(255,255,255,.5); text-decoration: none; }
    .footer-contact a:hover { color: rgba(255,255,255,.8); }
    .footer-social { display: flex; gap: 1rem; align-items: center; }
    .footer-social a { color: rgba(255,255,255,.5); transition: color .2s; }
    .footer-social a:hover { color: rgba(255,255,255,.9); }
    .footer-copy { text-align: center; color: rgba(255,255,255,.3); font-size: .75rem; border-top: 1px solid rgba(255,255,255,.08); padding-top: 1.25rem; max-width: 960px; margin: 0 auto; }
    .footer-copy a { color: rgba(255,255,255,.3); text-decoration: none; }
    @media (max-width: 640px) { .footer-inner { flex-direction: column; align-items: center; text-align: center; } }

    /* ── WhatsApp ─────────────────────────────────────── */
    @keyframes wa-pulse { 0%{box-shadow:0 0 0 0 rgba(37,211,102,.5)} 70%{box-shadow:0 0 0 14px rgba(37,211,102,0)} 100%{box-shadow:0 0 0 0 rgba(37,211,102,0)} }
    .wa-btn { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 999; width: 56px; height: 56px; border-radius: 50%; background: #25D366; display: flex; align-items: center; justify-content: center; text-decoration: none; animation: wa-pulse 2s infinite; box-shadow: 0 2px 10px rgba(0,0,0,.2); }
    .wa-btn svg { width: 28px; height: 28px; fill: #fff; }
</style>
