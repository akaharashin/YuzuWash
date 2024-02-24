<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\id_ID\Person;
use Termwind\Components\Element;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = Order::class;
     public function definition(): array
    {
        $faker = $this->faker;
        $faker->addProvider(new Person($faker));
        $product = Product::all()->random();
        return [
            'product_id' => $product->id,
            'customer' => $faker->name,
            'contact' => $faker->phoneNumber,
            'plat' => $faker->numerify('F ####'). $faker->lexify(' ??'),
            'status' => 'list',
            'created_at' => $this->faker->dateTimeBetween('2024-01-01', 'now'),
        ];
    }
}
