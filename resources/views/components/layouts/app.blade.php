<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="color: rgb(0,0,0);">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? env('APP_NAME') }}</title>

        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="bg-gradient-primary" style="background: var(--bs-green);">
        <div class="container">
            {{ $slot }}
            <div class="row" style="color: rgb(0,0,0);">
                <div class="col" style="text-align: center;color: var(--bs-white);"><span style="color: var(--bs-white);">©️ 2023 <strong>{!! config('app.spolecnost') ?? "<a href='https://ultron01.ultronarmy.eu' target='_blank' class='odkaz'>Petr Vurm</a>" !!}</strong></span></div>
            </div>
        </div>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/script.min.js"></script>
    </body>
</html>
