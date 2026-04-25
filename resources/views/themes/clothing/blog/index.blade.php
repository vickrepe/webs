<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog · {{ $site->config['business_name'] ?? $site->slug }}</title>
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
    @include('themes.clothing.blog._styles')
    <style>
        .blog-header { padding: 3rem 1.5rem 2rem; max-width: 960px; margin: 0 auto; }
        .blog-header h1 { font-size: clamp(1.6rem, 3vw, 2.2rem); color: #1a1a1a; margin-bottom: .5rem; }
        .blog-header p { color: #666; font-size: .95rem; }
        .blog-grid-wrap { max-width: 960px; margin: 0 auto; padding: 0 1.5rem 4rem; }
        .blog-pagination { display: flex; gap: .5rem; justify-content: center; margin-top: 3rem; }
        .blog-pagination a,
        .blog-pagination span { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; border: 1px solid #eee; font-size: .85rem; text-decoration: none; color: #444; }
        .blog-pagination .active { background: var(--primary); color: var(--text-on-primary); border-color: var(--primary); font-weight: 700; }
        .blog-empty { text-align: center; color: #999; padding: 3rem 0; font-size: .95rem; }
        .blog-new-wrap { text-align: center; margin-bottom: 2rem; }
    </style>
</head>
<body>
@include('themes.clothing.blog._nav')

<main>
    <div class="blog-header">
        <h1>Blog</h1>
        <p><a href="{{ route('site.show', $site->slug) }}" style="color:var(--primary);text-decoration:none;">← Volver al inicio</a></p>
    </div>

    <div class="blog-grid-wrap">
        @php $isOwner = auth()->check() && auth()->id() === $site->user_id; @endphp

        @if ($isOwner)
        <div class="blog-new-wrap">
            <form method="POST" action="{{ route('blog.store', $site->slug) }}" style="display:inline;">
                @csrf
                <button type="submit" class="blog-new-btn">+ Nuevo artículo</button>
            </form>
        </div>
        @endif

        @if ($posts->isNotEmpty())
            <div class="blog-preview-grid">
                @foreach ($posts as $post)
                    <a href="{{ route('blog.show', [$site->slug, $post->slug]) }}" class="blog-card">
                        @if ($post->cover_image)
                            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="blog-card-img">
                        @endif
                        <div class="blog-card-body">
                            <h3>{{ $post->title }}</h3>
                            @if ($post->excerpt)
                                <p>{{ Str::limit($post->excerpt, 100) }}</p>
                            @endif
                            <span class="blog-card-date">{{ $post->published_at->format('d M Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($posts->hasPages())
            <div class="blog-pagination">
                {{-- Previous --}}
                @if ($posts->onFirstPage())
                    <span>&lsaquo;</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}">&lsaquo;</a>
                @endif

                {{-- Page numbers --}}
                @foreach (range(1, $posts->lastPage()) as $page)
                    @if ($page === $posts->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $posts->url($page) }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}">&rsaquo;</a>
                @else
                    <span>&rsaquo;</span>
                @endif
            </div>
            @endif
        @else
            <p class="blog-empty">Todavía no hay artículos publicados.</p>
        @endif
    </div>
</main>

@include('themes.clothing.blog._footer')
</body>
</html>
