<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () { //<-- sellado de ruta para obligar la autenticacion

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //forma larga sin llamar el controlador arriba con "use"

// ------------------------- GESTIÓN DE PERSONAS Y SISTEMA -----------------------------
Route::resource('personas', PersonaController::class); //forma corta pero debo llamar en el name space al controlador con "use"
Route::resource('clientes', ClienteController::class); 
Route::resource('empleados', EmpleadoController::class);
Route::resource('contratos', ContratoController::class);

Route::resource('usuarios', UsuarioSistemaController::class)->parameters(['usuarios' => 'usuario_sistema' ]); //<-- usuarioSistema

Route::resource('metodos-pago', MetodoDePagoController::class)->parameters(['metodos-pago' => 'metodo_pago']); //<-- MetodoDePAgo

// ------------------------- INVENTARIO Y COMPRAS ------------------------------------
Route::resource('proveedores', ProveedorController::class);
Route::resource('productos', ProductoController::class);

Route::resource('orden-compras', OrdenDeCompraController::class)->parameters(['orden-compras' => 'orden_compra']); //<-- OrdenDeCompra

Route::resource('orden-compra.detalles-compras', DetalleCompraController::class); //<-- DetalleCompra bajo la orden

// ----------------------- PEDIDOS Y FACTURACIÓN -------------------------------------------
Route::resource('menus', MenuController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('facturas', FacturaController::class);

// DETALLES ANIDADOS: DetallePedido y DetalleFactura
Route::resource('pedido.detalles', DetallePedidoController::class);
Route::resource('factura.detalles', DetalleFacturaController::class);

Route::resource('cuentas-pagar', CuentaPorPagarController::class)->parameters(['cuentas-pagar' => 'cuenta_por_pagar']); //<-- CuentasPorPagar

Route::resource('cuentas-cobrar', CuentaPorCobrarController::class)->parameters(['cuentas-cobrar' => 'cuenta_por_cobrar']);

});