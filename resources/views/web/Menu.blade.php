@extends('web/plantillaWeb')
@section('pagina')
<li><a href="/">Inicio</a></li>
<li><a class="active" href="/takeawey">Takeawey</a></li>
<li><a href="/Nosotros">Nosotros</a></li>
<li><a href="/Contacto">Contacto</a></li>
@endsection
@section('contenido')
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Menu</h3>
</div>
<!-- bradcam_area_end -->

<!-- best_burgers_area_start  -->
<div class="best_burgers_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-80">
                    <span>Burger Menu</span>
                    <h3>Las mejores hamburguesas</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($aProductos as $producto)
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('files/'.$producto->imagen) }}" alt="" width="200px" height="200px">
                    </div>
                    <div class="info">
                        <h3>{{$producto->titulo}}</h3>
                        <p>{{$producto->descripcion}}</p>
                        <span>${{number_format($producto->precio,0)}}</span>
                        <form action="" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="numProducto" value="{{$producto->idproducto}}" class="boxed-btn3">
                            <div class="row">
                                <div class="col-6  ">
                                    <input type="number" name="numCantidad" placeholder="Cantidad" class="form-control" width="40px" required>
                                </div>
                                <div class="col-6 ">
                                    <?php if (isset($cliente)) { ?>

                                        <?php if ($cliente::autenticado() == True) { ?>

                                            <button type="submit" class="boxed-btn3">Ordenar</button>



                                        <?php } else { ?>

                                            <a href="/login" class="boxed-btn3">Ordenar</a>

                                        <?php } ?>
                                    <?php } ?>

                                </div>

                            </div>




                        </form>

                    </div>

                </div>
            </div>
            @endforeach
            <div class=" col-12 p-4 section_title text-center mb-80">
                <span>Promosiones</span>

            </div>




            @foreach($aPromocion as $promo)

            <div class="col-xl-6 col-md-6 col-lg-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('files/'.$promo->imagen) }}" alt="" width="200px" height="200px">
                    </div>
                    <div class="info">
                        <h3>{{$promo->titulo}}</h3>
                        <p>{{$promo->descripcion}}</p>
                        <span>${{number_format($promo->precio,0)}}</span>

                        <form action="" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="numProducto" value="{{$promo->idproducto}}" class="boxed-btn3">
                            <div class="row">
                                <div class="col-6  ">
                                    <input type="number" name="numCantidad" placeholder="Cantidad" class="form-control" width="40px" required>
                                </div>
                                <div class="col-6 ">

                                    <?php if (isset($cliente)) { ?>

                                        <?php if ($cliente::autenticado() == True) { ?>

                                            <button type="submit" class="boxed-btn3">Ordenar</button>



                                        <?php } else { ?>

                                            <a href="/login" class="boxed-btn3">Ordenar</a>

                                        <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>
            </div>

            @endforeach




        </div>
    </div>
</div>
</div>
<!-- best_burgers_area_end  -->

<!-- features_room_startt -->


<!-- features_room_end -->

<!-- testimonial_area_start  -->

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