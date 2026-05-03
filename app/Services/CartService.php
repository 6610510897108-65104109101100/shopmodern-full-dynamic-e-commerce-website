<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

final class CartService
{
    public function getSessionId(): string
    {
        // কেন: guest কার্ট persist করতে session_id দরকার
        return request()->session()->getId();
    }

    public function baseQuery()
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();

        return CartItem::query()
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->whereNull('user_id')->where('session_id', $sessionId));
    }

    public function items()
    {
        return $this->baseQuery()->with('product.images')->get();
    }

    public function add(Product $product, int $qty = 1, ?string $size = null, ?string $color = null): void
    {
        $qty = max(1, $qty);

        $userId = Auth::id();
        $sessionId = $this->getSessionId();

        $item = CartItem::query()->firstOrNew([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'product_id' => $product->id,
            'size' => $size,
            'color' => $color,
        ]);

        // কেন: একই product, size এবং color বারবার add করলে quantity যোগ হবে
        $item->quantity = ($item->exists ? $item->quantity : 0) + $qty;
        $item->save();
    }

    public function update(CartItem $item, int $qty): void
    {
        $qty = max(1, $qty);
        $item->update(['quantity' => $qty]);
    }

    public function remove(CartItem $item): void
    {
        $item->delete();
    }

    public function totals(): array
    {
        $subtotalCents = $this->items()->sum(fn($i) => $i->product->price_cents * $i->quantity);
        
        $shippingThreshold = 25000; // $250 in cents
        $shippingCents = ($subtotalCents > 0 && $subtotalCents < $shippingThreshold) ? 1000 : 0;
        
        $totalCents = $subtotalCents + $shippingCents;

        return compact('subtotalCents', 'shippingCents', 'totalCents');
    }
}