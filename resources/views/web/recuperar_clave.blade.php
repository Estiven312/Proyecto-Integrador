<!DOCTYPE html>
<html lang="es">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>RecuperarClave</title>
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
</head>

<body>
      <div id="log">


            <!-- Modal -->
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
            <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="modal-body">
                              <?php if (isset($msg)) { ?>

                                    <div class="column" id="main">
                                          <p>{{$msg}}.<?php if (isset($nuevaContrasena)) { ?>
                                                {{$nuevaContrasena}}
                                          <?php } else { ?>
                                                {{$correo}}

                                          <?php  } ?>
                                          </p>
                                    </div>
                                    <div class="p-4 text-center">
                                          <a href="/login" class=" btn btn-primary">Volver a Login</a>
                                    </div>
                              <?php } else { ?>
                                    <div class="column" id="main">
                                          <h1>Recuperar Clave</h1>
                                          <?php
                                          if (isset($msg)) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                      {{$msg}}
                                                </div>
                                          <?php  } ?>

                                          <form method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>


                                                <div class="form-group">
                                                      <label for="exampleInputPassword1">Correo</label>
                                                      <input type="email" name="txtCorreo" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Recuperar</button><br>
                                                <div class="p-2 text-center">

                                                      <a href="/login">Volver al login</a>
                                                </div>

                                          </form>
                                    </div>


                              <?php } ?>










                        </div>
                  </div>
            </div>
      </div>
      </div>

</body>

</html>