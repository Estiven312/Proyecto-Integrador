<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class TipoProducto extends Model

{
     

      public function obtenerTodos()
      {

            $sql = "SELECT 

                  idtipoproducto,
                  nombre
                 
                   
                FROM tipo_productos      ";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }


    public   function cargarDesdeRequest($request)
      {
            $this->idTipo = $request->input('id') != "0" ? $request->input('id') : $this->idTipo;
            $this->nombre = $request->input('txtNombre');
       
      }
      public function obtenerPorId($idTipo)
      {
            $sql = "SELECT
                idtipoproducto,
                    nombre
                
                FROM tipo_productos WHERE idtipoproducto = $idTipo";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idtipo = $lstRetorno[0]->idtipoproducto;
                  $this->nombre = $lstRetorno[0]->nombre;
                
                  return $this;
            }
            return null;
      }
      public function insertar()
      {
            $sql = "INSERT INTO tipo_productos (
                nombre
                
            ) VALUES (?);";
            $result = DB::insert($sql, [
                  $this->nombre,
           
            ]);
            return $this->idcliente = DB::getPdo()->lastInsertId();
      }
      public function updateTipo()
      {
            $sql = "UPDATE tipo_productos SET
            nombre='$this->nombre'
             
            WHERE idtipoproducto=?;";

            $affected = DB::update($sql, [$this->idTipo]);
      }

      public function obtenerFiltrado()
      {
            $request = $_REQUEST;
            $columns = array(
                  0 => 'idtipoproducto',
                  1 => 'nombre',
     
            );
            $sql = "SELECT DISTINCT
                            idtipoproducto,
                            nombre
                        FROM tipo_productos
                        WHERE 1=1
                ";

            //Realiza el filtrado
            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%'  )";
            }
           /// $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

            $lstRetorno = DB::select($sql);
          

         

            return $lstRetorno;
      }



      public function eliminar($variable)
      {
            $sql = "DELETE FROM tipo_productos WHERE
            idtipoproducto=?;";




            $affected = DB::delete($sql, [$variable]);
      }
      
}
