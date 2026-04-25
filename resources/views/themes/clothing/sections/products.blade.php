@php
    $items  = $data['items']  ?? [];
    $layout = $data['layout'] ?? 'grid';
@endphp

@if (count($items) > 0)

@if ($layout === 'alternating')

    <section id="products">
        <div class="section-wrap section-dark" style="padding-bottom:2rem;">
            <div class="section-inner">
                <div class="section-heading">
                    <h2>Productos</h2>
                    <div class="heading-line"></div>
                </div>
            </div>
        </div>

        @foreach ($items as $i => $item)
        <div class="section-wrap {{ $i % 2 === 0 ? 'section-dark' : 'section-light' }}">
            <div class="section-inner">
                <div class="services-alt-row {{ $i % 2 === 1 ? 'reverse' : '' }}">
                    <div class="services-alt-text">
                        <h3 style="color:var(--on-surface);">{{ $item['name'] ?? '' }}</h3>
                        @if (!empty($item['price']))
                            <p class="services-alt-price">{{ $item['price'] }}</p>
                        @endif
                        @if (!empty($item['description']))
                            <p style="color:var(--on-surface-muted);font-size:.95rem;line-height:1.7;">{{ $item['description'] }}</p>
                        @endif
                    </div>
                    @if (!empty($item['image']))
                        <div class="services-alt-img">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] ?? '' }}">
                        </div>
                    @else
                        <div class="services-alt-img services-alt-img--empty" style="background:var(--surface-high);"></div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </section>

@elseif ($layout === 'cols_4')

    <section id="products" class="section-wrap section-light">
        <div class="section-inner">
            <div class="section-heading">
                <h2>Colección</h2>
                <div class="heading-line"></div>
            </div>
            <div class="products-4-grid">
                @foreach ($items as $item)
                <div class="products-4-card">
                    @if(!empty($item['image']))
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] ?? '' }}" class="products-4-img">
                    @else
                        <div class="products-4-img"></div>
                    @endif
                    <div class="products-4-body">
                        <div class="products-4-name">{{ $item['name'] ?? '' }}</div>
                        @if(!empty($item['price']))
                            <div class="products-4-price">{{ $item['price'] }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@else

    <section id="products" class="section-wrap section-dark">
        <div class="section-inner">
            <div class="section-heading">
                <h2>Productos</h2>
                <div class="heading-line"></div>
            </div>
            <div class="services-grid">
                @foreach ($items as $item)
                    <div class="services-card">
                        @if (!empty($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] ?? '' }}" class="services-card-img">
                        @endif
                        <div class="services-card-body">
                            <h3>{{ $item['name'] ?? '' }}</h3>
                            @if (!empty($item['price']))
                                <p class="services-card-price">{{ $item['price'] }}</p>
                            @endif
                            @if (!empty($item['description']))
                                <p class="services-card-desc">{{ $item['description'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if (!empty($data['show_more']) && $data['show_more'] === '1')
            <div style="text-align:center;margin-top:2.5rem;">
                <a href="{{ route('site.fullpage', ['slug' => $site->slug, 'sectionType' => 'products']) }}" class="services-more-btn">
                    Ver todos los productos
                </a>
            </div>
            @endif
        </div>
    </section>

@endif

@if (!empty($data['show_more']) && $data['show_more'] === '1' && ($layout ?? 'grid') === 'alternating')
<div class="section-wrap section-dark">
    <div class="section-inner" style="text-align:center;padding-top:2rem;padding-bottom:2rem;">
        <a href="{{ route('site.fullpage', ['slug' => $site->slug, 'sectionType' => 'products']) }}" class="services-more-btn">
            Ver todos los productos
        </a>
    </div>
</div>
@endif

<style>
    .services-more-btn {
        display: inline-block;
        padding: .7rem 2rem;
        background: var(--primary);
        color: var(--text-on-primary);
        border-radius: 999px;
        text-decoration: none;
        font-weight: 600;
        font-size: .9rem;
        transition: opacity .2s;
    }
    .services-more-btn:hover { opacity: .85; }

    /* ── Grid layout ── */
    .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .services-card { background: var(--surface-lowest); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.06); display: flex; flex-direction: column; }
    .services-card-img { width: 100%; height: 160px; object-fit: cover; display: block; }
    .services-card-body { padding: 1.5rem; flex: 1; }
    .services-card-body h3 { font-weight: 700; margin-bottom: .5rem; color: var(--on-surface); }
    .services-card-price { color: var(--primary); font-weight: 700; font-size: 1.2rem; margin-bottom: .5rem; }
    .services-card-desc  { color: var(--on-surface-muted); font-size: .875rem; line-height: 1.6; }

    /* ── Alternating layout ── */
    .services-alt-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 4rem;
    }
    .services-alt-row.reverse { direction: rtl; }
    .services-alt-row.reverse > * { direction: ltr; }
    .services-alt-price { color: var(--primary); font-weight: 700; font-size: 1.3rem; margin-bottom: .75rem; }
    .services-alt-text h3 { font-size: 1.4rem; font-weight: 700; margin-bottom: .75rem; }
    .services-alt-img img { width: 100%; aspect-ratio: 4/3; object-fit: cover; border-radius: 12px; display: block; }
    .services-alt-img--empty { width: 100%; aspect-ratio: 4/3; border-radius: 12px; }

    @media (max-width: 1023px) { .services-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 767px) {
        .services-grid { grid-template-columns: 1fr; }
        .services-alt-row,
        .services-alt-row.reverse { grid-template-columns: 1fr; direction: ltr; gap: 1.5rem; }
        .services-alt-row .services-alt-img { order: -1; }
    }

    /* ── cols_4 layout ── */
    .products-4-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .products-4-card { background: var(--surface-lowest); border-radius: 8px; overflow: hidden; }
    .products-4-img  { width: 100%; aspect-ratio: 3/4; object-fit: cover; display: block; background: var(--surface-high); }
    .products-4-body { padding: 1rem; }
    .products-4-name { font-weight: 700; font-size: .95rem; color: var(--on-surface); margin-bottom: .25rem; }
    .products-4-price{ color: var(--primary); font-weight: 700; font-size: .9rem; }
    @media (max-width: 1023px) { .products-4-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px)  { .products-4-grid { grid-template-columns: repeat(2, 1fr); gap: .75rem; } }
</style>
@endif
