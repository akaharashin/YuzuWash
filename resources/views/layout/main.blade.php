<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yuzu Wash - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/yuzu-navy.png') }}" type="image/x-icon">
    <script src="{{ asset('js/chart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    {{-- <script src="{{ asset('css/swal.css') }}"></script> --}}
    {{-- <script src="{{ asset('js/swal.js') }}"></script> --}}
</head>

<body>
    @include('layout.nav')
    <div class="container h-100">
        @if (Session::has('error'))
            <div class="alert alert-danger mt-4">{{ Session::get('error') }}</div>
        @endif
        @yield('body')
    </div>
    @include('layout.footer')
    <script src="{{ asset('js/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
