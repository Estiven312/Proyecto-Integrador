<!doctype html>
<html class="no-js" lang="zxx">

<head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Burger</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- <link rel="manifest" href="site.webmanifest"> -->
      <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
      <!-- Place favicon.ico in the root directory -->

      <!-- CSS here -->
      <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/magnific-popup.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/themify-icons.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/nice-select.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/flaticon.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/animate.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/slicknav.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

      <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
      <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

      <!-- header-start -->
      <header>
            <div class="header-area ">
                  <div id="sticky-header" class="main-header-area">
                        <div class="container-fluid p-0">
                              <div class="row align-items-center no-gutters">
                                    <div class="col-xl-7 col-lg-7  pt-4">
                                          <div class="main-menu  d-none d-lg-block">
                                                <nav>
                                                      <ul id="navigation">

                                                            @yield('pagina')
                                                      </ul>
                                                </nav>
                                          </div>
                                    </div>

                                    <div class="col-xl-5 col-lg-5  pt-4 d-none d-lg-block">
                                          <div class="book_room">
                                                <div class="socail_links">
                                                      <ul>
                                                            <li>
                                                                  <a href="#">
                                                                        <i class="fa fa-instagram"></i>
                                                                  </a>
                                                            </li>
                                                            <li>
                                                                  <a href="#">
                                                                        <i class="fa fa-twitter"></i>
                                                                  </a>
                                                            </li>
                                                            <li>
                                                                  <a href="#">
                                                                        <i class="fa fa-facebook"></i>
                                                                  </a>
                                                            </li>
                                                            <li>
                                                                  <a href="#">
                                                                        <i class="fa fa-google-plus"></i>
                                                                  </a>
                                                            </li>
                                                            <?php if (isset($cliente)) { ?>

                                                                  <?php if ($cliente::autenticado() == True) { ?>
                                                                        <li>
                                                                              <a href="/Carrito">

                                                                                    <i class="bi bi-cart-check-fill"></i>
                                                                              </a>
                                                                        </li>

                                                                  <?php } ?>

                                                            <?php } ?>
                                                      </ul>
                                                </div>
                                                <div class="book_btn d-none d-xl-block">


                                                      <?php if (isset($cliente)) { ?>

                                                            <?php if ($cliente::autenticado() == True) { ?>

                                                                  <!-- <a class="#" href="/MiCuenta">Mi Cuenta</a> <br>
                                                                  <a href="#" class="#">Cerrar Sesion</a> -->
                                                                  <div class="main-menu  d-none d-lg-block ">
                                                                        <ul id="navigation ">
                                                                              <li><a href="#">Mi Cuenta <i class="ti-angle-down"></i></a>
                                                                                    <ul class="submenu ">
                                                                                          <li><a class=" # m-1" href="/MiCuenta">Cuenta</a></li>
                                                                                          <li><a class=" # m-1" href="/Cerrar">Cerrar Sesión</a></li>
                                                                                    </ul>
                                                                              </li>
                                                                        </ul>

                                                                  </div>
                                                            <?php } else { ?>
                                                                  <a class="#" href="/login">Iniciar sesión</a>

                                                            <?php } ?>
                                                      <?php }  ?>

                                                </div>


                                          </div>
                                          <div class="col-12">
                                                <div class="mobile_menu d-block d-lg-none"></div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
      </header>
      <!-- header-end -->

      @yield('contenido')

      <footer class="footer">
            <div class="footer_top">
                  <div class="container">
                        <div class="row">

                              @foreach($aSucursales as $key=> $sucursal)


                              <div class="col-3">
                                    <h3 class="footer_title pos_margin">
                                          {{$sucursal->nombre}}
                                    </h3>
                                    <p>{{$sucursal->direccion}} <br>
                                          <a href="{{$sucursal->linkmapa}}">Link Mapa {{$sucursal->nombre}}</a>
                                    </p>
                                    <a class="number" href="#">{{$sucursal->telefono}}</a>
                                    <p>
                                          <a href="{{$sucursal->linkmapa}}">{{$sucursal->horario}}</a>
                                    </p>

                              </div>
                              @endforeach







                              <div class=" col-12 pt-5 text-center">
                                    <div class="socail_links text-center">
                                          <div class="d-inline">
                                                <div>
                                                      <ul>
                                                            <li class="pr-3">
                                                                  <a href="#">
                                                                        <i class="ti-instagram"></i>
                                                                  </a>
                                                            </li>
                                                            <li class="pr-3">
                                                                  <a href="#">
                                                                        <i class="ti-twitter-alt"></i>
                                                                  </a>
                                                            </li>
                                                            <li class="pr-3">
                                                                  <a href="#">
                                                                        <i class="ti-facebook"></i>
                                                                  </a>
                                                            </li>
                                                            <li class="pr-3">
                                                                  <a href="#">
                                                                        <i class="fa fa-google-plus"></i>
                                                                  </a>
                                                            </li>
                                                      </ul>
                                                </div>
                                          </div>
                                    </div>
                              </div>

                        </div>








                  </div>


            </div>
            </div>
            </div>
            </div>
            <div class="copy-right_text">
                  <div class="container">
                        <div class="footer_border"></div>
                        <div class="row">
                              <div class="col-xl-12">
                                    <p class="copy_right text-center">
                                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                          Copyright &copy;<script>
                                                document.write(new Date().getFullYear());
                                          </script> All rights reserved | Estiven Carvajal Rojas
                                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </p>
                              </div>
                        </div>
                  </div>
            </div>
      </footer>


      <!-- JS here -->
      <!-- <script src="{{asset('web/js/vendor/modernizr-3.5.0.min.js')}}"></script> -->
      <script src="{{asset('web/js/vendor/jquery-1.12.4.min.js')}}"></script>
      <script src="{{asset('web/js/popper.min.js')}}"></script>
      <script src="{{asset('web/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('web/js/isotope.pkgd.min.js')}}"></script>
      <script src="{{asset('web/js/ajax-form.js')}}"></script>
      <script src="{{asset('web/js/waypoints.min.js')}}"></script>
      <script src="{{asset('web/js/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('web/js/imagesloaded.pkgd.min.js')}}"></script>
      <script src="{{asset('web/js/scrollIt.js')}}"></script>
      <script src="{{asset('web/js/jquery.scrollUp.min.js')}}"></script>
      <script src="{{asset('web/js/wow.min.js')}}"></script>
      <script src="{{asset('web/js/nice-select.min.js')}}"></script>
      <script src="{{asset('web/js/jquery.slicknav.min.js')}}"></script>
      <script src="{{asset('web/js/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{asset('web/js/plugins.js')}}"></script>

      <!--contact js-->
      <script src=" {{asset('web/js/contact.js')}}"></script>
      <script src="{{asset('web/js/jquery.ajaxchimp.min.js')}}"></script>
      <script src="{{asset('web/js/jquery.form.js')}}"></script>
      <script src="{{asset('web/js/jquery.validate.min.js')}}"></script>
      <script src="{{asset('web/js/mail-script.js')}}"></script>

      <script src=" {{asset('js/main.js')}}"></script>

</body>

</html>