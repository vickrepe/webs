@php $items = $data['items'] ?? []; @endphp
@if(count($items))
<section class="section-wrap section-bg-surface" id="team">
<div class="section-inner">
    <div class="section-heading centered">
        <span class="section-label">Nuestro equipo</span>
        <h2>{{ $data['title'] ?? 'El equipo' }}</h2>
        <div class="heading-line"></div>
    </div>
    <div class="salon-team-grid">
        @foreach($items as $member)
        <div class="salon-team-card">
            @if(!empty($member['photo']))
                <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] ?? '' }}" class="salon-team-photo">
            @else
                <div class="salon-team-placeholder"></div>
            @endif
            <div class="salon-team-name">{{ $member['name'] ?? '' }}</div>
            <div class="salon-team-role">{{ $member['role'] ?? '' }}</div>
        </div>
        @endforeach
    </div>
</div>
</section>
@endif
