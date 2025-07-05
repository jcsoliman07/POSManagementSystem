<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
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
            //Filters user based on the role
            //fn($q) => $q->where('name', 'user')) limits its to  users whose role name is exactly 'user'
            'user_id'   => User::whereHas('role', fn($q) => $q->where('name', 'user'))->inRandomOrder()->first()?->id,
            'total'     => fake()->randomFloat(2, 100, 1000), //float number from 100 - 1000 and have a 2 decimal places
        ];
    }
}
