<?php

namespace Database\Seeders;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Get all the available products
        $products = Products::all();

        //Create 5 orders for 'User' Account only
        $orders = Orders::factory()->count(5)->create();

        foreach ($orders as $order)
        {
            //Create 2-5 items per Order
            $items = OrderItems::factory()
                    ->count(fake()->numberBetween(2,5))
                    ->state(function () use ($order, $products){
                        
                        return [
                            'order_id'      => $order->id,
                            // 'quantity'      => $order->quanity,
                            // 'price'         => $order->price,
                        ];

                    })
                    ->create();

            //Compute Total after Creating Items
            $total = $items->sum(function($item){
                return $item->price * $item->quantity;
            });

            $order->update(['total_amount' => $total]);
        }
    }
}
