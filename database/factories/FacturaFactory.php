<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return[
        'cliente_id' => \App\Models\Cliente::factory(),
            'nFactura' => $this->faker->unique()->numerify('FAC-#####'),
            'estado' => 1,
            'descuentoTotal' => $this->faker->randomFloat(2, 0, 50), 
            'total' => $this->faker->randomFloat(2, 50, 1000),
            'pago' => $this->faker->randomFloat(2, 0, 1000),
            'metodoDePago' => 1
        ];   
    }
}
