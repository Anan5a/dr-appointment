<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Home') - {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('includes.header')
    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }} Logo" height="60"
             width="60">
    </div>

    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route("page.main") }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        @guest()
        @else
            <!-- Right navbar items -->
            <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- user image -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset(auth()->user()->profile_picture) }}"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ asset(auth()->user()->profile_picture) }}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}
                            @foreach( auth()->user()->roles as $role)
                                <span class="badge badge-success">{{ $role->name }}</span>
                            @endforeach
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('user.profile') }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="javascript:void(0)" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        @endguest

    </nav>

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2022- <a href="javascript:void(0)">Developers</a>.</strong> All rights
        reserved.
    </footer>
</div>
@include('includes.footer')
@stack('third_party_scripts')

@stack('page_scripts')
<script>
    @error('message')
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ $message }}'
    })
    @enderror
    @if(!$errors->isEmpty())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error');
    @endforeach
    @endif
    @if(\Illuminate\Support\Facades\Session::has('message'))
        toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}', 'Success');
    @endif
</script>

</body>
</html>
