<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*use App\Http\Controllers\UserController;
Route::get('/users', [UserController::class, 'index']); */

/*Route::get('/about', function () {return 'Acerca de nosotros';}); 

Route::get('/user/{id}', function ($id) {return 'ID de usuario: ' . $id;});

Route::get('/contacto', function () {return 'Página de contacto';})->name('contacto');

Route::get('/user/{id}', function ($id) {return 'ID de usuario: ' . $id;})->where('id', '[0-9]{3}');

Route::prefix('admin')->group(function () {
Route::get('/', function () {return 'Panel de administración';});
Route::get('/users', function () {return 'Lista de usuarios';});});/* 
//--------------------------------------------------- Ejercicio---------------------------------------*/


// ------------------------- GESTIÓN DE PERSONAS Y SISTEMA -----------------------------
Route::resource('personas', App\Http\Controllers\PersonaController::class);
Route::resource('clientes', App\Http\Controllers\ClienteController::class);
Route::resource('empleados', App\Http\Controllers\EmpleadoController::class);
Route::resource('contratos', App\Http\Controllers\ContratoController::class);

Route::resource('usuarios', App\Http\Controllers\UsuarioSistemaController::class)->parameters(['usuarios' => 'usuario_sistema' ]); //<-- usuarioSistema

Route::resource('metodos-pago', App\Http\Controllers\MetodoDePagoController::class)->parameters(['metodos-pago' => 'metodo_pago']); //<-- MetodoDePAgo

// ------------------------- INVENTARIO Y COMPRAS ------------------------------------
Route::resource('proveedores', App\Http\Controllers\ProveedorController::class);
Route::resource('productos', App\Http\Controllers\ProductoController::class);

Route::resource('ordenes-compra', App\Http\Controllers\OrdenDeCompraController::class)->parameters(['ordenes-compra' => 'orden_compra']); //<-- OrdenDeCompra

Route::resource('ordenes-compra.detalles-compra', App\Http\Controllers\DetalleCompraController::class); //<-- DetalleCompra bajo la orden

// ----------------------- PEDIDOS Y FACTURACIÓN -------------------------------------------
Route::resource('menus', App\Http\Controllers\MenuController::class);
Route::resource('pedidos', App\Http\Controllers\PedidoController::class);
Route::resource('facturas', AppHttp\Controllers\FacturaController::class);

// DETALLES ANIDADOS: DetallePedido y DetalleFactura
Route::resource('pedidos.detalles', App\Http\Controllers\DetallePedidoController::class);
Route::resource('facturas.detalles', App\Http\Controllers\DetalleFacturaController::class);

Route::resource('cuentas-pagar', App\Http\Controllers\CuentaPorPagarController::class)->parameters(['cuentas-pagar' => 'cuenta_por_pagar']); //<-- CuentasPorPagar

Route::resource('cuentas-cobrar', Controllers\CuentaPorCobrarController::class)->parameters(['cuentas-cobrar' => 'cuenta_por_cobrar']);