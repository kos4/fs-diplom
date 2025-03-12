<!DOCTYPE html>
<html lang="ru">

<head>
    @include('admin.includes.head')
</head>

<body>

<header class="page-header">
    @include('admin.includes.header');
</header>

<main>
    @yield('content')
</main>

</body>
</html>
