<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Category extends Model
{
    use HasFactory; // কেন: factory() চালাতে লাগে

    protected $fillable = ['name', 'slug', 'description', 'image'];

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : 'https://placehold.co/800x1000?text=' . urlencode($this->name);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}