@extends('admin.layout')
@section('title', 'Contenido por defecto · ' . $variant->label)
@section('content')

@php
    $uploadUrl = route('admin.catalog.variant.upload-image', [$sector, $variant]);
    $defaults  = $variant->defaults ?? [];
    $skipKeys  = ['social', 'whatsapp_cta'];
    $skipFlags = ['blog_section', 'booking_section', 'footer_only'];
@endphp

<a href="{{ route('admin.catalog.sector', $sector) }}" style="font-size:.875rem;color:#71717a;text-decoration:none;">← {{ $sector->label }}</a>
<h1 style="margin-top:.5rem;">
    <span style="width:22px;height:22px;border-radius:50%;background:{{ $variant->color }};display:inline-block;vertical-align:middle;border:1px solid #ddd;"></span>
    {{ $variant->label }} · Contenido por defecto
</h1>
<p style="color:#71717a;font-size:.875rem;margin-bottom:1.5rem;">
    Estos son los textos e imágenes que aparecerán pre-cargados cuando alguien cree una web con esta variante.
    Puedes dejar campos vacíos y se usarán los placeholders del template.
</p>

<form method="POST" action="{{ route('admin.catalog.variant.defaults.update', [$sector, $variant]) }}" id="defaults-form">
    @csrf @method('PATCH')

    @foreach ($template['sections'] as $sectionKey => $schema)
        @php
            if (in_array($sectionKey, $skipKeys)) continue;
            $isSpecial = false;
            foreach ($skipFlags as $flag) {
                if (!empty($schema[$flag])) { $isSpecial = true; break; }
            }
            if ($isSpecial) continue;

            $sectionDefaults = $defaults[$sectionKey] ?? [];
            $isRepeatable    = !empty($schema['repeatable']);
        @endphp

        <div class="card">
            <h2>{{ $schema['label'] }}</h2>

            @if ($isRepeatable)
                <div id="items-{{ $sectionKey }}">
                    @foreach ($sectionDefaults['items'] ?? [] as $idx => $item)
                        @include('admin.catalog._defaults_item', [
                            'sectionKey' => $sectionKey,
                            'schema'     => $schema,
                            'item'       => $item,
                            'idx'        => $idx,
                        ])
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline" style="margin-top:.75rem;"
                    onclick="addItem('{{ $sectionKey }}', {{ json_encode($schema['fields']) }})">
                    + Añadir item
                </button>

            @else
                <div class="form-row">
                    @foreach ($schema['fields'] as $fieldKey => $fieldDef)
                        @php $uid = "img-{$sectionKey}-{$fieldKey}"; @endphp
                        @if ($fieldDef['type'] === 'image')
                            <div>
                                <label>{{ $fieldDef['label'] }}</label>
                                @php $val = $sectionDefaults[$fieldKey] ?? ''; @endphp
                                <input type="hidden" name="defaults[{{ $sectionKey }}][{{ $fieldKey }}]" id="{{ $uid }}-url" value="{{ $val }}">
                                <img id="{{ $uid }}-preview" src="{{ $val }}"
                                    style="width:80px;height:56px;object-fit:cover;border-radius:4px;display:{{ $val ? 'block' : 'none' }};margin-bottom:.35rem;">
                                <label style="display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .75rem;background:#fff;border:1px solid #d4d4d8;border-radius:6px;cursor:pointer;font-size:.8rem;font-weight:400;">
                                    📎 Subir imagen
                                    <input type="file" accept="image/*" data-uid="{{ $uid }}" style="display:none;">
                                </label>
                            </div>
                        @elseif ($fieldDef['type'] === 'textarea')
                            <div style="grid-column:1/-1;">
                                <label>{{ $fieldDef['label'] }}</label>
                                <textarea name="defaults[{{ $sectionKey }}][{{ $fieldKey }}]" rows="3"
                                    style="font-family:inherit;font-size:.875rem;">{{ $sectionDefaults[$fieldKey] ?? '' }}</textarea>
                            </div>
                        @else
                            <div>
                                <label>{{ $fieldDef['label'] }}</label>
                                <input type="text" name="defaults[{{ $sectionKey }}][{{ $fieldKey }}]"
                                    value="{{ $sectionDefaults[$fieldKey] ?? '' }}"
                                    placeholder="{{ $fieldDef['placeholder'] ?? '' }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach

    <div style="position:sticky;bottom:1rem;display:flex;justify-content:flex-end;padding:1rem 0;">
        <button class="btn btn-dark" style="padding:.6rem 2rem;font-size:1rem;">Guardar cambios</button>
    </div>
