<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Builder — {{ $site->config['business_name'] ?? $site->slug }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;700&family=Raleway:wght@400;700&family=Oswald:wght@400;700&family=Lato:wght@400;700&family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&family=Nunito:wght@400;700&family=Playfair+Display:wght@400;700&family=Merriweather:wght@400;700&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            display: flex;
            height: 100dvh;
            overflow: hidden;
            background: #0f0f17;
        }

        /* ── SIDEBAR ──────────────────────────────────────────── */
        #sidebar {
            width: 320px;
            flex-shrink: 0;
            background: #1e1e2e;
            color: #cdd6f4;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-right: 1px solid #2a2a3e;
        }

        /* Header */
        #sb-header {
            padding: 1.1rem 1.25rem;
            background: #181825;
            border-bottom: 1px solid #2a2a3e;
            flex-shrink: 0;
        }

        #sb-header h1 {
            font-size: .95rem;
            font-weight: 700;
            color: #cdd6f4;
            margin-bottom: .2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sb-preview-link {
            font-size: .75rem;
            color: #6c7086;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
            transition: color .15s;
        }
        .sb-preview-link:hover { color: #cba6f7; }

        /* Scrollable content */
        #sb-body {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #313244 transparent;
        }

        /* ── Accordion ─────────────────────────────────────────── */
        .accordion-item {
            border-bottom: 1px solid #2a2a3e;
        }

        .accordion-header {
            display: flex;
            align-items: center;
            padding: .85rem 1.25rem;
            cursor: pointer;
            gap: .75rem;
            user-select: none;
        }

        .accordion-header:hover { background: rgba(255,255,255,.03); }

        .accordion-label {
            flex: 1;
            font-size: .85rem;
            font-weight: 600;
            color: #cdd6f4;
        }

        .accordion-chevron {
            width: 16px;
            height: 16px;
            fill: #6c7086;
            transition: transform .2s;
            flex-shrink: 0;
        }

        .accordion-item.open .accordion-chevron { transform: rotate(180deg); }

        .accordion-body {
            display: none;
            padding: 0 1.25rem 1.25rem;
        }

        .accordion-item.open .accordion-body { display: block; }

        /* ── Toggle sección ────────────────────────────────────── */
        .toggle-row {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .85rem;
        }

        .toggle-switch {
            position: relative;
            width: 34px;
            height: 18px;
            flex-shrink: 0;
        }

        .toggle-switch input { opacity: 0; width: 0; height: 0; position: absolute; }

        .toggle-slider {
            position: absolute;
            inset: 0;
            background: #45475a;
            border-radius: 18px;
            cursor: pointer;
            transition: background .2s;
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            left: 3px;
            top: 3px;
            background: #cdd6f4;
            border-radius: 50%;
            transition: transform .2s;
        }

        .toggle-switch input:checked + .toggle-slider { background: #a6e3a1; }
        .toggle-switch input:checked + .toggle-slider::before { transform: translateX(16px); }
        .toggle-switch input:disabled + .toggle-slider { opacity: .35; cursor: not-allowed; }

        .required-badge {
            font-size: .65rem;
            background: #313244;
            color: #6c7086;
            padding: .15rem .45rem;
            border-radius: 4px;
        }

        /* ── Fields ────────────────────────────────────────────── */
        .field-group { margin-bottom: 1rem; }

        .field-group label {
            display: block;
            font-size: .72rem;
            font-weight: 600;
            color: #6c7086;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
        }

        .field-group input[type=text],
        .field-group input[type=url],
        .field-group input[type=number],
        .field-group textarea {
            width: 100%;
            background: #181825;
            border: 1px solid #313244;
            color: #cdd6f4;
            border-radius: 7px;
            padding: .5rem .7rem;
            font-size: .85rem;
            font-family: inherit;
            resize: vertical;
            outline: none;
            transition: border-color .15s;
        }

        .field-group input:focus,
        .field-group textarea:focus { border-color: #cba6f7; }

        /* ── Color picker ──────────────────────────────────────── */
        .color-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            background: #181825;
            border: 1px solid #313244;
            border-radius: 7px;
            padding: .45rem .7rem;
            cursor: pointer;
        }

        .color-chip-sb {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .color-value-sb {
            font-size: .82rem;
            color: #a6adc8;
            font-family: monospace;
            flex: 1;
        }

        input[type=color].hidden-picker {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        /* ── Logo upload ───────────────────────────────────────── */
        .logo-upload {
            border: 1px dashed #313244;
            border-radius: 7px;
            padding: .75rem;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: border-color .15s;
        }

        .logo-upload:hover { border-color: #cba6f7; }

        .logo-upload input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .logo-thumb {
            height: 40px;
            object-fit: contain;
            margin: 0 auto .4rem;
            display: {{ $site->logo_url ? 'block' : 'none' }};
        }

        .logo-hint { font-size: .75rem; color: #6c7086; }

        /* ── Repeatable items ──────────────────────────────────── */
        .item-card {
            background: #181825;
            border: 1px solid #313244;
            border-radius: 8px;
            padding: .75rem;
            margin-bottom: .75rem;
            position: relative;
        }

        .item-remove {
            position: absolute;
            top: .5rem;
            right: .5rem;
            background: none;
            border: none;
            color: #f38ba8;
            cursor: pointer;
            font-size: .8rem;
            padding: .1rem .35rem;
            border-radius: 4px;
        }

        .item-remove:hover { background: rgba(243,139,168,.1); }

        .add-item-btn {
            width: 100%;
            padding: .5rem;
            background: #313244;
            border: none;
            border-radius: 7px;
            color: #cba6f7;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s;
        }

        .add-item-btn:hover { background: #3d3f52; }
        .add-item-btn:disabled { opacity: .4; cursor: not-allowed; }

        /* ── Social toggleable ─────────────────────────────────────── */
        .social-field-row { display:flex; align-items:center; gap:.5rem; margin-bottom:.5rem; }
        .social-field-row.is-hidden { display:none; }
        .social-input-wrap { flex: 1; display: flex; flex-direction: column; gap: 2px; }
        .social-input-wrap input {
            background: #181825;
            border: 1px solid #45475a;
            border-radius: 6px;
            color: #cdd6f4;
            padding: .45rem .6rem;
            font-size: .82rem;
            outline: none;
            width: 100%;
        }
        .social-input-wrap input:focus { border-color: #cba6f7; }
        .social-field-hint { font-size: .68rem; color: #f9e2af; display: none; }
        .social-input-wrap input:placeholder-shown + .social-field-hint { display: block; }
        .social-remove-btn { background:none; border:none; color:#888; cursor:pointer; font-size:1rem; line-height:1; padding:0 .25rem; flex-shrink:0; }
        .social-remove-btn:hover { color:#f38ba8; }
        .social-add-btn { width:100%; padding:.5rem; margin-top:.25rem; background:#313244; border:1px dashed #45475a; border-radius:8px; color:#cdd6f4; cursor:pointer; font-size:.8rem; }
        .social-add-btn:hover { background:#3d3f52; }
        .social-add-select { width:100%; margin-top:.4rem; padding:.4rem .5rem; border-radius:6px; border:1px solid #45475a; background:#313244; color:#cdd6f4; font-size:.82rem; }

        /* ── Font select ────────────────────────────────────────── */
        .font-select {
            width: 100%;
            background: #181825;
            border: 1px solid #45475a;
            border-radius: 6px;
            color: #cdd6f4;
            padding: .45rem .6rem;
            font-size: .82rem;
            outline: none;
            cursor: pointer;
        }
        .font-select:focus { border-color: #cba6f7; }

        /* ── Font picker custom ─────────────────────────────────────── */
        .font-picker { position: relative; }

        .font-picker-btn {
            width: 100%;
            background: #181825;
            border: 1px solid #45475a;
            border-radius: 6px;
            color: #cdd6f4;
            padding: .45rem .6rem;
            font-size: .9rem;
            outline: none;
            cursor: pointer;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
            transition: border-color .15s;
            font-family: inherit; /* se sobreescribe por JS */
        }

        .font-picker.open .font-picker-btn,
        .font-picker-btn:focus { border-color: #cba6f7; }

        .font-picker-dropdown {
            position: absolute;
            top: calc(100% + 3px);
            left: 0; right: 0;
            background: #1e1e2e;
            border: 1px solid #313244;
            border-radius: 8px;
            max-height: 210px;
            overflow-y: auto;
            z-index: 500;
            display: none;
            scrollbar-width: thin;
            scrollbar-color: #313244 transparent;
            box-shadow: 0 8px 24px rgba(0,0,0,.4);
        }

        .font-picker.open .font-picker-dropdown { display: block; }

        .font-picker-option {
            padding: .5rem .75rem;
            font-size: .9rem;
            color: #cdd6f4;
            cursor: pointer;
            transition: background .1s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .font-picker-option:hover  { background: #2a2a3e; }
        .font-picker-option.active { background: #313244; color: #cba6f7; }

        /* ── Footer fijo ───────────────────────────────────────── */
        #sb-footer {
            padding: 1rem 1.25rem;
            background: #181825;
            border-top: 1px solid #2a2a3e;
            display: flex;
            gap: .75rem;
            flex-shrink: 0;
        }

        .btn-save {
            flex: 1;
            padding: .65rem;
            background: #cba6f7;
            color: #1e1e2e;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s;
        }

        .btn-save:hover { background: #b4befe; }

        .btn-publish {
            flex: 1;
            padding: .65rem;
            background: #a6e3a1;
            color: #1e1e2e;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s;
        }

        .btn-publish:hover { background: #94d18f; }

        /* ── Toast ─────────────────────────────────────────────── */
        #toast {
            position: fixed;
            bottom: 5rem;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #1e1e2e;
            color: #cdd6f4;
            border: 1px solid #313244;
            padding: .6rem 1.25rem;
            border-radius: 8px;
            font-size: .85rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s, transform .25s;
            z-index: 9999;
            white-space: nowrap;
        }

        #toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ── Preview iframe ────────────────────────────────────── */
        #preview-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        #preview-bar {
            background: #181825;
            border-bottom: 1px solid #2a2a3e;
            padding: .5rem 1rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        #preview-url {
            flex: 1;
            background: #1e1e2e;
            border: 1px solid #313244;
            border-radius: 6px;
            padding: .35rem .75rem;
            font-size: .78rem;
            color: #6c7086;
            font-family: monospace;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #preview-open {
            font-size: .75rem;
            color: #6c7086;
            text-decoration: none;
            border: 1px solid #313244;
            border-radius: 6px;
            padding: .35rem .6rem;
            white-space: nowrap;
            transition: color .15s, border-color .15s;
        }

        #preview-open:hover { color: #cba6f7; border-color: #cba6f7; }

        #preview {
            flex: 1;
            border: none;
            width: 100%;
        }

        /* ── Mobile ────────────────────────────────────────────── */
        @media (max-width: 767px) {
            #preview-wrap { display: none; }
            #sidebar { width: 100%; }
        }

        /* ── Image upload field ────────────────────────────────── */
        .image-upload-field { position: relative; }

        .image-preview-wrap {
            border: 1px dashed #313244;
            border-radius: 7px;
            padding: .6rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .5rem;
            cursor: pointer;
            transition: border-color .15s;
        }

        .image-preview-wrap:hover { border-color: #cba6f7; }

        .image-field-thumb {
            width: 100%;
            max-height: 100px;
            object-fit: cover;
            border-radius: 5px;
            display: block;
        }

        .image-upload-label {
            font-size: .75rem;
            color: #6c7086;
            cursor: pointer;
            text-align: center;
        }

        /* ── Plan badge ────────────────────────────────────────── */
        .plan-badge {
            display: inline-block;
            padding: .15rem .5rem;
            border-radius: 999px;
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            background: {{ $site->user->plan === 'pro' ? '#a6e3a1' : ($site->user->plan === 'basic' ? '#89b4fa' : '#585b70') }};
            color: #1e1e2e;
            vertical-align: middle;
        }
    </style>
</head>
<body>

@if (session('_admin_id'))
<div style="background:#7c3aed;color:#fff;text-align:center;padding:.5rem 1rem;font-size:.85rem;font-weight:600;">
    ⚡ Accediendo como <strong>{{ auth()->user()->name }}</strong> —
    <form method="POST" action="{{ route('admin.stop-impersonating') }}" style="display:inline;">
        @csrf
        <button style="background:none;border:none;color:#fff;text-decoration:underline;cursor:pointer;font-weight:600;">Salir</button>
    </form>
</div>
@endif

{{-- ── SIDEBAR ────────────────────────────────────────────────── --}}
<aside id="sidebar">

    {{-- Header --}}
    <div id="sb-header">
        <h1>
            {{ $site->config['business_name'] ?? $site->slug }}
            <span class="plan-badge">{{ $site->user->plan }}</span>
        </h1>
        <div style="display:flex;align-items:center;gap:1rem;margin-top:.4rem;">
            <a href="{{ route('site.show', $site->slug) }}?preview=1" class="sb-preview-link">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                Vista previa
            </a>
            <a href="{{ route('site.show', $site->slug) }}" target="_blank" class="sb-preview-link">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M19 19H5V5h7V3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/></svg>
                Ver web
            </a>
        </div>
    </div>

    {{-- Scrollable body --}}
    <div id="sb-body">

        {{-- ── Diseño (accordion abierto por defecto) ─────────── --}}
        <div class="accordion-item open" data-accordion="design">
            <div class="accordion-header" onclick="toggleAccordion(this)">
                <span class="accordion-label">Diseño</span>
                <svg class="accordion-chevron" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
            </div>
            <div class="accordion-body">

                {{-- Color primario --}}
                <div class="field-group">
                    <label>Color principal</label>
                    <div class="color-row" onclick="document.getElementById('primary-picker').click()">
                        <div class="color-chip-sb" id="primary-chip" style="background:{{ $site->config['colors']['primary'] ?? '#2d2d2d' }};"></div>
                        <span class="color-value-sb" id="primary-value">{{ $site->config['colors']['primary'] ?? '#2d2d2d' }}</span>
                        <input type="color" class="hidden-picker" id="primary-picker" value="{{ $site->config['colors']['primary'] ?? '#2d2d2d' }}">
                    </div>
                </div>

                {{-- Color secundario --}}
                <div class="field-group" style="margin-top:.75rem;">
                    <label>Color secundario</label>
                    <div class="color-row" onclick="document.getElementById('secondary-picker').click()">
                        <div class="color-chip-sb" id="secondary-chip"
                             style="background:{{ $site->secondaryColor() }};"></div>
                        <span class="color-value-sb" id="secondary-value">{{ $site->secondaryColor() }}</span>
                        <input type="color" class="hidden-picker" id="secondary-picker"
                               value="{{ $site->secondaryColor() }}">
                    </div>
                </div>

                {{-- Logo --}}
                <div class="field-group">
                    <label>Logo</label>
                    <div class="logo-upload">
                        <input type="file" id="logo-input" accept="image/*">
                        <img src="{{ $site->logo_url ? asset('storage/' . $site->logo_url) : '' }}" id="logo-thumb" class="logo-thumb"
                             alt="Logo" {{ $site->logo_url ? '' : 'style=display:none' }}>
                        <p class="logo-hint" id="logo-hint" {{ $site->logo_url ? 'style=display:none' : '' }}>
                            Haz clic para subir<br>
                            <span style="font-size:.7rem;">PNG, JPG — máx. 2MB</span>
                        </p>
                    </div>
                </div>

                {{-- Tipografía --}}
                @php
                    $currentHeading = $site->config['typography']['heading'] ?? 'Montserrat';
                    $currentBody    = $site->config['typography']['body']    ?? 'Lato';
                    $fontList = ['Inter','Montserrat','Poppins','Raleway','Oswald','Lato','Open Sans','Roboto','Nunito','Playfair Display','Merriweather','Libre Baskerville'];
                @endphp

                {{-- Tipografía --}}
                <div class="field-group" style="margin-top:1rem;">
                    <label>Títulos</label>
                    <div class="font-picker" id="fp-heading">
                        <button type="button" class="font-picker-btn" style="font-family:'{{ $currentHeading }}',sans-serif;">
                            <span>{{ $currentHeading }}</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#6c7086" flex-shrink="0"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div class="font-picker-dropdown">
                            @foreach ($fontList as $font)
                                <div class="font-picker-option {{ $currentHeading === $font ? 'active' : '' }}"
                                     data-value="{{ $font }}"
                                     style="font-family:'{{ $font }}',sans-serif;">
                                    {{ $font }}
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="font-heading-select" value="{{ $currentHeading }}">
                    </div>
                </div>

                <div class="field-group">
                    <label>Texto</label>
                    <div class="font-picker" id="fp-body">
                        <button type="button" class="font-picker-btn" style="font-family:'{{ $currentBody }}',sans-serif;">
                            <span>{{ $currentBody }}</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#6c7086"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div class="font-picker-dropdown">
                            @foreach ($fontList as $font)
                                <div class="font-picker-option {{ $currentBody === $font ? 'active' : '' }}"
                                     data-value="{{ $font }}"
                                     style="font-family:'{{ $font }}',sans-serif;">
                                    {{ $font }}
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="font-body-select" value="{{ $currentBody }}">
                    </div>
                </div>

            </div>
        </div>

        {{-- ── Secciones del template ──────────────────────────── --}}
        @php
            $plans = ['free' => 0, 'basic' => 1, 'pro' => 2];

            /**
             * Renderiza un campo según su tipo.
             * $field: clave, $def: schema, $value: valor actual, $extraAttr: atributos extra (ej: data-section)
             */
            $renderField = function(string $field, array $def, string $value = '', string $extraAttr = '') {
                if ($def['type'] === 'textarea') {
                    return '<textarea data-field="' . e($field) . '" ' . $extraAttr . ' placeholder="' . e($def['placeholder'] ?? '') . '" rows="3">' . e($value) . '</textarea>';
                }
                if ($def['type'] === 'select') {
                    $opts = '';
                    foreach ($def['options'] as $val => $label) {
                        $selected = $value === $val ? 'selected' : '';
                        $opts .= '<option value="' . e($val) . '" ' . $selected . '>' . e($label) . '</option>';
                    }
                    return '<select data-field="' . e($field) . '" ' . $extraAttr . ' class="font-select">' . $opts . '</select>';
                }
                if ($def['type'] === 'image') {
                    $thumb = $value ? '<img src="' . e($value) . '" class="image-field-thumb">' : '';
                    $label = $value ? 'Cambiar imagen' : 'Subir imagen';
                    return '
                        <div class="image-upload-field">
                            <input type="hidden" data-field="' . e($field) . '" ' . $extraAttr . ' value="' . e($value) . '">
                            <div class="image-preview-wrap">
                                ' . $thumb . '
                                <label class="image-upload-label">
                                    <input type="file" accept="image/*" class="image-file-input" style="display:none">
                                    <span>' . $label . '</span>
                                </label>
                            </div>
                        </div>';
                }
                return '<input type="' . e($def['type']) . '" data-field="' . e($field) . '" ' . $extraAttr . ' placeholder="' . e($def['placeholder'] ?? '') . '" value="' . e($value) . '">';
            };
        @endphp

        @foreach ($template['sections'] as $type => $schema)
            @php
                if (isset($schema['min_plan'])) {
                    $userPlan = $plans[$site->user->plan] ?? 0;
                    $minPlan  = $plans[$schema['min_plan']] ?? 0;
                    if ($userPlan < $minPlan) continue;
                }
                $isRequired  = $schema['required'] ?? false;
                $isRepeatable = ! empty($schema['repeatable']);
                $sectionDb   = $sections->get($type);
                $isActive    = $sectionDb?->active ?? true;
                $sectionData = $sectionDb?->config ?? [];
                $items       = $sectionData['items'] ?? [];
                $limitKey    = $schema['plan_limit'] ?? null;
                $limit       = $limitKey ? ($planLimits[$limitKey] ?? PHP_INT_MAX) : PHP_INT_MAX;
            @endphp

            <div class="accordion-item" data-accordion="{{ $type }}">
                <div class="accordion-header" onclick="toggleAccordion(this)">

                    {{-- Toggle activo/inactivo --}}
                    <label class="toggle-switch" onclick="event.stopPropagation()"
                           @if ($isRequired) title="Esta sección es obligatoria" @endif>
                        <input type="checkbox"
                               class="section-toggle"
                               data-type="{{ $type }}"
                               {{ $isActive ? 'checked' : '' }}
                               {{ $isRequired ? 'disabled' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>

                    <span class="accordion-label">{{ $schema['label'] }}</span>

                    @if ($isRequired)
                        <span class="required-badge">obligatoria</span>
                    @endif

                    <svg class="accordion-chevron" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                </div>

                <div class="accordion-body" data-section="{{ $type }}">

                    @if ($isRepeatable)

                        @if (!empty($schema['section_fields']))
                        <div style="margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid #2a2a3e;">
                            @foreach ($schema['section_fields'] as $field => $def)
                                <div class="field-group">
                                    <label>{{ $def['label'] }}</label>
                                    {!! $renderField($field, $def, $sectionData[$field] ?? ($def['default'] ?? ''), 'data-section-field="' . e($field) . '" data-section="' . e($type) . '"') !!}
                                </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Items repetibles --}}
                        <div class="items-list" data-type="{{ $type }}" data-list-key="items">
                            @foreach ($items as $i => $item)
                                <div class="item-card" data-index="{{ $i }}">
                                    <button type="button" class="item-remove" title="Eliminar">✕</button>
                                    @foreach ($schema['fields'] as $field => $def)
                                        <div class="field-group">
                                            <label>{{ $def['label'] ?? ucfirst($field) }}</label>
                                            {!! $renderField($field, $def, $item[$field] ?? '') !!}
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        @php $canAdd = count($items) < $limit; @endphp
                        <button type="button"
                                class="add-item-btn"
                                data-type="{{ $type }}"
                                {{ $canAdd ? '' : 'disabled title="Límite alcanzado"' }}>
                            + Añadir {{ Str::lower($schema['label']) }}
                        </button>

                        {{-- Template oculto para nuevo item --}}
                        <template id="tpl-{{ $type }}">
                            <div class="item-card">
                                <button type="button" class="item-remove" title="Eliminar">✕</button>
                                @foreach ($schema['fields'] as $field => $def)
                                    <div class="field-group">
                                        <label>{{ $def['label'] ?? ucfirst($field) }}</label>
                                        {!! $renderField($field, $def, '') !!}
                                    </div>
                                @endforeach
                            </div>
                        </template>

                        @if (!empty($schema['section_fields']['show_more']))
                        @php $moreItems = $sectionData['more_items'] ?? []; @endphp
                        <div class="more-items-panel"
                             data-for="{{ $type }}"
                             style="{{ ($sectionData['show_more'] ?? '0') === '1' ? '' : 'display:none' }}">
                            <div style="margin-top:1.25rem;padding-top:1rem;border-top:1px dashed #313244;">
                                <p style="font-size:.72rem;font-weight:600;color:#6c7086;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.75rem;">
                                    Página completa — items adicionales
                                </p>
                                <div class="items-list" data-type="{{ $type }}" data-list-key="more_items">
                                    @foreach ($moreItems as $i => $item)
                                        <div class="item-card" data-index="{{ $i }}">
                                            <button type="button" class="item-remove" title="Eliminar">✕</button>
                                            @foreach ($schema['fields'] as $field => $def)
                                                <div class="field-group">
                                                    <label>{{ $def['label'] ?? ucfirst($field) }}</label>
                                                    {!! $renderField($field, $def, $item[$field] ?? '') !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="add-item-btn" data-type="{{ $type }}" data-list-key="more_items">
                                    + Añadir item (página completa)
                                </button>
                                <template id="tpl-{{ $type }}-more">
                                    <div class="item-card">
                                        <button type="button" class="item-remove" title="Eliminar">✕</button>
                                        @foreach ($schema['fields'] as $field => $def)
                                            <div class="field-group">
                                                <label>{{ $def['label'] ?? ucfirst($field) }}</label>
                                                {!! $renderField($field, $def, '') !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </template>
                            </div>
                        </div>
                        @endif

                    @elseif (!empty($schema['toggleable_fields']))

                        {{-- Redes sociales toggleable --}}
                        @php
                            $hiddenFields = array_filter(explode(',', $sectionData['_hidden'] ?? ''));
                        @endphp

                        <input type="hidden"
                               data-field="_hidden"
                               data-section="{{ $type }}"
                               class="social-hidden-tracker"
                               value="{{ $sectionData['_hidden'] ?? '' }}">

                        @foreach ($schema['fields'] as $field => $def)
                            <div class="social-field-row {{ in_array($field, $hiddenFields) ? 'is-hidden' : '' }}"
                                 data-network="{{ $field }}">
                                <span style="font-size:.78rem;color:#a6adc8;min-width:80px;">{{ $def['label'] }}</span>
                                <div class="social-input-wrap">
                                    <input type="text"
                                           data-field="{{ $field }}"
                                           data-section="{{ $type }}"
                                           placeholder="{{ $def['placeholder'] ?? '' }}"
                                           value="{{ $sectionData[$field] ?? '' }}">
                                    <span class="social-field-hint">Es obligatorio para mostrar el icono</span>
                                </div>
                                <button type="button" class="social-remove-btn" data-network="{{ $field }}" title="Quitar">✕</button>
                            </div>
                        @endforeach

                        <button type="button" class="social-add-btn" id="social-add-btn">+ Añadir red social</button>
                        <select class="social-add-select" id="social-add-select" style="display:none">
                            <option value="">Selecciona una red…</option>
                        </select>

                    @elseif (!empty($schema['blog_section']))

                        {{-- Blog — enlace directo a gestión de posts --}}
                        <p style="font-size:.82rem;color:#a6adc8;margin-bottom:1rem;">
                            Los artículos se editan directamente en la sección blog del sitio.
                        </p>
                        <a href="{{ route('blog.index', $site->slug) }}"
                           target="_blank"
                           class="sb-preview-link">
                            Gestionar posts ↗
                        </a>

                    @elseif (!empty($schema['booking_section']))
                        @php $bs = $site->bookingSetting; @endphp

                        {{-- Conexión Google --}}
                        <div style="margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid #2a2a3e;">
                            @if ($bs?->isConnected())
                                <p style="font-size:.8rem;color:#a6e3a1;margin-bottom:.75rem;">✓ Google Calendar conectado</p>
                                <button type="button"
                                        class="sb-preview-link"
                                        style="color:#f38ba8;"
                                        onclick="disconnectGoogle({{ $site->id }})">
                                    Desconectar
                                </button>
                            @else
                                <p style="font-size:.8rem;color:#a6adc8;margin-bottom:.75rem;">
                                    Conecta tu Google Calendar para recibir citas automáticamente.
                                </p>
                                <a href="{{ route('google.connect', $site) }}" class="sb-preview-link">
                                    Conectar Google Calendar ↗
                                </a>
                            @endif
                        </div>

                        {{-- Configuración --}}
                        <div id="booking-settings-form">
                            <div class="field-group">
                                <label>Duración de cada cita</label>
                                <select id="bs-duration">
                                    @foreach ([15=>'15 min',30=>'30 min',45=>'45 min',60=>'1 hora',90=>'1h 30min',120=>'2 horas'] as $val => $lbl)
                                        <option value="{{ $val }}" {{ ($bs?->slot_duration_minutes ?? 60) == $val ? 'selected' : '' }}>
                                            {{ $lbl }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field-group">
                                <label>Días laborables</label>
                                <div style="display:flex;flex-wrap:wrap;gap:.4rem;margin-top:.35rem;">
                                    @foreach (['mon'=>'L','tue'=>'M','wed'=>'X','thu'=>'J','fri'=>'V','sat'=>'S','sun'=>'D'] as $key => $lbl)
                                        <label style="display:flex;align-items:center;gap:.3rem;font-size:.8rem;font-weight:400;text-transform:none;letter-spacing:0;">
                                            <input type="checkbox"
                                                   class="bs-day"
                                                   value="{{ $key }}"
                                                   {{ in_array($key, $bs?->working_days ?? ['mon','tue','wed','thu','fri']) ? 'checked' : '' }}>
                                            {{ $lbl }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="field-group" style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;">
                                <div>
                                    <label>Inicio</label>
                                    <input type="time" id="bs-start" value="{{ $bs?->working_hours_start ?? '09:00' }}">
                                </div>
                                <div>
                                    <label>Fin</label>
                                    <input type="time" id="bs-end" value="{{ $bs?->working_hours_end ?? '18:00' }}">
                                </div>
                            </div>
                            <div class="field-group">
                                <label>Días disponibles con antelación</label>
                                <input type="number" id="bs-advance" min="1" max="365" value="{{ $bs?->advance_booking_days ?? 30 }}">
                            </div>
                            <button type="button" class="btn-save" style="width:100%;margin-top:.5rem;" onclick="saveBookingSettings()">
                                Guardar configuración
                            </button>
                        </div>

                    @else

                        {{-- Campos simples --}}
                        @foreach ($schema['fields'] as $field => $def)
                            <div class="field-group">
                                <label>{{ $def['label'] ?? ucfirst($field) }}</label>
                                {!! $renderField($field, $def, $sectionData[$field] ?? '', 'data-section="' . e($type) . '"') !!}
                            </div>
                        @endforeach

                    @endif

                </div>
            </div>
        @endforeach

    </div>{{-- /sb-body --}}

    {{-- Footer fijo --}}
    <div id="sb-footer">
        <button class="btn-save" id="btn-save">Guardar</button>
        <button class="btn-publish" id="btn-publish">Publicar</button>
    </div>

</aside>

{{-- ── PREVIEW ─────────────────────────────────────────────────── --}}
<div id="preview-wrap">
    <div id="preview-bar">
        <span id="preview-url">{{ url('/site/' . $site->slug) }}</span>
        <a id="preview-open" href="{{ route('site.show', $site->slug) }}" target="_blank">
            Abrir ↗
        </a>
    </div>
    <iframe id="preview" src="{{ route('site.show', $site->slug) }}" title="Preview"></iframe>
</div>

{{-- Toast --}}
<div id="toast"></div>

<script>
const SITE_ID    = {{ $site->id }};
const BASE_URL   = '{{ url('/dashboard/sites') }}';
const TOKEN      = document.querySelector('meta[name="csrf-token"]').content;
const preview    = document.getElementById('preview');
const ORIGIN     = window.location.origin;

// ── Accordion ──────────────────────────────────────────────────
function toggleAccordion(header) {
    const item = header.closest('.accordion-item');
    item.classList.toggle('open');
}

// ── Toast ───────────────────────────────────────────────────────
function showToast(msg, duration = 2500) {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), duration);
}

// ── Color picker ────────────────────────────────────────────────
function textOnPrimary(hex) {
    const r = parseInt(hex.slice(1,3), 16) / 255;
    const g = parseInt(hex.slice(3,5), 16) / 255;
    const b = parseInt(hex.slice(5,7), 16) / 255;
    return (0.2126*r + 0.7152*g + 0.0722*b) > 0.4 ? '#1a1a1a' : '#ffffff';
}

document.getElementById('primary-picker').addEventListener('input', (e) => {
    const color = e.target.value;
    document.getElementById('primary-chip').style.background = color;
    document.getElementById('primary-value').textContent     = color;

    preview.contentWindow?.postMessage({
        type: 'vibly:theme',
        vars: {
            '--primary':         color,
            '--text-on-primary': textOnPrimary(color),
        },
    }, ORIGIN);
});

document.getElementById('secondary-picker').addEventListener('input', (e) => {
    const color = e.target.value;
    document.getElementById('secondary-chip').style.background = color;
    document.getElementById('secondary-value').textContent     = color;

    preview.contentWindow?.postMessage({
        type: 'vibly:theme',
        vars: { '--secondary': color },
    }, ORIGIN);
});

// ── Logo upload ─────────────────────────────────────────────────
document.getElementById('logo-input').addEventListener('change', async (e) => {
    const file = e.target.files[0];
    if (! file) return;

    // Preview local inmediato
    const localUrl = URL.createObjectURL(file);
    const thumb    = document.getElementById('logo-thumb');
    thumb.src      = localUrl;
    thumb.style.display = 'block';
    document.getElementById('logo-hint').style.display = 'none';

    // Upload al servidor
    const form = new FormData();
    form.append('logo', file);
    form.append('_method', 'PATCH');

    const res  = await fetch(`${BASE_URL}/${SITE_ID}/logo`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': TOKEN },
        body: form,
    });

    if (res.ok) {
        const data = await res.json();
        preview.contentWindow?.postMessage({ type: 'vibly:logo', url: data.url }, ORIGIN);
        showToast('Logo actualizado ✓');
    }
});

// ── Toggles de sección ──────────────────────────────────────────
document.querySelectorAll('.section-toggle').forEach(toggle => {
    toggle.addEventListener('change', async (e) => {
        const type   = e.target.dataset.type;
        const active = e.target.checked;

        const res = await fetch(`${BASE_URL}/${SITE_ID}/sections/${type}/toggle`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN },
            body: JSON.stringify({ active }),
        });

        if (! res.ok) {
            e.target.checked = ! active;
            const data = await res.json();
            showToast(data.error ?? 'Error al actualizar');
        }
    });
});

// ── Añadir / eliminar items repetibles ─────────────────────────
document.querySelectorAll('.add-item-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const type    = btn.dataset.type;
        const listKey = btn.dataset.listKey || 'items';
        const list    = document.querySelector(`.items-list[data-type="${type}"][data-list-key="${listKey}"]`);
        const tplId   = listKey === 'more_items' ? `tpl-${type}-more` : `tpl-${type}`;
        const tpl     = document.getElementById(tplId);
        if (! tpl || ! list) return;
        const clone = tpl.content.cloneNode(true);
        clone.querySelector('.item-remove').addEventListener('click', function () {
            this.closest('.item-card').remove();
        });
        list.appendChild(clone);
    });
});

// Eliminar items existentes
document.querySelectorAll('.item-remove').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('.item-card').remove();
    });
});

// ── Guardar ─────────────────────────────────────────────────────
document.getElementById('btn-save').addEventListener('click', async () => {
    const btn = document.getElementById('btn-save');
    btn.textContent = '…';

    const tasks = [];

    // 1. Colores
    tasks.push(fetch(`${BASE_URL}/${SITE_ID}/colors`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN },
        body: JSON.stringify({
            primary:   document.getElementById('primary-picker').value,
            secondary: document.getElementById('secondary-picker').value,
        }),
    }));

    // Typography
    tasks.push(fetch(`${BASE_URL}/${SITE_ID}/typography`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN },
        body: JSON.stringify({
            heading: document.getElementById('font-heading-select').value,
            body:    document.getElementById('font-body-select').value,
        }),
    }));

    // 2. Secciones simples
    document.querySelectorAll('.accordion-body[data-section]').forEach(body => {
        if (body.querySelector('.items-list')) return; // repetible — se guarda en paso 3

        const type   = body.dataset.section;
        const config = {};

        body.querySelectorAll('[data-field][data-section]').forEach(el => {
            config[el.dataset.field] = el.value;
        });

        tasks.push(fetch(`${BASE_URL}/${SITE_ID}/sections/${type}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN },
            body: JSON.stringify({ config }),
        }));
    });

    // 3. Secciones repetibles
    const sectionRepeatMap = {};

    document.querySelectorAll('.accordion-body[data-section]').forEach(body => {
        if (! body.querySelector('.items-list')) return;
        const type = body.dataset.section;
        if (sectionRepeatMap[type]) return; // ya procesado
        const config = {};

        body.querySelectorAll('[data-section-field]').forEach(el => {
            config[el.dataset.sectionField] = el.value;
        });

        body.querySelectorAll(`.items-list[data-type="${type}"]`).forEach(list => {
            const key   = list.dataset.listKey || 'items';
            const items = [];
            list.querySelectorAll('.item-card').forEach(card => {
                const item = {};
                card.querySelectorAll('[data-field]').forEach(el => {
                    item[el.dataset.field] = el.value;
                });
                items.push(item);
            });
            config[key] = items;
        });

        sectionRepeatMap[type] = config;
    });

    Object.entries(sectionRepeatMap).forEach(([type, config]) => {
        tasks.push(fetch(`${BASE_URL}/${SITE_ID}/sections/${type}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN },
            body: JSON.stringify({ config }),
        }));
    });

    const results  = await Promise.all(tasks);
    const failedRes = results.filter(r => ! r.ok);

    preview.src = preview.src;
    btn.textContent = 'Guardar';

    if (failedRes.length === 0) {
        showToast('Cambios guardados ✓');
    } else {
        // Extraer mensajes de error de las respuestas 422
        const errors = await Promise.all(
            failedRes.map(r => r.json().then(d => d.error ?? 'Error desconocido').catch(() => 'Error desconocido'))
        );
        showToast(`Guardado parcial — ${errors[0]}`, 4000);
    }
});

// ── Upload de imágenes de sección (delegado en sb-body) ─────────
document.getElementById('sb-body').addEventListener('change', async (e) => {
    if (! e.target.classList.contains('image-file-input')) return;

    const file = e.target.files[0];
    if (! file) return;

    const wrap   = e.target.closest('.image-upload-field');
    const hidden = wrap.querySelector('[data-field]');

    const form = new FormData();
    form.append('image', file);

    const res = await fetch(`${BASE_URL}/${SITE_ID}/upload-image`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': TOKEN },
        body: form,
    });

    if (res.ok) {
        const data = await res.json();
        hidden.value = data.url;

        let thumb = wrap.querySelector('.image-field-thumb');
        if (! thumb) {
            thumb = document.createElement('img');
            thumb.className = 'image-field-thumb';
            wrap.querySelector('.image-preview-wrap').prepend(thumb);
        }
        thumb.src = data.url;

        wrap.querySelector('.image-upload-label span').textContent = 'Cambiar imagen';
    }
});


// ── Publicar ─────────────────────────────────────────────────────
document.getElementById('btn-publish').addEventListener('click', async () => {
    const res  = await fetch(`${BASE_URL}/${SITE_ID}/publish`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN },
    });

    if (res.ok) {
        const data = await res.json();
        showToast('¡Tu web está en línea! 🎉', 4000);
        document.getElementById('preview-open').href = data.url;
    }
});

