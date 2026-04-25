<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin · @yield('title', 'Panel')</title>
    {{-- Google Fonts: todas las fuentes del picker --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;700&family=Raleway:wght@400;700&family=Oswald:wght@400;700&family=Lato:wght@400;700&family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&family=Nunito:wght@400;700&family=Playfair+Display:wght@400;700&family=Merriweather:wght@400;700&family=Libre+Baskerville:wght@400;700&family=Source+Sans+3:wght@400;700&family=Ubuntu:wght@400;700&family=PT+Sans:wght@400;700&family=Josefin+Sans:wght@400;700&family=Bebas+Neue&family=Pacifico&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f4f4f5; color: #18181b; min-height: 100vh; }
        .adm-topbar { background: #18181b; color: #fff; display: flex; align-items: center; gap: 2rem; padding: .75rem 2rem; }
        .adm-topbar a { color: #d4d4d8; text-decoration: none; font-size: .875rem; }
        .adm-topbar a:hover { color: #fff; }
        .adm-topbar .brand { font-weight: 700; font-size: 1rem; color: #fff; margin-right: auto; }
        .adm-wrap { max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem; }
        h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; }
        h2 { font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; }
        .card { background: #fff; border-radius: 10px; border: 1px solid #e4e4e7; padding: 1.5rem; margin-bottom: 1.5rem; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        th { text-align: left; padding: .5rem .75rem; background: #f4f4f5; border-bottom: 1px solid #e4e4e7; font-weight: 600; }
        td { padding: .6rem .75rem; border-bottom: 1px solid #f4f4f5; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        .btn { display: inline-flex; align-items: center; gap: .3rem; padding: .4rem 1rem; border-radius: 6px; font-size: .8rem; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: opacity .15s; }
        .btn:hover { opacity: .8; }
        .btn-dark { background: #18181b; color: #fff; }
        .btn-red  { background: #dc2626; color: #fff; }
        .btn-green { background: #16a34a; color: #fff; }
        .btn-outline { background: #fff; color: #18181b; border: 1px solid #d4d4d8; }
        .badge { display: inline-block; padding: .15rem .5rem; border-radius: 999px; font-size: .7rem; font-weight: 600; }
        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .badge-gray { background: #f4f4f5; color: #71717a; }
        .alert-ok  { background: #dcfce7; color: #15803d; padding: .75rem 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: .875rem; }
        .alert-err { background: #fee2e2; color: #dc2626; padding: .75rem 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: .875rem; }
        input[type="text"], input[type="color"], select, textarea {
            width: 100%; padding: .5rem .75rem; border: 1px solid #d4d4d8; border-radius: 6px;
            font-size: .875rem; font-family: inherit;
        }
        textarea { resize: vertical; min-height: 100px; font-family: monospace; font-size: .8rem; }
        label { display: block; font-size: .8rem; font-weight: 600; margin-bottom: .25rem; color: #52525b; }
        .form-row { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1rem; }
        .form-actions { display: flex; gap: .75rem; margin-top: .75rem; }
        /* Font picker */
        .adm-font-picker { position: relative; }
        .adm-font-picker-btn {
            width: 100%; background: #fff; border: 1px solid #d4d4d8; border-radius: 6px;
            color: #18181b; padding: .5rem .75rem; font-size: .95rem; outline: none;
            cursor: pointer; text-align: left; display: flex; align-items: center;
            justify-content: space-between; gap: .5rem; transition: border-color .15s;
        }
        .adm-font-picker-btn:focus,
        .adm-font-picker.open .adm-font-picker-btn { border-color: #18181b; }
        .adm-font-picker-dropdown {
            position: absolute; top: calc(100% + 3px); left: 0; right: 0;
            background: #fff; border: 1px solid #e4e4e7; border-radius: 8px;
            max-height: 220px; overflow-y: auto; z-index: 500; display: none;
            box-shadow: 0 8px 24px rgba(0,0,0,.1);
            scrollbar-width: thin; scrollbar-color: #d4d4d8 transparent;
        }
        .adm-font-picker.open .adm-font-picker-dropdown { display: block; }
        .adm-font-picker-option {
            padding: .45rem .75rem; font-size: .95rem; color: #18181b;
            cursor: pointer; transition: background .1s;
        }
        .adm-font-picker-option:hover  { background: #f4f4f5; }
        .adm-font-picker-option.active { background: #f4f4f5; font-weight: 700; }
    </style>
</head>
<body>
<nav class="adm-topbar">
    <span class="brand">⚡ Webmaster</span>
    <a href="{{ route('admin.dashboard') }}">Usuarios</a>
    <a href="{{ route('admin.catalog.index') }}">Catálogo</a>
    <a href="{{ route('admin.sites.index') }}">Sites</a>
    <a href="/dashboard">← Mi dashboard</a>
</nav>
<div class="adm-wrap">
    @if (session('success'))
        <div class="alert-ok">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-err">{{ $errors->first() }}</div>
    @endif
    @yield('content')
</div>
<script>
function initAdmFontPicker(pickerId, inputId) {
    const picker   = document.getElementById(pickerId);
    if (!picker) return;
    const input    = document.getElementById(inputId);
    const btn      = picker.querySelector('.adm-font-picker-btn');
    const label    = btn.querySelector('span');
    const dropdown = picker.querySelector('.adm-font-picker-dropdown');

    btn.addEventListener('click', e => {
        e.stopPropagation();
        const isOpen = picker.classList.contains('open');
        document.querySelectorAll('.adm-font-picker.open').forEach(p => p.classList.remove('open'));
        if (!isOpen) {
            picker.classList.add('open');
            const active = dropdown.querySelector('.active');
            if (active) active.scrollIntoView({ block: 'nearest' });
        }
    });

    picker.querySelectorAll('.adm-font-picker-option').forEach(opt => {
        opt.addEventListener('click', () => {
            const value = opt.dataset.value;
            input.value          = value;
            label.textContent    = value;
            btn.style.fontFamily = `'${value}', sans-serif`;
            picker.querySelectorAll('.adm-font-picker-option').forEach(o => o.classList.remove('active'));
            opt.classList.add('active');
            picker.classList.remove('open');
        });
    });
}

document.addEventListener('click', () => {
    document.querySelectorAll('.adm-font-picker.open').forEach(p => p.classList.remove('open'));
});
</script>
</body>
</html>
