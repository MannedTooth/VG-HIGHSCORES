<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link active" href="/">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Browse
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/genres">Genres</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/manage/genres">Genres</a>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @if (Auth::user())
            <li class="nav-item">
                <a class="nav-link" href="/profile">Welcome back, {{ Auth::user()->name }} !</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="navbar-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
        @endif
    </ul>
</nav>