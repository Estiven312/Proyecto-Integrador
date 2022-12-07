@extends('web.plantillaWeb')

@section('pagina')
<li><a href="/">Inicio</a></li>
<li><a href="/takeawey">Takeawey</a></li>
<li><a href="/Nosotros">Nosotros</a></li>
<li><a href="/Contacto">Contacto</a></li>
@endsection
@section('contenido')
<div class="bradcam_area breadcam_bg_1 overlay">
      <h3>Carrito</h3>
</div>
<!-- bradcam_area_end -->
<!-- about_area_start -->
<div class="about_area">
      <div class="container">
            <div class="row align-items-center">

                  @foreach($CarroTotal as $key => $value)
                  <div class="col-12">
                        <form action="" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                              <div class="row border">
                                    <div class="col-6 p-2 d-inline">
                                          <div class="row">
                                                <div class="col-1 text-right">
                                                      <p> X{{$value['Cantidad']}}</p>
                                                </div>
                                                <div class="col-11 p ">
                                                      <img src="{{ asset('files/'.$value['Producto']) }}" alt="" width="100px" height="85px" class="rounded ">

                                                </div>

                                          </div>

                                    </div>
                                    <div class="col-4 p-2">
                                          <p> <b>Precio</b>............... ${{$value['Precio']}}</p>

                                          <p> <b>Subtotal</b>............. ${{$value['Subtotal']}}</p>
                                    </div>
                                    <div class="col-2 display-4">
                                          <input type="hidden" name="pedido" value="{{$value['IdCarrito']}}">
                                          <button type="submit" class="btn" name="btn" value="eliminar">
                                                <i class="bi bi-file-excel-fill"></i>
                                          </button>

                                    </div>


                              </div>
                        </form>

                  </div>
                  @endforeach




                  <form action="" method="post" class="col-12">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="row">
                              <div class="col-12 text-right">
                                    <p>Total...........${{$Total}}</p>
                              </div>
                              <div class="col-6 p-4">
                                    <label for="">Elige una Sucursal para reclamar tu pedido</label>
                                    <select name="lstSucursal" id="" class="form-control">
                                          @foreach($aSucursales as $sucursal)
                                          <option value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                                          @endforeach
                                    </select>
                              </div>
                              <div class="col-6 p-4 ">
                                    <label for="">Metodo de Pago</label>
                                    <select name="lstPago" id="" class="form-control">
                                          <option value="Efectivo">Efectivo</option>
                                          <option value="MP.Pago">Mercado Pago</option>
                                    </select>
                              </div>

                              <div class="col-6 text-center">
                                    <a href="/takeawey" class="boxed-btn3">Otro pedido</a>

                              </div>
                              <div class="col-6 text-center">
                                    <button type="submit" class="boxed-btn3" name="btn" value="continuar">Continuar Pedido</button>
                              </div>
                        </div>
                  </form>

            </div>


      </div>

</div>
</div>


@endsection