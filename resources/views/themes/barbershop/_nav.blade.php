@php
    $navTemplate = $template ?? config("templates.{$site->sector}");
    $navSections = $sections ?? $site->sections()->where('active', true)->get()->keyBy('type');
    $navPlans    = ['free' => 0, 'basic' => 1, 'pro' => 2];
    $navUserPlan = $navPlans[$site->user->plan ?? 'free'] ?? 0;

    $navConfig   = $navSections->get('nav')?->config ?? [];
    $logoDisplay = $navConfig['logo_display'] ?? 'image';
    $ctaEnabled  = ($navConfig['cta_enabled'] ?? '1') === '1';
    $ctaText     = $navConfig['cta_text'] ?? 'Reservar ahora';
    $ctaUrl      = $navConfig['cta_url']  ?? '#contact';

    $navSurface = $site->config['theme_colors']['surface'] ?? '#ffffff';
    $nr = hexdec(substr(ltrim($navSurface, '#'), 0, 2));
    $ng = hexdec(substr(ltrim($navSurface, '#'), 2, 2));
    $nb = hexdec(substr(ltrim($navSurface, '#'), 4, 2));
    $navBg = "rgba($nr,$ng,$nb,0.85)";
@endphp
<nav class="site-nav">
    <div class="nav-inner">
        @if ($logoDisplay === 'image' && $site->logo_url)
            <a href="{{ route('site.show', $site->slug) }}">
                <img src="{{ asset('storage/' . $site->logo_url) }}" alt="{{ $site->config['business_name'] ?? '' }}" class="nav-logo site-logo">
            </a>
        @elseif ($logoDisplay === 'text' || ($logoDisplay === 'image' && !$site->logo_url))
            <a href="{{ route('site.show', $site->slug) }}" class="nav-logo-text">{{ $site->config['business_name'] ?? $site->slug }}</a>
        @endif
        {{-- logoDisplay === 'hidden': no renderiza nada --}}

        <ul class="nav-links">
            @foreach ($navTemplate['sections'] as $type => $schema)
                @php
                    $navSection = $navSections->get($type);
                    if (! $navSection || ! $navSection->active) continue;
                    if (in_array($type, ['hero', 'whatsapp_cta']) || !empty($schema['footer_only']) || !empty($schema['nav_only'])) continue;
                    if (isset($schema['min_plan']) && $navUserPlan < ($navPlans[$schema['min_plan']] ?? 0)) continue;
                @endphp
                <li>
                    <a href="{{ !empty($schema['blog_section']) ? route('blog.index', $site->slug) : route('site.show', $site->slug).'#'.$type }}">
                        {{ $schema['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        @if ($ctaEnabled)
            <a href="{{ $ctaUrl }}" class="nav-cta">{{ $ctaText }}</a>
        @endif

        <button class="nav-hamburger" id="nav-hamburger" aria-label="Abrir menú">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <ul class="nav-mobile" id="nav-mobile">
        @foreach ($navTemplate['sections'] as $type => $schema)
            @php
                $navSection = $navSections->get($type);
                if (! $navSection || ! $navSection->active) continue;
                if (in_array($type, ['hero', 'whatsapp_cta']) || !empty($schema['footer_only']) || !empty($schema['nav_only'])) continue;
                if (isset($schema['min_plan']) && $navUserPlan < ($navPlans[$schema['min_plan']] ?? 0)) continue;
            @endphp
            <li>
                <a href="{{ !empty($schema['blog_section']) ? route('blog.index', $site->slug) : route('site.show', $site->slug).'#'.$type }}"
                   onclick="document.getElementById('nav-mobile').classList.remove('open')">
                    {{ $schema['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
<script>
    document.getElementById('nav-hamburger')?.addEventListener('click', () => {
        document.getElementById('nav-mobile').classList.toggle('open');
    });
    (function () {
        const nav = document.querySelector('.site-nav');
        if (! nav) return;
        const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 20);
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    })();
</script>
