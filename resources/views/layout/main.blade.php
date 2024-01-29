<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yuzu Wash - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    @include('layout.nav')
    <div class="container">
        @yield('body')
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>