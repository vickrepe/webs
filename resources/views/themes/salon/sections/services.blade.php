@php $items = $data['items'] ?? []; @endphp
<section class="section-wrap section-bg-surface" id="services">
<div class="section-inner">
    <div class="section-heading centered">
        <span class="section-label">Nuestros rituales</span>
        <h2>{{ $data['title'] ?? 'Servicios' }}</h2>
        <div class="heading-line"></div>
    </div>
    <div class="salon-services-grid">
        @foreach($items as $item)
        <div class="salon-service-card">
            @if(!empty($item['image']))
                <div class="salon-service-img-wrap">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] ?? '' }}" class="salon-service-img">
                </div>
            @else
                <div class="salon-service-img-placeholder"></div>
            @endif
            <div class="salon-service-header">
                <span class="salon-service-name">{{ $item['name'] ?? '' }}</span>
                @if(!empty($item['price']))
                <span class="salon-service-price">{{ $item['price'] }}</span>
                @endif
            </div>
            @if(!empty($item['description']))
            <p class="salon-service-desc">{{ $item['description'] }}</p>
            @endif
        </div>
        @endforeach
    </div>
</div>
</section>
