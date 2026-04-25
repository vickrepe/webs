@php
    $slides = array_filter([
        $data['bg_image']   ?? '',
        $data['bg_image_2'] ?? '',
        $data['bg_image_3'] ?? '',
    ]);
    if (empty($slides)) $slides = ['/images/defaults/salon/slider_1.png'];
    $slides = array_values($slides);
    $hasMultiple = count($slides) > 1;
@endphp

<section class="salon-hero">
    <div class="hero-slides">
        @foreach($slides as $i => $img)
        <div class="hero-slide {{ $i === 0 ? 'active' : '' }}"
             style="background-image: url('{{ asset($img) }}')"></div>
        @endforeach
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <h1>{{ $data['headline'] ?? $site->config['business_name'] ?? 'Tu salón de belleza' }}
            @if(!empty($data['subheadline']))
                <br><em style="font-size:.65em;font-weight:400;">{{ $data['subheadline'] }}</em>
            @endif
        </h1>
        @if(!empty($data['cta_text']))
        <div class="hero-ctas">
            @php $bookingLink = '#booking'; @endphp
            <a href="{{ $bookingLink }}" class="btn-primary">{{ $data['cta_text'] }}</a>
            <a href="#services" class="btn-ghost">Ver servicios</a>
        </div>
        @endif
    </div>

    @if($hasMultiple)
    <div class="hero-dots">
        @foreach($slides as $i => $s)
        <div class="hero-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
        @endforeach
    </div>
    @endif
</section>

<script>
(function(){
    var slides = document.querySelectorAll('.salon-hero .hero-slide');
    var dots   = document.querySelectorAll('.salon-hero .hero-dot');
    if(slides.length < 2) return;
    var cur = 0;
    function go(n){
        slides[cur].classList.remove('active');
        dots[cur] && dots[cur].classList.remove('active');
        cur = (n + slides.length) % slides.length;
        slides[cur].classList.add('active');
        dots[cur] && dots[cur].classList.add('active');
    }
    dots.forEach(function(d){ d.addEventListener('click', function(){ go(+this.dataset.index); }); });
    setInterval(function(){ go(cur + 1); }, 5000);
})();
</script>
