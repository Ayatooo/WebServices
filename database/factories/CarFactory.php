<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'color' => $this->faker->word(),
            'price' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'car_model_id' => CarModel::factory(),
            'user_id' => User::factory(),
        ];
    }
}
