<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class ProductAdminController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with('category')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required','exists:categories,id'],
            'name' => ['required','string','max:255'],
            'sku' => ['required','string','max:64','unique:products,sku'],
            'description' => ['nullable','string'],
            'price' => ['required','numeric','min:0'],
            'compare_at_price' => ['nullable','numeric','min:0'],
            'stock' => ['required','integer','min:0'],
            'is_active' => ['sometimes','boolean'],
        ]);

        $slug = Str::slug($data['name']);
        $product = Product::create([
            'category_id' => (int)$data['category_id'],
            'name' => $data['name'],
            'slug' => $this->uniqueSlug($slug),
            'sku' => $data['sku'],
            'description' => $data['description'] ?? null,
            'price_cents' => (int) round(((float)$data['price']) * 100),
            'compare_at_price_cents' => $data['compare_at_price'] !== null
                ? (int) round(((float)$data['compare_at_price']) * 100)
                : null,
            'stock' => (int)$data['stock'],
            'is_active' => (bool)($data['is_active'] ?? false),
            'published_at' => now(),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created');
    }

    private function uniqueSlug(string $base): string
    {
        $slug = $base;
        $i = 2;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }
}