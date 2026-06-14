<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // VISITS (lượt truy cập)
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 45);
            $table->text('user_agent');
            $table->string('referrer')->nullable();
            $table->string('path')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->timestamps();

            $table->index('ip');
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
