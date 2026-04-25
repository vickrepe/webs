<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} · {{ $site->config['business_name'] ?? $site->slug }}</title>
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
        $isOwner = auth()->check() && auth()->id() === $site->user_id;
    @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fontsParam }}&display=swap" rel="stylesheet">
    @if ($isOwner)
        <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
    @endif
    @include('themes.barbershop.blog._styles')
    <style>
        .post-wrap { max-width: 720px; margin: 0 auto; padding: 2.5rem 1.5rem 5rem; }
        .post-back { display: inline-block; margin-bottom: 1.5rem; font-size: .875rem; color: var(--primary); text-decoration: none; }
        .post-back:hover { text-decoration: underline; }
        .post-cover { width: 100%; max-height: 420px; object-fit: cover; border-radius: 12px; margin-bottom: 2rem; }
        .post-title { font-size: clamp(1.6rem, 3.5vw, 2.4rem); color: #1a1a1a; margin-bottom: .75rem; }
        .post-meta { font-size: .8rem; color: #999; margin-bottom: 2rem; display: flex; align-items: center; gap: .75rem; }
        .post-draft-badge { background: #fef3c7; color: #92400e; border-radius: 4px; padding: .15rem .5rem; font-size: .75rem; font-weight: 600; }
        .post-body { font-size: 1rem; line-height: 1.8; color: #333; }
        .post-body h1,.post-body h2,.post-body h3 { margin: 1.5rem 0 .5rem; color: #1a1a1a; }
        .post-body p { margin-bottom: 1rem; }
        .post-body ul,.post-body ol { padding-left: 1.5rem; margin-bottom: 1rem; }
        .post-body li { margin-bottom: .25rem; }
        .post-body a { color: var(--primary); }
        .post-body blockquote { border-left: 3px solid var(--primary); padding-left: 1rem; color: #666; font-style: italic; margin: 1.5rem 0; }
        .post-body img { border-radius: 8px; margin: 1rem 0; }

        /* Owner toolbar */
        .owner-bar { position: fixed; bottom: 0; left: 0; right: 0; background: #1a1a1a; display: flex; align-items: center; gap: 1rem; padding: .75rem 1.5rem; z-index: 200; flex-wrap: wrap; }
        .owner-bar input[type="text"] { flex: 1; min-width: 180px; background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: 6px; padding: .45rem .75rem; font-size: .9rem; font-family: inherit; }
        .owner-bar input[type="text"]::placeholder { color: #777; }
        .owner-bar .ob-btn { padding: .45rem 1rem; border-radius: 6px; font-size: .85rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; white-space: nowrap; }
        .ob-save    { background: var(--primary); color: var(--text-on-primary); }
        .ob-save:hover { opacity: .9; }
        .ob-publish { background: #16a34a; color: #fff; }
        .ob-publish:hover { background: #15803d; }
        .ob-unpublish { background: #dc2626; color: #fff; }
        .ob-unpublish:hover { background: #b91c1c; }
        .ob-delete  { background: transparent; color: #ef4444; border: 1px solid #ef4444 !important; }
        .ob-delete:hover { background: #ef444422; }
        .ob-cover   { background: #374151; color: #d1d5db; }
        .ob-status  { font-size: .8rem; color: #9ca3af; margin-left: auto; }

        #quill-editor { min-height: 300px; font-size: 1rem; line-height: 1.8; color: #333; border: none; }
        .ql-toolbar { border-radius: 8px 8px 0 0; border-color: #e5e7eb !important; }
        .ql-container { border-radius: 0 0 8px 8px; border-color: #e5e7eb !important; font-family: var(--font-body); font-size: 1rem; }
        .ql-editor { min-height: 300px; padding: 1.25rem; }

        @media (max-width: 600px) {
            .owner-bar { gap: .5rem; }
            .owner-bar input[type="text"] { width: 100%; flex: none; }
            .ob-status { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body style="{{ $isOwner ? 'padding-bottom:70px;' : '' }}">
@include('themes.barbershop.blog._nav')

<main>
    <div class="post-wrap">
        <a href="{{ route('blog.index', $site->slug) }}" class="post-back">← Todos los artículos</a>

        @if ($post->cover_image)
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="post-cover" id="post-cover-img">
        @else
            <div id="post-cover-img"></div>
        @endif

        @if ($isOwner)
            <h1 class="post-title" id="post-title-display">{{ $post->title }}</h1>
        @else
            <h1 class="post-title">{{ $post->title }}</h1>
        @endif

        <div class="post-meta">
            @if ($post->published_at)
                <span>{{ $post->published_at->format('d M Y') }}</span>
            @endif
            @if (! $post->published)
                <span class="post-draft-badge">Borrador</span>
            @endif
        </div>

        @if ($isOwner)
            <div id="quill-editor">{!! $post->content !!}</div>
        @else
            <div class="post-body">{!! $post->content !!}</div>
        @endif
    </div>
</main>

@include('themes.barbershop.blog._footer')

@if ($isOwner)
<div class="owner-bar" id="owner-bar">
    <input type="text" id="ob-title" value="{{ $post->title }}" placeholder="Título del artículo">
    <input type="text" id="ob-excerpt" value="{{ $post->excerpt ?? '' }}" placeholder="Extracto (opcional)">
    <button class="ob-btn ob-cover" id="ob-cover-btn">Portada</button>
    <input type="file" id="ob-cover-input" accept="image/*" style="display:none">
    <button class="ob-btn ob-save" id="ob-save-btn">Guardar</button>
    <button class="ob-btn {{ $post->published ? 'ob-unpublish' : 'ob-publish' }}" id="ob-publish-btn">
        {{ $post->published ? 'Despublicar' : 'Publicar' }}
    </button>
    <button class="ob-btn ob-delete" id="ob-delete-btn">Eliminar</button>
    <span class="ob-status" id="ob-status"></span>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<script>
(function () {
    const SITE  = @json($site->slug);
    const CSRF  = @json(csrf_token());
    const BASE  = `/site/${SITE}/blog`;
    const url   = {
        update:  () => `${BASE}/${currentSlug}`,
        publish: () => `${BASE}/${currentSlug}/publish`,
        cover:   () => `${BASE}/${currentSlug}/cover`,
        destroy: () => `${BASE}/${currentSlug}`,
    };

    let published   = @json($post->published);
    let currentSlug = @json($post->slug);

    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'image', 'blockquote'],
                ['clean'],
            ]
        }
    });

    function setStatus(msg, ok = true) {
        const el = document.getElementById('ob-status');
        el.textContent = msg;
        el.style.color = ok ? '#86efac' : '#fca5a5';
        if (ok) setTimeout(() => { el.textContent = ''; }, 3000);
    }

    async function save() {
        const title   = document.getElementById('ob-title').value.trim();
        const excerpt = document.getElementById('ob-excerpt').value.trim();
        const content = quill.root.innerHTML;

        if (! title) { setStatus('El título no puede estar vacío.', false); return; }

        document.getElementById('ob-save-btn').disabled = true;
        try {
            const res = await fetch(url.update(), {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: JSON.stringify({ title, excerpt, content }),
            });
            const data = await res.json();
            if (data.ok) {
                const prevSlug = currentSlug;
                currentSlug = data.slug;
                document.getElementById('post-title-display').textContent = title;
                if (data.slug !== prevSlug) {
                    history.replaceState(null, '', `${BASE}/${data.slug}`);
                }
                setStatus('Guardado.');
            } else {
                setStatus('Error al guardar.', false);
            }
        } catch {
            setStatus('Error de red.', false);
        }
        document.getElementById('ob-save-btn').disabled = false;
    }

    document.getElementById('ob-save-btn').addEventListener('click', save);

    document.getElementById('ob-publish-btn').addEventListener('click', async function () {
        this.disabled = true;
        try {
            const res  = await fetch(url.publish(), {
                method: 'PATCH',
                headers: { 'X-CSRF-TOKEN': CSRF },
            });
            const data = await res.json();
            if (data.ok) {
                published = data.published;
                this.textContent = published ? 'Despublicar' : 'Publicar';
                this.className   = 'ob-btn ' + (published ? 'ob-unpublish' : 'ob-publish');
                // Update draft badge
                const badge = document.querySelector('.post-draft-badge');
                if (published && badge) badge.remove();
                if (! published) {
                    const meta = document.querySelector('.post-meta');
                    if (! meta.querySelector('.post-draft-badge')) {
                        const b = document.createElement('span');
                        b.className = 'post-draft-badge';
                        b.textContent = 'Borrador';
                        meta.appendChild(b);
                    }
                }
                setStatus(published ? 'Publicado.' : 'Despublicado.');
            }
        } catch {
            setStatus('Error.', false);
        }
        this.disabled = false;
    });

    document.getElementById('ob-delete-btn').addEventListener('click', function () {
        if (! confirm('¿Eliminar este artículo? Esta acción no se puede deshacer.')) return;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url.destroy();
        form.innerHTML = `<input name="_token" value="${CSRF}"><input name="_method" value="DELETE">`;
        document.body.appendChild(form);
        form.submit();
    });

    // Cover image upload
    document.getElementById('ob-cover-btn').addEventListener('click', () => {
        document.getElementById('ob-cover-input').click();
    });

    document.getElementById('ob-cover-input').addEventListener('change', async function () {
        const file = this.files[0];
        if (! file) return;
        const fd = new FormData();
        fd.append('cover', file);
        fd.append('_token', CSRF);
        setStatus('Subiendo portada…');
        try {
            const res  = await fetch(url.cover(), { method: 'POST', body: fd });
            const data = await res.json();
            if (data.ok) {
                let img = document.getElementById('post-cover-img');
                if (img.tagName === 'DIV') {
                    img = document.createElement('img');
                    img.id        = 'post-cover-img';
                    img.className = 'post-cover';
                    img.alt       = '';
                    document.getElementById('post-cover-img').replaceWith(img);
                }
                img.src = data.url;
                setStatus('Portada actualizada.');
            } else {
                setStatus('Error al subir portada.', false);
            }
        } catch {
            setStatus('Error de red.', false);
        }
    });
})();
</script>
@endif
</body>
</html>
