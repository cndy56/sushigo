<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Relasi: detail milik 1 pesanan
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: detail merujuk ke 1 produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}