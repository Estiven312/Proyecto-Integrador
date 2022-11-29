<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Postulacion;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;


class ControladorPostulaciones extends Controller
{
     public function index(){

        if (!Patente::autorizarOperacion("POSTULANTECONSULTA")) {
            $titulo = "Sin permisos";
            $codigo = "POSTULANTECONSULTA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {
        if (Usuario::autenticado()==True) {
            return view("sistema.postulaciones-listar");
        }else {
            return redirect("admin/login");
        }
    }
       
     }
    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new Postulacion();
        $aPos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
           
            $row[] =  $aPos[$i]->nombre;
            $row[] = $aPos[$i]->apellido;
            $row[] = $aPos[$i]->telefono;
            $row[] = $aPos[$i]->correo;
            $row[] = "<a href= '/" . $aPos[$i]->linkcv . "'>  Descargar </a>";
            $row[] = "<a href='/admin/postulaciones/" . $aPos[$i]->idpostulacion . "'>" . " <i class='bi bi-trash-fill'></i>" . "</a>";
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
    public function eliminar($idPostulacion){

        if (!Patente::autorizarOperacion("POSTULANTEBAJA")) {
            $titulo = "Sin permisos";
            $codigo = "POSTULANTEBAJA";
            $mensaje = "No tiene pemisos para la operaci&oacute;n.";
            return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
        } else {

        $postulacion= new Postulacion();
        $aPostulaciones= $postulacion->obtenerPorId($idPostulacion);
        
        $linkcv = "";
        foreach ($aPostulaciones as  $value) {
            $linkcv = $value->linkcv;
        }
        
       if( @unlink($linkcv)){
            $postulacion->eliminar($idPostulacion);
            return redirect("admin/postulaciones");
       }
    }
        

    }
}
