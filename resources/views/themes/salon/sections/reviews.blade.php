@php $items = $data['items'] ?? []; @endphp
@if(count($items))
<section class="section-wrap section-bg-low" id="reviews">
<div class="section-inner">
    <div class="salon-reviews-wrap">
        @foreach($items as $i => $review)
        <div class="salon-review-item" style="{{ $i > 0 ? 'display:none' : '' }}" data-review="{{ $i }}">
            <div class="salon-review-stars">
                @for($s = 0; $s < 5; $s++) ★ @endfor
            </div>
            <blockquote class="salon-review-quote">"{{ $review['text'] ?? '' }}"</blockquote>
            <cite class="salon-review-author">— {{ $review['author'] ?? '' }}</cite>
        </div>
        @endforeach
        @if(count($items) > 1)
        <div class="salon-reviews-dots">
            @foreach($items as $i => $r)
            <div class="salon-reviews-dot {{ $i === 0 ? 'active' : '' }}" data-target="{{ $i }}"></div>
            @endforeach
        </div>
        @endif
    </div>
</div>
</section>
<script>
(function(){
    var items = document.querySelectorAll('.salon-review-item');
    var dots  = document.querySelectorAll('.salon-reviews-dot');
    if(items.length < 2) return;
    var cur = 0;
    function show(n){
        items[cur].style.display = 'none';
        dots[cur] && dots[cur].classList.remove('active');
        cur = (n + items.length) % items.length;
        items[cur].style.display = '';
        dots[cur] && dots[cur].classList.add('active');
    }
    dots.forEach(function(d){ d.addEventListener('click', function(){ show(+this.dataset.target); }); });
    setInterval(function(){ show(cur + 1); }, 6000);
})();
</script>
@endif
