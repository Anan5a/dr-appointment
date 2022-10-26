<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Home') - {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('includes.header')
{{--    @vite(['resources/js/app.js', 'resources/sass/app.scss', 'resources/css/app.css'])--}}

    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="@yield('body-class', '')">

<div class="wrapper">
    @include('layouts.menu-base')

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }} Logo" height="60" width="60">
    </div>

    @yield('content')
</div>
{{--<div class="wrapper">--}}
{{--    <div class="wrapper-content">--}}
{{--        <footer class="main-footer">--}}
{{--            <div class="float-right d-none d-sm-block">--}}
{{--                <b>Version</b> 1.0.0--}}
{{--            </div>--}}
{{--            <strong>Copyright &copy; 2022- <a href="javascript:void(0)">Developers</a>.</strong> All rights--}}
{{--            reserved.--}}
{{--        </footer>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Content Wrapper. Contains page content -->

{{--    <!-- Main Footer -->--}}

@include('includes.footer')
@stack('third_party_scripts')

@stack('page_scripts')
@error('message')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ $message }}'
    })
</script>
@enderror
</body>
</html>
