<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // Relasi: keranjang milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: keranjang punya banyak item
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}