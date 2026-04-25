@php
    $posts   = $site->blogPosts()->where('published', true)->latest('published_at')->take(3)->get();
    $isOwner = auth()->check() && auth()->id() === $site->user_id;
@endphp

@if ($posts->isNotEmpty() || $isOwner)
<section id="blog" class="section-wrap section-light">
    <div class="section-inner">
        <div class="section-heading">
            <h2>Blog</h2>
            <div class="heading-line"></div>
        </div>

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
        <div style="text-align:center;margin-top:2.5rem;">
            <a href="{{ route('blog.index', $site->slug) }}" class="blog-more-btn">Ver todos los artículos</a>
        </div>
        @endif

        @if ($isOwner)
        <div style="text-align:center;margin-top:1.5rem;">
            <form method="POST" action="{{ route('blog.store', $site->slug) }}" style="display:inline;">
                @csrf
                <button type="submit" class="blog-new-btn">+ Nuevo artículo</button>
            </form>
        </div>
        @endif
    </div>
</section>

<style>
.blog-preview-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; }
.blog-card { text-decoration:none; color:inherit; border:1px solid var(--outline); border-radius:10px; overflow:hidden; display:flex; flex-direction:column; transition:box-shadow .2s; }
.blog-card:hover { box-shadow:0 4px 16px rgba(0,0,0,.08); }
.blog-card-img { width:100%; height:160px; object-fit:cover; display:block; }
.blog-card-body { padding:1.25rem; flex:1; display:flex; flex-direction:column; gap:.5rem; }
.blog-card-body h3 { font-size:1rem; font-weight:700; color:var(--on-surface); }
.blog-card-body p { font-size:.875rem; color:var(--on-surface-muted); line-height:1.5; flex:1; }
.blog-card-date { font-size:.75rem; color:var(--on-surface-muted); }
.blog-more-btn { display:inline-block; padding:.75rem 2rem; border:2px solid var(--primary); color:var(--primary); border-radius:999px; font-weight:700; font-size:.875rem; text-decoration:none; transition:all .2s; }
.blog-more-btn:hover { background:var(--primary); color:var(--text-on-primary); }
.blog-new-btn { display:inline-block; padding:.6rem 1.5rem; background:var(--surface-high); color:var(--on-surface-muted); border:1px dashed var(--outline); border-radius:8px; font-size:.85rem; cursor:pointer; font-family:inherit; transition:background .2s; }
.blog-new-btn:hover { background:var(--surface-high); }
@media (max-width:767px) { .blog-preview-grid { grid-template-columns:1fr; } }
</style>
@endif
