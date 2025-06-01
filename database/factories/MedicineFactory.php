<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Medicine::class;

    public function definition(): array
    {
        return [
        'name' => $this->faker->unique()->word(),
        'unit_price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
