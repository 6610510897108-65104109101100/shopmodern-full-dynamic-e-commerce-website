<?php

namespace App\Http\Controllers;

use App\Models\Product;

final class DealsController
{
    public function index()
    {
        $products = Product::query()
            ->whereNotNull('compare_at_price_cents')
            ->where('is_active', true)
            ->with('images','category')
            ->latest('published_at')
            ->paginate(12);

        return view('public.deals', compact('products'));
    }
}