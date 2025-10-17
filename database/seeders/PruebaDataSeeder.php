<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\UsuarioSistema;
use App\Models\Contrato;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\OrdenDeCompra;
use App\Models\DetalleCompra;
use App\Models\MetodoDePago;
use App\Models\CuentaPorPagar;
use App\Models\Menu;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\CuentaPorCobrar;

class PruebaDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseCount = 20; // 20 registros para las tablas principales

        // 1. Tablas Sin Dependencia (Bases)
        $metodosPago = collect(['Efectivo', 'Transferencia', 'Tarjeta Crédito', 'Tarjeta Débito', 'Crédito Proveedor'])
        ->map(fn ($nombre) => MetodoDePago::create(['nombre' => $nombre]));
        $proveedores = Proveedor::factory($baseCount)->create();
        $menus = Menu::factory($baseCount)->create();
        
        // 2. Tablas Base de Personas
        // Se crean 40 personas para tener suficientes para Clientes y Empleados (20 cada uno)
        $personas = Persona::factory(40)->create();

        // 3. Tablas de Personas con Dependencia
        $clientes = Cliente::factory($baseCount)
            ->recycle($personas->take($baseCount)) // Primeras 20 personas para Clientes
            ->create();
        
        $empleados = Empleado::factory($baseCount)
            ->recycle($personas->skip($baseCount)->take($baseCount)) // Siguientes 20 personas para Empleados
            ->create();

        // 4. Tablas del Sistema (depende de Empleado)
        // Solo 10 empleados tendrán cuenta de sistema para dejar margen
        UsuarioSistema::factory(10) 
            ->recycle($empleados->random(10)) 
            ->create();
            
        Contrato::factory($baseCount)->recycle($empleados)->create();

        // 5. Tablas de Inventario y Compras (depende de Proveedor)
        $productos = Producto::factory($baseCount)->create();
        $ordenes = OrdenDeCompra::factory($baseCount)->create();
        
        // 6. Tablas de Detalles y Cuentas (depende de Productos, Ordenes, MetodosDePago)
        // Creamos más detalles (3 veces la base) para que las órdenes y productos tengan contenido.
        DetalleCompra::factory($baseCount * 3) 
            ->recycle($productos)
            ->recycle($ordenes)
            ->create();

        CuentaPorPagar::factory($baseCount)
            ->recycle($ordenes)
            ->recycle($metodosPago)
            ->create();


        // 7. Tablas de Pedidos y Facturación
        $pedidos = Pedido::factory($baseCount)->create();
        
        // Más detalles de pedido (5 veces la base) para simular contenido
        DetallePedido::factory($baseCount * 5) 
            ->recycle($pedidos)
            ->recycle($menus)
            ->create();

        $facturas = Factura::factory($baseCount)
            ->recycle($clientes) 
            ->create();

        // Más detalles de factura (4 veces la base)
        DetalleFactura::factory($baseCount * 4) 
            ->recycle($facturas)
            ->create();

        CuentaPorCobrar::factory($baseCount)
            ->recycle($facturas)
            ->recycle($metodosPago)
            ->create();
    }
}