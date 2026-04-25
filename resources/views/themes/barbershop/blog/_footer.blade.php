@php
    $contactData  = $sections->get('contact')?->config ?? [];
    $socialData   = $sections->get('social')?->config   ?? [];
    $businessName = $site->config['business_name'] ?? $site->slug;
@endphp
<footer class="site-footer">
    <div class="footer-inner">

        <div class="footer-brand">
            @if ($site->logo_url)
                <img src="{{ asset('storage/' . $site->logo_url) }}"
                     alt="{{ $businessName }}"
                     class="footer-logo">
            @endif
            @if (!empty($contactData['address']) || !empty($contactData['phone']))
                <p class="footer-contact">
                    @if (!empty($contactData['address'])){{ $contactData['address'] }}@endif
                    @if (!empty($contactData['address']) && !empty($contactData['phone'])) <br> @endif
                    @if (!empty($contactData['phone']))<a href="tel:{{ $contactData['phone'] }}">{{ $contactData['phone'] }}</a>@endif
                </p>
            @endif
        </div>

        <div class="footer-social">
            @foreach (['instagram','facebook','tiktok','youtube','x'] as $network)
                @if (!empty($socialData[$network]))
                    <a href="{{ $socialData[$network] }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($network) }}">
                        @include('themes.barbershop.blog._social_icon', ['network' => $network])
                    </a>
                @endif
            @endforeach
        </div>

    </div>
    <div class="footer-copy">
        © {{ date('Y') }} {{ $businessName }} · Creado con <a href="https://vibly.es" target="_blank" rel="noopener">Vibly</a>
    </div>
</footer>
