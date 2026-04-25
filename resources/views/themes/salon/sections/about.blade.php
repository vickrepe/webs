<section class="section-wrap section-bg-low" id="about">
<div class="section-inner">
    <div class="salon-about-grid">
        <div class="salon-about-img-wrap">
            @if(!empty($data['image']))
                <img src="{{ asset($data['image']) }}" alt="{{ $data['title'] ?? 'Sobre nosotros' }}" class="salon-about-img">
            @else
                <div class="salon-about-img-placeholder"></div>
            @endif
            <div class="salon-about-stat">
                <span class="salon-about-stat-num">15+</span>
                <span class="salon-about-stat-label">Años de experiencia</span>
            </div>
        </div>
        <div class="salon-about-text">
            <span class="section-label">Nuestra filosofía</span>
            <h2>{{ $data['title'] ?? 'Sobre nosotros' }}</h2>
            @if(!empty($data['text']))
                @foreach(explode("\n", $data['text']) as $para)
                    @if(trim($para))<p>{{ trim($para) }}</p>@endif
                @endforeach
            @endif
        </div>
    </div>
</div>
</section>
