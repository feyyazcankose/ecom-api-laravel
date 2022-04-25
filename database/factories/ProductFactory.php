<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition()
    {
        return [
            "category_id"=>Arr::random([1,2]),
            "title"=>$this->faker->title(),
            "descirptions"=>$this->faker->text(100),
            "price"=>$this->faker->numberBetween(1000,10000),
            "quantity"=>$this->faker->numberBetween(100,200),
        ];
    }
}
