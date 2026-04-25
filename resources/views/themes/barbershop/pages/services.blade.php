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
    <title>Servicios · {{ $site->config['business_name'] ?? $site->slug }}</title>
    @if ($site->logo_url)
        <link rel="icon" href="{{ asset('storage/' . $site->logo_url) }}" type="image/png">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fontsParam }}&display=swap" rel="stylesheet">
    @include('themes.barbershop._head_styles', ['site' => $site, 'fontHeading' => $fontHeading, 'fontBody' => $fontBody])
    <style>
        .page-wrap { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem 0; }
        .page-back { display: inline-block; margin-bottom: 1.5rem; font-size: .875rem; color: var(--primary); text-decoration: none; }
        .page-back:hover { text-decoration: underline; }

        /* Owner toolbar */
        .owner-toolbar {
            display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
            margin-bottom: 1.5rem; padding: 1rem 1.25rem;
            background: #f8f8f8; border: 1px solid #e5e5e5; border-radius: 10px;
        }
        .save-btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .55rem 1.5rem; background: #1a1a1a; color: #fff;
            border: none; border-radius: 999px; font-size: .875rem; font-weight: 600;
            cursor: pointer; transition: opacity .2s;
        }
        .save-btn:hover { opacity: .8; }
        .save-btn:disabled { opacity: .45; cursor: default; }
        .save-status { font-size: .8rem; color: #666; margin-left: auto; }

        /* Badges */
        .item-badge {
            display: inline-block; font-size: .7rem; padding: .15rem .5rem;
            background: #e0e0e0; color: #555; border-radius: 999px; margin-bottom: .5rem;
        }

        /* Services grid */
        .services-more-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; padding: 0 1.5rem 3rem; max-width: 1100px; margin: 0 auto; }
        .svc-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.06); display: flex; flex-direction: column; position: relative; }
        .svc-card-img { width: 100%; height: 160px; object-fit: cover; display: block; }
        .svc-card-body { padding: 1.25rem; flex: 1; }
        .svc-card-body h3 { font-weight: 700; margin-bottom: .4rem; color: #1a1a1a; font-size: 1.05rem; }
        .svc-card-price { color: var(--primary); font-weight: 700; font-size: 1.1rem; margin-bottom: .4rem; }
        .svc-card-desc { color: #666; font-size: .875rem; line-height: 1.6; }
        .svc-card-home-badge { position: absolute; top: .5rem; left: .5rem; background: rgba(0,0,0,.5); color: #fff; font-size: .7rem; padding: .15rem .5rem; border-radius: 999px; }
        .svc-card-delete {
            position: absolute; top: .4rem; right: .4rem;
            background: rgba(200,30,30,.8); border: none; border-radius: 50%;
            width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #fff; transition: background .2s;
        }
        .svc-card-delete:hover { background: rgba(200,30,30,1); }

        /* Alternating layout extra items */
        .svc-alt-more { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem 3rem; }

        /* Add form */
        .add-service-panel {
            max-width: 1100px; margin: 0 auto 2rem; padding: 1.25rem 1.5rem;
            background: #f8f8f8; border: 1px dashed #ccc; border-radius: 10px;
        }
        .add-service-panel h3 { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; color: #1a1a1a; }
        .add-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
        .add-form-grid input, .add-form-grid textarea {
            padding: .6rem .8rem; border: 1px solid #ddd; border-radius: 6px; font-size: .875rem;
            font-family: inherit; width: 100%; box-sizing: border-box;
        }
        .add-form-grid textarea { resize: vertical; min-height: 70px; }
        .add-form-grid .full-col { grid-column: 1 / -1; }
        .add-form-actions { display: flex; align-items: center; gap: 1rem; margin-top: 1rem; flex-wrap: wrap; }
        .add-form-upload { display: inline-flex; align-items: center; gap: .4rem; padding: .5rem 1.1rem; background: #fff; border: 1px solid #ccc; border-radius: 999px; font-size: .8rem; cursor: pointer; }
        .add-form-upload:hover { background: #f0f0f0; }
        .add-form-upload input[type="file"] { display: none; }
        .add-form-submit { padding: .5rem 1.25rem; background: var(--primary); color: var(--text-on-primary); border: none; border-radius: 999px; font-size: .875rem; font-weight: 600; cursor: pointer; transition: opacity .2s; }
        .add-form-submit:hover { opacity: .85; }
        .add-form-preview { width: 64px; height: 48px; object-fit: cover; border-radius: 6px; display: none; }

        @media (max-width: 1023px) { .services-more-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 767px) {
            .services-more-grid { grid-template-columns: 1fr; }
            .add-form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
@include('themes.barbershop._nav', ['site' => $site])

<main>
    <div class="page-wrap">
        <a href="{{ route('site.show', $site->slug) }}#services" class="page-back">← Volver</a>
    </div>

    @php
        $layout   = $section->config['layout'] ?? 'grid';
        $allItems = array_merge($homeItems, $moreItems);
    @endphp

    {{-- Render home items via the normal section partial (read-only, no show_more) --}}
    @include('themes.barbershop.sections.services', [
        'data' => ['items' => $homeItems, 'layout' => $layout, 'show_more' => '0'],
        'site' => $site,
    ])

    @if ($isOwner)
    {{-- Owner toolbar --}}
    <div class="page-wrap" style="padding-bottom: 0;">
        <div class="owner-toolbar">
            <strong style="font-size:.875rem;">Gestionar servicios adicionales</strong>
            <button class="save-btn" id="save-btn" disabled>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Guardar cambios
            </button>
            <span class="save-status" id="save-status"></span>
        </div>
    </div>
    @endif

    {{-- More items --}}
    @if (count($moreItems) > 0 || $isOwner)
    <div class="services-more-grid" id="more-items-grid">
        @foreach ($moreItems as $idx => $item)
        <div class="svc-card" data-more-idx="{{ $idx }}">
            @if (!empty($item['image']))
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] ?? '' }}" class="svc-card-img" data-field="image">
            @endif
            @if ($isOwner)
                <button class="svc-card-delete" title="Eliminar">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            @endif
            <div class="svc-card-body">
                <h3 data-field="name">{{ $item['name'] ?? '' }}</h3>
                @if (!empty($item['price']))
                    <p class="svc-card-price" data-field="price">{{ $item['price'] }}</p>
                @endif
                @if (!empty($item['description']))
                    <p class="svc-card-desc" data-field="description">{{ $item['description'] }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if ($isOwner)
    {{-- Add service form --}}
    <div class="add-service-panel" id="add-service-panel">
        <h3>+ Añadir servicio</h3>
        <div class="add-form-grid">
            <input type="text" id="new-name" placeholder="Nombre del servicio *">
            <input type="text" id="new-price" placeholder="Precio (ej: $25)">
            <textarea id="new-desc" class="full-col" placeholder="Descripción (opcional)"></textarea>
        </div>
        <div class="add-form-actions">
            <label class="add-form-upload">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                Imagen
                <input type="file" id="new-image-input" accept="image/*">
            </label>
            <img id="new-image-preview" class="add-form-preview" src="" alt="">
            <button class="add-form-submit" id="add-service-btn">Añadir</button>
        </div>
    </div>
    @endif
</main>

@include('themes.barbershop._footer', ['site' => $site])

@if ($isOwner)
<script>
(function () {
    const SLUG    = @json($site->slug);
    const SITE_ID = @json($site->id);

    const grid    = document.getElementById('more-items-grid');
    const saveBtn = document.getElementById('save-btn');
    const status  = document.getElementById('save-status');

    function getToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content
            ?? document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1]?.replace(/%3D/g,'=') ?? '';
    }

    function markDirty() {
        saveBtn.disabled = false;
        status.textContent = '';
    }

    function getMoreItems() {
        return Array.from(grid?.querySelectorAll('[data-more-idx]') ?? []).map(card => ({
            name:        card.querySelector('[data-field="name"]')?.textContent?.trim()        ?? '',
            price:       card.querySelector('[data-field="price"]')?.textContent?.trim()       ?? '',
            description: card.querySelector('[data-field="description"]')?.textContent?.trim() ?? '',
            image:       card.querySelector('[data-field="image"]')?.src ?? '',
        }));
    }

    function reindex() {
        grid?.querySelectorAll('[data-more-idx]').forEach((el, i) => { el.dataset.moreIdx = i; });
    }

    function buildMoreCard(item) {
        const card = document.createElement('div');
        card.className = 'svc-card';
        card.dataset.moreIdx = '0';
        card.innerHTML = `
            ${item.image ? `<img src="${item.image}" alt="${item.name ?? ''}" class="svc-card-img" data-field="image">` : ''}
            <button class="svc-card-delete" title="Eliminar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            <div class="svc-card-body">
                <h3 data-field="name">${item.name ?? ''}</h3>
                ${item.price       ? `<p class="svc-card-price" data-field="price">${item.price}</p>` : ''}
                ${item.description ? `<p class="svc-card-desc"  data-field="description">${item.description}</p>` : ''}
            </div>`;
        return card;
    }

    // Ensure grid exists
    function ensureGrid() {
        let g = document.getElementById('more-items-grid');
        if (!g) {
            g = document.createElement('div');
            g.className = 'services-more-grid';
            g.id = 'more-items-grid';
            document.getElementById('add-service-panel').before(g);
        }
        return g;
    }

    // Delete
    document.addEventListener('click', e => {
        const del = e.target.closest('.svc-card-delete');
        if (!del) return;
        del.closest('[data-more-idx]').remove();
        reindex();
        markDirty();
    });

    // Image preview
    let pendingImageUrl = '';
    document.getElementById('new-image-input')?.addEventListener('change', async function () {
        const file = this.files[0];
        if (!file) return;
        const fd = new FormData();
        fd.append('image', file);
        fd.append('_token', getToken());
        try {
            const res  = await fetch(`/dashboard/sites/${SITE_ID}/upload-image`, { method: 'POST', body: fd });
            const data = await res.json();
            if (data.url) {
                pendingImageUrl = data.url;
                const preview = document.getElementById('new-image-preview');
                preview.src = data.url;
                preview.style.display = 'block';
            }
        } catch (_) {}
        this.value = '';
    });

    // Add service
    document.getElementById('add-service-btn')?.addEventListener('click', () => {
        const name  = document.getElementById('new-name').value.trim();
        if (!name) { document.getElementById('new-name').focus(); return; }

        const item = {
            name,
            price:       document.getElementById('new-price').value.trim(),
            description: document.getElementById('new-desc').value.trim(),
            image:       pendingImageUrl,
        };

        const g = ensureGrid();
        g.appendChild(buildMoreCard(item));
        reindex();
        markDirty();

        // Reset form
        document.getElementById('new-name').value  = '';
        document.getElementById('new-price').value = '';
        document.getElementById('new-desc').value  = '';
        const preview = document.getElementById('new-image-preview');
        preview.src   = '';
        preview.style.display = 'none';
        pendingImageUrl = '';
    });

    // Save
    saveBtn.addEventListener('click', async () => {
        saveBtn.disabled = true;
        status.textContent = 'Guardando…';

        const more_items = getMoreItems();
        const saveUrl = "{{ route('site.more-items.update', ['slug' => $site->slug, 'sectionType' => 'services']) }}";

        try {
            const res  = await fetch(saveUrl, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getToken(), 'Accept': 'application/json' },
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
@endif
</body>
</html>
