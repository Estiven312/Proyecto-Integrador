<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Producto extends Model
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

      public function cargarDesdeRequest($request)
      { //consulta de cargar imagen
            $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
            $this->titulo = $request->input('txtNombre');
            $this->fk_idtipoproducto = $request->input('lstTipo');
            $this->cantidad = $request->input('numCantidad');
            $this->precio = $request->input('numPrecio');
            $this->descripcion = $request->input('txtDescripcion');
      }

      public function existeTipoProducto($idTipoProducto)
      {

            $sql = "SELECT
            fk_idtipoproducto
                
                FROM productos WHERE fk_idtipoproducto = $idTipoProducto";
            $lstRetorno = DB::select($sql);

            
            return $lstRetorno;
      }

      public function obtenerPorId($idProducto)
      {

            $sql = "SELECT 

                  idproducto,
                  titulo,
                  precio,
                  cantidad,
                  descripcion,
                  imagen,
                  fk_idtipoproducto

                FROM productos WHERE idproducto=$idProducto";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
     

      public function obtenerTodos()
      {

            $sql = "SELECT 

                  idproducto,
                  titulo,
                  precio,
                  cantidad,
                  descripcion,
                  imagen,
                  fk_idtipoproducto
                 
                   
                FROM productos      ";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
      public function obtenerPorTipo($idTipoProducto)
      {

            $sql = "SELECT 
                  idproducto,
                  titulo,
                  precio,
                  cantidad,
                  descripcion,
                  imagen,
                  fk_idtipoproducto
                FROM productos where fk_idtipoproducto=$idTipoProducto ";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }


    
      public function updatePedido()
      {
            $sql = "UPDATE pedidos SET
            fk_idestadopedido='$this->estadoPedido'
           
            WHERE idpedido=?;";

            $affected = DB::update($sql, [$this->idpedido]);
      }
     

      public function obtenerFiltrado()
      {
            $request = $_REQUEST;
            $columns = array(
                  0 => 'A.idproducto',
                  1 => 'A.titulo',
                  2 => 'A.precio',
                  3 => 'A.cantidad',
                  4 => 'A.descripcion',
                  5=>'A.imagen',
                 
                  6 => 'B.nombre'
            );
            $sql = "SELECT 
                    A.idproducto, 
                    A.titulo,
                    A.cantidad,
                    A.precio,
                    A.descripcion,
                    A.imagen,
                    A.fk_idtipoproducto,
                    B.nombre as tipo_productos
                    
                   FROM  productos A 
                   INNER JOIN tipo_productos B ON A.fk_idtipoproducto=B.idtipoproducto
                   Where 1=1";
            if (!empty($request['search']['value'])) {
                  $sql .= " AND ( A.titulo LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.cantidad LIKE '%" . $request['search']['value'] . "%' ";
                  $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";

                  $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' )";
            }
           //$sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

            $lstRetorno = DB::select($sql);
           
            return $lstRetorno;
            
      }











      public function eliminar($variable)
      {
            $sql = "DELETE FROM productos WHERE
            idproducto=?;";

            $affected = DB::delete($sql, [$variable]);
      }
      public function insertar()
      {
            $sql = "INSERT INTO productos (
                    titulo,
                    precio,
                    cantidad,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                    )
                VALUES (?, ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->titulo,
                  $this->precio,
                  $this->cantidad,
                  $this->descripcion,
                  $this->imagen,
                  $this->fk_idtipoproducto,
            ]);
            return $this->idproducto = DB::getPdo()->lastInsertId();
      }

      public function updateProducto()
      {
            $sql = "UPDATE productos SET
               titulo='$this->titulo',
                precio=$this->precio,
                cantidad=$this->cantidad,
                descripcion='$this->descripcion',
                imagen='$this->imagen',
                fk_idtipoproducto=$this->fk_idtipoproducto
            WHERE idproducto=?;";

            

            $affected = DB::update($sql, [$this->idproducto]);
      }

}
