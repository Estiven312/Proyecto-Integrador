<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Estado_pedido;
use App\Entidades\Sistema\Patente;

class ControladorPedido extends Controller
{
    public function index()
    {
        
        if (Usuario::autenticado() == true) {
          
                return view("sistema/pedido_listar");
          
        } else {
            return redirect("admmin/login");
        }
    }

    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();


        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/pedido/vista/" . $aPedidos[$i]->idpedido . "'>" . " <i class='bi bi-eye-fill'></i>" . "</a>";

            $row[] =  $aPedidos[$i]->idpedido;
            $row[] = $aPedidos[$i]->sucursal;
            $row[] = $aPedidos[$i]->cliente;

            $row[] = $aPedidos[$i]->estado_del_pedido;
            $row[] =   date_format(date_create($aPedidos[$i]->fecha), "d/m/Y");
            $row[] = number_format($aPedidos[$i]->total, 2, ",", ".");
            $row[] = "<a href='/admin/pedidos/" . $aPedidos[$i]->idpedido . "'>" . " <i class='bi bi-trash-fill'></i>" . "</a>";
            $cont++;

            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
    public function vista($idPedido)
    {
       

        if (Usuario::autenticado() == true) {

            if (!Patente::autorizarOperacion("PEDIDOEDITAR")) {
                $titulo = "No tienes permiso";
                $codigo = " PEDIDOEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
            $apedido = new Pedido();
            $pedido = $apedido->obtenerPorId($idPedido);
            $aPedidoP = $apedido->pedido_productos($idPedido);
            
            $estadoPedido = new Estado_pedido();
            $aEstadosPedidos = $estadoPedido->obtenerTodos();

            $producto = new Producto();
            $aProducto = $producto->obtenerPorId($aPedidoP[0]->fk_idproducto);


            return view("sistema.pedido", compact('pedido', 'aEstadosPedidos', 'aPedidoP', 'aProducto'));
       } 
    } else {
            return redirect("admin/login");
        }
    }
    public function actualizar(Request $request)
    {
        $pedido = new Pedido();
        $pedido->cargarDesdeRequest($request);
        $pedido->updatePedido();
        return  redirect("admin/pedidos");
    }
    public function eliminar($idPedido)
    {
        if (!Patente::autorizarOperacion("PEDIDOBAJA")) {
            $titulo = "No tienes permiso";
            $codigo = "PEDIDOBAJA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {

        $pedido = new Pedido();
        $aPedido = $pedido->pedido_productos($idPedido);
       
            $pedido->eliminar_pedido_producto($idPedido);
            $pedido->eliminar($idPedido);
            return redirect("admin/pedidos");}
        
    }
}
