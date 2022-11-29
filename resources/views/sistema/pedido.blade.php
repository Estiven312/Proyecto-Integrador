@extends('plantilla')

@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection
@section('breadcrumb')
<script>
      globalId = '<?php echo isset($pedido->idpedido) && $pedido->idpedido > 0 ? $pedido->idpedido : 0; ?>';
      <?php $globalId = isset($pedido->idpedido) ? $pedido->idpedido : "0"; ?>
</script>
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
      <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">

      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
      </li>

      <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
      function fsalir() {
            location.href = "/admin";
      }
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
      echo '<div id = "msg"></div>';
      echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>


</div>

<div class="panel-body">
      <form id="form1" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="row p-2">
                  <div class="form-group col-6 text-center p-4">
                        
                        @if(isset($aProducto[0]->imagen))


                        <img src="{{ asset('files/'.$aProducto[0]->imagen) }}" alt="" class="rounded" width="100%">


                        @endif
                  </div>
                  <div class="col-6 p-4">
                        <div class="form-group col-12">
                              <label>Producto *</label>
                              <input type="text" id="" name="txtSucursal" class="form-control" disabled value="<?php if (isset($aProducto[0]->titulo)) {
                                                                                                                        echo $aProducto[0]->titulo;
                                                                                                                  } ?>" required>
                        </div>
                        <div class="form-group col-12">
                              <label>Cantidad *</label>
                              <input type="num" id="" name="txtSucursal" class="form-control" disabled value="<?php if (isset($aPedidoP[0]->cantidad)) {
                                                                                                                        echo $aPedidoP[0]->cantidad;
                                                                                                                  } ?>" required>
                        </div>

                        <div class="form-group col-12">
                              <label>Sucursal *</label>
                              <input type="text" id="" name="txtSucursal" class="form-control" disabled value="<?php if (isset($pedido->sucursal)) {
                                                                                                                        echo $pedido->sucursal;
                                                                                                                  } ?>" required>
                        </div>
                        <div class="form-group col-12">
                              <label>Cliente: *</label>
                              <input type="text" id="" name="txtCliente" class="form-control" disabled value="<?php if (isset($pedido->cliente)) {
                                                                                                                        echo $pedido->cliente;
                                                                                                                  } ?>" required>
                        </div>

                        <div class="form-group col-12">
                              <label for>Fecha *</label>
                              <input type="txt" id="" name="txtFecha" class="form-control" disabled value="<?php if (isset($pedido->fecha)) {
                                                                                                                  echo $pedido->fecha;
                                                                                                            } ?>" required>
                        </div>
                        <div class="form-group col-12">
                              <label>Total: *</label>
                              <input type="num" id="" name="numTotal" class="form-control" disabled value="<?php if (isset($pedido->total)) {
                                                                                                                  echo $pedido->total;
                                                                                                            } ?>" required>
                        </div>


                  </div>
                  <div class="form-group col-6">
                        <label for="">Pago:</label>
                        <input type="text" class="form-control" name="txtPago" id="" disabled value="<?php if (isset($pedido->pago)) {
                                                                                                            echo $pedido->pago;
                                                                                                      } ?>">
                  </div>

                  <div class="form-group col-6">
                        <label>Estado de Pedido: *</label>
                        <select name="lstEstadoPedido" id="lstEstadoPedido" class="form-control">
                              @foreach($aEstadosPedidos as $estado)
                              <option <?php if ($estado->idestadopedido == $pedido->idEstadoPedido) {
                                                echo "selected";
                                          } ?> value="{{$estado->idestadopedido}}">{{$estado->nombre}}</option>'


                              @endforeach
                        </select>

                  </div>
            </div>
      </form>
</div>

<script>
      $("#form1").validate();

      function guardar() {
            if ($("#form1").valid()) {
                  modificado = false;
                  form1.submit();
            } else {
                  $("#modalGuardar").modal('toggle');
                  msgShow("Corrija los errores e intente nuevamente.", "danger");
                  return false;
            }
      }
</script>
@endsection