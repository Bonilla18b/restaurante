<?php

namespace Database\Factories;

use App\Models\CuentaPorPagar;
use App\Models\MetodoDePago;
use App\Models\OrdenDeCompra;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaPorPagarFactory extends Factory
{
    public function definition(): array
    {
        $montoTotal = $this->faker->randomFloat(2, 500, 5000);
        $montoPagado = $this->faker->randomFloat(2, 0, $montoTotal);
        $montoPendiente = $montoTotal - $montoPagado;

        return [
            // **Asumiendo que ya existen MetodosDePago y OrdenesDeCompra**
            'metodo_de_pago_id' => MetodoDePago::factory(),
            'orden_de_compra_id' => OrdenDeCompra::factory(),
            'montoPagado' => $montoPagado,
            'montoPendiente' => $montoPendiente,
            'montoTotal' => $montoTotal,
            'fechaVencimiento' => $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'estado' => $this->faker->randomElement(['Pagada', 'Pendiente', 'Vencida']),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}