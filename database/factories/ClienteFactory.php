<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;


class ClienteFactory extends Factory
{
   
    public function definition(): array
    {
        return [
            'persona_id' => Persona::factory(), 
            'direccion' => $this->faker->address,
        ];
    }
}
