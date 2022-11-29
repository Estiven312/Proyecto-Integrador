<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
class ControladorWebContacto extends Controller
{
    public function index(){
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view('web.contact',compact('aSucursales'));
    }
}
