<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Product extends Model
{
    use HasFactory; // কেন: Product::factory() কাজ করার জন্য

    protected $fillable = [
        'category_id','name','slug','sku','description','sizes','colors',
        'fabric_type', 'yarn_count', 'composition', 'gsm', 'color_type',
        'price_cents','compare_at_price_cents','stock',
        'is_active','published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'sizes' => 'array',
        'colors' => 'array',
    ];

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function images(): HasMany { return $this->hasMany(ProductImage::class)->orderBy('sort_order'); }

    public function getPriceAttribute(): string
    {
        return number_format($this->price_cents / 100, 2);
    }

    public function getCompareAtPriceAttribute(): ?string
    {
        if (!$this->compare_at_price_cents) {
            return null;
        }
        return number_format($this->compare_at_price_cents / 100, 2);
    }
}