<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\TipoProducto;
use App\Entidades\Sistema\producto;
use App\Entidades\Sistema\Usuario;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class ControladorTipoProducto extends Controller
{
    public function index()
    {
        if (Usuario::autenticado()==True) {
        
        
        $entidad = new TipoProducto();
            return view("sistema.tipo_producto");
        }
       else{
        return redirect("admin/login");
       }
        
       
    }
    public function nuevo(){

        return view("sistema.tipo-producto-nuevo");
    }

    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new TipoProducto();
        $aPos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/tipoproducto/nuevo/" . $aPos[$i]->idtipoproducto . "'>" . " <i class='bi bi-eye-fill'></i>" . "</a>";
            $row[] =  $aPos[$i]->nombre;
           
            $row[] = "<a href='/admin/tipoproductos/" . $aPos[$i]->idtipoproducto . "'>" . " <i class='bi bi-trash-fill'></i>" . "</a>";
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
    public function eliminar($idTipoProducto){
        $producto= new Producto();
        $tipo = new TipoProducto();
        $aFkTipo=$producto->existeTipoProducto($idTipoProducto);
        if(empty($aFkTipo)){
            
            $tipo->eliminar($idTipoProducto);
            return redirect('admin/tipoproductos');

        }else{
            $msg["ESTADO"] = MSG_WARNING;
            $msg["MSG"] = "No puedes eliminar un tipo producto con un producto asociado";

            return view("sistema.tipo_producto", compact("msg"));

        }
       

    }
    public function guardar(Request $request){
        $tipo= new TipoProducto();
        $tipo->cargarDesdeRequest($request);
        $tipo->insertar();
        $msg["ESTADO"] = MSG_SUCCESS;
        $msg["MSG"] = "Tipo Producto insertado correctamente";

        return view("sistema.tipo-producto-nuevo", compact("msg"));
    }
    public function editar($idTipoProducto)
    {
        $tipo= new TipoProducto();
        $aTipo=$tipo->obtenerPorId($idTipoProducto);
        return View("sistema.tipo-producto-nuevo",compact("aTipo"));

    }
    public function actualizar(Request $request){
        $tipo = new TipoProducto();
        $tipo->cargarDesdeRequest($request);
        $tipo = $tipo->updateTipo();
        return redirect("admin/tipoproductos");
    }

}
