<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    @yield('meta')
    <link rel="icon" href="{{ route('home') }}/favicon.ico">

    <title>@yield('title')</title>

    @yield('links')
</head>

<body>

@yield('content')

@yield('scripts')
</body>
</html>
