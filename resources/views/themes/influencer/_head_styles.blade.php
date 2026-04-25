<style>
    @php
        $tc = $site->config['theme_colors'] ?? [];
        $tc_surface          = $tc['surface']          ?? '#f9f9fb';
        $tc_surface_low      = $tc['surface_low']      ?? '#f2f4f7';
        $tc_surface_lowest   = $tc['surface_lowest']   ?? '#ffffff';
        $tc_surface_high     = $tc['surface_high']     ?? '#e4e7ec';
        $tc_on_surface       = $tc['on_surface']       ?? '#2d3338';
        $tc_on_surface_muted = $tc['on_surface_muted'] ?? '#6b7280';
        $tc_secondary        = $tc['secondary']        ?? '#e9e1dd';
        $tc_tertiary         = $tc['tertiary']         ?? '#6f5d37';
        $tc_outline          = $tc['outline']          ?? '#d0ccc8';
    @endphp

    :root {
        --primary:           {{ $site->config['colors']['primary'] ?? '#625d5b' }};
        --primary-container: {{ $site->config['colors']['primary_container'] ?? '#9c8880' }};
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
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background: var(--surface);
        color: var(--on-surface);
        font-family: var(--font-body);
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 2rem 1rem 4rem;
    }

    .inf-wrap {
        width: 100%;
        max-width: 480px;
    }

    /* ── Hero / Perfil ─────────────────────────────── */
    .inf-hero {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 2.5rem 0 2rem;
        gap: .75rem;
    }

    .inf-avatar {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--outline);
    }

    .inf-avatar-placeholder {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: var(--surface-high);
        border: 3px solid var(--outline);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }

    .inf-name {
        font-family: var(--font-heading);
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--on-surface);
        letter-spacing: -.01em;
    }

    .inf-bio {
        font-size: .9rem;
        color: var(--on-surface-muted);
        line-height: 1.5;
        max-width: 320px;
    }

    /* ── Links ─────────────────────────────────────── */
    .inf-links {
        display: flex;
        flex-direction: column;
        gap: .75rem;
        margin-bottom: 2rem;
    }

    .inf-link-btn {
        display: block;
        width: 100%;
        padding: .9rem 1.5rem;
        background: var(--surface-lowest);
        color: var(--on-surface);
        text-decoration: none;
        font-family: var(--font-body);
        font-size: .95rem;
        font-weight: 600;
        text-align: center;
        border-radius: 12px;
        border: 1px solid var(--outline);
        transition: background .2s, transform .15s, box-shadow .2s;
    }

    .inf-link-btn:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0,0,0,.07);
    }

    /* ── Social ────────────────────────────────────── */
    .inf-social {
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding-top: .5rem;
    }

    .inf-social a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--surface-low);
        color: var(--on-surface-muted);
        text-decoration: none;
        transition: background .2s, color .2s;
    }

    .inf-social a:hover {
        background: var(--primary);
        color: var(--on-primary);
    }

    .inf-social svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    /* ── Footer ────────────────────────────────────── */
    .inf-footer {
        text-align: center;
        margin-top: 2.5rem;
        font-size: .75rem;
        color: var(--on-surface-muted);
    }

    .inf-footer a {
        color: var(--on-surface-muted);
        text-decoration: none;
    }

    .inf-footer a:hover { color: var(--primary); }
</style>
