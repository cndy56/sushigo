<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Relasi: item milik 1 keranjang
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relasi: item merujuk ke 1 produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}