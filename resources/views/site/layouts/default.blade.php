<!DOCTYPE html>
<html lang="ru">

<head>
    @include('site.includes.head')
</head>

<body>

<header class="page-header">
    @include('site.includes.header');
</header>

@hasSection('dates')
    @yield('dates')
@endif

<main>
    @yield('content')
</main>

</body>
</html>
