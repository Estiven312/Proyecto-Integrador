<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Carrito;
use Session;

class ControladorWebMenu extends Controller
{
   public function index(){
        $producto = new Producto();
        $idPromocion = 2;
        $aPromocion = $producto->obtenerPorTipo($idPromocion);
        $aProductos = $producto->obtenerTodos();
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
      $cliente = new Cliente();
    return view("web.Menu", compact('aSucursales','aPromocion','aProductos','cliente'));
   }


  public function agregar(Request $request)
  {

    $idCliente = Session::get('cliente_id');
    $carrito = new Carrito();
    $carrito->cargarDesdeRequest($request);
   
    $carrito->cliente = $idCliente;
   
    $carrito->insertar();


    return redirect('/Carrito');
  }

   
  
}
