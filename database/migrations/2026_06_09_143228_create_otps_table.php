<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // OTPs (xác thực email / quên mật khẩu)
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('otp', 10);
            $table->enum('type', ['verify email', 'forgot password']);
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index('email');
            $table->index('expires_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
