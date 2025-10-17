<?php

namespace Database\Factories;

use App\Models\UsiarioSistema;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioSistemaFactory extends Factory
{
    public function definition(): array
    {
        
        $username = $this->faker->userName(); 

        return [
            
            'empleado_id' => Empleado::factory(), 
            'username' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'), 
            'registradoPor' => $this->faker->name(),
        ];
    }
}