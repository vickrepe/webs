@php
    $items = $data['items'] ?? [];
    $title = $data['title'] ?? '';
@endphp

@if(count($items) > 0)
<section id="stats" class="section-wrap section-light">
    <div class="section-inner">
        @if($title)
        <div class="section-heading">
            <h2>{{ $title }}</h2>
            <div class="heading-line"></div>
        </div>
        @endif
        <div class="stats-grid">
            @foreach($items as $item)
            <div class="stats-item">
                <span class="stats-number">{{ $item['number'] ?? '' }}</span>
                <span class="stats-label">{{ $item['label'] ?? '' }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
<style>
    .stats-grid  { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .stats-item  { text-align: center; padding: 2rem 1rem; }
    .stats-number{ display: block; font-family: var(--font-heading); font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; color: var(--primary); line-height: 1; margin-bottom: .5rem; }
    .stats-label { display: block; font-size: .8rem; text-transform: uppercase; letter-spacing: .15em; color: var(--on-surface-muted); }
    @media (max-width: 767px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
</style>
@endif
