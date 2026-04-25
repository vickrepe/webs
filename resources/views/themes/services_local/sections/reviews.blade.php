@php $items = $data['items'] ?? []; @endphp

@if (count($items) > 0)
<section id="reviews" class="section-wrap section-light">
    <div class="section-inner">
        <div class="section-heading">
            <h2>Reseñas</h2>
            <div class="heading-line"></div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;" class="reviews-grid">
            @foreach ($items as $review)
                <blockquote style="background:var(--surface-lowest);border:1px solid var(--outline);border-radius:12px;padding:1.5rem;margin:0;">
                    @if (!empty($review['rating']))
                        <div style="color:var(--primary);font-size:1.1rem;margin-bottom:.75rem;">
                            {{ str_repeat('★', max(0, min(5, (int) $review['rating']))) }}{{ str_repeat('☆', 5 - max(0, min(5, (int) $review['rating']))) }}
                        </div>
                    @endif
                    @if (!empty($review['text']))
                        <p style="color:var(--on-surface-muted);font-size:.9rem;font-style:italic;line-height:1.6;margin-bottom:1rem;">"{{ $review['text'] }}"</p>
                    @endif
                    <footer style="font-weight:700;font-size:.875rem;color:var(--on-surface);">— {{ $review['author'] ?? '' }}</footer>
                </blockquote>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    @media (max-width: 767px) { .reviews-grid { grid-template-columns: 1fr !important; } }
</style>
