<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Postulacion extends Model
{
      protected $table = 'sistema_patentes';
      public $timestamps = false;

      protected $fillable = [
            'idpatente',
            'nombre',
            'descripcion',
            'modulo',
            'submodulo',
            'tipo',
            'log_operacion'
      ];
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


    

      public function obtenerFiltradoDisponibles()
      {
            /*
         * Obtiene todas las patentes que aun no fueron agregadas en la familia
         * 
         */
            $request = $_REQUEST;
            $columns = array(
                  0 => 'A.idpatente',
                  1 => 'A.idpatente',
                  2 => 'A.descripcion',
                  3 => 'A.tipo',
                  4 => 'A.modulo',
                  5 => 'A.submodulo',
                  6 => 'A.nombre'
            );
            $sql = "SELECT 
                    idpatente, 
                    nombre,
                    descripcion,
                    modulo,
                    submodulo,
                    tipo
                    FROM sistema_patentes A WHERE 1=1 ";

            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.modulo LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.submodulo LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.tipo LIKE '%" . $request['search']['value'] . "%' )";
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

    
     

      public function guardar()
      {
            $sql = "UPDATE sistema_patentes SET
            nombre = '$this->nombre',
            tipo = '$this->tipo',
            modulo = '$this->modulo',
            submodulo = '$this->submodulo',
            log_operacion = $this->log_operacion,
            descripcion = '$this->descripcion'
            WHERE idpatente=?";
            DB::update($sql, [$this->idpatente]);
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
