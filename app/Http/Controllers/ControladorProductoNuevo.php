<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;

use App\Entidades\Sistema\Pedido;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;
use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\TipoProducto;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';


class ControladorProductoNuevo extends Controller
{
    public function index()
    {
        if (Usuario::autenticado()==True) {

            if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                $titulo = "Sin permisos";
                $codigo = "PRODUCTOCONSULTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
            return View("sistema/producto-listar");
            }
        }else{
            return redirect("admin/login");
        }
        
    }
    public function nueva()
    {   
        if(Usuario::autenticado()==True){
        $tipo = new TipoProducto();
        $aTipo = $tipo->obtenerTodos();
        return View("sistema/producto-nuevo", compact("aTipo"));
        }else{
            return redirect("admin/login");
        }
    }
    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new Producto();
        $aPos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/producto/nuevo/" . $aPos[$i]->idproducto . "'>" . " <i class='bi bi-eye-fill'></i>" . "</a>";

            $row[] =  $aPos[$i]->titulo;
            $row[] = $aPos[$i]->precio;
            $row[] = $aPos[$i]->cantidad;
            $row[] = $aPos[$i]->descripcion;
            $row[] = "<img src='/files/" . $aPos[$i]->imagen . "' width='50px' class=\"img-thumbnail img-fluid\">";
        
            $row[] = $aPos[$i]->tipo_productos;

            $row[] = "<a href='/admin/productos/" . $aPos[$i]->idproducto . "'>" . " <i class='bi bi-trash-fill'></i>" . "</a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
    public function guardar(Request $request)
    {
        if (!Patente::autorizarOperacion("PRODUCTOSALTA")) {
            $titulo = "Sin permisos";
            $codigo = "PRODUCTOSALTA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {

        //Define la entidad servicio
        $titulo = "Modificar producto";
        $entidad = new Producto();

        $entidad->cargarDesdeRequest($request);


        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            $nombre = date("Ymdhmsi") . ".$extension";
            $archivo = $_FILES["archivo"]["tmp_name"];
            if ($extension == "jpeg" || $extension == "jpg" || $extension == "jfif" || $extension == "png") {
                move_uploaded_file($archivo, "files/".$nombre);
            } else {
                return "";
            }

            $entidad->imagen = $nombre;
        }



        //Es nuevo
        $entidad->insertar();

        $msg["ESTADO"] = MSG_SUCCESS;
        $msg["MSG"] = OKINSERT;
        return redirect("admin/producto/nuevo");
    }
    }
    public function eliminar($idProducto){
        if (!Patente::autorizarOperacion("PRODUCTOELIMINAR")) {
            $titulo = "Sin permisos";
            $codigo = "PRODUCTOELIMINAR";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
        $producto= new Producto();
        $aProducto=$producto->obtenerPorId($idProducto);
        $imagen="";
        foreach ($aProducto as  $value) {
            $imagen=$value->imagen;
        }
        @unlink("files/$imagen");
            $producto->eliminar($idProducto);

            return redirect("admin/productos");
    }
       
    }
    public function editar($idProducto){
        if (!Patente::autorizarOperacion("PRODUCTOEDITAR")) {
            $titulo = "Sin permisos";
            $codigo = "PRODUCTOEDITAR";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
        $tipo = new TipoProducto();
        $aTipo = $tipo->obtenerTodos();
        $producto= new Producto();
        $aProducto= $producto->obtenerPorId($idProducto);
       

        return view("sistema.producto-nuevo", compact('aProducto','aTipo'));

        }
    }
    public function actualizar(Request $request, $idProducto){
        if (!Patente::autorizarOperacion("POSTULANTECONSULTA")) {
            $titulo = "Sin permisos";
            $codigo = "POSTULANTECONSULTA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
        $producto= new Producto();
        $aProductos= $producto->obtenerPorId($idProducto);
        $producto->cargarDesdeRequest($request);
        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
            //Eliminar imagen anterior
            @unlink("files/" .$aProductos[0]->imagen);
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            $nombre = date("Ymdhmsi") . ".$extension";
            $archivo = $_FILES["archivo"]["tmp_name"];
            if ($extension == "jpeg" || $extension == "jpg" || $extension == "jfif" || $extension == "png") {
                move_uploaded_file($archivo, "files/" . $nombre);
            } else {
                return "";
            }

            $producto->imagen = $nombre;

        } else {
         
            $producto->imagen = $aProductos[0]->imagen;
        }

        $producto-> updateProducto();
        return redirect("admin/productos");
    }

    }
}
