<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adjuntos>
 */
class AdjuntosFactory extends Factory
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
            'adjunto' => $this->faker->text(100),
            'tarea_id'=> $this->faker->numberBetween(49, 68),
            'empleado_id'=> $this->faker->numberBetween(50, 80)
            
        ];
    }
}
