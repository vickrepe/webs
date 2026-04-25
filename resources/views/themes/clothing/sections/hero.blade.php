@php
    $bgImages   = array_values(array_filter([
        $data['bg_image']   ?? '',
        $data['bg_image_2'] ?? '',
        $data['bg_image_3'] ?? '',
    ]));
    $hasImages  = count($bgImages) > 0;
    $isSlideshow = count($bgImages) > 1;

    $btnBg    = $hasImages ? 'var(--primary)' : '#ffffff';
    $btnColor = $hasImages ? 'var(--text-on-primary)' : 'var(--primary)';
    $layout   = $data['layout'] ?? 'fullscreen';
@endphp

@if ($layout === 'split')
<section id="hero" style="min-height:100vh;display:grid;grid-template-columns:1fr 1fr;overflow:hidden;">
    <div style="display:flex;flex-direction:column;justify-content:center;padding:5rem 3rem 5rem max(2rem,5vw);background:var(--surface);">
        @if(!empty($data['headline']))
            <h1 style="font-size:clamp(2.5rem,4vw,4rem);font-weight:700;color:var(--on-surface);line-height:1.1;margin-bottom:1.25rem;">{{ $data['headline'] }}</h1>
        @endif
        @if(!empty($data['subheadline']))
            <p style="font-size:1.05rem;color:var(--on-surface-muted);line-height:1.7;margin-bottom:2.5rem;max-width:480px;">{{ $data['subheadline'] }}</p>
        @endif
        @if(!empty($data['cta_text']))
            <a href="#contact" style="display:inline-block;background:var(--primary);color:var(--on-primary);padding:.9rem 2.5rem;border-radius:999px;font-weight:700;text-decoration:none;align-self:flex-start;transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">{{ $data['cta_text'] }}</a>
        @endif
    </div>
    <div style="position:relative;overflow:hidden;min-height:60vw;">
        @if($hasImages)
            <img src="{{ $bgImages[0] }}" alt="{{ $data['headline'] ?? '' }}" style="width:100%;height:100%;object-fit:cover;display:block;position:absolute;inset:0;">
        @else
            <div style="width:100%;height:100%;background:var(--surface-high);"></div>
        @endif
    </div>
</section>
<style>
@media (max-width:767px) {
    #hero[style*="grid-template-columns:1fr 1fr"] { grid-template-columns:1fr !important; }
    #hero[style*="grid-template-columns:1fr 1fr"] > div:last-child { min-height:55vw; }
}
</style>

@else

<section id="hero"
    data-slideshow="{{ $isSlideshow ? 'true' : 'false' }}"
    style="
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem 1.5rem;
        background-color: var(--primary);
        overflow: hidden;
">
    @if ($hasImages)
        <div class="hero-slides">
            @foreach ($bgImages as $i => $img)
                <div class="hero-slide {{ $i === 0 ? 'active' : '' }}"
                     style="background-image: url('{{ $img }}')"></div>
            @endforeach
        </div>
        <div class="hero-overlay"></div>
    @endif

    <div style="position:relative;z-index:1;max-width:720px;width:100%;">
        @if (!empty($data['headline']))
            <h1 style="color:#fff;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;margin-bottom:1rem;">
                {{ $data['headline'] }}
            </h1>
        @endif

        @if (!empty($data['subheadline']))
            <p style="color:rgba(255,255,255,.85);font-size:clamp(1rem,2.5vw,1.3rem);margin-bottom:2.5rem;line-height:1.6;">
                {{ $data['subheadline'] }}
            </p>
        @endif

        @if (!empty($data['cta_text']))
            <a href="#contact"
               style="display:inline-block;background:{{ $btnBg }};color:{{ $btnColor }};padding:1rem 2.5rem;border-radius:999px;font-weight:700;font-size:1rem;text-decoration:none;transition:opacity .2s;"
               onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                {{ $data['cta_text'] }}
            </a>
        @endif
    </div>
</section>

<style>
    @media (max-width: 767px) {
        #hero { min-height: 80vh !important; }
    }
</style>

@endif
