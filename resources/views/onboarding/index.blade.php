<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibly — Crea tu web</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @php
        $onboardingFonts = collect($services)
            ->flatMap(fn($s) => collect($s['variants'])
                ->flatMap(fn($v) => [$v['typography']['heading'] ?? null, $v['typography']['body'] ?? null])
            )
            ->filter()
            ->unique()
            ->map(fn($f) => 'family=' . str_replace(' ', '+', $f) . ':wght@400;600;700')
            ->implode('&');
    @endphp
    @if($onboardingFonts)
        <link href="https://fonts.googleapis.com/css2?{{ $onboardingFonts }}&display=swap" rel="stylesheet">
    @endif
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #f5f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 32px rgba(0,0,0,.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo span {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -.03em;
        }

        .logo span em {
            color: #c9a96e;
            font-style: normal;
        }

        h1 {
            text-align: center;
            font-size: 1.35rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: .5rem;
        }

        .subtitle {
            text-align: center;
            color: #666;
            font-size: .9rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .field { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: #444;
            margin-bottom: .4rem;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        input[type=text],
        input[type=file] {
            width: 100%;
            padding: .75rem 1rem;
            border: 1.5px solid #e5e5e5;
            border-radius: 10px;
            font-size: .95rem;
            font-family: inherit;
            color: #1a1a1a;
            outline: none;
            transition: border-color .2s;
        }

        input[type=text]:focus { border-color: #c9a96e; }

        /* Color picker row */
        .color-field {
            display: flex;
            align-items: center;
            gap: .75rem;
            border: 1.5px solid #e5e5e5;
            border-radius: 10px;
            padding: .5rem .75rem;
            cursor: pointer;
            transition: border-color .2s;
        }

        .color-field:focus-within { border-color: #c9a96e; }

        .color-chip {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            flex-shrink: 0;
            transition: background .15s;
        }

        .color-value {
            font-size: .9rem;
            color: #444;
            font-family: monospace;
            flex: 1;
        }

        input[type=color] {
            opacity: 0;
            position: absolute;
            width: 0;
            height: 0;
        }

        /* Logo upload */
        .logo-upload-area {
            border: 1.5px dashed #e5e5e5;
            border-radius: 10px;
            padding: 1.25rem;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s;
            position: relative;
        }

        .logo-upload-area:hover { border-color: #c9a96e; }

        .logo-upload-area input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .logo-preview-img {
            height: 56px;
            object-fit: contain;
            margin: 0 auto .5rem;
            display: none;
        }

        .upload-hint {
            font-size: .8rem;
            color: #999;
        }

        /* Error messages */
        .error { color: #e53e3e; font-size: .8rem; margin-top: .3rem; }

        /* Submit */
        .submit-btn {
            width: 100%;
            padding: .9rem;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            margin-top: .75rem;
            transition: background .2s, transform .1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .submit-btn:hover { background: #333; }
        .submit-btn:active { transform: scale(.98); }
        .submit-btn:disabled { opacity: .6; cursor: not-allowed; }

        /* Service / variant selector */
        .selector-group { margin-bottom: 1.5rem; }

        .selector-cards {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .selector-card {
            flex: 1;
            min-width: 120px;
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            padding: .85rem 1rem;
            cursor: pointer;
            text-align: center;
            transition: border-color .2s, background .2s;
            user-select: none;
        }

        .selector-card:hover { border-color: #c9a96e; }

        .selector-card.selected {
            border-color: #1a1a1a;
            background: #f9f9f9;
        }

        .selector-card .card-icon  { font-size: 1.5rem; margin-bottom: .3rem; }
        .selector-card .card-label { font-size: .85rem; font-weight: 600; color: #1a1a1a; }
        .selector-card .card-sub   { font-size: .72rem; color: #999; margin-top: .15rem; }

        .variant-row {
            margin-top: .75rem;
            display: none;
            animation: fadeIn .2s ease;
        }
        .variant-row.visible { display: flex; gap: .75rem; flex-wrap: wrap; }

        @keyframes fadeIn { from { opacity:0; transform:translateY(-4px); } to { opacity:1; transform:translateY(0); } }
    </style>
</head>
<body>

<div class="card">
    <div class="logo">
        <span>Vi<em>bly</em></span>
    </div>

    <h1>Crea tu web en 2 minutos</h1>
    <p class="subtitle">Solo necesitamos 3 datos para dejarte listo.</p>

    @if ($errors->any())
        <div style="background:#fff5f5;border:1px solid #fed7d7;border-radius:8px;padding:.75rem 1rem;margin-bottom:1.25rem;font-size:.85rem;color:#c53030;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('onboarding.create') }}" enctype="multipart/form-data" id="onboarding-form">
        @csrf

        {{-- Tipo de servicio --}}
        <div class="field selector-group">
            <label>Tipo de negocio</label>
            <input type="hidden" name="service" id="input-service" value="{{ old('service') }}">
            <div class="selector-cards" id="service-cards">
                @foreach($services as $serviceKey => $service)
                    <div class="selector-card {{ old('service') === $serviceKey ? 'selected' : '' }}"
                         data-service="{{ $serviceKey }}"
                         data-color="{{ $service['variants'][array_key_first($service['variants'])]['color'] ?? '#2d2d2d' }}">
                        <div class="card-icon">{{ $service['icon'] }}</div>
                        <div class="card-label">{{ $service['label'] }}</div>
                    </div>
                @endforeach
            </div>
            @error('service')<p class="error">{{ $message }}</p>@enderror
        </div>

        {{-- Variante (aparece al seleccionar servicio) --}}
        <div class="field selector-group">
            <input type="hidden" name="variant" id="input-variant" value="{{ old('variant') }}">
            @foreach($services as $serviceKey => $service)
                <div class="variant-row {{ old('service') === $serviceKey ? 'visible' : '' }}"
                     id="variants-{{ $serviceKey }}">
                    <label style="width:100%;margin-bottom:.5rem;">¿Qué tipo de {{ $service['label'] }}?</label>
                    @foreach($service['variants'] as $variantKey => $variant)
                        <div class="selector-card {{ old('variant') === $variantKey ? 'selected' : '' }}"
                             data-variant="{{ $variantKey }}"
                             data-service="{{ $serviceKey }}"
                             data-color="{{ $variant['color'] }}"
                             data-heading="{{ $variant['typography']['heading'] }}"
                             data-placeholder="{{ $variant['placeholder'] ?? '' }}">
                            <div class="card-label">{{ $variant['label'] }}</div>
                            <div class="card-sub" style="font-family:'{{ $variant['typography']['heading'] }}',sans-serif;">
                                {{ $variant['typography']['heading'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            @error('variant')<p class="error">{{ $message }}</p>@enderror
        </div>

        {{-- Nombre del negocio --}}
        <div class="field">
            <label for="business_name">Nombre de tu negocio</label>
            <input type="text"
                   id="business_name"
                   name="business_name"
                   value="{{ old('business_name') }}"
                   placeholder="Ej: Barbería Don Carlos"
                   required
                   maxlength="80"
                   autocomplete="off">
            @error('business_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Color principal --}}
        <div class="field">
            <label>Color principal</label>
            <div class="color-field" onclick="document.getElementById('color-picker').click()">
                <div class="color-chip" id="color-chip" style="background:#2d2d2d;"></div>
                <span class="color-value" id="color-value">#2d2d2d</span>
                <input type="color" id="color-picker" name="primary_color" value="{{ old('primary_color', '#2d2d2d') }}">
            </div>
            @error('primary_color')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Logo (opcional) --}}
        <div class="field">
            <label>Tu logo <span style="color:#999;font-weight:400;text-transform:none;">(opcional)</span></label>
            <div class="logo-upload-area" id="logo-drop">
                <input type="file" name="logo" id="logo-input" accept="image/*">
                <img src="" alt="Logo preview" class="logo-preview-img" id="logo-preview">
                <p class="upload-hint" id="upload-hint">
                    Haz clic para subir tu logo<br>
                    <span style="font-size:.75rem;">PNG, JPG — máx. 2MB</span>
                </p>
            </div>
            @error('logo')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="submit-btn" id="submit-btn">
            Crear mi web
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
        </button>
    </form>
</div>

<script>
    // Color picker en tiempo real
    const picker = document.getElementById('color-picker');
    const chip   = document.getElementById('color-chip');
    const val    = document.getElementById('color-value');

    picker.addEventListener('input', (e) => {
        chip.style.background = e.target.value;
        val.textContent       = e.target.value;
    });

    // Inicializar con valor actual
    chip.style.background = picker.value;
    val.textContent       = picker.value;

    // Logo preview
    document.getElementById('logo-input').addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (! file) return;

        const reader = new FileReader();
        reader.onload = (ev) => {
            const preview = document.getElementById('logo-preview');
            preview.src   = ev.target.result;
            preview.style.display = 'block';
            document.getElementById('upload-hint').style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    // ── Service / variant selector ────────────────────────────────
    (function () {
        const inputService = document.getElementById('input-service');
        const inputVariant = document.getElementById('input-variant');

        function setColor(hex) {
            picker.value          = hex;
            chip.style.background = hex;
            val.textContent       = hex;
        }

        // Seleccionar servicio
        document.querySelectorAll('#service-cards .selector-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('#service-cards .selector-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');

                const serviceKey = card.dataset.service;
                inputService.value = serviceKey;

                // Ocultar todas las variant-rows, mostrar la del servicio seleccionado
                document.querySelectorAll('.variant-row').forEach(r => r.classList.remove('visible'));
                const varRow = document.getElementById(`variants-${serviceKey}`);
                if (varRow) varRow.classList.add('visible');

                // Limpiar variante seleccionada
                inputVariant.value = '';
                document.querySelectorAll('.variant-row .selector-card').forEach(c => c.classList.remove('selected'));
            });
        });

        // Seleccionar variante
        document.querySelectorAll('.variant-row .selector-card').forEach(card => {
            card.addEventListener('click', () => {
                // Deseleccionar dentro de la misma variant-row
                card.closest('.variant-row').querySelectorAll('.selector-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');

                inputVariant.value = card.dataset.variant;

                // Sugerir color de la variante
                if (card.dataset.color) setColor(card.dataset.color);

                if (card.dataset.placeholder) {
                    document.getElementById('business_name').placeholder = card.dataset.placeholder;
                }
            });
        });
    })();

    // Deshabilitar botón al enviar (solo si pasa validación)
    document.getElementById('onboarding-form').addEventListener('submit', (e) => {
        const inputService = document.getElementById('input-service');
        const inputVariant = document.getElementById('input-variant');
        if (! inputService.value || ! inputVariant.value) {
            e.preventDefault();
            alert('Por favor selecciona el tipo de negocio y la variante.');
            return;
        }
        const btn = document.getElementById('submit-btn');
        btn.disabled    = true;
        btn.textContent = 'Creando tu web…';
    });
</script>
</body>
</html>
