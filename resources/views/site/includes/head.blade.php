<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf_token" content="{{ csrf_token() }}">
<title>{{ $pageTitle }}</title>

<!-- Styles / Scripts -->
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/site/css/app.css', 'resources/site/js/app.js'])
@endif
