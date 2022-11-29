@extends("plantilla")

@section('breadcrumb')
<script>
      globalId = '<?php echo isset($aProducto[0]->idproducto) && $aProducto[0]->idproducto > 0 ? $aProducto[0]->idproducto : 0; ?>';
      <?php $globalId = isset($aProducto[0]->idproducto) ? $aProducto[0]->idproducto : "0"; ?>
</script>
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/productos">Producto</a></li>
      <li class="breadcrumb-item active">Nuevo</li>
</ol>
<ol class="toolbar">
      <li class="btn-item"><a title="Nuevo" href="/admin/producto/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
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
<div class="panel-body">
      <form id="form1" method="POST" enctype="multipart/form-data">
            <div class="row">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-6">
                        <label>Nombre: *</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php if (isset($aProducto[0]->titulo)) {
                                                                                                                  echo $aProducto[0]->titulo;
                                                                                                            } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Cantidad: *</label>
                        <input type="number" id="numCantidad" name="numCantidad" class="form-control" value="<?php if (isset($aProducto[0]->cantidad)) {
                                                                                                                        echo $aProducto[0]->cantidad;
                                                                                                                  } ?>" required>

                  </div>
                  <div class="form-group col-6">
                        <label>Precio: *</label>
                        <input type="number" id="numPrecio" name="numPrecio" class="form-control" value="<?php if (isset($aProducto[0]->precio)) {
                                                                                                                  echo $aProducto[0]->precio;
                                                                                                            } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label for>Descripcion: *</label>
                        <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" value="<?php if (isset($aProducto[0]->descripcion)) {
                                                                                                                        echo $aProducto[0]->descripcion;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Tipo Producto: *</label>
                        <select name="lstTipo" id="lstTipo" class="form-control">

                              @foreach($aTipo as $tipo)
                              <?php if ( isset($aProducto) && $aProducto[0]->fk_idtipoproducto = $tipo->idtipoproducto) { ?>
                                    <option selected value="{{$tipo->idtipoproducto}}">
                                          {{$tipo->nombre}}
                                    </option>
                              <?php } else { ?>
                                    <option value="{{$tipo->idtipoproducto}}">
                                          {{$tipo->nombre}}
                                    </option>
                              <?php } ?>


                              @endforeach

                        </select>
                  </div>
                  <div class="form-group col-6">
                        <label>Imagen: *</label>

                        <input type="file" class="form-control" name="archivo" id="archivo" class="form-control-file " >
                  </div>
                  <div class="col-6">

                  </div>
                  @if(isset($aProducto[0]->imagen))
                  <div class="col-6  p-2  text-center">

                        <img src="{{ asset('files/'.$aProducto[0]->imagen) }}" alt="" class="rounded" width="75%">

                  </div>
                  @endif
            </div>
      </form>
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