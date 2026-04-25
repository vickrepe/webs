@php $items = $data['items'] ?? []; @endphp

@if (count($items) > 0)
<section id="team" class="section-wrap section-dark">
    <div class="section-inner">
        <div class="section-heading">
            <h2>Equipo</h2>
            <div class="heading-line"></div>
        </div>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:2rem;" class="team-grid">
            @foreach ($items as $member)
                <div>
                    @if (!empty($member['photo']))
                        <img src="{{ $member['photo'] }}"
                             alt="{{ $member['name'] ?? '' }}"
                             style="width:96px;height:96px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.5);margin:0 auto 1rem;">
                    @else
                        <div style="width:96px;height:96px;border-radius:50%;background:rgba(255,255,255,.15);color:#ffffff;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;margin:0 auto 1rem;border:3px solid rgba(255,255,255,.5);">
                            {{ mb_strtoupper(mb_substr($member['name'] ?? '?', 0, 1)) }}
                        </div>
                    @endif
                    <h3 style="font-weight:700;font-size:1rem;margin-bottom:.25rem;color:#ffffff;">{{ $member['name'] ?? '' }}</h3>
                    @if (!empty($member['role']))
                        <p style="color:rgba(255,255,255,.75);font-size:.875rem;">{{ $member['role'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    .team-grid > div { flex: 0 1 160px; text-align: center; }
    @media (max-width: 767px) { .team-grid > div { flex-basis: 130px; } }
</style>