</form>

<script>
const UPLOAD_URL = @json($uploadUrl);
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

const counters = {};
@foreach ($template['sections'] as $sectionKey => $schema)
    @if (!empty($schema['repeatable']))
        counters['{{ $sectionKey }}'] = {{ count($defaults[$sectionKey]['items'] ?? []) }};
    @endif
@endforeach

function addItem(sectionKey, fields) {
    const idx       = counters[sectionKey]++;
    const container = document.getElementById('items-' + sectionKey);
    const div       = document.createElement('div');
    div.dataset.itemIdx = idx;
    div.style.cssText   = 'border:1px solid #e4e4e7;border-radius:8px;padding:1rem;margin-bottom:.75rem;position:relative;';

    let html = '<div class="form-row">';
    for (const [fieldKey, fieldDef] of Object.entries(fields)) {
        const name = `defaults[${sectionKey}][items][${idx}][${fieldKey}]`;
        const uid  = `img-${sectionKey}-${idx}-${fieldKey}`;
        if (fieldDef.type === 'image') {
            html += imageFieldHtml(name, uid, fieldDef.label, '');
        } else if (fieldDef.type === 'textarea') {
            html += `<div style="grid-column:1/-1"><label style="display:block;font-size:.8rem;font-weight:600;margin-bottom:.25rem;color:#52525b;">${fieldDef.label}</label>
                     <textarea name="${name}" rows="2" style="width:100%;padding:.5rem;border:1px solid #d4d4d8;border-radius:6px;font-family:inherit;font-size:.875rem;"></textarea></div>`;
        } else {
            html += `<div><label style="display:block;font-size:.8rem;font-weight:600;margin-bottom:.25rem;color:#52525b;">${fieldDef.label}</label>
                     <input type="text" name="${name}" placeholder="${fieldDef.placeholder ?? ''}" style="width:100%;padding:.5rem .75rem;border:1px solid #d4d4d8;border-radius:6px;font-size:.875rem;"></div>`;
        }
    }
    html += '</div>';
    html += `<button type="button" onclick="this.closest('[data-item-idx]').remove()"
        style="position:absolute;top:.4rem;right:.4rem;background:#dc2626;border:none;color:#fff;border-radius:50%;width:24px;height:24px;cursor:pointer;font-size:.8rem;">✕</button>`;

    div.innerHTML = html;
    container.appendChild(div);
    bindImageUploads(div);
}

function imageFieldHtml(name, uid, label, currentUrl) {
    const preview = currentUrl
        ? `<img id="${uid}-preview" src="${currentUrl}" style="width:80px;height:56px;object-fit:cover;border-radius:4px;display:block;margin-bottom:.35rem;">`
        : `<img id="${uid}-preview" style="width:80px;height:56px;object-fit:cover;border-radius:4px;display:none;">`;
    return `<div>
        <label style="display:block;font-size:.8rem;font-weight:600;margin-bottom:.25rem;color:#52525b;">${label}</label>
        <input type="hidden" name="${name}" id="${uid}-url" value="${currentUrl}">
        ${preview}
        <label style="display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .75rem;background:#fff;border:1px solid #d4d4d8;border-radius:6px;cursor:pointer;font-size:.8rem;font-weight:400;">
            📎 Subir imagen
            <input type="file" accept="image/*" data-uid="${uid}" style="display:none;">
        </label>
    </div>`;
}

async function handleImageUpload(input) {
    const file = input.files[0];
    if (!file) return;
    const uid = input.dataset.uid;
    const fd  = new FormData();
    fd.append('image', file);
    fd.append('_token', CSRF_TOKEN);
    input.disabled = true;
    try {
        const res  = await fetch(UPLOAD_URL, { method: 'POST', body: fd });
        const data = await res.json();
        if (data.url) {
            document.getElementById(uid + '-url').value = data.url;
            const preview = document.getElementById(uid + '-preview');
            preview.src   = data.url;
            preview.style.display = 'block';
        }
    } finally {
        input.disabled = false;
        input.value    = '';
    }
}

function bindImageUploads(root) {
    root.querySelectorAll('input[type="file"]').forEach(el => {
        el.addEventListener('change', function () { handleImageUpload(this); });
    });
}

document.querySelectorAll('[data-item-idx]').forEach(bindImageUploads);
</script>
@endsection
