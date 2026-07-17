<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_code', 'status', 'total_price', 'notes',
    ];

    // Label status dalam Bahasa Indonesia
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'Menunggu',
            'diproses'    => 'Diproses',
            'selesai'     => 'Selesai',
            'dibatalkan'  => 'Dibatalkan',
            default       => 'Tidak Diketahui',
        };
    }

    // Warna badge status
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'yellow',
            'diproses'    => 'blue',
            'selesai'     => 'green',
            'dibatalkan'  => 'red',
            default       => 'gray',
        };
    }

    // Relasi: pesanan milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: pesanan punya banyak detail
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}