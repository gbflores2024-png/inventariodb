
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>ZARA | Sistema de Ventas y Devoluciones</title>

    <!-- Fuentes -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet">

    <!-- Estilos de Laravel Breeze -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
        }

        .zara-background {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background: linear-gradient(
                135deg,
                #14263d 0%,
                #254b76 55%,
                #e8eef5 100%
            );
        }

        .zara-card {
            width: 100%;
            max-width: 460px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
        }

        @media (max-width: 480px) {
            .zara-card {
                padding: 24px;
            }
        }
    </style>
</head>

<body class="antialiased">

    <div class="zara-background">

        <div class="zara-card">

            {{ $slot }}

        </div>

    </div>

</body>
</html>
