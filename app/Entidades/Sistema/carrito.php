<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Carrito extends Model

{


      function cargarDesdeRequest($request)
      {
            
            $this->cantidad = $request->input('numCantidad');
            $this->producto = $request->input('numProducto');
            
       
      }
      public function obtenerTodos()
      {
            $sql = "SELECT
                   idcarrito,
                   fk_idcliente,
                   fk_idproducto,
                   cantidad
                FROM carritos" ;
            $lstRetorno = DB::select($sql);


            return $lstRetorno;
      }
   
  
   
     
      public function obtenerPorId($idCliente)
      {
            $sql = "SELECT
                   idcarrito,
                   fk_idcliente,
                   fk_idproducto,
                   cantidad
                FROM carritos WHERE fk_idcliente = '$idCliente'";
            $lstRetorno = DB::select($sql);

         
        return $lstRetorno;
      }

      public function insertar()
      {
            $sql = "INSERT INTO carritos (
               fk_idcliente,
               fk_idproducto,
               cantidad
            ) VALUES (?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->cliente,
                  $this->producto,
                  $this->cantidad
                  
                 
            ]);
            return $this->idCarrito = DB::getPdo()->lastInsertId();
      }
   


    

      public function eliminar($variable)
      {
            $sql = "DELETE FROM carritos WHERE
            idcarrito=?;";




            $affected = DB::delete($sql, [$variable]);
      }

      public function eliminarPorCliente($variable){
            $sql = "DELETE FROM carritos WHERE
            fk_idcliente=?;";




            $affected = DB::delete($sql, [$variable]);

      }
}
