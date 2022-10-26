<nav class="main-header navbar navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
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
