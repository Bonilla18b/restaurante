<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'nombre' => $this->faker->word(), 
         'apellido' => $this->faker->word(),
         'documento' => $this->faker->unique()->numberBetween(1000000-9999999999), 
         'telefono'=> $this->faker->numberBetween(1000000000-9999999999,true ), 
         'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
