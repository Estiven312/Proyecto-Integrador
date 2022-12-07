<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Sucursal extends Model
{
      
      public function obtenerTodos()
      {

            $sql = "SELECT 
            idsucursal, 
            nombre,
            direccion,
            telefono,
            linkmapa,
            horario  
            FROM sucursales";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      function cargarDesdeRequest($request)
      {
            $this->idsucursal = $request->input('id') != "0" ? $request->input('id') : $this->idsucursal;
            $this->nombre = $request->input('txtNombre');
            $this->direccion = $request->input('txtDireccion');
            $this->telefono = $request->input('txtTelefono');
            $this->mapa = $request->input('txtMapa');
            $this->horario = $request->input('txtHorario');
          
      }

     

      public function obtenerFiltrado()
      {
            $request = $_REQUEST;
            $columns = array(
                  0 => 'nombre',
                  1 => 'direccion',
                  2 => 'telefono',
                  3=>'linkmapa',
                  4 => 'horario',
                  5=>'acciones'
               
            );
            $sql = "SELECT DISTINCT
                            idsucursal,
                            nombre,
                            direccion,
                            telefono,
                            linkmapa,
                            horario
                        FROM sucursales
                        WHERE 1=1
                ";

            //Realiza el filtrado
            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR direccion LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR telefono LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR linkmapa LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR horario LIKE '%" . $request['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

            $lstRetorno = DB::select($sql);

            return $lstRetorno;
      }



    

      

      

    

    
     
     
     

      public  function eliminar($idSucursal)
      {
            $sql = "DELETE FROM sucursales WHERE 
            idsucursal=?";
            DB::delete($sql, [$idSucursal]);
      }

      public function insertar()
      {
            $sql = "INSERT INTO sucursales (
                nombre,
                direccion,
                telefono,
                linkmapa,
                horario
            ) VALUES ( ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->direccion,
                  $this->telefono,
                  $this->mapa,
                  $this->horario
            ]);
            return $this->idsucursal = DB::getPdo()->lastInsertId();
      }
      public function obtenerPorId($idSucursal)
      {
            $sql = "SELECT
                 idsucursal,
                 nombre,
                 direccion,
                 telefono,
                 linkmapa,
                 horario
                FROM sucursales           
                WHERE idsucursal = $idSucursal";
            $lstRetorno = DB::select($sql);


            if (count($lstRetorno) > 0) {
                  $this->idsucursal = $lstRetorno[0]->idsucursal;
                  $this->nombre = $lstRetorno[0]->nombre;
                  $this->direccion = $lstRetorno[0]->direccion;
                  $this->telefono = $lstRetorno[0]->telefono;
                  $this->mapa = $lstRetorno[0]->linkmapa;
                  $this->horario = $lstRetorno[0]->horario;
                  
                  return $this;
            }
            return null;
      }
      public function updateSucursal()
      {
            $sql = "UPDATE sucursales SET
            nombre='$this->nombre',
                telefono='$this->telefono',
                direccion='$this->direccion',
                linkmapa='$this->mapa',
                horario='$this->horario'
                
            WHERE idsucursal=?;";

            $affected = DB::update($sql, [$this->idsucursal]);
      }

}
