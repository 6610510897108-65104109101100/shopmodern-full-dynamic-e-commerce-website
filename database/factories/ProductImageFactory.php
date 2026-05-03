<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            // কেন: ডেমোর জন্য placeholder image URL
            'url' => 'https://placehold.co/800x1100',
            'sort_order' => 0,
        ];
    }
}