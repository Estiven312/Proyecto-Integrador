<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Cliente;

class ControladorWebLogin extends Controller
{
    public function index()
    {
        return view('web.login');
    }
    public function recuperarClave(){
        return view("web.recuperar_clave");
    }
    public function recuperar(Request $request){
        $correo= $request->input("txtCorreo");
        $cliente= new Cliente();
        $aCliente=$cliente->obtenerPorCorreo($correo);
      

        if (empty($aCliente[0]->correo)) {


            $msg = "No hay una cuenta asociado al correo:";
            return view("web.recuperar_clave", compact("msg", "correo"));
           
        }else {
            $cliente->nombre=$aCliente[0]->nombre;
            $cliente->telefono=$aCliente[0]->telefono;
            $cliente->direccion=$aCliente[0]->direccion;
            $cliente->correo=$aCliente[0]->correo;
            $nuevaContrasena = rand(1000, 9999);
            $clave= password_hash($nuevaContrasena, PASSWORD_DEFAULT);
           
            $cliente->password=$clave;
         
            $cliente->actualizar($aCliente[0]->idcliente);
           
            
            $msg = "Tu nueva contraseña ah sido actualiza por:";
            return view("web.recuperar_clave", compact("nuevaContrasena", "msg"));
            
            
        }

    }

    public function ingresar(Request $request)
    {
        $password = $request->input('txtClave');
        $cliente = new Cliente();
        $cliente->cargarDesdeRequest($request);
        $aCliente =  $cliente->validarUsuario();
     

        if (count($aCliente) > 0) {
            if (password_verify($password, $aCliente[0]->clave)) {
                # code...
            // }
            // if ($password == $aCliente[0]->clave) {

                $request->session()->put('cliente_id', $aCliente[0]->idcliente);
                $request->session()->put('nombre', $aCliente[0]->nombre);
                $request->session()->put('documento', $aCliente[0]->cc);
                $request->session()->put('correo', $aCliente[0]->correo);


                return redirect("/");
            } else {
             
                $msg = "Usuario o Contraseña invalida";
                return view('web.login', compact('msg'));
            }
        } else {
            
            $msg =
            "Usuario o Contraseña invalida";
            return view('web.login', compact('msg'));
        }

     
    }

    public function nuevo()
    {
        return view('web.nuevo');
    }
    public function insertar(Request $request)
    {
        $cliente = new Cliente();
        $cliente->cargarDesdeRequest($request);
        $cliente->insertar();
       
        return redirect("/login");
    }
   
}
