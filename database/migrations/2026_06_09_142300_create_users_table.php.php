<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password')->nullable(); // nullable vì login Google không cần password
            $table->string('firebase_id')->nullable(); // Google OAuth
            $table->string('phone', 20)->nullable();
            $table->string('avatar')->default('https://hitly.vn/avatar-default');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->boolean('is_verify')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->timestamp('last_active')->nullable();
            $table->timestamps();

            $table->index('email');
            $table->index('role');
            $table->index('firebase_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
