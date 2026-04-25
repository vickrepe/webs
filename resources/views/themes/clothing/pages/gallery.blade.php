@php
    $fontHeading = $site->config['typography']['heading'] ?? 'Montserrat';
    $fontBody    = $site->config['typography']['body']    ?? 'Lato';
    $uniqueFonts = array_unique([$fontHeading, $fontBody]);
    $fontsParam  = implode('&family=', array_map(
        fn($f) => str_replace(' ', '+', $f) . ':wght@400;700',
        $uniqueFonts
    ));
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookbook · {{ $site->config['business_name'] ?? $site->slug }}</title>
    @if ($site->logo_url)
        <link rel="icon" href="{{ asset('storage/' . $site->logo_url) }}" type="image/png">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fontsParam }}&display=swap" rel="stylesheet">
    @include('themes.clothing._head_styles', ['site' => $site, 'fontHeading' => $fontHeading, 'fontBody' => $fontBody])
    <style>
        .page-wrap { max-width: 1100px; margin: 0 auto; padding: 3rem 1.5rem 5rem; }
        .page-back { display: inline-block; margin-bottom: 1.5rem; font-size: .875rem; color: var(--primary); text-decoration: none; }
        .page-back:hover { text-decoration: underline; }
        .page-title { font-size: clamp(1.8rem, 4vw, 2.5rem); color: #1a1a1a; margin-bottom: 2rem; }
        .full-gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .full-gallery-item { position: relative; overflow: hidden; border-radius: 8px; cursor: pointer; }
        .full-gallery-item img { width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block; transition: transform .35s; }
        .full-gallery-item:hover img { transform: scale(1.04); }
        .full-gallery-overlay {
            position: absolute; inset: 0; background: rgba(0,0,0,.35);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity .25s;
        }
        .full-gallery-item:hover .full-gallery-overlay { opacity: 1; }

        .item-badge {
            position: absolute; top: .5rem; left: .5rem; z-index: 2;
            background: rgba(0,0,0,.55); color: #fff; font-size: .7rem;
            padding: .15rem .5rem; border-radius: 999px; pointer-events: none;
        }

        .item-delete {
            position: absolute; top: .4rem; right: .4rem; z-index: 3;
            background: rgba(200,30,30,.8); border: none; border-radius: 50%;
            width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #fff; transition: background .2s;
        }
        .item-delete:hover { background: rgba(200,30,30,1); }

        .owner-toolbar {
            display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
            margin-bottom: 1.5rem; padding: 1rem 1.25rem;
            background: #f8f8f8; border: 1px solid #e5e5e5; border-radius: 10px;
        }
        .owner-toolbar label.upload-btn {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .55rem 1.25rem; background: var(--primary); color: var(--text-on-primary);
            border-radius: 999px; font-size: .875rem; font-weight: 600; cursor: pointer;
            transition: opacity .2s;
        }
        .owner-toolbar label.upload-btn:hover { opacity: .85; }
        .owner-toolbar input[type="file"] { display: none; }
        .save-btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .55rem 1.5rem; background: #1a1a1a; color: #fff;
            border: none; border-radius: 999px; font-size: .875rem; font-weight: 600;
            cursor: pointer; transition: opacity .2s;
        }
        .save-btn:hover { opacity: .8; }
        .save-btn:disabled { opacity: .45; cursor: default; }
        .save-status { font-size: .8rem; color: #666; margin-left: auto; }

        .caption-input {
            display: block; width: 100%; margin-top: .4rem;
            background: rgba(255,255,255,.9); border: 1px solid #ddd;
            border-radius: 4px; padding: .3rem .5rem; font-size: .75rem;
            box-sizing: border-box;
        }

        .lb-backdrop { position:fixed;inset:0;z-index:9000;background:rgba(0,0,0,.92);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .25s; }
        .lb-backdrop.open { opacity:1;pointer-events:all; }
        .lb-content { display:flex;flex-direction:column;align-items:center;max-width:min(90vw,900px);width:100%; }
        .lb-content img { max-height:75vh;max-width:100%;object-fit:contain;border-radius:6px;display:block; }
        .lb-caption { color:rgba(255,255,255,.75);font-size:.9rem;margin-top:.9rem;text-align:center;min-height:1.4em; }
        .lb-close { position:fixed;top:1.25rem;right:1.25rem;background:rgba(255,255,255,.12);border:none;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff;transition:background .2s;z-index:9001; }
        .lb-close:hover { background:rgba(255,255,255,.25); }
        .lb-arrow { position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.12);border:none;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff;transition:background .2s;z-index:9001; }
        .lb-arrow:hover { background:rgba(255,255,255,.25); }
        .lb-prev { left:1.25rem; } .lb-next { right:1.25rem; }
        .lb-arrow:disabled { opacity:.25;cursor:default; }

        @media (max-width: 767px) { .full-gallery-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .full-gallery-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
@include('themes.clothing._nav', ['site' => $site])

<main>
    <div class="page-wrap">
        <a href="{{ route('site.show', $site->slug) }}#gallery" class="page-back">← Volver</a>
        <h1 class="page-title">Lookbook</h1>

        @if ($isOwner)
        <div class="owner-toolbar">
            <label class="upload-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                Añadir fotos
                <input type="file" id="file-input" accept="image/*" multiple>
            </label>
            <button class="save-btn" id="save-btn" disabled>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Guardar cambios
            </button>
            <span class="save-status" id="save-status"></span>
        </div>
        @endif

        @php $totalItems = count($homeItems) + count($moreItems); @endphp

        @if ($totalItems > 0)
            <div class="full-gallery-grid" id="gallery-grid">
                @foreach ($homeItems as $idx => $item)
                    <div class="full-gallery-item" data-idx="{{ $idx }}" data-src="{{ $item['image'] }}" data-caption="{{ $item['caption'] ?? '' }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['caption'] ?? '' }}">
                        @if ($isOwner)
                            <span class="item-badge">Inicio</span>
                        @endif
                        <div class="full-gallery-overlay">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                        </div>
                    </div>
                @endforeach
                @foreach ($moreItems as $idx => $item)
                    @php $globalIdx = count($homeItems) + $idx; @endphp
                    <div class="full-gallery-item" data-idx="{{ $globalIdx }}" data-src="{{ $item['image'] }}" data-caption="{{ $item['caption'] ?? '' }}" data-more-idx="{{ $idx }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['caption'] ?? '' }}">
                        @if ($isOwner)
                            <button class="item-delete" data-more-idx="{{ $idx }}" title="Eliminar">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                            <input class="caption-input" type="text" placeholder="Descripción (opcional)" value="{{ $item['caption'] ?? '' }}" data-more-idx="{{ $idx }}">
                        @endif
                        <div class="full-gallery-overlay">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color:#999;" id="empty-msg">No hay fotos todavía.</p>
        @endif
    </div>
</main>

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

@include('themes.clothing._footer', ['site' => $site])

<script>
(function () {
    const SLUG      = @json($site->slug);
    const SITE_ID   = @json($site->id);
    const IS_OWNER  = @json($isOwner);
    const HOME_COUNT = @json(count($homeItems));

    const lb      = document.getElementById('gallery-lb');
    const lbImg   = document.getElementById('lb-img');
    const lbCap   = document.getElementById('lb-caption');
    const btnPrev = document.getElementById('lb-prev');
    const btnNext = document.getElementById('lb-next');
    let   current = 0;

    function getClickableItems() {
        return Array.from(document.querySelectorAll('.full-gallery-item'));
    }

    function openLb(idx) {
        const items = getClickableItems();
        if (idx < 0 || idx >= items.length) return;
        current = idx;
        lbImg.src         = items[idx].dataset.src;
        lbImg.alt         = items[idx].dataset.caption ?? '';
        lbCap.textContent = items[idx].dataset.caption ?? '';
        btnPrev.disabled  = idx === 0;
        btnNext.disabled  = idx === items.length - 1;
        lb.classList.add('open');
        lb.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeLb() {
        lb.classList.remove('open');
        lb.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.getElementById('gallery-grid')?.addEventListener('click', e => {
        const item = e.target.closest('.full-gallery-item');
        if (!item) return;
        if (e.target.closest('.item-delete') || e.target.closest('.caption-input')) return;
        openLb(+item.dataset.idx);
    });

    document.getElementById('lb-close').addEventListener('click', closeLb);
    btnPrev.addEventListener('click', () => openLb(current - 1));
    btnNext.addEventListener('click', () => openLb(current + 1));
    lb.addEventListener('click', e => { if (e.target === lb) closeLb(); });

    document.addEventListener('keydown', e => {
        if (!lb.classList.contains('open')) return;
        if (e.key === 'Escape')     closeLb();
        if (e.key === 'ArrowLeft'  && current > 0)                    openLb(current - 1);
        if (e.key === 'ArrowRight' && current < getClickableItems().length - 1) openLb(current + 1);
    });

    if (!IS_OWNER) return;

    const grid    = document.getElementById('gallery-grid');
    const saveBtn = document.getElementById('save-btn');
    const status  = document.getElementById('save-status');
    const emptyMsg = document.getElementById('empty-msg');

    function markDirty() {
        saveBtn.disabled = false;
        status.textContent = '';
    }

    function getMoreItems() {
        return Array.from(grid?.querySelectorAll('[data-more-idx]') ?? []).map(el => ({
            image:   el.dataset.src,
            caption: el.querySelector('.caption-input')?.value ?? '',
        }));
    }

    function reindexItems() {
        let globalIdx = HOME_COUNT;
        grid?.querySelectorAll('[data-more-idx]').forEach((el, i) => {
            el.dataset.moreIdx = i;
            el.dataset.idx     = globalIdx++;
            const del = el.querySelector('.item-delete');
            if (del) del.dataset.moreIdx = i;
            const cap = el.querySelector('.caption-input');
            if (cap) cap.dataset.moreIdx = i;
        });
    }

    function buildMoreCard(url, caption) {
        const div = document.createElement('div');
        div.className = 'full-gallery-item';
        div.dataset.src     = url;
        div.dataset.caption = caption ?? '';
        div.dataset.moreIdx = '0';
        div.dataset.idx     = '0';
        div.innerHTML = `
            <img src="${url}" alt="">
            <button class="item-delete" title="Eliminar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            <input class="caption-input" type="text" placeholder="Descripción (opcional)" value="${caption ?? ''}">
            <div class="full-gallery-overlay">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
            </div>`;
        div.querySelector('.caption-input').addEventListener('input', markDirty);
        return div;
    }

    grid?.addEventListener('click', e => {
        const del = e.target.closest('.item-delete');
        if (!del) return;
        e.stopPropagation();
        del.closest('.full-gallery-item').remove();
        reindexItems();
        if (emptyMsg && !grid.querySelector('.full-gallery-item')) emptyMsg.style.display = '';
        markDirty();
    });

    grid?.addEventListener('input', e => {
        if (e.target.classList.contains('caption-input')) {
            e.target.closest('.full-gallery-item').dataset.caption = e.target.value;
            markDirty();
        }
    });

    document.getElementById('file-input')?.addEventListener('change', async function () {
        const files = Array.from(this.files);
        if (!files.length) return;

        saveBtn.disabled = true;
        status.textContent = 'Subiendo…';

        for (const file of files) {
            const fd = new FormData();
            fd.append('image', file);
            fd.append('_token', document.querySelector('meta[name="csrf-token"]')?.content
                ?? document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1]?.replace(/%3D/g,'=') ?? '');

            try {
                const res  = await fetch(`/dashboard/sites/${SITE_ID}/upload-image`, { method: 'POST', body: fd });
                const data = await res.json();
                if (data.url) {
                    if (!grid) {
                        const g = document.createElement('div');
                        g.className = 'full-gallery-grid';
                        g.id = 'gallery-grid';
                        emptyMsg?.replaceWith(g);
                    }
                    const card = buildMoreCard(data.url, '');
                    document.getElementById('gallery-grid').appendChild(card);
                    if (emptyMsg) emptyMsg.style.display = 'none';
                    reindexItems();
                }
            } catch (_) {}
        }

        this.value = '';
        saveBtn.disabled = false;
        status.textContent = 'Listo para guardar';
        markDirty();
    });

    saveBtn.addEventListener('click', async () => {
        saveBtn.disabled = true;
        status.textContent = 'Guardando…';

        const more_items = getMoreItems();
        const token = document.querySelector('meta[name="csrf-token"]')?.content
            ?? document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1]?.replace(/%3D/g,'=') ?? '';

        const saveUrl = "{{ route('site.more-items.update', ['slug' => $site->slug, 'sectionType' => 'gallery']) }}";

        try {
            const res  = await fetch(saveUrl, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                body: JSON.stringify({ more_items }),
            });
            const data = await res.json();
            status.textContent = data.ok ? '¡Guardado!' : 'Error al guardar';
        } catch (_) {
            status.textContent = 'Error de red';
        }

        setTimeout(() => { status.textContent = ''; }, 3000);
    });
})();
</script>
</body>
</html>
