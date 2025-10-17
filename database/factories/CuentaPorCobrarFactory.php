<?php

namespace Database\Factories;


use App\Models\CuentaPorCobrar;
use App\Models\MetodoDePago;
use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaPorCobrarFactory extends Factory
{
    public function definition(): array
    {
        $montoTotal = $this->faker->randomFloat(2, 50, 500);
        $montoPagado = $this->faker->randomFloat(2, 0, $montoTotal);
        $montoPendiente = $montoTotal - $montoPagado;

        return [
            // **Asumiendo que ya existen MetodosDePago y Facturas**
            'metodo_de_pago_id' => MetodoDePago::factory(),
            'factura_id' => Factura::factory(),
            'montoPagado' => $montoPagado,
            'montoPendiente' => $montoPendiente,
            'montoTotal' => $montoTotal,
            'fechaVencimiento' => $this->faker->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
            'estado' => $this->faker->randomElement(['Cobrada', 'Pendiente', 'Vencida']),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}