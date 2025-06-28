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
            ['name' => '1-pc Chickenjoy with Rice', 'category' => 'Chickenjoy', 'price' => 89.00, 'description' => 'Crispy fried chicken served with steamed rice.'],
            ['name' => '2-pc Chickenjoy with Rice', 'category' => 'Chickenjoy', 'price' => 175.00, 'description' => 'Two pieces of crispy Chickenjoy with rice.'],
            ['name' => 'Chickenjoy with Jolly Spaghetti', 'category' => 'Chickenjoy', 'price' => 130.00, 'description' => 'Crispy Chickenjoy paired with sweet-style spaghetti.'],
            ['name' => 'Chickenjoy with Palabok', 'category' => 'Chickenjoy', 'price' => 150.00, 'description' => 'Crispy chicken served with flavorful Palabok.'],
            ['name' => 'Chickenjoy with Burger Steak', 'category' => 'Chickenjoy', 'price' => 140.00, 'description' => 'Chickenjoy and burger steak in one hearty meal.'],
            ['name' => 'Chickenjoy Solo', 'category' => 'Chickenjoy', 'price' => 82.00, 'description' => 'A single serving of our crispy Chickenjoy.'],
            ['name' => 'Chickenjoy Bucket (6-pc)', 'category' => 'Chickenjoy', 'price' => 435.00, 'description' => 'Six pieces of juicy Chickenjoy for sharing.'],
            ['name' => 'Chickenjoy Bucket (8-pc)', 'category' => 'Chickenjoy', 'price' => 579.00, 'description' => 'Eight pieces of crispy Chickenjoy goodness.'],

            ['name' => 'Yumburger', 'category' => 'Burger', 'price' => 40.00, 'description' => 'Classic beef burger with signature dressing.'],
            ['name' => 'Yumburger with Cheese', 'category' => 'Burger', 'price' => 55.00, 'description' => 'Juicy Yumburger topped with creamy cheese.'],
            ['name' => 'Yumburger with TLC', 'category' => 'Burger', 'price' => 65.00, 'description' => 'Beef burger with tomato, lettuce, and cheese.'],
            ['name' => 'Champ Burger', 'category' => 'Burger', 'price' => 165.00, 'description' => 'Big and juicy burger with premium ingredients.'],
            ['name' => 'Amazing Aloha Champ', 'category' => 'Burger', 'price' => 190.00, 'description' => 'Champ burger with pineapple and bacon twist.'],
            ['name' => 'Bacon Champ', 'category' => 'Burger', 'price' => 185.00, 'description' => 'Champ burger topped with crispy bacon.'],
            ['name' => 'Double Bacon Cheesy Yumburger', 'category' => 'Burger', 'price' => 120.00, 'description' => 'Double patty Yumburger with bacon and cheese.'],

            ['name' => 'Jolly Spaghetti (Solo)', 'category' => 'Spaghetti', 'price' => 60.00, 'description' => 'Sweet-style spaghetti with hotdog slices.'],
            ['name' => 'Jolly Spaghetti with Yum', 'category' => 'Spaghetti', 'price' => 95.00, 'description' => 'Spaghetti meal paired with a Yumburger.'],
            ['name' => 'Chickenjoy with Jolly Spaghetti', 'category' => 'Spaghetti', 'price' => 130.00, 'description' => 'Classic Chickenjoy with sweet-style spaghetti.'],
            ['name' => 'Jolly Spaghetti Family Pan', 'category' => 'Spaghetti', 'price' => 230.00, 'description' => 'Family-sized serving of sweet Jolly Spaghetti.'],
            ['name' => 'Jolly Spaghetti w/ Fries & Drink', 'category' => 'Spaghetti', 'price' => 120.00, 'description' => 'Spaghetti meal with fries and a drink.'],
        ];

        $product = $this->faker->randomElement($products);
        $category = Category::firstOrCreate(['name' => $product['category']]);

        return [
            //Creating a fake dat for Products

            'category_id'       => $category->id,
            'name'              => $product['name'],
            'price'             => $product['price'],
            'description' => $product['description'],

        ];
    }
}
