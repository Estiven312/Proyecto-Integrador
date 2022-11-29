@extends('web/plantillaWeb')
@section('pagina')
<li><a href="/">Inicio</a></li>
<li><a href="/takeawey">Takeawey</a></li>
<li><a href="/Nosotros">Nosotros</a></li>
@endsection
@section('contenido')
<div class="bradcam_area breadcam_bg overlay">
      <h3>Mi Cuenta</h3>
</div>
<!-- bradcam_area_end -->

<!-- best_burgers_area_start  -->
<div class="best_burgers_area">
      <div class="container">
            <div class="row">
                  <div class="col-lg-12">
                        <div class="section_title text-center mb-80">
                              <span>Cuenta Personal</span>
                              <!-- <h3>las mejores hamburguesas</h3> -->
                        </div>
                        <div class="row">
                              <div class="col-12">
                                    <form action="" method="post">
                                          <div class="row">

                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                <div class="col-6">
                                                      <label for="">Nombre</label>
                                                      <input type="text" name="txtNombre" value="{{$aCliente->nombre}}" class="form-control">

                                                </div>

                                                <div class="col-6">
                                                      <label for="">Telefono</label>
                                                      <input type="text" name="txtTelefono" value="{{$aCliente->telefono}}" class="form-control">

                                                </div>
                                                <div class="col-6">
                                                      <label for="">Correo</label>
                                                      <input type="email" name="txtCorreo" value="{{$aCliente->correo}}" class="form-control">

                                                </div>
                                                <div class="col-6">
                                                      <label for="">Direccion</label>
                                                      <input type="text" name="txtDireccion" value="{{$aCliente->direccion}}" class="form-control">

                                                </div>
                                                <div class="col-6 ">
                                                      <label for="">Cambiar contraseña</label>
                                                      <input type="text" name="txtClave" value="" class="form-control">



                                                </div>
                                                <div class="col-12 text-center p-5">
                                                      <button class="boxed-btn5" type="submit">Actualizar</button>

                                                </div>
                                          </div>

                                    </form>

                              </div>
                        </div>

                        <div class="row">
                              <div class="col-12">
                                    <div class="section_title text-center mb-80">
                                          <span>Pedidos</span>
                                          <!-- <h3>las mejores hamburguesas</h3> -->
                                    </div>
                                    <table class="table table-hover border">
                                          <thead>

                                                <th>Producto</th>
                                                <th>Sucursal</th>
                                                <th>Estado del Pedido</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Total</th>
                                                <th>Pago</th>
                                          </thead>
                                          <tbody>

                                                @foreach($aPedido as $key=> $pedido)

                                                <tr>

                                                      <td>@foreach($aProductosPorPedido[$key] as $Producto)
                                                            {{($Producto->producto) }}<br>
                                                            @endforeach
                                                      </td>
                                                      <td>{{$pedido->sucursal}}</td>
                                                      <td>{{$pedido->estado_del_pedido}}</td>
                                                      <td>{{$pedido->fecha}}</td>


                                                      <td> @foreach($aProductosPorPedido[$key] as $Producto)
                                                            {{$Producto->cantidad }}<br>
                                                            @endforeach
                                                      </td>
                                                      <td>
                                                            {{$pedido->total}}

                                                      </td>
                                                      <td>

                                                            {{$pedido->pago }}<br>


                                                      </td>



                                                </tr>
                                                @endforeach
                                          </tbody>




                                    </table>
                              </div>
                        </div>

                  </div>

            </div>
      </div>
      @endsection