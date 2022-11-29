@extends("plantilla")

@section('breadcrumb')
<script>
      globalId = '<?php echo isset($cliente->idcliente) && $cliente->idcliente > 0 ? $cliente->idcliente : 0; ?>';
      <?php $globalId = isset($cliente->idcliente) ? $cliente->idcliente : "0"; ?>
</script>
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/clientes">Clientes</a></li>
      <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
      <li class="btn-item"><a title="Nuevo" href="/admin/cliente/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
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
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php if (isset($cliente->nombre)) {
                                                                                                                  echo $cliente->nombre;
                                                                                                            } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Teléfono: *</label>
                        <input type="number" id="txtTelefono" name="txtTelefono" class="form-control" value="<?php if (isset($cliente->telefono)) {
                                                                                                                        echo $cliente->telefono;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Dirección: *</label>
                        <input type="text" id="txtDireccion" name="txtDireccion" class="form-control" value="<?php if (isset($cliente->direccion)) {
                                                                                                                        echo $cliente->direccion;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label for>Documento: *</label>
                        <input type="text" id="txtDocumento" name="txtDocumento" class="form-control" value="<?php if (isset($cliente->documento)) {
                                                                                                                        echo $cliente->documento;
                                                                                                                  } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label>Correo: *</label>
                        <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" value="<?php if (isset($cliente->correo)) {
                                                                                                                  echo $cliente->correo;
                                                                                                            } ?>" required>
                  </div>
                  <div class="form-group col-6">
                        <label for="txtClave">Clave:</label>
                        <input type="password" class="form-control" name="txtClave" id="txtClave" value="">
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