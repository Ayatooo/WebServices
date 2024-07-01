<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;
use Database\Factories\CarFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
         CarModel::factory(10)->create();

         CarFactory::new()->count(10)->create();

         Car::create([
            'name' => 'Super Hero Car ⚡',
            'color' => 'Red',
            'price' => '1000',
            'car_model_id' => 1,
            'user_id' => 1,
        ]);
    }
}
