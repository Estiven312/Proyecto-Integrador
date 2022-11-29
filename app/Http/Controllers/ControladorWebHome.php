<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Sucursal;
use Illuminate\Http\Request;

class ControladorWebHome extends Controller
{
    public function index()
  
    {
        $sucursal=new Sucursal();
       $aSucursales= $sucursal->obtenerTodos();
       
        $producto = new Producto();
        $idPromocion=2;
        $aPromocion=$producto->obtenerPorTipo($idPromocion);
        $aProductos= $producto->obtenerTodos();
        $cliente= new Cliente();

            return  view("web.index", compact('aProductos','aPromocion','aSucursales','cliente'));
    }
    public function agregar(Request $request)
    {
        $cliente = new Cliente();

        if ($cliente::autenticado() == True) {
        } else {
            return redirect('/login');
        }
    }
}
