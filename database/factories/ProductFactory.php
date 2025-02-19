<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    static $productNumber = 0;


    public function definition()
    {
        $name = $this->faker->words(3, true); // Generates a random product name
        self::$productNumber++;

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph(5),
            'regular_price' => $this->faker->randomFloat(2, 10, 500), // Price between 10 and 500
            'sale_price' => $this->faker->optional()->randomFloat(2, 5, 400),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-####')),
            'stock_status' => $this->faker->randomElement(['instock', 'outofstock']),
            'featured' => $this->faker->boolean(50), // 20% chance of being featured
            'quantity' => $this->faker->numberBetween(1, 100),
            'main_image' => "product_" . self::$productNumber . ".jpg",
            'images' => [
                "product_" . self::$productNumber . ".jpg",
                "product_" . self::$productNumber . "-1.jpg",
            ],

            'category_id' => Category::inRandomOrder()->first()->id ,
            'brand_id' => Brand::inRandomOrder()->first()->id ,
        ];
    }
}
