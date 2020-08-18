
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            Inicio Sesión Andean Wide
        </title>
        <!-- Favicon -->
        <link href="/assets/images/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
        <!-- Icons -->
        <link href="/admin/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
        <link href="/admin/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="/admin/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
        <link href="/admin/css/custon.css" rel="stylesheet" />
    </head>

    <body>
      <div class="main-content" id="auth_app">
        <!-- Navbar -->
        <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Andean Wide</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-default">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="javascript:void(0)">
                                    <img src="/admin/img/brand/blue.png">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <ul class="navbar-nav ml-lg-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-icon" href="{{ route('home') }}">
                                <i class="fas fa-home mr-2"></i> Inicio
                                <span class="nav-link-inner--text d-lg-none">Inicio</span>
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-icon" href=" {{ route('login') }}">
                                <i class="fas fa-key mr-2"></i> Login
                                <span class="nav-link-inner--text d-lg-none">Login</span>
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                                <i class="fas fa-list mr-2"></i> Registro
                                <span class="nav-link-inner--text d-lg-none">Registro</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- Header -->

        @yield('content')

      </div>
      <!--   Core   -->
      <script src="/admin/js/plugins/jquery/dist/jquery.min.js"></script>
      <script src="/admin/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!--   Optional JS   -->
      <!--   Argon JS   -->
      <script src="/admin/js/argon-dashboard.min.js?v=1.1.0"></script>
      <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

        <script src="/js/manifest.js" defer></script>
        <script src="/js/vendor.js" defer></script>
        <script src="/js/auth.js" defer></script>
    </body>

</html>



