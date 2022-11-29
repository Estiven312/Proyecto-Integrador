<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Cliente;
use Faker\Test\Provider\fr_FR\CompanyTest;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use Session;

class ControladorClienteNuevo extends Controller
{
    public function index(){
        if (Usuario::autenticado() == true) {
            $cliente= "CLIENTEALTA";

            if (!Patente::autorizarOperacion($cliente)) {
                $titulo="No tienes permiso";
                $codigo = "CLIENTEALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {

                return view("sistema.cliente-nuevo");

            }

        }else{
            return redirect("admin/login");
        }

        

    }
    public function guardar(Request $request){

        $cliente= new Cliente();
        $cliente->cargarDesdeRequest($request);
        $cliente->insertar();
        $msg["ESTADO"] = MSG_SUCCESS;
        $msg["MSG"] = "Insertado Correctamente";

        return view('sistema.cliente-nuevo', compact('msg'));

    }
    public function actualizar(Request $request){
       
        $cliente= new Cliente();
        $cliente->cargarDesdeRequest($request);
        $cliente->updateCliente();
       
        return redirect('admin/clientes');
        
    }
    
}
