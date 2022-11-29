@extends("plantilla")

@section('breadcrumb')
<script>
      globalId = '<?php echo isset($aSucursal->idsucursasl) && $aSucursal->idsucursal > 0 ? $aSucursal->idsucursal : 0; ?>';
      <?php $globalId = isset($aSucursal->idsucursal) ? $aSucursal->idsucursal : "0"; ?>
</script>
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/sucursales/nueva">Sucursales</a></li>
      
</ol>
<ol class="toolbar">
      <li class="btn-item"><a title="Nuevo" href="/admin/sucursal/nueva" class="fa fa-plus-circle" aria-hidden=""><span>Nuevo</span></a></li>
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
      <form id="form1" method="POST">
            <div class="row">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-6">
                        <label>Nombre: *</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php if (isset($aSucursal->nombre)) {
                                                                                                                  echo $aSucursal->nombre;
                                                                                                            } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Dirección: *</label>
                        <input type="text" id="txtDireccion" name="txtDireccion" class="form-control" value="<?php if (isset($aSucursal->direccion)) {
                                                                                                                        echo $aSucursal->direccion;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Telefono: *</label>
                        <input type="num" id="txtTelefono" name="txtTelefono" class="form-control" value="<?php if (isset($aSucursal->telefono)) {
                                                                                                                        echo $aSucursal->telefono;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label for>Link Mapa: *</label>
                        <input type="text" id="txtMapa" name="txtMapa" class="form-control" value="<?php if (isset($aSucursal->mapa)) {
                                                                                                                        echo $aSucursal->mapa;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Horario *</label>
                        <input type="text" id="txtHorario" name="txtHorario" class="form-control" value="<?php if (isset($aSucursal->horario)) {
                                                                                                                  echo $aSucursal->horario;
                                                                                                            } ?>" required>
                  </div>

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