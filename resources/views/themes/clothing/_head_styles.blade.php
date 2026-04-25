<style>
    @php
        $tc = $site->config['theme_colors'] ?? [];
        $tc_surface          = $tc['surface']          ?? '#ffffff';
        $tc_surface_low      = $tc['surface_low']      ?? '#f5f5f5';
        $tc_surface_lowest   = $tc['surface_lowest']   ?? '#ffffff';
        $tc_surface_high     = $tc['surface_high']     ?? '#e0e0e0';
        $tc_on_surface       = $tc['on_surface']       ?? '#1a1a1a';
        $tc_on_surface_muted = $tc['on_surface_muted'] ?? '#666666';
        $tc_secondary        = $tc['secondary']        ?? '#2d2d2d';
        $tc_tertiary         = $tc['tertiary']         ?? '#888888';
        $tc_outline          = $tc['outline']          ?? '#e0e0e0';
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
        /* Grupo 1 — dinámicas por negocio */
        --primary:           {{ $site->config['colors']['primary'] ?? '#2d2d2d' }};
        --primary-container: {{ $site->config['colors']['primary_container'] ?? '#555555' }};
        --on-primary:        {{ $site->textOnPrimary() }};
        --font-heading:      '{{ $fontHeading }}', sans-serif;
        --font-body:         '{{ $fontBody }}', sans-serif;

        /* Grupo 2 — dinámicas por theme, editables solo por admin */
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

    h1, h2, h3, h4, h5, h6 { font-family: var(--font-heading); line-height: 1.2; }
    body, p, li, a, td, input, textarea { font-family: var(--font-body); }

    h2 {
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        margin-bottom: .5rem;
    }

    p { line-height: 1.7; color: var(--on-surface-muted); }

    img { display: block; max-width: 100%; }

    /* ── Nav ──────────────────────────────────────────────── */
    .site-nav {
        position: sticky;
        top: 0;
        z-index: 100;
        background: rgba({{ $nr }},{{ $ng }},{{ $nb }},{{ $tc_glass_opacity }});
        backdrop-filter: blur(var(--glass-blur));
        -webkit-backdrop-filter: blur(var(--glass-blur));
        border-bottom: 1px solid rgba({{ $nr }},{{ $ng }},{{ $nb }},0.4);
        box-shadow: 0 1px 24px rgba(0, 0, 0, 0.06);
        transition: background .3s, box-shadow .3s;
    }

    .site-nav.scrolled {
        background: rgba({{ $nr }},{{ $ng }},{{ $nb }},{{ $tc_glass_opacity_scrolled }});
        box-shadow: 0 2px 32px rgba(0, 0, 0, 0.1);
    }

    .nav-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: .75rem 1.5rem;
        gap: 1rem;
    }

    .nav-logo { height: 56px; width: auto; object-fit: contain; }
    .nav-logo-text {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--primary);
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        gap: .25rem;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        font-size: .875rem;
        font-weight: 600;
        font-family: var(--font-body);
        color: var(--on-surface);
        padding: .4rem .85rem;
        border-radius: 999px;
        transition: background .2s, color .2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--primary);
        font-weight: 700;
        background: transparent;
    }

    .nav-hamburger {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: .25rem;
        color: var(--on-surface-muted);
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-mobile {
        display: none;
        flex-direction: column;
        list-style: none;
        padding: .5rem 1.5rem 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
        background: rgba({{ $nr }},{{ $ng }},{{ $nb }},0.97);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        gap: 0;
    }

    .nav-mobile.open { display: flex; }

    .nav-mobile li a {
        display: block;
        text-decoration: none;
        font-size: .9rem;
        font-weight: 600;
        font-family: var(--font-body);
        color: var(--on-surface);
        padding: .6rem .5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: color .2s;
    }

    .nav-mobile li:last-child a { border-bottom: none; }
    .nav-mobile li a:hover { color: var(--primary); font-weight: 700; }

    .nav-cta {
        display: inline-block;
        padding: .5rem 1.25rem;
        background: var(--primary);
        color: var(--on-primary);
        border-radius: 6px;
        font-family: var(--font-body);
        font-size: .875rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: opacity .2s;
        flex-shrink: 0;
    }
    .nav-cta:hover { opacity: .85; }

    @media (max-width: 767px) {
        .nav-links     { display: none; }
        .nav-hamburger { display: flex; }
    }

    /* ── Section headings ─────────────────────────────────── */
    .section-heading {
        margin-bottom: 3rem;
        text-align: center;
    }

    .section-heading h2 { margin-bottom: .5rem; }

    .heading-line {
        width: 48px;
        height: 3px;
        background: var(--primary);
        margin: .5rem auto 0;
        border-radius: 2px;
    }

    /* ── Section dark / light ─────────────────────────────── */
    .section-dark  { background: var(--secondary); }
    .section-light { background: var(--surface-lowest); }

    .section-dark  .section-heading h2 { color: #ffffff; }
    .section-light .section-heading h2 { color: var(--on-surface); }

    .section-dark  .heading-line { background: var(--primary); opacity: .6; }
    .section-light .heading-line { background: var(--primary); }

    /* ── Section padding ──────────────────────────────────── */
    .section-wrap {
        padding: 5rem 1.5rem;
    }

    .section-inner {
        max-width: 1200px;
        margin: 0 auto;
    }

    @media (max-width: 767px) {
        .section-wrap { padding: 3rem 1.25rem; }
    }

    /* ── Footer ───────────────────────────────────────────── */
    .site-footer { background: var(--surface-high); padding: 2.5rem 1.5rem 1.5rem; }

    .footer-inner {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 2rem;
        max-width: 960px;
        margin: 0 auto 2rem;
    }

    .footer-brand { text-align: left; }

    .footer-logo { display: block; height: 52px; margin: 0 0 .75rem; opacity: .85; }

    .footer-contact { color: var(--on-surface-muted); font-size: .85rem; line-height: 1.8; margin: 0; }
    .footer-contact a { color: var(--on-surface-muted); text-decoration: none; }
    .footer-contact a:hover { color: var(--on-surface); }

    .footer-social { display: flex; flex-direction: row; flex-wrap: wrap; gap: 1rem; align-items: center; }
    .footer-social a { color: var(--on-surface-muted); line-height: 0; transition: color .2s; }
    .footer-social a:hover { color: var(--on-surface); }

    .footer-copy {
        text-align: center;
        color: var(--on-surface-muted);
        font-size: .78rem;
        border-top: 1px solid var(--outline);
        padding-top: 1.25rem;
        max-width: 960px;
        margin: 0 auto;
    }
    .footer-copy a { color: var(--on-surface-muted); text-decoration: none; }

    @media (max-width: 640px) {
        .footer-inner { flex-direction: column; align-items: center; }
        .footer-brand { text-align: center; }
        .footer-logo { margin: 0 auto .75rem; }
        .footer-social { flex-direction: row; align-items: center; }
    }

    /* ── WhatsApp pulse ───────────────────────────────────── */
    @keyframes wa-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(37, 211, 102, .5); }
        70%  { box-shadow: 0 0 0 14px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }

    .wa-btn {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 999;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #25D366;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        animation: wa-pulse 2s infinite;
        box-shadow: 0 2px 10px rgba(0,0,0,.2);
    }

    .wa-btn svg { width: 28px; height: 28px; fill: #fff; }

    /* ── Hero slideshow ───────────────────────────────────── */
    .hero-slides { position: absolute; inset: 0; }
    .hero-slide  { position: absolute; inset: 0; background-size: cover; background-position: center;
                   opacity: 0; transition: opacity 1s ease; }
    .hero-slide.active { opacity: 1; }
    .hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.45); }
    @media (hover: none) { .gallery-img { filter: none !important; } }
</style>
