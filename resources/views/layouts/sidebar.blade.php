<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('page.main') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}"
             alt="{{ config('app.name') }} Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        @guest()
            <nav class="mt-2">
                <!-- Left navbar links -->
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                    <!-- Navbar Search -->
                    @guest()
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    @else
                        <li class="nav-item d-none d-sm-inline-block">
                            @hasanyrole('super admin|doctor|manager')
                            <a href="{{ route('admin.home.index') }}" class="nav-link">Dashboard</a>
                            @else
                                <a href="{{ route('home.index') }}" class="nav-link">Dashboard</a>
                                @endhasanyrole
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="javascript:void(0)" class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    @endguest
                </ul>
            </nav>

        @else
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset(auth()->user()->profile_picture) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('user.profile') }}" class="d-block">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
                </div>
            </div>
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
        @endguest
    </div>

</aside>
