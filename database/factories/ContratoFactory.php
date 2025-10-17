<?php

namespace Database\Factories;


use App\Models\Contrati;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    public function definition(): array
    {
        $salario = $this->faker->numberBetween(1000, 5000) * 100;

        return [
            // **Asumiendo que ya existen Empleados (id 1 a 10)**
            'empleado_id' => Empleado::factory(),
            'tipoContrato' => $this->faker->randomElement(['Indefinido', 'Fijo', 'Servicios']),
            'fechaInicio' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'fechaFin' => $this->faker->optional(0.7)->dateTimeBetween('now', '+1 year')->format('Y-m-d'), // Opcional (70% de probabilidad de tener fecha fin)
            'estadoContrato' => $this->faker->randomElement(['Vigente', 'Finalizado', 'Renovación']),
            'salario' => $salario,
        ];
    }
}