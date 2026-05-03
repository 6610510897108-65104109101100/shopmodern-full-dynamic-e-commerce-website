<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $priceCents = $this->faker->numberBetween(900, 20000);

        $compare = $this->faker->boolean(50)
            ? $priceCents + $this->faker->numberBetween(300, 6000)
            : null;

        return [
            'category_id' => Category::factory(),
            'name' => Str::title($name),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'sku' => 'SKU-' . $this->faker->unique()->bothify('??####'),
            'description' => $this->faker->paragraph(3),
            'price_cents' => $priceCents,
            'compare_at_price_cents' => $compare,
            'stock' => $this->faker->numberBetween(0, 120),
            'is_active' => true,
            'published_at' => now(),
        ];
    }
}