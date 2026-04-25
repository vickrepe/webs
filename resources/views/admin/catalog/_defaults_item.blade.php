<div data-item-idx="{{ $idx }}" style="border:1px solid #e4e4e7;border-radius:8px;padding:1rem;margin-bottom:.75rem;position:relative;">
    <div class="form-row">
        @foreach ($schema['fields'] as $fieldKey => $fieldDef)
            @php
                $name  = "defaults[{$sectionKey}][items][{$idx}][{$fieldKey}]";
                $uid   = "img-{$sectionKey}-{$idx}-{$fieldKey}";
                $value = $item[$fieldKey] ?? '';
            @endphp

            @if ($fieldDef['type'] === 'image')
                <div>
                    <label>{{ $fieldDef['label'] }}</label>
                    <input type="hidden" name="{{ $name }}" id="{{ $uid }}-url" value="{{ $value }}">
                    <img id="{{ $uid }}-preview" src="{{ $value }}"
                        style="width:80px;height:56px;object-fit:cover;border-radius:4px;display:{{ $value ? 'block' : 'none' }};margin-bottom:.35rem;">
                    <label style="display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .75rem;background:#fff;border:1px solid #d4d4d8;border-radius:6px;cursor:pointer;font-size:.8rem;font-weight:400;">
                        📎 Subir imagen
                        <input type="file" accept="image/*" data-uid="{{ $uid }}" style="display:none;">
                    </label>
                </div>
            @elseif ($fieldDef['type'] === 'textarea')
                <div style="grid-column:1/-1;">
                    <label>{{ $fieldDef['label'] }}</label>
                    <textarea name="{{ $name }}" rows="2"
                        style="width:100%;padding:.5rem;border:1px solid #d4d4d8;border-radius:6px;font-family:inherit;font-size:.875rem;">{{ $value }}</textarea>
                </div>
            @else
                <div>
                    <label>{{ $fieldDef['label'] }}</label>
                    <input type="text" name="{{ $name }}" value="{{ $value }}"
                        placeholder="{{ $fieldDef['placeholder'] ?? '' }}">
                </div>
            @endif
        @endforeach
    </div>
    <button type="button" onclick="this.closest('[data-item-idx]').remove()"
        style="position:absolute;top:.4rem;right:.4rem;background:#dc2626;border:none;color:#fff;border-radius:50%;width:24px;height:24px;cursor:pointer;font-size:.8rem;">✕</button>
</div>