// ── Tipografía ───────────────────────────────────────────────
// ── Font picker ──────────────────────────────────────────────────
function initFontPicker(pickerId, hiddenId, onChange) {
    const picker   = document.getElementById(pickerId);
    const hidden   = document.getElementById(hiddenId);
    const btn      = picker.querySelector('.font-picker-btn');
    const label    = btn.querySelector('span');
    const dropdown = picker.querySelector('.font-picker-dropdown');

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = picker.classList.contains('open');
        // Cerrar todos los pickers abiertos
        document.querySelectorAll('.font-picker.open').forEach(p => p.classList.remove('open'));
        if (! isOpen) {
            picker.classList.add('open');
            // Scroll a la opción activa
            const active = dropdown.querySelector('.active');
            if (active) active.scrollIntoView({ block: 'nearest' });
        }
    });

    picker.querySelectorAll('.font-picker-option').forEach(opt => {
        opt.addEventListener('click', () => {
            const value = opt.dataset.value;
            hidden.value         = value;
            label.textContent    = value;
            btn.style.fontFamily = `'${value}', sans-serif`;
            picker.querySelectorAll('.font-picker-option').forEach(o => o.classList.remove('active'));
            opt.classList.add('active');
            picker.classList.remove('open');
            if (onChange) onChange();
        });
    });
}

