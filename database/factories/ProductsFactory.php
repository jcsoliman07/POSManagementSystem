<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //Pre defined factory data
        $products = [
            ['name' => '1-pc Chickenjoy with Rice', 'category' => 'Chickenjoy', 'price' => 89.00],
            ['name' => '2-pc Chickenjoy with Rice', 'category' => 'Chickenjoy', 'price' => 175.00],
            ['name' => 'Chickenjoy with Jolly Spaghetti', 'category' => 'Chickenjoy', 'price' => 130.00],
            ['name' => 'Chickenjoy with Palabok', 'category' => 'Chickenjoy', 'price' => 150.00],
            ['name' => 'Chickenjoy with Burger Steak', 'category' => 'Chickenjoy', 'price' => 140.00],
            ['name' => 'Chickenjoy Solo', 'category' => 'Chickenjoy', 'price' => 82.00],
            ['name' => 'Chickenjoy Bucket (6-pc)', 'category' => 'Chickenjoy', 'price' => 435.00],
            ['name' => 'Chickenjoy Bucket (8-pc)', 'category' => 'Chickenjoy', 'price' => 579.00],

            ['name' => 'Yumburger', 'category' => 'Burger', 'price' => 40.00],
            ['name' => 'Yumburger with Cheese', 'category' => 'Burger', 'price' => 55.00],
            ['name' => 'Yumburger with TLC', 'category' => 'Burger', 'price' => 65.00],
            ['name' => 'Champ Burger', 'category' => 'Burger', 'price' => 165.00],
            ['name' => 'Amazing Aloha Champ', 'category' => 'Burger', 'price' => 190.00],
            ['name' => 'Bacon Champ', 'category' => 'Burger', 'price' => 185.00],
            ['name' => 'Double Bacon Cheesy Yumburger', 'category' => 'Burger', 'price' => 120.00],

            ['name' => 'Jolly Spaghetti (Solo)', 'category' => 'Spaghetti', 'price' => 60.00],
            ['name' => 'Jolly Spaghetti with Yum', 'category' => 'Spaghetti', 'price' => 95.00],
            ['name' => 'Chickenjoy with Jolly Spaghetti', 'category' => 'Spaghetti', 'price' => 130.00],
            ['name' => 'Jolly Spaghetti Family Pan', 'category' => 'Spaghetti', 'price' => 230.00],
            ['name' => 'Jolly Spaghetti w/ Fries & Drink', 'category' => 'Spaghetti', 'price' => 120.00],
        ];

        $product = $this->faker->randomElement($products);
        $category = Category::firstOrCreate(['name' => $product['category']]);

        return [
            //Creating a fake dat for Products

            'category_id'       => $category->id,
            'name'              => $product['name'],
            'price'             => $product['price'],

        ];
    }
}
