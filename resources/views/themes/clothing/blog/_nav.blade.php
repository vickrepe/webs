<nav class="site-nav">
    <div class="nav-inner">
        @if ($site->logo_url)
            <a href="{{ route('site.show', $site->slug) }}">
                <img src="{{ asset('storage/' . $site->logo_url) }}" alt="{{ $site->config['business_name'] ?? $site->slug }}" class="nav-logo">
            </a>
        @else
            <a href="{{ route('site.show', $site->slug) }}" class="nav-logo-text">{{ $site->config['business_name'] ?? $site->slug }}</a>
        @endif

        <ul class="nav-links">
            @foreach ($template['sections'] as $type => $schema)
                @php
                    $navSection = $sections->get($type);
                    if (! $navSection || ! $navSection->active) continue;
                    if (in_array($type, ['hero', 'whatsapp_cta']) || !empty($schema['footer_only'])) continue;
                @endphp
                <li>
                    <a href="{{ !empty($schema['blog_section']) ? route('blog.index', $site->slug) : route('site.show', $site->slug).'#'.$type }}">
                        {{ $schema['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <button class="nav-hamburger" id="nav-hamburger" aria-label="Abrir menú">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <ul class="nav-mobile" id="nav-mobile">
        @foreach ($template['sections'] as $type => $schema)
            @php
                $navSection = $sections->get($type);
                if (! $navSection || ! $navSection->active) continue;
                if (in_array($type, ['hero', 'whatsapp_cta']) || !empty($schema['footer_only'])) continue;
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
</script>
