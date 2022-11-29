<?php
 //use Carbon\Carbon; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/*Route::get('/time' , function(){$date =new Carbon;echo $date ; } );*/


Route::group(array('domain' => '127.0.0.1'), function () {

    Route::get('/', 'ControladorWebHome@index');
    Route::post('/', 'ControladorWebHome@agregar');


    Route::get('/takeawey', 'ControladorWebMenu@index');
    Route::post('/takeawey', 'ControladorWebMenu@agregar');





    Route::get('/Nosotros', 'ControladorWebNosotros@index');
    Route::post('/Nosotros', 'ControladorWebNosotros@insertar');
    Route::get('/Gracias', 'ControladorWebNosotros@gracias');
   
    Route::get('/login', 'ControladorWebLogin@index');
    Route::post('/login', 'ControladorWebLogin@ingresar');

    Route::get('/Recuperar', 'ControladorWebLogin@recuperarClave');
    Route::post('/Recuperar', 'ControladorWebLogin@recuperar');

    Route::get('/Crear/Cuenta', 'ControladorWebLogin@nuevo');
    Route::post('/Crear/Cuenta', 'ControladorWebLogin@insertar');


    Route::get('/MiCuenta', 'ControladorWebCuenta@index');
    Route::post('/MiCuenta', 'ControladorWebCuenta@actualizar');


    Route::get('/Cerrar', 'ControladorWebCuenta@Cerrar');

    Route::get('/Carrito', 'ControladorWebCarrito@index');
    Route::post('/Carrito', 'ControladorWebCarrito@guardar');
    
 

    Route::get('/admin', 'ControladorHome@index');

    Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');

    

/* --------------------------------------------- */
/* CONTROLADOR LOGIN                           */
/* --------------------------------------------- */
    Route::get('/admin/login', 'ControladorLogin@index');
    Route::get('/admin/logout', 'ControladorLogin@logout');
    Route::post('/admin/logout', 'ControladorLogin@entrar');
    Route::post('/admin/login', 'ControladorLogin@entrar');

/* --------------------------------------------- */
/* CONTROLADOR RECUPERO CLAVE                    */
/* --------------------------------------------- */
    Route::get('/admin/recupero-clave', 'ControladorRecuperoClave@index');
    Route::post('/admin/recupero-clave', 'ControladorRecuperoClave@recuperar');

/* --------------------------------------------- */
/* CONTROLADOR PERMISO                           */
/* --------------------------------------------- */
    Route::get('/admin/usuarios/cargarGrillaFamiliaDisponibles', 'ControladorPermiso@cargarGrillaFamiliaDisponibles')->name('usuarios.cargarGrillaFamiliaDisponibles');
    Route::get('/admin/usuarios/cargarGrillaFamiliasDelUsuario', 'ControladorPermiso@cargarGrillaFamiliasDelUsuario')->name('usuarios.cargarGrillaFamiliasDelUsuario');
    Route::get('/admin/permisos', 'ControladorPermiso@index');
    Route::get('/admin/permisos/cargarGrilla', 'ControladorPermiso@cargarGrilla')->name('permiso.cargarGrilla');
    Route::get('/admin/permiso/nuevo', 'ControladorPermiso@nuevo');
    Route::get('/admin/permiso/cargarGrillaPatentesPorFamilia', 'ControladorPermiso@cargarGrillaPatentesPorFamilia')->name('permiso.cargarGrillaPatentesPorFamilia');
    Route::get('/admin/permiso/cargarGrillaPatentesDisponibles', 'ControladorPermiso@cargarGrillaPatentesDisponibles')->name('permiso.cargarGrillaPatentesDisponibles');
    Route::get('/admin/permiso/{idpermiso}', 'ControladorPermiso@editar');
    Route::post('/admin/permiso/{idpermiso}', 'ControladorPermiso@guardar');

/* --------------------------------------------- */
/* CONTROLADOR GRUPO                             */
/* --------------------------------------------- */
    Route::get('/admin/grupos', 'ControladorGrupo@index');
    Route::get('/admin/usuarios/cargarGrillaGruposDelUsuario', 'ControladorGrupo@cargarGrillaGruposDelUsuario')->name('usuarios.cargarGrillaGruposDelUsuario'); //otra cosa
    Route::get('/admin/usuarios/cargarGrillaGruposDisponibles', 'ControladorGrupo@cargarGrillaGruposDisponibles')->name('usuarios.cargarGrillaGruposDisponibles'); //otra cosa
    Route::get('/admin/grupos/cargarGrilla', 'ControladorGrupo@cargarGrilla')->name('grupo.cargarGrilla');
    Route::get('/admin/grupo/nuevo', 'ControladorGrupo@nuevo');
    Route::get('/admin/grupo/setearGrupo', 'ControladorGrupo@setearGrupo');
    Route::post('/admin/grupo/nuevo', 'ControladorGrupo@guardar');
    Route::get('/admin/grupo/{idgrupo}', 'ControladorGrupo@editar');
    Route::post('/admin/grupo/{idgrupo}', 'ControladorGrupo@guardar');

/* --------------------------------------------- */
/* CONTROLADOR USUARIO                           */
/* --------------------------------------------- */
    Route::get('/admin/usuarios', 'ControladorUsuario@index');
    Route::get('/admin/usuarios/nuevo', 'ControladorUsuario@nuevo');
    Route::post('/admin/usuarios/nuevo', 'ControladorUsuario@guardar');
    Route::post('/admin/usuarios/{usuario}', 'ControladorUsuario@guardar');
    Route::get('/admin/usuarios/cargarGrilla', 'ControladorUsuario@cargarGrilla')->name('usuarios.cargarGrilla');
    Route::get('/admin/usuarios/buscarUsuario', 'ControladorUsuario@buscarUsuario');
    Route::get('/admin/usuarios/{usuario}', 'ControladorUsuario@editar');

/* --------------------------------------------- */
/* CONTROLADOR MENU                             */
/* --------------------------------------------- */
    Route::get('/admin/sistema/menu', 'ControladorMenu@index');
    Route::get('/admin/sistema/menu/nuevo', 'ControladorMenu@nuevo');
    Route::post('/admin/sistema/menu/nuevo', 'ControladorMenu@guardar');
    Route::get('/admin/sistema/menu/cargarGrilla', 'ControladorMenu@cargarGrilla')->name('menu.cargarGrilla');
    Route::get('/admin/sistema/menu/eliminar', 'ControladorMenu@eliminar');
    Route::get('/admin/sistema/menu/{id}', 'ControladorMenu@editar');
    Route::post('/admin/sistema/menu/{id}', 'ControladorMenu@guardar');

});

