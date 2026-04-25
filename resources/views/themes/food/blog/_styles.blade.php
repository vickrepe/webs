<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
        --primary:         {{ $site->config['colors']['primary'] ?? '#2d2d2d' }};
        --secondary:       {{ $site->secondaryColor() }};
        --text-on-primary: {{ $site->textOnPrimary() }};
        --font-heading:    '{{ $site->config['typography']['heading'] ?? 'Montserrat' }}', sans-serif;
        --font-body:       '{{ $site->config['typography']['body'] ?? 'Lato' }}', sans-serif;
    }
    body { font-family: var(--font-body); color: #1a1a1a; background: #fff; }
    h1, h2, h3, h4 { font-family: var(--font-heading); line-height: 1.2; }
    img { display: block; max-width: 100%; }
    p { line-height: 1.7; color: #444; }
    .heading-line { width: 48px; height: 3px; background: var(--primary); border-radius: 2px; }

    .site-nav { position: sticky; top: 0; z-index: 100; background: #fff; border-bottom: 1px solid #eee; }
    .nav-inner { display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 0 auto; padding: .75rem 1.5rem; gap: 1rem; }
    .nav-logo { height: 56px; width: auto; object-fit: contain; }
    .nav-logo-text { font-weight: 700; font-size: 1.1rem; color: var(--primary); text-decoration: none; }
    .nav-links { display: flex; gap: 1.5rem; list-style: none; }
    .nav-links a { text-decoration: none; font-size: .875rem; font-weight: 600; color: #444; transition: color .2s; }
    .nav-links a:hover { color: var(--primary); }
    .nav-hamburger { display: none; background: none; border: none; cursor: pointer; padding: .25rem; color: #444; align-items: center; justify-content: center; }
    .nav-mobile { display: none; flex-direction: column; list-style: none; padding: .5rem 1.5rem 1rem; border-top: 1px solid #eee; }
    .nav-mobile.open { display: flex; }
    .nav-mobile li a { display: block; text-decoration: none; font-size: .9rem; font-weight: 600; color: #444; padding: .6rem 0; border-bottom: 1px solid #f5f5f5; transition: color .2s; }
    .nav-mobile li:last-child a { border-bottom: none; }
    .nav-mobile li a:hover { color: var(--primary); }
    @media (max-width: 767px) {
        .nav-links { display: none; }
        .nav-hamburger { display: flex; }
    }

    .site-footer { background: #1a1a1a; padding: 2rem 1.5rem 1.5rem; }
    .footer-inner { display: flex; justify-content: space-between; align-items: flex-start; gap: 2rem; max-width: 960px; margin: 0 auto 1.5rem; }
    .footer-logo { display: block; height: 44px; opacity: .85; margin-bottom: .5rem; }
    .footer-social { display: flex; gap: 1rem; align-items: center; }
    .footer-social a { color: #555; line-height: 0; transition: color .2s; }
    .footer-social a:hover { color: #fff; }
    .footer-copy { text-align: center; color: #444; font-size: .78rem; border-top: 1px solid #2a2a2a; padding-top: 1.25rem; max-width: 960px; margin: 0 auto; }
    .footer-copy a { color: #555; text-decoration: none; }

    .blog-preview-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .blog-card { text-decoration: none; color: inherit; border: 1px solid #eee; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; transition: box-shadow .2s; }
    .blog-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.08); }
    .blog-card-img { width: 100%; height: 160px; object-fit: cover; }
    .blog-card-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; gap: .5rem; }
    .blog-card-body h3 { font-size: 1rem; font-weight: 700; color: #1a1a1a; }
    .blog-card-body p { font-size: .875rem; color: #666; line-height: 1.5; flex: 1; }
    .blog-card-date { font-size: .75rem; color: #999; }
    .blog-new-btn { display: inline-block; padding: .6rem 1.5rem; background: #f0f0f5; color: #555; border: 1px dashed #ccc; border-radius: 8px; font-size: .85rem; cursor: pointer; font-family: inherit; transition: background .2s; }
    .blog-new-btn:hover { background: #e4e4ef; }
    @media (max-width: 767px) {
        .blog-preview-grid { grid-template-columns: 1fr; }
        .footer-inner { flex-direction: column; align-items: center; }
    }
</style>
