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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Thông tin người mua
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone', 20);

            // Thông tin người nhận
            $table->string('recipient_name');
            $table->string('recipient_phone', 20);

            // Địa chỉ giao hàng 
            $table->string('province_name');
            $table->unsignedInteger('province_id');
            $table->string('district_name');
            $table->unsignedInteger('district_id');
            $table->string('ward_name');
            $table->string('ward_code', 20);
            $table->string('street');

            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'reject', 'shipping', 'success', 'canceled'])->default('pending');
            $table->unsignedBigInteger('total_amount')->default(0);
            $table->unsignedBigInteger('shipping_fee')->default(0);

            // Thanh toán
            $table->enum('payment_method', ['COD', 'Bank']);
            $table->enum('payment_gateway', ['MoMo', 'ZaloPay', 'VnPay'])->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('pay_url')->nullable();

            // MoMo
            $table->string('momo_trans_id')->nullable();
            $table->string('momo_request_id')->nullable();

            $table->boolean('is_refunded')->default(false);
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
            $table->index('payment_method');
            $table->index('is_paid');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
