@extends('admin.layout')
@section('title', $sector->label)
@section('content')

@php
$headingFonts = ['Inter','Montserrat','Poppins','Raleway','Oswald','Lato','Open Sans','Roboto','Nunito','Playfair Display','Merriweather','Libre Baskerville','Josefin Sans','Bebas Neue','Pacifico','Dancing Script'];
$bodyFonts    = ['Lato','Inter','Roboto','Open Sans','Nunito','Poppins','Source Sans 3','Ubuntu','PT Sans','Raleway','Merriweather','Georgia','Montserrat'];
@endphp

<a href="{{ route('admin.catalog.index') }}" style="font-size:.875rem;color:#71717a;text-decoration:none;">← Catálogo</a>
<h1 style="margin-top:.5rem;">{{ $sector->icon }} {{ $sector->label }} · Variantes</h1>

{{-- Añadir variante --}}
<div class="card">
    <h2>Añadir variante</h2>
    <form method="POST" action="{{ route('admin.catalog.variant.store', $sector) }}">
        @csrf
        <div class="form-row">
            <div><label>Key</label><input type="text" name="key" placeholder="arquitecto"></div>
            <div><label>Etiqueta</label><input type="text" name="label" placeholder="Arquitecto"></div>
            <div><label>Color principal</label><input type="color" name="color" value="#2d2d2d" style="height:38px;padding:.2rem;"></div>
            <div><label>Placeholder (onboarding)</label><input type="text" name="placeholder" placeholder="Ej: Estudio ArquiDesign"></div>
            <div>
                <label>Fuente Heading</label>
                <input type="hidden" name="typography[heading]" id="new-heading-val" value="Montserrat">
                <div class="adm-font-picker" id="fp-new-heading">
                    <button type="button" class="adm-font-picker-btn" style="font-family:'Montserrat',sans-serif;">
                        <span>Montserrat</span> <span style="font-size:.7rem;color:#71717a;">▾</span>
                    </button>
                    <div class="adm-font-picker-dropdown">
                        @foreach($headingFonts as $font)
                        <div class="adm-font-picker-option {{ $font === 'Montserrat' ? 'active' : '' }}"
                            data-value="{{ $font }}" style="font-family:'{{ $font }}',sans-serif;">{{ $font }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <label>Fuente Body</label>
                <input type="hidden" name="typography[body]" id="new-body-val" value="Lato">
                <div class="adm-font-picker" id="fp-new-body">
                    <button type="button" class="adm-font-picker-btn" style="font-family:'Lato',sans-serif;">
                        <span>Lato</span> <span style="font-size:.7rem;color:#71717a;">▾</span>
                    </button>
                    <div class="adm-font-picker-dropdown">
                        @foreach($bodyFonts as $font)
                        <div class="adm-font-picker-option {{ $font === 'Lato' ? 'active' : '' }}"
                            data-value="{{ $font }}" style="font-family:'{{ $font }}',sans-serif;">{{ $font }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions"><button class="btn btn-dark">Crear variante</button></div>
    </form>
</div>

{{-- Lista de variantes --}}
@foreach ($sector->variants as $variant)
<div class="card">
    <details>
        <summary style="cursor:pointer;display:flex;align-items:center;gap:1rem;">
            <span style="width:18px;height:18px;border-radius:50%;background:{{ $variant->color }};display:inline-block;border:1px solid #ddd;"></span>
            <strong>{{ $variant->label }}</strong>
            <span class="badge badge-gray">{{ $variant->key }}</span>
            @if(!$variant->is_active)<span class="badge" style="background:#fef9c3;color:#92400e;">inactiva</span>@endif
        </summary>
        <form method="POST" action="{{ route('admin.catalog.variant.update', [$sector, $variant]) }}" style="margin-top:1rem;">
            @csrf @method('PATCH')
            <div class="form-row">
                <div><label>Etiqueta</label><input type="text" name="label" value="{{ $variant->label }}"></div>
                <div><label>Color</label><input type="color" name="color" value="{{ $variant->color }}" style="height:38px;padding:.2rem;"></div>
                <div><label>Placeholder</label><input type="text" name="placeholder" value="{{ $variant->placeholder }}"></div>
                <div>
                    <label>Fuente Heading</label>
                    @php $hVal = $variant->typography['heading'] ?? 'Montserrat'; @endphp
                    <input type="hidden" name="typography[heading]" id="heading-val-{{ $variant->id }}" value="{{ $hVal }}">
                    <div class="adm-font-picker" id="fp-heading-{{ $variant->id }}">
                        <button type="button" class="adm-font-picker-btn" style="font-family:'{{ $hVal }}',sans-serif;">
                            <span>{{ $hVal }}</span> <span style="font-size:.7rem;color:#71717a;">▾</span>
                        </button>
                        <div class="adm-font-picker-dropdown">
                            @foreach($headingFonts as $font)
                            <div class="adm-font-picker-option {{ $hVal === $font ? 'active' : '' }}"
                                data-value="{{ $font }}" style="font-family:'{{ $font }}',sans-serif;">{{ $font }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <label>Fuente Body</label>
                    @php $bVal = $variant->typography['body'] ?? 'Lato'; @endphp
                    <input type="hidden" name="typography[body]" id="body-val-{{ $variant->id }}" value="{{ $bVal }}">
                    <div class="adm-font-picker" id="fp-body-{{ $variant->id }}">
                        <button type="button" class="adm-font-picker-btn" style="font-family:'{{ $bVal }}',sans-serif;">
                            <span>{{ $bVal }}</span> <span style="font-size:.7rem;color:#71717a;">▾</span>
                        </button>
                        <div class="adm-font-picker-dropdown">
                            @foreach($bodyFonts as $font)
                            <div class="adm-font-picker-option {{ $bVal === $font ? 'active' : '' }}"
                                data-value="{{ $font }}" style="font-family:'{{ $font }}',sans-serif;">{{ $font }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:.5rem;padding-top:1.2rem;">
                    <input type="checkbox" name="is_active" value="1" id="active_{{ $variant->id }}" @checked($variant->is_active)>
                    <label for="active_{{ $variant->id }}" style="margin:0;">Activa</label>
                </div>
            </div>
            <div style="margin-top:1rem;">
                <strong style="display:block;margin-bottom:.75rem;font-size:.875rem;">Paleta del theme (Grupo 2)</strong>
                <div class="form-row">
                    @php
                        $tcFields = [
                            'surface'          => 'Fondo base',
                            'surface_low'      => 'Fondo secciones',
                            'surface_lowest'   => 'Fondo tarjetas',
                            'surface_high'     => 'Fondo hundido (inputs/footer)',
                            'on_surface'       => 'Texto principal',
                            'on_surface_muted' => 'Texto secundario',
                            'secondary'        => 'Color identidad del theme',
                            'tertiary'         => 'Acento especial (alertas)',
                            'outline'          => 'Bordes sutiles',
                        ];
                    @endphp
                    @foreach($tcFields as $key => $label)
                        <div>
                            <label>{{ $label }}</label>
                            <input type="color" name="theme_colors[{{ $key }}]"
                                value="{{ $variant->theme_colors[$key] ?? '#ffffff' }}"
                                style="height:38px;padding:.2rem;width:100%;">
                        </div>
                    @endforeach
                </div>
            </div>
            <div style="margin-top:.75rem;">
                <a href="{{ route('admin.catalog.variant.defaults', [$sector, $variant]) }}" class="btn btn-outline">
                    🖼 Editar contenido por defecto
                </a>
            </div>
            <div class="form-actions">
                <button class="btn btn-dark">Guardar</button>
                <form method="POST" action="{{ route('admin.catalog.variant.destroy', [$sector, $variant]) }}" style="display:inline;" onsubmit="return confirm('¿Borrar variante?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-red">Borrar</button>
                </form>
            </div>
        </form>
    </details>
</div>
@endforeach

<script>
initAdmFontPicker('fp-new-heading', 'new-heading-val');
initAdmFontPicker('fp-new-body',    'new-body-val');
@foreach ($sector->variants as $variant)
initAdmFontPicker('fp-heading-{{ $variant->id }}', 'heading-val-{{ $variant->id }}');
initAdmFontPicker('fp-body-{{ $variant->id }}',    'body-val-{{ $variant->id }}');
@endforeach
</script>
@endsection
