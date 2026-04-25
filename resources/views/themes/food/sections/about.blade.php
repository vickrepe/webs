@if (!empty($data['title']) || !empty($data['text']))
<section id="about" class="section-wrap section-light">
    <div class="section-inner">
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        " class="about-grid">
            <div>
                <h2>{{ $data['title'] ?? '' }}</h2>
                <div class="heading-line" style="margin:0 0 1.5rem;"></div>
                @if (!empty($data['text']))
                    <p style="font-size:1rem;">{{ $data['text'] }}</p>
                @endif
            </div>

            @if (!empty($data['image']))
                <div>
                    <img src="{{ $data['image'] }}"
                         alt="{{ $data['title'] ?? 'Sobre nosotros' }}"
                         style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:12px;">
                </div>
            @endif
        </div>
    </div>
</section>
@endif

<style>
    @media (max-width: 767px) {
        .about-grid {
            grid-template-columns: 1fr !important;
            gap: 2rem !important;
        }
        .about-grid > div:first-child { order: 2; }
        .about-grid > div:last-child  { order: 1; }
    }
</style>