// Cerrar al hacer clic fuera
document.addEventListener('click', () => {
    document.querySelectorAll('.font-picker.open').forEach(p => p.classList.remove('open'));
});

initFontPicker('fp-heading', 'font-heading-select', sendFontPreview);
initFontPicker('fp-body',    'font-body-select',    sendFontPreview);

function sendFontPreview() {
    preview.contentWindow?.postMessage({
        type:    'vibly:fonts',
        heading: document.getElementById('font-heading-select').value,
        body:    document.getElementById('font-body-select').value,
    }, ORIGIN);
}

// ── Social fields toggleable ────────────────────────────────
(function () {
    const addBtn    = document.getElementById('social-add-btn');
    const addSelect = document.getElementById('social-add-select');
    const tracker   = document.querySelector('.social-hidden-tracker');

    if (! addBtn) return; // sección no existe en este template

    function syncState() {
        const hiddenRows = [...document.querySelectorAll('.social-field-row.is-hidden')];

        // Actualizar tracker
        tracker.value = hiddenRows.map(r => r.dataset.network).join(',');

        // Reconstruir select
        addSelect.innerHTML = '<option value="">Selecciona una red…</option>';
        hiddenRows.forEach(row => {
            const opt = document.createElement('option');
            opt.value       = row.dataset.network;
            opt.textContent = row.querySelector('span').textContent.trim();
            addSelect.appendChild(opt);
        });

        // Mostrar/ocultar botón añadir
        addBtn.style.display = hiddenRows.length > 0 ? '' : 'none';
    }

    // Remove
    document.querySelectorAll('.social-remove-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = document.querySelector(`.social-field-row[data-network="${btn.dataset.network}"]`);
            row.querySelector('input[data-field]').value = '';
            row.classList.add('is-hidden');
            addSelect.style.display = 'none';
            syncState();
        });
    });

    // Add toggle
    addBtn.addEventListener('click', () => {
        addSelect.style.display = addSelect.style.display === 'none' ? '' : 'none';
    });

    // Select change
    addSelect.addEventListener('change', () => {
        const network = addSelect.value;
        if (! network) return;
        document.querySelector(`.social-field-row[data-network="${network}"]`).classList.remove('is-hidden');
        addSelect.value         = '';
        addSelect.style.display = 'none';
        syncState();
    });

    // Estado inicial
    syncState();
})();

