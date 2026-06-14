<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('phone', 20);
            $table->string('street');
            // Tỉnh/Thành phố
            $table->string('province_name');
            $table->unsignedInteger('province_id');
            // Quận/Huyện
            $table->string('district_name');
            $table->unsignedInteger('district_id');
            // Phường/Xã
            $table->string('ward_name');
            $table->string('ward_code', 20);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
