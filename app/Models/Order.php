<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Order extends Model
{
    protected $fillable = [
        'user_id','order_number','customer_name','customer_email','customer_phone',
        'shipping_address','subtotal_cents','shipping_cents','total_cents','status', 'payment_status',
    ];

    public function items(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute(): string {
        return number_format($this->total_cents / 100, 2);
    }
}