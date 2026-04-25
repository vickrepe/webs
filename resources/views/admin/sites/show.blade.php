@extends('admin.layout')
@section('title', $site->config['business_name'] ?? $site->slug)
@section('content')

@php
$tc = $site->config['theme_colors'] ?? [];
$colors = $site->config['colors'] ?? [];
$tcFields = [
    'surface'          => 'Fondo base',
    'surface_low'      => 'Fondo secciones',
    'surface_lowest'   => 'Fondo tarjetas',
    'surface_high'     => 'Fondo hundido (inputs/footer)',
    'on_surface'       => 'Texto principal',
    'on_surface_muted' => 'Texto secundario',
    'secondary'        => 'Color identidad del theme',
    'tertiary'         => 'Acento especial',
    'outline'          => 'Bordes sutiles',
];
@endphp

<a href="{{ route('admin.sites.index') }}" style="font-size:.875rem;color:#71717a;text-decoration:none;">← Sites</a>
<h1 style="margin-top:.5rem;">{{ $site->config['business_name'] ?? $site->slug }}</h1>

{{-- Grupo 1: colores del negocio --}}
<div class="card">
    <h2>Colores del negocio (Grupo 1)</h2>
    <p style="color:#71717a;font-size:.875rem;margin-bottom:1rem;">El usuario también puede cambiar estos desde el builder.</p>
    <form method="POST" action="{{ route('admin.sites.colors', $site) }}">
        @csrf @method('PATCH')
        <div class="form-row">
            <div>
                <label>Color principal</label>
                <input type="color" name="colors[primary]" value="{{ $colors['primary'] ?? '#2d2d2d' }}" style="height:38px;padding:.2rem;width:100%;">
            </div>
            <div>
                <label>Color hover/gradiente</label>
                <input type="color" name="colors[primary_container]" value="{{ $colors['primary_container'] ?? '#555555' }}" style="height:38px;padding:.2rem;width:100%;">
            </div>
        </div>
        <div class="form-actions"><button class="btn btn-dark">Guardar</button></div>
    </form>
</div>

{{-- Grupo 2: paleta del theme --}}
<div class="card">
    <h2>Paleta del theme (Grupo 2)</h2>
    <p style="color:#71717a;font-size:.875rem;margin-bottom:1rem;">Solo visible para el admin. Define la personalidad visual del theme.</p>
    <form method="POST" action="{{ route('admin.sites.theme-colors', $site) }}">
        @csrf @method('PATCH')
        <div class="form-row">
            @foreach($tcFields as $key => $label)
            <div>
                <label>{{ $label }}</label>
                <input type="color" name="theme_colors[{{ $key }}]"
                    value="{{ $tc[$key] ?? '#ffffff' }}"
                    style="height:38px;padding:.2rem;width:100%;">
            </div>
            @endforeach
        </div>
        <div class="form-actions"><button class="btn btn-dark">Guardar paleta</button></div>
    </form>
</div>

@endsection
