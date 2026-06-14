<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('name_zh')->nullable();
            $table->string('name_ja')->nullable();
            $table->string('code')->nullable();
            $table->json('images')->nullable(); // lưu mảng URL ảnh
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('cost_price');
            $table->unsignedInteger('quantity')->default(0);
            $table->foreignId('manufacturer_id')->constrained('manufacturers')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_zh')->nullable();
            $table->longText('description_ja')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->decimal('ratings', 2, 1)->default(1.0);
            $table->timestamp('deleted_at')->nullable(); // soft delete
            $table->timestamps();

            $table->index('category_id');
            $table->index('manufacturer_id');
            $table->index('in_stock');
            $table->index('ratings');
            $table->index('deleted_at');
            $table->fullText(['name', 'name_en']); // full-text search
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
