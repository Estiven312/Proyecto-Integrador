<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Estado_pedido extends Model

{


  
      public function obtenerTodos()
      {
            $sql = "SELECT
                    idestadopedido,
                   nombre
                  
                FROM estado_pedidos ";
            $lstRetorno = DB::select($sql);
           
            
            return $lstRetorno;
      }

    
}
