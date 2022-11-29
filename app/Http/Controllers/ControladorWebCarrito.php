<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Sucursal;
use App\Entidades\Sistema\Cliente;
use App\Entidades\Sistema\Producto;
use App\Entidades\Sistema\Carrito;
use App\Entidades\Sistema\Pedido;
use MercadoPago\Item;
USE MercadoPago\MerchantOrder;
use MercadoPago\Payment;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Session;

class ControladorWebCarrito extends Controller
{
    public function index()
    {

        $idCliente = Session::get('cliente_id');
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente = new Cliente();
        $carrito = new Carrito();

        $CarroTotal = array();
        $producto = new Producto();
        $aCarrito = $carrito->obtenerPorId($idCliente);
        $Total = 0;


        foreach ($aCarrito as $key => $value) {

            $aProducto = $producto->obtenerPorId($value->fk_idproducto);

            $CarroTotal += array(
                "$key" => array(
                    'Cantidad' =>  $value->cantidad,
                    'Producto' => $aProducto[0]->imagen,
                    'Precio' => $aProducto[0]->precio,
                    'Subtotal' => $aProducto[0]->precio * $value->cantidad,
                    'IdCarrito' => $value->idcarrito
                )
            );
            $Total += $aProducto[0]->precio * $value->cantidad;
        }

       






        return view('web.carrito', compact('aSucursales', 'cliente', 'CarroTotal', 'Total'));
    }

    public function guardar(Request $request)
    {

        $carrito = new Carrito();
        $carrito->cargarDesdeRequest($request);

        if ($_POST["btn"] == "eliminar") {
            $pedido = $request->input('pedido');
            $carrito->eliminar($pedido);
            return redirect('/Carrito');

        } else if ($_POST["btn"] == "continuar") {
            $sucursal = $request->input('lstSucursal');

            $pago = $request->input('lstPago');

            if ($pago == "Efectivo") {

                date_default_timezone_set("America/Bogota");
                $pedido = new Pedido();
                $pedido->sucursal = $sucursal;

                $idCliente = Session::get('cliente_id');
                $pedido->cliente = $idCliente;
                $pedido->estadopedido = 1;
                $pedido->fecha = date("Y-m-d");
                $pedido->pago = $pago;

                $carrito = new Carrito();

                $CarroTotal = array();
                $producto = new Producto();
                $aCarrito = $carrito->obtenerPorId($idCliente);
                $Total = 0;
                $lisIdPedido=[];
                


                foreach ($aCarrito as $key => $value) {

                 

                    $aProducto = $producto->obtenerPorId($value->fk_idproducto);

                    $CarroTotal += array(
                        "$key" => array(
                            'Cantidad' =>  $value->cantidad,
                            'Producto' => $aProducto[0]->idproducto,
                            'Precio' => $aProducto[0]->precio,
                            'Subtotal' => $aProducto[0]->precio * $value->cantidad,
                            'IdCarrito' => $value->idcarrito
                        )
                    );
                    $Total = $aProducto[0]->precio * $value->cantidad;

                    $pedido->pago = "$pago";
                    $pedido->total = $Total;
                    
                    $lisIdPedido[] += $pedido->insertar();

                   
                }

                foreach ($CarroTotal as $key => $value) {
                    $pedido->producto = $value['Producto'];
                    $pedido->cantidad = $value['Cantidad'];
                    $pedido->pedido = $lisIdPedido[$key];

                    $pedido->insertar_pedido_productos();
                }
               

              

               
               
            }else if($pago == "MP.Pago"){

                date_default_timezone_set("America/Bogota");
                $pedido = new Pedido();
                $pedido->sucursal = $sucursal;

                $idCliente = Session::get('cliente_id');
                $nombre= Session::get('nombre');
                $correo = Session::get('correo');
                $cc = Session::get('documento');

                $pedido->cliente = $idCliente;
                $pedido->estadopedido = 4;
                $pedido->fecha = date("Y-m-d");
                $pedido->pago = $pago;

                $carrito = new Carrito();

                $CarroTotal = array();
                $producto = new Producto();
                $aCarrito = $carrito->obtenerPorId($idCliente);
                $Total = 0;


                foreach ($aCarrito as $key => $value) {

                    $aProducto = $producto->obtenerPorId($value->fk_idproducto);

                    $CarroTotal += array(
                        "$key" => array(
                            'Cantidad' =>  $value->cantidad,
                            'Producto' => $aProducto[0]->idproducto,
                            'Precio' => $aProducto[0]->precio,
                            'Subtotal' => $aProducto[0]->precio * $value->cantidad,
                            'IdCarrito' => $value->idcarrito
                        )
                    );
                    $Total += $aProducto[0]->precio * $value->cantidad;
                }
                $pedido->pago = "$pago";
                $pedido->total = $Total;

              

              



                // $access_token = "";
                // SDK::setClientId(config("payment-methods.mercadopago.client"));
                // SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
                // SDK::setAccessToken($access_token);


                // //Armado del producto ‘item’
                // $item = new Item();
                // $item->id = "1234";
                // $item->title = "Compra Web Burger SRL";
                // $item->category_id = "products";
                // $item->quantity = 1;
                // $item->unit_price = $Total;
                // $item->currency_id = "COP";

                // $preference = new Preference();
                // $preference->items = array($item);

                // //Datos del comprador
                // $payer = new Payer();
                // $payer->name = $nombre;
                // $payer->surname = "";
                // $payer->email = $correo;
                // $payer->date_created = date('Y-m-d H:m:s');
                // $payer->identification = array(
                //     "type" => "CC", //cc
                //     "number" => $cc,
                // );
                // $preference->payer = $payer;



                $idpedido = $pedido->insertar();

                foreach ($CarroTotal as $key => $value) {
                    $pedido->producto = $value['Producto'];
                    $pedido->cantidad = $value['Cantidad'];
                    $pedido->pedido = $idpedido;

                    $pedido->insertar_pedido_productos();
                }



                // $preference->back_urls = [
                //     "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
                //     "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
                //     "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
                // ];

                // $preference->payment_methods = array("installments" => 6);
                // $preference->auto_return = "all";
                // $preference->notification_url = '';
                // $preference->save(); //Ejecuta la transacción



                




            }
           
            $carrito->eliminarPorCliente($idCliente);
            
            return redirect('/MiCuenta');
        }

       
      
    }
}
