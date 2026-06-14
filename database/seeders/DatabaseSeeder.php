<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,         // 1. Tạo users trước (không phụ thuộc gì)
            CategorySeeder::class,     // 2. Danh mục
            ManufacturerSeeder::class, // 3. Thương hiệu
            ProductSeeder::class,      // 4. Sản phẩm (cần category + manufacturer)
        ]);

        $this->command->info('Seeding hoàn tất!');
    }
}
