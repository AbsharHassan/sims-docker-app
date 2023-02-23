<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\studentData>
 */
class studentDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(1),
            // 'age' => $this->faker->numberBetween($min = 18, $max = 24),
            // 'CGPA' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 4),
            // 'SGPA' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 4),
            // 'FSC' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 98),
            // 'Matric' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 98),
        ];
    }
}
