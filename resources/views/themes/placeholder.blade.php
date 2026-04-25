<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $site->config['business_name'] ?? $site->slug }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, sans-serif;
            background: #f5f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .wrap {
            text-align: center;
            max-width: 400px;
        }
        .icon { font-size: 3rem; margin-bottom: 1.25rem; }
        h1 { font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: .5rem; }
        p  { font-size: .9rem; color: #666; line-height: 1.6; }
        .badge {
            display: inline-block;
            margin-top: 1.5rem;
            padding: .35rem .9rem;
            background: #1a1a1a;
            color: #fff;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .04em;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="icon">🚧</div>
        <h1>Theme en construcción</h1>
        <p>
            El diseño para este tipo de negocio está siendo preparado.<br>
            Pronto podrás ver tu web aquí.
        </p>
        <span class="badge">{{ $site->sector }}</span>
    </div>
</body>
</html>