// ── Booking settings ─────────────────────────────────────────────
function saveBookingSettings() {
    const days = Array.from(document.querySelectorAll('.bs-day:checked')).map(el => el.value);
    fetch("{{ route('booking.settings.update', $site) }}", {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': TOKEN, 'Accept': 'application/json' },
        body: JSON.stringify({
            is_enabled:            true,
            slot_duration_minutes: +document.getElementById('bs-duration').value,
            working_days:          days,
            working_hours_start:   document.getElementById('bs-start').value,
            working_hours_end:     document.getElementById('bs-end').value,
            advance_booking_days:  +document.getElementById('bs-advance').value,
        }),
    })
    .then(r => r.json())
    .then(d => d.ok && showToast('Configuración guardada'));
}

function disconnectGoogle(siteId) {
    if (! confirm('¿Desconectar Google Calendar?')) return;
    fetch(`/dashboard/sites/${siteId}/google/disconnect`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': TOKEN, 'Accept': 'application/json' },
    }).then(() => location.reload());
}

// ── Show/hide more-items panel al cambiar show_more ─────────────
document.querySelectorAll('[data-section-field="show_more"]').forEach(sel => {
    const type = sel.dataset.section;
    sel.addEventListener('change', () => {
        const panel = document.querySelector(`.more-items-panel[data-for="${type}"]`);
        if (panel) panel.style.display = sel.value === '1' ? '' : 'none';
    });
});
</script>
</body>
</html>
