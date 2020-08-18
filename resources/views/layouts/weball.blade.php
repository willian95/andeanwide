<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Somos la opción más rápida para enviar y recibir dinero desde cualquier parte del mundo.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Website Title -->
    <title>Andean Wide</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="/assets/css/swiper.css" rel="stylesheet">
    <link href="/assets/css/magnific-popup.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">


    <!-- Favicon  -->
    <link rel="icon" href="/assets/images/favicon.png">
    <style>
        .btn {
            text-transform: none;
            transition: all 0.15s ease;
            letter-spacing: 0.025em;
            font-size: 0.875rem;
            font-weight: 600;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.60rem 1.25rem;
            line-height: 1.5;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="/"><img src="/assets/images/logo.svg" alt="alternative"></a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="/">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#services">Cómo funciona</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">Calculadora</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="/faqs" >Preguntas frecuentes</a>
                </li>

                <!-- Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle page-scroll" href="#about" id="navbarDropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">Acerca</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" target="black" href="/nosotros"><span class="item-text">¿Quiénes
                                somos?</span></a>
                        <div class="dropdown-items-divide-hr"></div>
                        <a class="dropdown-item" target="black" href="/terminosycondiciones"><span class="item-text">Términos y
                                condiciones</span></a>
                        <div class="dropdown-items-divide-hr"></div>
                        <a class="dropdown-item" target="black" href="/privacidad"><span class="item-text">Política de
                                privacidad</span></a>
                    </div>
                </li>
                <!-- end of dropdown menu -->

                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#contact">Contacto</a>
                </li>


            </ul>
            <span class="nav-item social-icons">
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x facebook"></i>
                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x twitter"></i>
                        <i class="fab fa-twitter fa-stack-1x"></i>
                    </a>
                </span>
            </span>
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->
    <div id="home_app">
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4>Andean Wide</h4>
                        <p>Somos la opción más rápida para enviar y recibir dinero desde cualquier parte del mundo. Forma parte de las miles de personas que envían dinero de forma casi instantánea gracias a Andean Wide.</p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Link importantes</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"> <a class="turquoise"
                                        href="/nosotros">Nosotros</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Leer <a class="turquoise" href="/terminosycondiciones">Términos
                                        & condiciones</a>, <a class="turquoise" href="/privacidad">Política de
                                        privacidad</a></div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Redes sociales</h4>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-google-plus-g fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © Andean Wide- sitio web desarrollado por <a
                            href="https://iwebpixel.com">iwebpixel.com</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="/assets/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="/assets/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="/assets/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="/assets/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="/assets/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="/assets/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="/assets/js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="/assets/js/scripts.js"></script> <!-- Custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <!-- <script>$(function () {
        $('select').selectpicker();
    });</script> -->

    <script src="/js/manifest.js" defer></script>
    <script src="/js/vendor.js" defer></script>
    <script src="/js/home_app.js" defer></script>

    @yield('scripts')



    {{-- Modales --}}


</body>

</html>
