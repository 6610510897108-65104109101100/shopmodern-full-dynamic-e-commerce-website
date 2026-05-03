<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

final class HomeController
{
    public function __invoke()
    {
        $categories = Category::query()->latest()->take(8)->get();
        $flashSale = Product::query()
            ->whereNotNull('compare_at_price_cents')
            ->where('is_active', true)
            ->latest('published_at')
            ->take(8)
            ->with('images','category')
            ->get();

        $settings = \App\Models\Setting::pluck('value', 'key')->all();

        return view('public.home', compact('categories', 'flashSale', 'settings'));
    }
}