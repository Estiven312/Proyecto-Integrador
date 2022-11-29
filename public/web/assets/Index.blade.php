@section('contenido')
<!-- slider_area_start -->
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
            @foreach($aProductos as $producto)


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
            @endforeach

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="iteam_links">
                    <a class="boxed-btn5" href="menu">Más Productos</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- features_room_startt -->
<div class="Burger_President_area">
    <div class="Burger_President_here">
        @foreach($aPromocion as $promo)

        <div class="single_Burger_President">
            <div class="room_thumb">
                <img src="{{ asset('files/'.$promo->imagen) }}" alt="" height="420px">
                <div class="room_heading d-flex justify-content-between align-items-center">
                    <div class="room_heading_inner">
                        <span>${{number_format($promo->precio,0);}}</span>
                        <h3>{{$promo->titulo}}</h3>
                        <p> {{$promo->descripcion}}</p>
                        <a href="#" class="boxed-btn3">Nueva Orden</a>
                    </div>

                    <!-- Deberia hacer una valicdacion donde pregunte si esta lgeado, si lo está
                         que me diriga a takewey, si no al campo loguearme -->

                </div>
            </div>
        </div>

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
                        <span>About Us</span>
                        <h3>Best Burger <br>
                            in your City</h3>
                    </div>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate</p>
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
        <h3>Burger <br>
            Bachelor</h3>
        <span>How we make delicious Burger</span>
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
@endsection