<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'image', 'stock', 'is_available',
    ];

    // Relasi: produk milik 1 kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: produk bisa ada di banyak cart item
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relasi: produk bisa ada di banyak order detail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}