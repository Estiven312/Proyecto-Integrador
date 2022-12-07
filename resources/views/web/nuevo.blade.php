<!DOCTYPE html>
<html lang="es">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Crear Cuenta</title>
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
                              <div class="column" id="main">
                                    <h1>Crear Cuenta</h1>

                                    <form action="" method="post">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

                                          <div class="form-group">
                                                <label for="exampleInputName">Nombre</label>
                                                <input type="text" name="txtNombre" class="form-control" id="exampleInputName" placeholder="Name">
                                          </div>
                                          <div class="form-group">
                                                <label for="exampleInputName">Telefono</label>
                                                <input type="txt" name="txtTelefono" class="form-control" id="exampleInputName" placeholder="Name">
                                          </div>
                                          <div class="form-group">
                                                <label for="exampleInputName">Direccion</label>
                                                <input type="name" name="txtDireccion" class="form-control" id="exampleInputName" placeholder="Name">
                                          </div>
                                          <div class="form-group">
                                                <label for="exampleInputName">Documento</label>
                                                <input type="name" name="txtDocumento" class="form-control" id="exampleInputName" placeholder="Name">
                                          </div>
                                          <div class="form-group">
                                                <label for="exampleInputName">Correo</label>
                                                <input type="email" name="txtCorreo" class="form-control" id="exampleInputName" placeholder="Name">
                                          </div>

                                          <div class="form-group">
                                                <label for="exampleInputPassword1">Contraseña</label>
                                                <input type="password" name="txtClave" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                          </div>
                                          <button type="submit" class="btn btn-primary">Crear</button>
                                    </form>
                              </div>
                              <div>

                                    <svg width="67px" height="578px" viewBox="0 0 67 578" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                          <!-- Generator: Sketch 53.2 (72643) - https://sketchapp.com -->
                                          <title>Path</title>
                                          <desc>Created with Sketch.</desc>
                                          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path d="M11.3847656,-5.68434189e-14 C-7.44726562,36.7213542 5.14322917,126.757812 49.15625,270.109375 C70.9827986,341.199016 54.8877465,443.829224 0.87109375,578 L67,578 L67,-5.68434189e-14 L11.3847656,-5.68434189e-14 Z" id="Path" fill="#F9BC35"></path>
                                          </g>
                                    </svg>
                              </div>
                              <div class="column" id="secondary">
                                    <div class="sec-content">
                                          <h2>Bienvenido</h2>
                                          <h3>Ya tienes cuenta</h3>
                                          <a class="btn btn-primary" href="/login">Iniciar sesión</a>

                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      </div>

</body>

</html>