<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentarios>
 */
class ComentariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'descripcion' => $this->faker-> text(100),
            'tarea_id'=> $this->faker->numberBetween(49, 68),
            'empleado_id'=> $this->faker->numberBetween(28, 70)
        ];
    }
}
