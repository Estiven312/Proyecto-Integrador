<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Pedido;
use App\Entidades\Sistema\Carrito;
use App\Entidades\Sistema\Patente;

use Illuminate\Http\Request;

use Session;
use App\Entidades\Sistema\Usuario;



class ControladorClienteListar extends Controller
{
    public function index()
    {
        if (Usuario::autenticado() == true) {

            if (!Patente::autorizarOperacion("CLIENTECONSULTA")) {
                $titulo = "No tienes permiso";
                $codigo = "CLIENTECONSULTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("sistema.cliente-listar");
            }
        } else {
            return redirect("admin/login");
        }
    }

    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new Cliente();
        $aClientes = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/cliente/nuevo/" . $aClientes[$i]->idcliente . "'>" . " <i class='bi bi-eye-fill'></i>" . "</a>";
            $row[] =  $aClientes[$i]->nombre;
            $row[] = $aClientes[$i]->cc;
            $row[] = $aClientes[$i]->direccion;
            $row[] = $aClientes[$i]->correo;
            $row[] = $aClientes[$i]->telefono;
            $row[] = "<a href='/admin/clientes/" . $aClientes[$i]->idcliente . "'>" . " <i class='bi bi-trash-fill'></i>" . "</a>";
            $cont++;
            $data[] = $row;
        }


        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
    public function editar($idCliente){
            if (!Patente::autorizarOperacion("CLIENTEEDITAR")) {
            $titulo = "No tienes permiso";
            $codigo = " CLIENTEEDITAR";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
            $titulo = "Edición de cliente";


            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);
            return view("sistema.cliente-nuevo", compact("titulo", "cliente"));

        }
    
       
    }

    public function eliminar($idCliente)
    {
      

        if (!Patente::autorizarOperacion("CLIENTEELIMINAR")) {
            $titulo="No tienes permiso";
            $codigo = "CLIENTEELIMINAR";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {

            $pedido = new Pedido();
            $aPedido = [];
            $valor = 0;
            $aPedido = $pedido->existePedidos($idCliente);

            $carrito = new Carrito();
            $aCarrito = $carrito->obtenerPorId($idCliente);

            if (empty($aPedido) && empty($aCarrito)) {

                $cliente = new Cliente();

                $cliente->eliminar($idCliente);
                return redirect("admin/clientes");
            } else {
                # code...

                $msg["ESTADO"] = MSG_WARNING;
                $msg["MSG"] = "No puedes eliminar un cliente con un pedido asociado o articulos en el carrito";
                return view("sistema.cliente-listar", compact("msg"));
            }
        }
    }
}
