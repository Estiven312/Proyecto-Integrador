<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Pedido;
use PhpParser\Node\Stmt\Return_;
use Session;

class ControladorWebCuenta extends Controller
{
    public function index()
    {
        if (Session::get('cliente_id')) {
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            $cliente = new Cliente;

            $idCliente = Session::get('cliente_id');
            $aCliente = $cliente->obtenerPorId($idCliente);
            $pedido = new Pedido();
            $aPedido = $pedido->obtenerCliente($idCliente);

            //    Obtener el id de cada pedido
            $aPedidoId = [];
            foreach ($aPedido as $key => $value) {
                $aPedidoId[] = $value->idpedido;
            }
            /////
            $aProductosPorPedido = [];
            foreach ($aPedidoId as $key => $value) {
                $aProductosPorPedido[] =  $pedido->pedido_productos1($value);
            }


            return view('web.cuenta', compact('aSucursales', 'cliente', 'aCliente', 'aPedido', 'aProductosPorPedido'));
        } else {

            return redirect('/');
        }
    }

    public function Cerrar()
    {
        $cliente = new Cliente();
        $cliente->Cerrar();
        return redirect('/');
    }
    public function actualizar(Request $request)
    {

        $cliente = new Cliente();
        $cliente->cargarDesdeRequest($request);
        $idCliente = Session::get('cliente_id');
        $cliente->actualizar($idCliente);
        return redirect("/MiCuenta");
    }
}
