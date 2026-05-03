<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class CheckoutController
{
    public function show(CartService $cart)
    {
        $items = $cart->items();
        $totals = $cart->totals();

        return view('public.checkout', compact('items','totals'));
    }

    public function placeOrder(Request $request, CartService $cart)
    {
        $data = $request->validate([
            'customer_name' => ['required','string','max:255'],
            'customer_email' => ['required','email','max:255'],
            'customer_phone' => ['nullable','string','max:50'],
            'shipping_address' => ['nullable','string','max:2000'],
        ]);

        $items = $cart->items();
        if ($items->isEmpty()) {
            return back()->withErrors(['cart' => 'Your cart is empty']);
        }

        return DB::transaction(function () use ($data, $items, $cart) {
            // কেন: stock + order creation atomic হতে হবে
            foreach ($items as $item) {
                $product = $item->product()->lockForUpdate()->first();
                if (!$product || $product->stock < $item->quantity) {
                    throw new \RuntimeException("Insufficient stock for {$item->product->name}");
                }
            }

            $totals = $cart->totals();
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $this->generateOrderNumber(),
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'shipping_address' => $data['shipping_address'] ?? null,
                'subtotal_cents' => $totals['subtotalCents'],
                'shipping_cents' => $totals['shippingCents'],
                'total_cents' => $totals['totalCents'],
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                $product = $item->product()->lockForUpdate()->first();

                $line = $product->price_cents * $item->quantity;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'unit_price_cents' => $product->price_cents,
                    'quantity' => $item->quantity,
                    'line_total_cents' => $line,
                ]);

                $product->decrement('stock', $item->quantity);
            }

            // cart clear
            $cart->baseQuery()->delete();

            return redirect()->route('order.thankyou', $order);
        });
    }

    private function generateOrderNumber(): string
    {
        // কেন: আপনার admin টেমপ্লেটে #ORD-7721 ফরম্যাট দেখা যাচ্ছে :contentReference[oaicite:12]{index=12}
        $rand = random_int(1000, 9999);
        return "ORD-{$rand}";
    }
}