/* --------------------------------------------- */
/* CONTROLADOR PATENTES                          */
/* --------------------------------------------- */
Route::get('/admin/patentes', 'ControladorPatente@index');
Route::get('/admin/patente/nuevo', 'ControladorPatente@nuevo');
Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');
Route::get('/admin/patente/cargarGrilla', 'ControladorPatente@cargarGrilla')->name('patente.cargarGrilla');
Route::get('/admin/patente/eliminar', 'ControladorPatente@eliminar');
Route::get('/admin/patente/nuevo/{id}', 'ControladorPatente@editar');
Route::post('/admin/patente/nuevo/{id}', 'ControladorPatente@guardar');


/*Controlador cliente*/
Route::get('/admin/cliente/nuevo', 'ControladorClienteNuevo@index');
Route::post('/admin/cliente/nuevo', 'ControladorClienteNuevo@guardar');
Route::get('/admin/cliente/nuevo/{idCliente}', 'ControladorClienteListar@editar');
Route::post('/admin/cliente/nuevo/{idCliente}', 'ControladorClienteNuevo@actualizar');

Route::get('/admin/clientes', 'ControladorClienteListar@index');
Route::get('/admin/clientes/cargarGrilla', 'ControladorClienteListar@cargarGrilla')->name('cliente.cargarGrilla');
Route::get('/admin/clientes/{idCliente}', 'ControladorClienteListar@eliminar');



/*Controlador Producto */
Route::get('/admin/producto/nuevo', 'ControladorProductoNuevo@nueva');
Route::post('/admin/producto/nuevo', 'ControladorProductoNuevo@guardar');
Route::get('/admin/producto/nuevo/{idProducto}', 'ControladorProductoNuevo@editar');
Route::post('/admin/producto/nuevo/{idProducto}', 'ControladorProductoNuevo@actualizar');


Route::get('/admin/productos', 'ControladorProductoNuevo@index');
Route::get('/admin/productos/cargarGrilla', 'ControladorProductoNuevo@cargarGrilla')->name('producto.cargarGrilla');
Route::get('/admin/productos/{idProducto}', 'ControladorProductoNuevo@eliminar');


/*Pedido */
Route::get('/admin/pedidos', 'ControladorPedido@index');
Route::get('/admin/pedidos/cargarGrilla', 'ControladorPedido@cargarGrilla')->name('pedido.cargarGrilla');
Route::get('/admin/pedidos/{idCliente}', 'ControladorPedido@eliminar');

Route::get('/admin/pedido/vista/{idPedido}', 'ControladorPedido@vista');
Route::post('/admin/pedido/vista/{idPedido}', 'ControladorPedido@actualizar');



/*Psotulaciones */

Route::get('/admin/postulaciones', 'ControladorPostulaciones@index');
Route::get('/admin/postulaciones/cargarGrilla', 'ControladorPostulaciones@cargarGrilla')->name('postulaciones.cargarGrilla');
Route::get('/admin/postulaciones/{idPostulacion}', 'ControladorPostulaciones@eliminar');
/*Sucursales */
Route::get('/admin/sucursales', 'ControladorSucursal@index');
Route::get('/admin/sucursales/cargarGrilla', 'ControladorSucursal@cargarGrilla')->name('sucursal.cargarGrilla');
Route::get('/admin/sucursales/{idSucursal}', 'ControladorSucursal@eliminar');

Route::get('/admin/sucursal/nueva', 'ControladorSucursal@nueva');
Route::post('/admin/sucursal/nueva', 'ControladorSucursal@guardar');
Route::get('/admin/sucursal/nueva/{idSucursal}', 'ControladorSucursal@editar');
Route::post('/admin/sucursal/nueva/{idSucursal}', 'ControladorSucursal@actualizar');
/*Tipo producto */
Route::get('/admin/tipoproductos', 'ControladorTipoProducto@index');
Route::get('/admin/tipoproductos/cargarGrilla', 'ControladorTipoProducto@cargarGrilla')->name('tipoProducto.cargarGrilla');
Route::get('/admin/tipoproductos/{idTipoProducto}', 'ControladorTipoProducto@eliminar');
Route::get('/admin/tipoproducto/nuevo', 'ControladorTipoProducto@nuevo');
Route::post('/admin/tipoproducto/nuevo', 'ControladorTipoProducto@guardar');
Route::get('/admin/tipoproducto/nuevo/{idPedido}', 'ControladorTipoProducto@editar');
Route::post('/admin/tipoproducto/nuevo/{idPedido}', 'ControladorTipoProducto@actualizar');
