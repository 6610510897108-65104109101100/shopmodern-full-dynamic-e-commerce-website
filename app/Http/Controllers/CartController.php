<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

final class CartController
{
    public function index(CartService $cart)
    {
        $items = $cart->items();
        $totals = $cart->totals();

        return view('public.cart', compact('items','totals'));
    }

    public function add(Request $request, CartService $cart)
    {
        $data = $request->validate([
            'product_id' => ['required','integer','exists:products,id'],
            'quantity' => ['nullable','integer','min:1','max:99'],
            'size' => ['nullable','string'],
            'color' => ['nullable','string'],
        ]);

        $product = Product::findOrFail((int)$data['product_id']);
        $cart->add($product, (int)($data['quantity'] ?? 1), $data['size'] ?? null, $data['color'] ?? null);

        return back()->with('success', 'Added to cart');
    }

    public function update(Request $request, CartItem $item, CartService $cart)
    {
        $data = $request->validate([
            'quantity' => ['required','integer','min:1','max:99'],
        ]);

        $cart->update($item, (int)$data['quantity']);
        return back()->with('success', 'Cart updated');
    }

    public function remove(CartItem $item, CartService $cart)
    {
        $cart->remove($item);
        return back()->with('success', 'Removed');
    }
}