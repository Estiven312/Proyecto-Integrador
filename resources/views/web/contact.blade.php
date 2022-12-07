@extends('web/plantillaWeb')

@section('pagina')
<li> <a href="/">Inicio</a></li>
<li><a href="/takeawey">Takeawey</a></li>
<li><a href="/Nosotros">Nosotros</a></li>
<li><a class="active" href="#">Contacto</a></li>
@endsection
@section('contenido')

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg_2">
    <h3>CONTACTO</h3>
</div>
<!-- bradcam_area_end -->

<!-- ================ contact section start ================= -->
<section class="contact-section">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">


        </div>


        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Contacto, quejas o sugerencias</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="" method="post"  >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100"  cols="30" rows="9" placeholder='Deja aquí tu mensaje, queja o sugerencia' required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control " name="name" id="name" type="text" placeholder='Nombre' required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control " name="email" id="email" type="email" placeholder='Correo' required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text" placeholder='Asunto' required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button boxed-btn">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">


                <div class="media contact-info">
                    <span class="contact-info__icon"><i class=""></i></span>
                    <div class="media-body">
                        <h3>support@burgers.com</h3>
                        <p>Dejanos tu mensaje!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

@endsection