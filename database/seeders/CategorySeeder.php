<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Bánh nướng',
                'description' => 'Bánh Trung Thu nướng truyền thống với nhân thập cẩm, đậu xanh, hạt sen',
                'image'       => 'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/category-banh-nuong.jpg',
            ],
            [
                'name'        => 'Bánh dẻo',
                'description' => 'Bánh Trung Thu dẻo mềm thơm ngon với nhiều hương vị đặc trưng',
                'image'       => 'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/category-banh-deo.jpg',
            ],
            [
                'name'        => 'Bánh pía',
                'description' => 'Bánh pía Sóc Trăng đặc sản miền Nam thơm ngon hấp dẫn',
                'image'       => 'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/category-banh-pia.jpg',
            ],
            [
                'name'        => 'Bánh truyền thống',
                'description' => 'Các loại bánh Trung Thu theo công thức truyền thống của từng vùng miền',
                'image'       => 'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/category-truyen-thong.jpg',
            ],
            [
                'name'        => 'Hộp quà',
                'description' => 'Hộp quà Trung Thu sang trọng, phù hợp làm quà tặng dịp lễ',
                'image'       => 'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/category-hop-qua.jpg',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }

        $this->command->info('✅ CategorySeeder: Tạo ' . count($categories) . ' danh mục thành công!');
    }
}
