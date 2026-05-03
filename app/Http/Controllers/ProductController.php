<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

final class ProductController
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with('images','category');

        if ($request->filled('q')) {
            $q = trim((string)$request->get('q'));
            $query->where(function($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('sku', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $slug = (string)$request->get('category');
            $query->whereHas('category', fn($c) => $c->where('slug', $slug));
        }

        $sort = (string)$request->get('sort', 'newest');
        $query = match ($sort) {
            'price_asc' => $query->orderBy('price_cents', 'asc'),
            'price_desc' => $query->orderBy('price_cents', 'desc'),
            default => $query->latest('published_at'),
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::query()->orderBy('name')->get();

        return view('public.shop', compact('products','categories','sort'));
    }

    public function show(string $slug)
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('images','category')
            ->firstOrFail();

        return view('public.product', compact('product'));
    }
}