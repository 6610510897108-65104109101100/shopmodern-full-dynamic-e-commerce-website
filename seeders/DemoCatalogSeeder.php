<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

final class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        // কেন: UI সুন্দর দেখাতে fixed category নাম
        $categories = collect([
            ['name' => 'Women', 'slug' => 'women'],
            ['name' => 'Men', 'slug' => 'men'],
            ['name' => 'Kids', 'slug' => 'kids'],
            ['name' => 'Accessories', 'slug' => 'accessories'],
        ])->map(fn($c) => Category::firstOrCreate(
            ['slug' => $c['slug']],
            ['name' => $c['name'], 'description' => 'Demo category']
        ));

        // কেন: 24টা demo product
        $products = Product::factory()
            ->count(24)
            ->state(fn() => ['category_id' => $categories->random()->id])
            ->create();

        // কেন: প্রতি product এ 2টা image
        foreach ($products as $p) {
            ProductImage::create([
                'product_id' => $p->id,
                'url' => 'https://placehold.co/800x1100',
                'sort_order' => 0,
            ]);

            ProductImage::create([
                'product_id' => $p->id,
                'url' => 'https://placehold.co/800x1100?text=Alt',
                'sort_order' => 1,
            ]);
        }
    }
}