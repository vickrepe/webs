@php
    $items         = array_values(array_filter($data['items'] ?? [], fn($i) => !empty($i['image'])));
    $galleryLayout = $data['layout'] ?? 'grid';
@endphp

@if (count($items) > 0)
<section id="gallery" class="section-wrap section-light">
    <div class="section-inner">
        <div class="section-heading">
            <h2>Trabajos realizados</h2>
            <div class="heading-line"></div>
        </div>

        @if ($galleryLayout === 'masonry')
        <div class="gallery-masonry">
            @foreach ($items as $idx => $item)
            <div class="gallery-masonry-item" data-idx="{{ $idx }}">
                <img src="{{ $item['image'] }}" alt="{{ $item['caption'] ?? '' }}">
                <div class="gallery-overlay">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                </div>
            </div>
            @endforeach
        </div>

        @elseif ($galleryLayout === 'bento')
        @php $bentoMap = ['gb-wide-tall','','','gb-wide','','gb-wide']; @endphp
        <div class="gallery-bento">
            @foreach ($items as $idx => $item)
            <div class="gallery-bento-item {{ $bentoMap[$idx % 6] ?? '' }}" data-idx="{{ $idx }}">
                <img src="{{ $item['image'] }}" alt="{{ $item['caption'] ?? '' }}">
                <div class="gallery-overlay">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="gallery-grid">
            @foreach ($items as $idx => $item)
                <div class="gallery-item" data-idx="{{ $idx }}">
                    <img src="{{ $item['image'] }}" alt="{{ $item['caption'] ?? '' }}">
                    <div class="gallery-overlay">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        @if (!empty($data['show_more']) && $data['show_more'] === '1')
        <div style="text-align:center;margin-top:2rem;">
            <a href="{{ route('site.fullpage', ['slug' => $site->slug, 'sectionType' => 'gallery']) }}" class="gallery-more-btn">
                Ver toda la galería
            </a>
        </div>
        @endif
    </div>
</section>

{{-- Lightbox --}}
<div id="gallery-lb" class="lb-backdrop" aria-hidden="true">
    <button class="lb-close" id="lb-close" aria-label="Cerrar">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <button class="lb-arrow lb-prev" id="lb-prev" aria-label="Anterior">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <div class="lb-content">
        <img id="lb-img" src="" alt="">
        <p id="lb-caption" class="lb-caption"></p>
    </div>
    <button class="lb-arrow lb-next" id="lb-next" aria-label="Siguiente">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
</div>

<style>
    .gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    .gallery-item { position: relative; overflow: hidden; border-radius: 8px; cursor: pointer; }
    .gallery-item img { width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block; transition: transform .35s; }
    .gallery-item:hover img { transform: scale(1.04); }
    .gallery-overlay {
        position: absolute; inset: 0;
        background: rgba(0,0,0,.35);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity .25s;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; }

    /* Lightbox */
    .lb-backdrop {
        position: fixed; inset: 0; z-index: 9000;
        background: rgba(0,0,0,.92);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; pointer-events: none;
        transition: opacity .25s;
    }
    .lb-backdrop.open { opacity: 1; pointer-events: all; }
    .lb-content {
        display: flex; flex-direction: column; align-items: center;
        max-width: min(90vw, 900px); width: 100%;
    }
    .lb-content img {
        max-height: 75vh; max-width: 100%;
        object-fit: contain; border-radius: 6px;
        display: block;
    }
    .lb-caption {
        color: rgba(255,255,255,.75); font-size: .9rem;
        margin-top: .9rem; text-align: center; min-height: 1.4em;
    }
    .lb-close {
        position: fixed; top: 1.25rem; right: 1.25rem;
        background: rgba(255,255,255,.12); border: none; border-radius: 50%;
        width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #fff; transition: background .2s; z-index: 9001;
    }
    .lb-close:hover { background: rgba(255,255,255,.25); }
    .lb-arrow {
        position: fixed; top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,.12); border: none; border-radius: 50%;
        width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #fff; transition: background .2s; z-index: 9001;
    }
    .lb-arrow:hover { background: rgba(255,255,255,.25); }
    .lb-prev { left: 1.25rem; }
    .lb-next { right: 1.25rem; }
    .lb-arrow:disabled { opacity: .25; cursor: default; }

    .gallery-more-btn {
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
    .gallery-more-btn:hover { opacity: .85; }

    /* ── Masonry ── */
    .gallery-masonry { columns: 3; column-gap: .75rem; }
    .gallery-masonry-item { break-inside: avoid; margin-bottom: .75rem; border-radius: 8px; overflow: hidden; cursor: pointer; position: relative; }
    .gallery-masonry-item img { width: 100%; display: block; transition: transform .35s; }
    .gallery-masonry-item:hover img { transform: scale(1.03); }
    .gallery-masonry-item .gallery-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.35); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .25s; }
    .gallery-masonry-item:hover .gallery-overlay { opacity: 1; }

    /* ── Bento ── */
    .gallery-bento { display: grid; grid-template-columns: repeat(3, 1fr); grid-auto-rows: 220px; gap: .75rem; }
    .gallery-bento-item { position: relative; overflow: hidden; border-radius: 8px; cursor: pointer; }
    .gallery-bento-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .35s; }
    .gallery-bento-item:hover img { transform: scale(1.04); }
    .gallery-bento-item .gallery-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.35); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .25s; }
    .gallery-bento-item:hover .gallery-overlay { opacity: 1; }
    .gb-wide-tall { grid-column: span 2; grid-row: span 2; }
    .gb-wide      { grid-column: span 2; }

    @media (max-width: 767px) {
        .gallery-grid { grid-template-columns: repeat(2, 1fr); }
        .gallery-masonry { columns: 2; }
        .gallery-bento { grid-template-columns: repeat(2,1fr); grid-auto-rows: 160px; }
        .gb-wide-tall  { grid-column: span 2; grid-row: span 1; }
        .lb-prev { left: .5rem; }
        .lb-next { right: .5rem; }
    }
    @media (hover: none) { .gallery-img { filter: none !important; } }
</style>

<script>
(function () {
    const items   = @json($items);
    const lb      = document.getElementById('gallery-lb');
    const lbImg   = document.getElementById('lb-img');
    const lbCap   = document.getElementById('lb-caption');
    const btnPrev = document.getElementById('lb-prev');
    const btnNext = document.getElementById('lb-next');
    let   current = 0;

    function open(idx) {
        current = idx;
        lbImg.src         = items[idx].image;
        lbImg.alt         = items[idx].caption ?? '';
        lbCap.textContent = items[idx].caption ?? '';
        btnPrev.disabled  = idx === 0;
        btnNext.disabled  = idx === items.length - 1;
        lb.classList.add('open');
        lb.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        lb.classList.remove('open');
        lb.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.gallery-item, .gallery-masonry-item, .gallery-bento-item').forEach(el => {
        el.addEventListener('click', () => open(+el.dataset.idx));
    });

    document.getElementById('lb-close').addEventListener('click', close);
    btnPrev.addEventListener('click', () => open(current - 1));
    btnNext.addEventListener('click', () => open(current + 1));

    lb.addEventListener('click', e => { if (e.target === lb) close(); });

    document.addEventListener('keydown', e => {
        if (! lb.classList.contains('open')) return;
        if (e.key === 'Escape')     close();
        if (e.key === 'ArrowLeft'  && current > 0)               open(current - 1);
        if (e.key === 'ArrowRight' && current < items.length - 1) open(current + 1);
    });
})();
</script>
@endif
