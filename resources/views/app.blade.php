<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#050505]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Atma:wght@300;400;500;600;700&family=Flow+Block&family=Flow+Circular&family=Flow+Rounded&family=Overpass+Mono:wght@300;400;500;600;700&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
        <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
        <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
        <link rel="apple-touch-startup-image" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
        <link rel="favicon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased h-full">
        @inertia
    </body>
</html>
