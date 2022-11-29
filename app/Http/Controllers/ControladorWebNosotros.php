<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Postulacion;

class ControladorWebNosotros extends Controller
{
    public function index(){
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente = new Cliente();
        return view('web.about', compact('aSucursales','cliente'));
    }
    public function insertar(Request $request){
            $entidad= New Postulacion();
            $entidad->cargarDesdeRequest($request);
            $link="";


        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            
            $nombre = date("Ymdhmsi") . ".$extension";
            $archivo = $_FILES["archivo"]["tmp_name"];
            if ($extension == "pdf" || $extension == "docx" || $extension == "doc" ) {
                move_uploaded_file($archivo, "files/" . $nombre);
            } else {
                return "/
                ";
            }

            $link = 'files/' . "$nombre";
            
            
           
        }
    
        $entidad->insertar($link);
        return redirect('/Gracias');


    }
    public function gracias(){
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente= new Cliente();


        return view('web.gracias', compact('aSucursales','cliente'));
    }
}
