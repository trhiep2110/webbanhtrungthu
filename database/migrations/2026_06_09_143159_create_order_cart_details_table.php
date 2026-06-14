<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Bảng pivot nối order với cart_details
        Schema::create('order_cart_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('cart_detail_id')->constrained('cart_details')->onDelete('cascade');

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_cart_details');
    }
};
