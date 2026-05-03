<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductImage;

final class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'images'])
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

public function store(Request $request)
{
    $data = $request->validate([
        'category_id' => ['required', 'exists:categories,id'],
        'name' => ['required', 'string', 'max:255'],
        'sku' => ['required', 'string', 'max:64', 'unique:products,sku'],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'compare_at_price' => ['nullable', 'numeric', 'min:0'],
        'stock' => ['required', 'integer', 'min:0'],
        'is_active' => ['sometimes', 'boolean'],
        'images' => ['nullable', 'array'],
        'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        'sizes' => ['nullable', 'array'],
        'colors_raw' => ['nullable', 'string', 'max:500'],
        'fabric_type' => ['nullable', 'string', 'max:255'],
        'yarn_count' => ['nullable', 'string', 'max:255'],
        'composition' => ['nullable', 'string', 'max:255'],
        'gsm' => ['nullable', 'string', 'max:255'],
        'color_type' => ['nullable', 'string', 'max:255'],
    ]);

    $base = \Illuminate\Support\Str::slug($data['name']);
    $slug = $this->uniqueSlug($base);

    $product = Product::create([
        'category_id' => (int) $data['category_id'],
        'name' => $data['name'],
        'slug' => $slug,
        'sku' => $data['sku'],
        'description' => $data['description'] ?? null,
        'sizes' => $data['sizes'] ?? [],
        'colors' => isset($data['colors_raw'])
            ? array_filter(array_map('trim', explode(',', $data['colors_raw'])))
            : [],
        'fabric_type' => $data['fabric_type'] ?? null,
        'yarn_count' => $data['yarn_count'] ?? null,
        'composition' => $data['composition'] ?? null,
        'gsm' => $data['gsm'] ?? null,
        'color_type' => $data['color_type'] ?? null,
        'price_cents' => (int) round(((float) $data['price']) * 100),
        'compare_at_price_cents' => $data['compare_at_price'] !== null
            ? (int) round(((float) $data['compare_at_price']) * 100)
            : null,
        'stock' => (int) $data['stock'],
        'is_active' => (bool) ($data['is_active'] ?? false),
        'published_at' => now(),
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');
            $product->images()->create([
                'url' => asset('storage/' . $path),
                'sort_order' => 0,
            ]);
        }
    } else {
        $product->images()->create([
            'url' => 'https://placehold.co/800x1100',
            'sort_order' => 0,
        ]);
    }

    return redirect()->route('admin.products.index')->with('success', 'Product created with images');
}

    public function edit(Product $product)
    {
        $categories = Category::query()->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
        'name' => ['required', 'string', 'max:255'],
        'sku' => ['required', 'string', 'max:64', 'unique:products,sku,' . $product->id],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'compare_at_price' => ['nullable', 'numeric', 'min:0'],
        'stock' => ['required', 'integer', 'min:0'],
        'is_active' => ['sometimes', 'boolean'],
        'images' => ['nullable', 'array'],
        'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        'sizes' => ['nullable', 'array'],
        'colors_raw' => ['nullable', 'string', 'max:500'],
        'fabric_type' => ['nullable', 'string', 'max:255'],
        'yarn_count' => ['nullable', 'string', 'max:255'],
        'composition' => ['nullable', 'string', 'max:255'],
        'gsm' => ['nullable', 'string', 'max:255'],
        'color_type' => ['nullable', 'string', 'max:255'],
    ]);

    $product->update([
        'category_id' => (int) $data['category_id'],
        'name' => $data['name'],
        'sku' => $data['sku'],
        'description' => $data['description'] ?? null,
        'sizes' => $data['sizes'] ?? [],
        'colors' => isset($data['colors_raw'])
            ? array_filter(array_map('trim', explode(',', $data['colors_raw'])))
            : [],
        'fabric_type' => $data['fabric_type'] ?? null,
        'yarn_count' => $data['yarn_count'] ?? null,
        'composition' => $data['composition'] ?? null,
        'gsm' => $data['gsm'] ?? null,
        'color_type' => $data['color_type'] ?? null,
        'price_cents' => (int) round(((float) $data['price']) * 100),
        'compare_at_price_cents' => $data['compare_at_price'] !== null
            ? (int) round(((float) $data['compare_at_price']) * 100)
            : null,
        'stock' => (int) $data['stock'],
        'is_active' => (bool) ($data['is_active'] ?? false),
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');
            $product->images()->create([
                'url' => asset('storage/' . $path),
                'sort_order' => 0,
            ]);
        }
    }

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted');
    }

    public function destroyImage(ProductImage $image)
    {
        $image->delete();
        return back()->with('success', 'Image removed from gallery.');
    }

    private function uniqueSlug(string $base): string
    {
        $slug = $base;
        $i = 2;

        // কেন: slug unique না হলে product show route conflict করবে
        while (Product::query()->where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}