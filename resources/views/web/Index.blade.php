@extends('web/plantillaWeb')
<!-- slider_area_start -->
@section('pagina')
<li><a class="active" href="/">Inicio</a></li>
<li><a href="/takeawey">Takeawey</a></li>
<li><a href="/Nosotros">Nosotros</a></li>
<li><a href="/Contacto">Contacto</a></li>
@endsection
@section('contenido')

<div class="slider_area">
    <div class="slider_active owl-carousel">
        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-9 col-md-9 col-md-12">
                        <div class="slider_text text-center">
                            <div class="deal_text">
                                <span>Big Deal</span>
                            </div>
                            <h3>Burger <br>
                                Bachelor</h3>
                            <h4>Maxican</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- slider_area_end -->

<div class="best_burgers_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-80">
                    <span>Burger Menu</span>
                    <h3>Best Ever Burgers</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($aProductos as $key=> $producto)

            <?php if ($key <= 3) { ?>
                <div class="col-xl-6 col-md-6 col-lg-6">
                    <div class="single_delicious d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset('files/'.$producto->imagen) }}" alt="" width="250px" height="200px">
                        </div>
                        <div class="info">
                            <h3>{{$producto->titulo}}</h3>
                            <p>{{$producto->descripcion}}</p>
                            <span>${{number_format($producto->precio,0)}}</span>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

            <?php } ?>
            @endforeach

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="iteam_links">
                    <a class="boxed-btn5" href="/takeawey">Más Productos</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- features_room_startt -->
<div class="Burger_President_area">
    <div class="Burger_President_here">
        @foreach($aPromocion as $key=> $promo)

        <?php if ($key <= 1) { ?>

            <div class="single_Burger_President">
                <div class="room_thumb">
                    <img src="{{ asset('files/'.$promo->imagen) }}" alt="" height="420px">
                    <div class="room_heading d-flex justify-content-between align-items-center">
                        <div class="room_heading_inner">
                            <span>${{number_format($promo->precio,0);}}</span>
                            <h3>{{$promo->titulo}}</h3>
                            <p> {{$promo->descripcion}}</p>

                        </div>

                        <!-- Deberia hacer una valicdacion donde pregunte si esta logeado, si lo está
                                que me diriga a takewey, si no al campo loguearme -->

                    </div>
                </div>
            </div>
        <?php } else { ?>

        <?php } ?>
        @endforeach


    </div>
</div>
<!-- features_room_end -->
<!-- about_area_start -->
<div class="about_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="about_thumb2">
                    <div class="img_1">
                        <img src="web/img/about/1.png" alt="">
                    </div>
                    <div class="img_2">
                        <img src="web/img/about/2.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 offset-lg-1 col-md-6">
                <div class="about_info">
                    <div class="section_title mb-20px">
                        <span>Nosotros</span>
                        <h3>Buger<br>
                               Top</h3>
                    </div>
                    <p>Somos una experiencia de hospitalidad y gastronomía en constante movimiento. Empezamos en 2003, creando el primer local Burger Top . Desde entonces, nos dedicamos a cocinar tus platillos japoneses favoritos, recibiéndote siempre, en un ambiente casual y divertido. Cada día, seleccionamos los mejores ingredientes de proveedores locales y extranjeros responsables con México y el medio ambiente. Trabajamos en equipo para tocar positivamente la vida de nuestros compañeros e invitados con procesos seguros, excelente servicio y pasión culinaria. Nos mueve aprender, enseñar y descubrir para crecer. Creemos en aprovechar lo que recibimos para convertirlo en algo mejor. Sobre todas las cosas, siempre queremos que la pases bien comiendo y bebiendo delicioso con nosotros. Descubre todo nuestro menú sorprendiéndote con algo nuevo cada vez.</p>
                    <div class="img_thumb">
                        <img src="web/img/jessica-signature.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about_area_end -->
<!-- video_area_start -->
<div class="video_area video_bg overlay">
    <div class="video_area_inner text-center">
        <h3>Nuestras <br>
            Mejores Hamburguesas</h3>
        <span>A Tu Alcance</span>
        <div class="video_payer">

        </div>
    </div>
</div>


<!-- instragram_area_start -->
<div class="instragram_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="web/img/instragram/1.png" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="web/img/instragram/2.png" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="web/img/instragram/3.png" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_instagram">
                    <img src="web/img/instragram/4.png" alt="">
                    <div class="ovrelay">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- instragram_area_end -->

@endsection