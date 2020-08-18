@extends('layouts.weball')
@section('content')
<!-- Header -->
<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12">
                    <div class="text-container">
                        <h1 class="text-white text-center">Enviar dinero nunca fue tan fácil</h1>
                        <hr>
                        <p class="text-white">Somos la opción más rápida para enviar y recibir dinero desde cualquier
                            parte del mundo. Forma parte de las miles de personas que envían dinero de forma casi
                            instantánea gracias a Andean Wide.<p>
                                <div class="col text-center">
                                    <a class="btn btn-outline-lg  mb-3 " href="/login" role="button"><i
                                            class="fa fa-key"></i> INICIAR SESIÓN</a>

                                    <a class="btn btn-outline-lg mb-3" href="/register" role="button"><i
                                            class="fa fa-user-alt"></i> CREA CUENTA</a>

                                </div>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-5 col-sm-12">
                    <div id="calculator_app">
                        <rate-calculator
                            redirect-route="{{ route('panel.user.order.create') }}"
                            :symbols="{{ json_encode($symbols) }}"
                            :params="{{ json_encode($params) }}"
                            :priorities="{{ json_encode($priorities) }}"
                        />
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->
<!-- end of header -->

<!-- Services -->
<div id="services" class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5">

                <h2>¿Cómo funciona?</h2>
                <p class="lead">Hacemos que el envío de dinero sea rápido, sencillo y seguro, sea cual sea el método de
                    pago que elijas, enviar dinero con Andean Wide está al alcance de tus manos.</p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Card -->
                <div class="card">
                    <img class="" src="/assets/images/services-icon-1.svg" alt="alternative" width="200">
                    <div class="card-body">
                        <br>
                        <h5 class="card-title text-muted">Registrate</h5>

                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <img class="" src="/assets/images/services-icon-3.svg" alt="alternative" width="200">
                    <div class="card-body">
                        <br>
                        <h5 class="card-title text-muted ">Verifica tu cuenta</h5>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <img class="" src="/assets/images/services-icon-2.svg" alt="alternative" width="200">
                    <div class="card-body">
                        <br>
                        <h5 class="card-title text-muted">Envia</h5>
                    </div>
                </div>
                <!-- end of card -->
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">Transfiere dinero con <br> Andean Wide</h3>
                    </div>
                    <div class="col-md-12 text-center mt-2 mb-2"><img src="/assets/images/linea.svg" alt=""
                            width="80px"></div>
                    <div class="col-lg-6 offset-lg-3 col-sm-12  text-lg-left">

                        <h5 class="text-muted">1. Registra tu cuenta</h5>
                        <p>Regístrate y verifica tu cuenta desde nuestro sitio web.</p>
                        <h5 class="text-muted">2. Crea tu orden de remesa</h5>
                        <p>
                            Selecciona a que país quieres enviar. <br>
                            Indica cuanto dinero deseas transferir.<br>
                            Verás nuestras bajas comisiones y el tipo de cambio por adelantado.</p>
                        <h5 class="text-muted">3. Paga por tu remesa</h5>
                        <p class="mb-2">Paga mediante:
                            <ul class="text-muted mt-0">
                                <li>Transferencia bancaria.</li>
                                <li>Deposito bancario.</li>
                            </ul>
                        </p>
                        <h5 class="text-muted">4. Añade la información de tu pago y destinatario</h5>
                        <p>Completa el formulario con los datos de pago, datos de beneficiario y ejecuta tu orden de
                            remesa. </p>
                        <br>
                        <a href="/register" class="btn btn-success btn-block">Regístrate</a>
                        <p class="text-center mt-3">
                            <small>
                                Al registrarte estas aceptando nuestra <a href="/privacidad">Política de privacidad</a>
                                y <a href="/terminos">Términos & condiciones.</a>
                            </small>
                        </p>
                    </div>

                </div>
            </div> <!-- end of col -->
        </div> <!-- end of row -->

    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
<!-- end of services -->


<!-- Details 1 -->
<div class="bg-gris ">

    <div class="container-fluid  ">
        <div class="row ">
            <div class="col-lg-6 ">
                <div class="text-container basic-2">
                    <h2 class="pl-4 pt-5">Tu dinero siempre a la vista</h2>
                    <p class="pl-4">En Andean Wide tu dinero esta en buenas manos. <br>
                        Desde tu panel de usuario podras consultar en todo momento el estado de tu envío de remesa.</p>

                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid" src="/assets/images/panel.png" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of basic-1 -->
