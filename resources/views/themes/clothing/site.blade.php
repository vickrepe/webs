<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $site->config['business_name'] ?? $site->slug }}</title>

    @if ($site->logo_url)
        <link rel="icon" href="{{ asset('storage/' . $site->logo_url) }}" type="image/png">
    @endif
    @php
        $fontHeading = $site->config['typography']['heading'] ?? 'Montserrat';
        $fontBody    = $site->config['typography']['body']    ?? 'Lato';
        $uniqueFonts = array_unique([$fontHeading, $fontBody]);
        $fontsParam  = implode('&family=', array_map(
            fn($f) => str_replace(' ', '+', $f) . ':wght@400;700',
            $uniqueFonts
        ));
    @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fontsParam }}&display=swap" rel="stylesheet">

    @include('themes.clothing._head_styles', ['site' => $site, 'fontHeading' => $fontHeading, 'fontBody' => $fontBody])
</head>
<body>

@if (request('preview'))
<div id="preview-bar">
    <a href="{{ route('dashboard.builder.show', $site) }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
        Volver al editor
    </a>
    <span>Vista previa · {{ $site->config['business_name'] ?? $site->slug }}</span>
</div>
<style>
    #preview-bar {
        position: fixed; top: 0; left: 0; right: 0; z-index: 9999;
        background: #1e1e2e; color: #6c7086;
        padding: .45rem 1.25rem;
        display: flex; align-items: center; gap: 1.5rem;
        font-size: .78rem; font-family: system-ui, sans-serif;
    }
    #preview-bar a {
        color: #cba6f7; text-decoration: none;
        display: inline-flex; align-items: center; gap: .35rem;
        font-weight: 600;
    }
    #preview-bar a:hover { color: #b4befe; }
    body { padding-top: 36px; }
</style>
@endif

@php
    $plans    = ['free' => 0, 'basic' => 1, 'pro' => 2];
    $userPlan = $plans[$site->user->plan ?? 'free'] ?? 0;
@endphp

@include('themes.clothing._nav')

{{-- ── SECTIONS ────────────────────────────────────────────── --}}
<main>
    @foreach ($template['sections'] as $type => $sectionSchema)
        @php
            $section = $sections->get($type);
            $data    = $section?->config ?? [];

            if (! $section || ! $section->active) continue;

            if (!empty($sectionSchema['footer_only'])) continue;
            if (!empty($sectionSchema['nav_only']))    continue;

            if (isset($sectionSchema['min_plan']) && $userPlan < ($plans[$sectionSchema['min_plan']] ?? 0)) continue;
        @endphp

        @include("themes.clothing.sections.{$type}", ['data' => $data, 'site' => $site])
    @endforeach
</main>

@include('themes.clothing._footer')

{{-- ── WHATSAPP ─────────────────────────────────────────────── --}}
@if ($sections->has('whatsapp_cta') && $sections->get('whatsapp_cta')->active)
    @php $wa = $sections->get('whatsapp_cta')->config ?? []; @endphp
    @if (!empty($wa['phone']))
        <a class="wa-btn"
           href="https://wa.me/{{ preg_replace('/\D/', '', $wa['phone']) }}?text={{ urlencode($wa['message'] ?? '¡Hola! Quiero hacer un pedido.') }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Contactar por WhatsApp">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    @endif
@endif

<script>
    window.addEventListener('message', (e) => {
        if (e.origin !== window.location.origin) return;

        switch (e.data?.type) {
            case 'vibly:theme': {
                const root = document.documentElement.style;
                Object.entries(e.data.vars ?? {}).forEach(([prop, value]) => {
                    root.setProperty(prop, value);
                });
                break;
            }
            case 'vibly:logo': {
                document.querySelectorAll('.site-logo').forEach(img => {
                    img.src = e.data.url;
                });
                break;
            }
            case 'vibly:fonts': {
                const fonts = [e.data.heading, e.data.body]
                    .filter((v, i, a) => v && a.indexOf(v) === i);
                fonts.forEach(font => {
                    const id = 'gf-' + font.replace(/\s+/g, '-');
                    if (! document.getElementById(id)) {
                        const link = document.createElement('link');
                        link.id   = id;
                        link.rel  = 'stylesheet';
                        link.href = `https://fonts.googleapis.com/css2?family=${font.replace(/ /g, '+')}:wght@400;700&display=swap`;
                        document.head.appendChild(link);
                    }
                });
                document.documentElement.style.setProperty('--font-heading', `'${e.data.heading}', sans-serif`);
                document.documentElement.style.setProperty('--font-body',    `'${e.data.body}', sans-serif`);
                break;
            }
        }
    });
</script>
</body>
</html>
