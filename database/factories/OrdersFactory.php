<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrdersFactory extends Factory
{
    protected $model = Orders::class;
    
    public function definition(): array
    {
        return [
            //
            //Filters user based on the role
            //fn($q) => $q->where('name', 'user')) limits its to  users whose role name is exactly 'user'
            'user_id'           => User::whereHas('role', fn($q) => $q->where('name', 'user'))->inRandomOrder()->first()?->id,
            'customer'          =>fake()->name,
            'payment_method'    => fake()->randomElement(['C', 'E']), //C = Cash, E = E-Money
            'total_amount'      => 0,
        ];
    }
}
