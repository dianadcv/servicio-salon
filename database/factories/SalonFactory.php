<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Salon;

class SalonFactory extends Factory
{
    protected $model = Salon::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'capacity' => $this->faker->numberBetween(50, 300),
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'description' => $this->faker->sentence(),
            'address' => $this->faker->address(),
            'available' => $this->faker->boolean(),
        ];
    }
}
