<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CHATS (hội thoại chat)
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('last_message')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_online')->default(false);
            $table->timestamps();

            $table->unique('user_id'); // mỗi user chỉ có 1 chat room
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
