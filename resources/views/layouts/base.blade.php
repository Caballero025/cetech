<!DOCTYPE html>
<html lang="es" class="theme-light">
<head>
    <title>CETECH v3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/css/miestilo.css">
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="">
                <figure class="image is-24x24">
                    <img src="/img/itsjr.png" />
                </figure>&nbsp;&nbsp;
                <p>Tec San Juan</p>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>&nbsp;Inicio
                </a>

            </div>
            <div class="navbar-end">
                <div class="navbar-item is-right has-dropdown is-hoverable">
                    <a class="navbar-link">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            <i class="fas fa-key"></i>&nbsp;
                            Cambiar contraseña
                        </a>
                        <a class="navbar-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>&nbsp;
                            Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container is-fluid">
        @yield('content')
    </div>
</body>
</html>