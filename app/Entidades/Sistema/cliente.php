<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
require app_path().'/start/constants.php';

class Cliente extends Model

{

     
      function cargarDesdeRequest($request)
      {
            $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
            
            $this->nombre = $request->input('txtNombre');
            $this->telefono = $request->input('txtTelefono');
            $this->direccion= $request->input('txtDireccion');
            $this->documento =  $request->input('txtDocumento');
            $this->correo= $request->input('txtCorreo');
            $this->clave= $request->input('txtClave');
            
          
            $this->password= password_hash($this->clave, PASSWORD_DEFAULT);
            
      }
      public function actualizar($idCliente)
      {
            $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            telefono='$this->telefono',
            direccion='$this->direccion',
            correo='$this->correo',
            clave='$this->password'

            WHERE idcliente=?;";

            $affected = DB::update($sql, [$idCliente]);
      }
      public function validarUsuario()
      {
            $sql = "SELECT DISTINCT 
                idcliente,
                nombre,
                telefono,
                direccion,
                cc,
                correo,
                clave

               
                FROM clientes
                WHERE nombre = '$this->nombre'";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
      public function validarClave($claveIngresada, $claveBBDD)
      {
            return password_verify($claveIngresada, $claveBBDD);
      }
      static function autenticado()
      {
            return Session::get('cliente_id') != null;
      }
      public function cerrar()
      {

            Session::flush();
            return redirect('/');
      }
      public function obtenerPorId($idCliente)
      {
            $sql = "SELECT
                idcliente,
                    nombre,
                    telefono,
                    direccion,
                    cc,
                    correo,
                    clave
                FROM clientes WHERE idcliente = '$idCliente'";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idcliente = $lstRetorno[0]->idcliente;
                  $this->nombre = $lstRetorno[0]->nombre;
                  $this->telefono = $lstRetorno[0]->telefono;
                  $this->direccion = $lstRetorno[0]->direccion;
                  $this->documento = $lstRetorno[0]->cc;
                  $this->correo = $lstRetorno[0]->correo;
                  $this->clave = $lstRetorno[0]->clave;
                  return $this;
            }
            return null;
      }
      public function obtenerPorCorreo($correo){
            $sql = "SELECT
                idcliente,
                    nombre,
                    telefono,
                    direccion,
                    cc,
                    correo,
                    clave
                FROM clientes WHERE correo = '$correo'";
            $lstRetorno = DB::select($sql);

          
            return $lstRetorno;
      }
      public function insertar()
      {
            $sql = "INSERT INTO clientes (
                nombre,
                telefono,
                direccion,
                cc,
                correo,
                clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->telefono,
                  $this->direccion,
                  $this->documento,
                  $this->correo,
                  $this->password
            ]);
            return $this->idcliente = DB::getPdo()->lastInsertId();
      }
      public function updateCliente()
      {
            $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            telefono='$this->telefono',
            direccion='$this->direccion',
            cc='$this->documento',
            correo='$this->correo',
            clave='$this->password'
            WHERE idcliente=?;";
           
            $affected = DB::update($sql, [$this->idcliente]);

           
      }
      

      public function obtenerFiltrado()
      {
            $request = $_REQUEST;
            $columns = array(
                  0 => 'idcliente',
                  1=>'nombre',
                  2=>'direccion',
                  3 => 'cc',
                  4 => 'correo',
                  5 => 'telefono',
                 
            );
            $sql = "SELECT DISTINCT
                            idcliente,
                            nombre,
                            telefono,
                            direccion,
                            cc,
                            correo
                        FROM clientes
                        WHERE 1=1
                ";

            //Realiza el filtrado
            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR telefono LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR direccion LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR cc LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR correo LIKE '%" . $request['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

            $lstRetorno = DB::select($sql);

            return $lstRetorno;
      }
      
      public function eliminar($variable)
      {
            $sql = "DELETE FROM clientes WHERE
            idcliente=?;";
           
          
                  
        
            $affected = DB::delete($sql, [$variable]);
      }
}
