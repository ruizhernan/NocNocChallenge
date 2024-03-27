<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tareas>
 */
class TareasFactory extends Factory
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
            'titulo' => $this->faker->sentence(6),
            'descripcion' => $this->faker->text(100),
            'estado'=> $this->faker->randomElement(['Asignada', 'EnProceso', 'Finalizada']),
            'empleado_id'=> $this->faker->numberBetween(1, 10)
        ];
    }
}
