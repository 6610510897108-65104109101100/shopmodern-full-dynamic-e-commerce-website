<?php

namespace App\Http\Controllers;

use App\Models\Product;

final class NewArrivalsController
{
    public function index()
    {
        $products = Product::query()
            ->where('is_active', true)
            ->with('images','category')
            ->latest('published_at')
            ->paginate(12);

        return view('public.new-arrivals', compact('products'));
    }
}