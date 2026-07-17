<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_code')->unique(); // Contoh: SGO-20260716-001
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])
                  ->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->text('notes')->nullable(); // Catatan dari pelanggan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};