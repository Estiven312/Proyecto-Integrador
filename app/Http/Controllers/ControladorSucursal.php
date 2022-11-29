<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use Illuminate\Http\Request;

class ControladorSucursal extends Controller
{
    public function index()
    {
        if (Usuario::autenticado()==True) {
            if (!Patente::autorizarOperacion("SUCURSALCONSULTA")) {
                $titulo = "Sin permisos";
                $codigo = "SUCURSALCONSULTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
            
    
        return view("sistema.sucursal-listar");
            }
        }else{
            return redirect("admin/login");
        }
    }

    public function nueva(){
        if(Usuario::autenticado()==True){
            return view("sistema.sucursal-nuevo");
        }else{
            return redirect("admin/login");
        }
       
    }

   
    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aSucursales = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aSucursales) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/sucursal/nueva/" . $aSucursales[$i]->idsucursal . "'>" . " <i class='bi bi-eye-fill'></i>" . "</a>";
            $row[] =   $aSucursales[$i]->nombre;
            $row[] = $aSucursales[$i]->direccion;
            $row[] = $aSucursales[$i]->telefono;
            $row[]= $aSucursales[$i]->linkmapa;
            $row[] = $aSucursales[$i]->horario;
            $row[] = "<a href='/admin/sucursales/" . $aSucursales[$i]->idsucursal . "'>" . " <i class='bi bi-trash-fill'></i>" . "</a>";
            $cont++;
            $data[] = $row;
        }
        

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursales), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursales), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function eliminar($idSucursal){
        if (!Patente::autorizarOperacion("SUCURSALBAJA")) {
            $titulo = "Sin permisos";
            $codigo = "SUCURSALBAJA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
        $pedido= new Pedido();
        $aPedido=$pedido->existePedidosSucursal($idSucursal);

        if (empty($aPedido)) {
            $cliente = new Sucursal();

            $cliente->eliminar($idSucursal);
            return redirect("admin/sucursales");
        }else{
            $msg["ESTADO"] = MSG_WARNING;
            $msg["MSG"] = "No puedes eliminar una sucursal asociada a un pedido ";
            return view("sistema.sucursal-listar", compact("msg"));
        }
    }
    }
    public function guardar(Request $request){
        if (!Patente::autorizarOperacion("SUCURSALALTA")) {
            $titulo = "Sin permisos";
            $codigo = "SUCURSALALTA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {

        $sucursal= new Sucursal();
        $sucursal->cargarDesdeRequest($request);
        $sucursal->insertar();
         return redirect("admin/sucursales");
        }
    }

    public function editar($idPedido)
    {
        if (!Patente::autorizarOperacion("SUCURSALEDITAR")) {
            $titulo = "Sin permisos";
            $codigo = "SUCURSALEDITAR";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
        $titulo = "Edición de cliente";


        $sucursal = new Sucursal();
       $aSucursal= $sucursal->obtenerPorId($idPedido);
        return view("sistema.sucursal-nuevo", compact("titulo", "aSucursal"));
    }}

    public function actualizar(Request $request){
        
        $sucursal= new Sucursal();
        $sucursal->cargarDesdeRequest($request);
        $sucursal->updateSucursal();
        return redirect( "admin/sucursales");
    }
}
