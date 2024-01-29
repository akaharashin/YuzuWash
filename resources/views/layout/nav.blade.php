<nav class="navbar navbar-expand-lg bg-primary px-5 shadow">
    <a href="/" class="navbar-brand">Yuzu Wash</a>
    <div class="container-fluid d-flex justify-content-end">
        <ul class="navbar-nav">
            @guest
                <li class="nav-item"><a href="{{ route('loginPage') }}" class="btn btn-warning">Login</a></li>
            @endguest
            @auth
                <li class="nav-item"><a href="{{ route('logout') }}" class="btn btn-warning">Logout</a></li>
            @endauth
        </ul>
    </div>
</nav>
