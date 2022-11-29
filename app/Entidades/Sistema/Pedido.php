<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Pedido extends Model
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

   
    public function pedido_productos($idPedido){
        $sql = "SELECT
                 idpedidoproducto,
                    fk_idproducto,
                    fk_idpedido,
                    cantidad
                FROM pedido_productos WHERE fk_idpedido = $idPedido";
        $lstRetorno = DB::select($sql);


        return $lstRetorno;

    }
    public function insertar_pedido_productos()
    {
        $sql = "INSERT INTO pedido_productos (
              fk_idproducto,
               fk_idpedido,
               cantidad
             
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->producto,
            $this->pedido,
            $this->cantidad
         



        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }
    public function pedido_productos1($idPedido)
    {
        $sql = "SELECT
                 idpedidoproducto,
                    A.fk_idproducto,
                    A.fk_idpedido,
                    A.cantidad,
                    B.titulo AS producto
                  
                 
                FROM pedido_productos A
					 INNER JOIN productos B ON A.fk_idproducto=B.idproducto WHERE A.fk_idpedido = $idPedido";
        $lstRetorno = DB::select($sql);


        return $lstRetorno;
    }
    public function eliminar_pedido_producto($variable)
    {
        $sql = "DELETE FROM pedido_productos WHERE
            fk_idpedido=?;";

        $affected = DB::delete($sql, [$variable]);
    }
    public function existePedidos($idCliente){

        $sql = "SELECT
                 idpedido,
                    fk_idsucursal,
                    fk_idcliente,
                    fk_idestadopedido,
                    fecha,
                    total,
                    pago
                FROM pedidos WHERE fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);

       
        return $lstRetorno;

    }
    public function existePedidosSucursal($idSucursal)
    {

        $sql = "SELECT
                 idpedido,
                    fk_idsucursal,
                    fk_idcliente,
                    fk_idestadopedido,
                    fecha,
                    total,
                    pago
                FROM pedidos WHERE fk_idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);
        print($sql);
        exit;


        return $lstRetorno;
    }
    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
               fk_idsucursal,
               fk_idcliente,
               fk_idestadopedido,
               fecha,
               total,
               pago
            ) VALUES (?, ?, ?,?,?,?);";
        $result = DB::insert($sql, [
            $this->sucursal,
            $this->cliente,
            $this->estadopedido,
            $this->fecha,
            $this->total,
            $this->pago
            


        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }
   

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
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
       
        
      
        $this->estadoPedido = $request->input('lstEstadoPedido');
       
    }
    public function updatePedido()
    {
        $sql = "UPDATE pedidos SET
            fk_idestadopedido='$this->estadoPedido'
           
            WHERE idpedido=?;";
    
        $affected = DB::update($sql, [$this->idpedido]);
    }
    public function obtenerTodosPorFamilia($familiaID)
    {
        $sql = "SELECT 
                idpatente,
                nombre,
                descripcion,
                modulo,
                submodulo,
                tipo
                FROM sistema_patentes A
                INNER JOIN sistema_patente_familia B ON B.fk_idpatente = A.idpatente AND B.fk_idfamilia = ? ";
        $sql .= " ORDER BY nombre";
        $lstRetorno = DB::select($sql, [$familiaID]);
        return $lstRetorno;
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'idpedido',
            1 => 'fk_idsucursal',
            2 => 'fk_idcliente',
            3=> 'fecha',
            4 => 'fk_idestadopedido',
            5 => 'total',
            6 => 'pago',
        );
        $sql = "SELECT DISTINCT
                            A.idpedido,
                            A.fecha,
                            A.fk_idsucursal ,
                            A.fk_idcliente,
                            A.fk_idestadopedido,
                            A.total,
                            A.pago,
                            B.nombre AS sucursal,
                            C.nombre AS cliente,
                            D.nombre AS estado_del_pedido
                        FROM pedidos A
                        INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                        INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                        INNER JOIN estado_pedidos D ON A.fk_idestadopedido = D.idestadopedido
                        WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " OR idpedido LIKE '%" . $request['search']['value'] . "%' ";
            
            $sql .= " OR fk_idsucursal LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idcliente LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idestadopedido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fecha LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR total LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR pago LIKE '%" . $request['search']['value'] . "%' )";
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

  

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT
               A.idpedido,
                            A.fecha,
                            A.fk_idsucursal ,
                            A.fk_idcliente,
                            A.fk_idestadopedido,
                            A.total,
                            A.pago,
                            B.nombre AS sucursal,
                            C.nombre AS cliente,
                            D.nombre AS estado_del_pedido
                        FROM pedidos A
                        INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                        INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                        INNER JOIN estado_pedidos D ON A.fk_idestadopedido = D.idestadopedido       
                        WHERE idpedido = '$idPedido'";
        $lstRetorno = DB::select($sql);
      

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->sucursal = $lstRetorno[0]->sucursal;
            $this->cliente = $lstRetorno[0]->cliente;
            $this->idEstadoPedido = $lstRetorno[0]->fk_idestadopedido;
            $this->estadoPedido = $lstRetorno[0]->estado_del_pedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->total = $lstRetorno[0]->total;
            $this->pago = $lstRetorno[0]->pago;
            return $this;
        }
        return null;
    }

    public function obtenerCliente($idCliente)
    {
        $sql = "SELECT
               A.idpedido,
                            A.fecha,
                            A.fk_idsucursal ,
                            A.fk_idcliente,
                            A.fk_idestadopedido,
                            A.total,
                            A.pago,
                            B.nombre AS sucursal,
                            C.nombre AS cliente,
                            D.nombre AS estado_del_pedido
                        FROM pedidos A
                        INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                        INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                        INNER JOIN estado_pedidos D ON A.fk_idestadopedido = D.idestadopedido       
                        WHERE A.fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

   

   
    public function eliminar($variable)
    {
        $sql = "DELETE FROM pedidos WHERE
            idpedido=?;";

        $affected = DB::delete($sql, [$variable]);
    }

   
}
