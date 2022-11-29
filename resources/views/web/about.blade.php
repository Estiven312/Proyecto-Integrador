@extends('web/plantillaWeb')
@section('pagina')
<li><a href="/">Inicio</a></li>
<li><a href="/takeawey">Takeawey</a></li>
<li><a class="active" href="/Nosotros">Nosotros</a></li>
@endsection
@section('contenido')

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg_1 overlay">
    <h3>Nosotros</h3>
</div>
<!-- bradcam_area_end -->
<!-- about_area_start -->
<div class="about_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="about_thumb2">

                    <div class="web/img_1">
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
                        <h3>La mejor burgueseria <br>
                            de la ciudad</h3>
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

<!-- gallery_start -->
<div class="gallery_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title mb-70 text-center">
                    <span>Trabaja Con Nosotros</span>
                    <!-- <h3>Our Gallery</h3> -->
                </div>
            </div>
        </div>
    </div>
    <div class="p-5">
        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

            <div class="row">
                <div class="col-6 p-2">
                    <label for=""> <span>Nombre</span></label>
                    <input type="text" name="txtNombre" class="form-control">
                </div>

                <div class="col-6 p-2">
                    <label for="">Apellido</label>
                    <input type="text" name="txtApellido" class="form-control">

                </div>
                <div class="col-6 p-2">
                    <label for="">Whatsapp</label>
                    <input type="text" name="txtTelefono" class="form-control">
                </div>
                <div class="col-6 p-2">
                    <label for="">Correo</label>
                    <input type="email" name="txtCorreo" class="form-control">
                </div>
                <div class="col-6 p-2">
                    <label for="">Hoja de vida </label>
                    <input type="file" class="form-control" name="archivo" id="archivo" accept=".doc, .docx, .pdf" class="form-control-file ">
                    <small class="d-block">Archivos admitidos: .doc, .docx, .pdf</small>
                </div>

            </div>
            <div class="text-center m-4"><button type="submit" class="boxed-btn3">Enviar</button></div>


            <a href=""></a>

        </form>
    </div>

</div>

<!-- testimonial_area_start  -->
<!--  -->

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