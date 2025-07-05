<?php

namespace Database\Factories;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItems>
 */
class OrderItemsFactory extends Factory
{
    protected $model = OrderItems::class;

    public function definition(): array
    {
        $product = Products::inRandomOrder()->first();

        return [
            //
            'order_id'      => Orders::inRandomOrder()->first()?->id,
            'product_id'    => $product?->id,
            'quantity'      => $this->faker->numberBetween(1,5),
            'price'         => $product?->price,
        ];
    }
}
