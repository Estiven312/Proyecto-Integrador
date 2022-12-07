<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Postulacion extends Model
{
      

  
      public function obtenerTodos()
      {

            $sql = "SELECT 
                   A.idpedido,
                    A.fk_idsucursal,
                    A.fk_idcliente,
                    A.fk_idestadopedido,
                    A.fecha,
                    A.total,
                    A.pago,
                    A.fk_idsucursal,
                     B.nombre AS sucursales,
                    C.nombre AS clientes,
                    D.nombre AS estado_pedidos
                 
                   
                FROM pedidos A
               INNER JOIN sucursales B ON A.fk_idsucursal=B.idsucursal
                INNER JOIN clientes C ON A.fk_idcliente=C.idcliente
                INNER JOIN estado_pedidos D ON A.fk_idestadopedido=D.idestadopedido 
                ORDER BY A.fk_idestadopedido ASC          ";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      function cargarDesdeRequest($request)
      {
            $this->idpatente = $request->input('id') != "0" ? $request->input('id') : $this->idpatente;
            $this->nombre = $request->input('txtNombre');
            $this->apellido= $request->input('txtApellido');
            $this->telefono = $request->input('txtTelefono');
            $this->correo = $request->input('txtCorreo');
           
      }

     

      public function obtenerFiltrado()
      {
            $request = $_REQUEST;
            $columns = array(
                  0 => 'nombre',
                  1 => 'apellido',
                  2 => 'whatsapp',
                  3 => 'correo',
                  4 => 'linkcv'
            );
            $sql = "SELECT DISTINCT
                            idpostulacion,
                            nombre,
                            apellido,
                            telefono,
                            correo,
                            linkcv
                        FROM postulaciones
                        WHERE 1=1
                ";

            //Realiza el filtrado
            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR apellido LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR whatsapp LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR correo LIKE '%" . $request['search']['value'] . "%' )";
                  $sql .= " OR linkcv LIKE '%" . $request['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

            $lstRetorno = DB::select($sql);

            return $lstRetorno;
      }


    

     
   

      public function obtenerPorId($idpatente)
      {
            $sql = "SELECT
                    idpostulacion,
                    nombre,
                    apellido,
                    telefono,
                    correo,
                    linkcv
                    FROM postulaciones WHERE idpostulacion = ?";
            $lstRetorno = DB::select($sql, [$idpatente]);

           
            return $lstRetorno;
      }

    
     

  

      public  function eliminar($idpostulacion)
      {
            $sql = "DELETE FROM postulaciones WHERE 
            idpostulacion=?";
            DB::delete($sql, [$idpostulacion]);
      }

      public function insertar($linkcv)
      {
            $sql = "INSERT INTO postulaciones (
                nombre,
                apellido,
                telefono,
                correo,
                linkcv
            ) VALUES (?, ?, ?, ?, ?);";
            
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->apellido,
                  $this->telefono,
                  $this->correo,
                  $linkcv
                  
            ]);

           
            return $this->idpostulacion = DB::getPdo()->lastInsertId();
      }
}
