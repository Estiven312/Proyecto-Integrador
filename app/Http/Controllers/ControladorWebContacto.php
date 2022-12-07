<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Cliente;
use Illuminate\Routing\RedirectController;

class ControladorWebContacto extends Controller
{
    public function index(){
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente = new Cliente();
        return view('web.contact',compact('aSucursales','cliente'));
    }
    public function gracias(){
        
        return redirect("/GraciasContacto");
        
    }

    public function graciasIndex(){
    $sucursal = new Sucursal();
    $aSucursales = $sucursal->obtenerTodos();
    $cliente = new Cliente();

    return view("web.graciasContacto", compact('aSucursales', 'cliente'));
    }
}