<!-- end of details 1 -->


<!-- Details 2 -->
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid" src="/assets/images/details-2-office-team-work.svg" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <div class="text-container pt-5">
                    <h2>Tu protección es importante</h2>
                    <p>Estas son algunas de las medidas que tomamos para protegerte a ti y a tu dinero:</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">

                            <div class="media-body"><i class="fas fa-check"></i> Verificación de identidad</div>
                        </li>
                        <li class="media">

                            <div class="media-body"> <i class="fas fa-check"></i> Un equipo de expertos en seguridad de
                                primer nivel</div>
                        </li>
                        <li class="media">

                            <div class="media-body"> <i class="fas fa-check"></i> Tu información de pago y datos
                                personales están protegidos</div>
                        </li>
                        {{-- </ul>
                    <a class="btn-solid-reg popup-with-move-anim" href="#details-lightbox-2">Ver más</a> --}}
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of basic-2 -->
<!-- end of details 2 -->




<!-- Testimonials  -->
{{-- <div class="slider-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid" src="/assets/images/testimonials-2-men-talking.svg" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <h2>Testimonios</h2>

                <!-- Card Slider -->
                <div class="slider-container">
                    <div class="swiper-container card-slider">
                        <div class="swiper-wrapper">

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="card">
                                    <img class="card-image" src="/assets/images/testimonial-1.svg" alt="alternative">
                                    <div class="card-body">
                                        <p class="testimonial-text">I just finished my trial period and was so amazed
                                            with the support and results that I purchased Evolo right away at the
                                            special price.</p>
                                        <p class="testimonial-author">Jude Thorn - Designer</p>
                                    </div>
                                </div>
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="card">
                                    <img class="card-image" src="/assets/images/testimonial-2.svg" alt="alternative">
                                    <div class="card-body">
                                        <p class="testimonial-text">Evolo has always helped or startup to position
                                            itself in the highly competitive market of mobile applications. You will not
                                            regret using it!</p>
                                        <p class="testimonial-author">Marsha Singer - Developer</p>
                                    </div>
                                </div>
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="card">
                                    <img class="card-image" src="/assets/images/testimonial-3.svg" alt="alternative">
                                    <div class="card-body">
                                        <p class="testimonial-text">Love their services and was so amazed with the
                                            support and results that I purchased Evolo for two years in a row. They are
                                            awesome.</p>
                                        <p class="testimonial-author">Roy Smith - Marketer</p>
                                    </div>
                                </div>
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                        </div> <!-- end of swiper-wrapper -->

                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- end of add arrows -->

                    </div> <!-- end of swiper-container -->
                </div> <!-- end of slider-container -->
                <!-- end of card slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider-2 --> --}}
<!-- end of testimonials -->




<!-- Contact -->
<div id="contact" class="form-2">
    <div class="container-fluid pb-5 pt-5  bg-contac">
        <div class="row">
            <div class="col-lg-12">
                <h2>Información de contacto</h2>
                <ul class="list-unstyled li-space-lg mb-4">
                    <li class="address">
                        <i class="fas fa-map"></i> CHILE : Av. Providencia 2529 L15, Las Condes, Santiago.<br/>
                        <i class="fas fa-map"></i> COLOMBIA: Calle 57 N 37 A 49, Oficina 102 Bogota.<br/>
                        <i class="fas fa-map"></i> ESTONIA: Laki Tn 30, 12915, Tallinn.<br/>
                    </li>

                    <li>
                        <i class="fas fa-phone"></i><a class="turquoise" href="tel:+56229790185">Teléfono:+56 229 790 185</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i><a class="turquoise" href="mailto:contacto@andeanwide.com">contacto@andeanwide.com</a>
                    </li>
                </ul>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            {{-- <div class="col-lg-6">
                <div class="map-responsive">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d100939.98555098464!2d-122.507640204439!3d37.757814996609724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sro!4v1498231462606"
                        allowfullscreen></iframe>
                </div>
            </div> <!-- end of col --> --}}
            <div class="col-lg-6 offset-lg-3 col-sm-12">

                <div id="contact_form">
                    <contact-form-component
                        url="{{ route('mailContact') }}"
                    />
                </div>

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-2 -->
<!-- end of contact -->

{{-- modal --}}

@endsection
