<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $banhNuong   = Category::where('name', 'Bánh nướng')->first();
        $banhDeo     = Category::where('name', 'Bánh dẻo')->first();
        $banhPia     = Category::where('name', 'Bánh pía')->first();
        $hopQua      = Category::where('name', 'Hộp quà')->first();

        $kinhDo      = Manufacturer::where('name', 'Kinh Đô')->first();
        $bibica      = Manufacturer::where('name', 'Bibica')->first();
        $thuHuong    = Manufacturer::where('name', 'Thu Hương Bakery')->first();
        $nhuLan      = Manufacturer::where('name', 'Như Lan')->first();

        $products = [
            // ======== BÁNH NƯỚNG ========
            [
                'name'            => 'Bánh Nướng Nhân Thập Cẩm Kinh Đô',
                'name_en'         => 'Mixed Nuts Mooncake Kinh Do',
                'code'            => 'KD-NN-001',
                'price'           => 85000,
                'cost_price'      => 50000,
                'quantity'        => 100,
                'category_id'     => $banhNuong?->id,
                'manufacturer_id' => $kinhDo?->id,
                'in_stock'        => true,
                'ratings'         => 4.5,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-nuong-thap-cam-1.jpg',
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-nuong-thap-cam-2.jpg',
                ]),
                'description'     => 'Bánh nướng nhân thập cẩm truyền thống Kinh Đô với lớp vỏ mỏng giòn, nhân thập cẩm thơm ngon gồm hạt sen, hạt dưa, mỡ đường, lạp xưởng.',
                'description_en'  => 'Traditional Kinh Do mixed nuts mooncake with thin crispy crust, fragrant mixed filling including lotus seeds, watermelon seeds, sugar fat, Chinese sausage.',
            ],
            [
                'name'            => 'Bánh Nướng Nhân Đậu Xanh Trứng Muối',
                'name_en'         => 'Mung Bean Salted Egg Mooncake',
                'code'            => 'KD-NN-002',
                'price'           => 95000,
                'cost_price'      => 58000,
                'quantity'        => 80,
                'category_id'     => $banhNuong?->id,
                'manufacturer_id' => $kinhDo?->id,
                'in_stock'        => true,
                'ratings'         => 4.8,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-nuong-dau-xanh-trung-muoi.jpg',
                ]),
                'description'     => 'Bánh nướng nhân đậu xanh kết hợp trứng muối béo ngậy, vỏ bánh vàng đẹp, thơm mùi dầu mè.',
                'description_en'  => 'Baked mooncake with smooth mung bean paste and rich salted egg yolk, beautiful golden crust with sesame oil aroma.',
            ],
            [
                'name'            => 'Bánh Nướng Nhân Hạt Sen Bibica',
                'name_en'         => 'Lotus Seed Mooncake Bibica',
                'code'            => 'BB-NN-001',
                'price'           => 75000,
                'cost_price'      => 45000,
                'quantity'        => 120,
                'category_id'     => $banhNuong?->id,
                'manufacturer_id' => $bibica?->id,
                'in_stock'        => true,
                'ratings'         => 4.3,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-nuong-hat-sen-bibica.jpg',
                ]),
                'description'     => 'Bánh nướng nhân hạt sen nguyên chất Bibica, vị thanh nhẹ, phù hợp cho người ăn kiêng đường.',
                'description_en'  => 'Bibica lotus seed mooncake with pure lotus filling, light flavor, suitable for low-sugar diet.',
            ],

            // ======== BÁNH DẺO ========
            [
                'name'            => 'Bánh Dẻo Nhân Đậu Xanh Thu Hương',
                'name_en'         => 'Mung Bean Snow Skin Mooncake Thu Huong',
                'code'            => 'TH-BD-001',
                'price'           => 65000,
                'cost_price'      => 38000,
                'quantity'        => 90,
                'category_id'     => $banhDeo?->id,
                'manufacturer_id' => $thuHuong?->id,
                'in_stock'        => true,
                'ratings'         => 4.6,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-deo-dau-xanh.jpg',
                ]),
                'description'     => 'Bánh dẻo vỏ trắng mềm mịn, nhân đậu xanh thanh mát, được làm thủ công theo công thức truyền thống.',
                'description_en'  => 'Snow skin mooncake with soft white crust, refreshing mung bean filling, handcrafted using traditional recipe.',
            ],
            [
                'name'            => 'Bánh Dẻo Nhân Hạt Sen Trứng Muối',
                'name_en'         => 'Lotus Salted Egg Snow Skin Mooncake',
                'code'            => 'TH-BD-002',
                'price'           => 78000,
                'cost_price'      => 47000,
                'quantity'        => 60,
                'category_id'     => $banhDeo?->id,
                'manufacturer_id' => $thuHuong?->id,
                'in_stock'        => true,
                'ratings'         => 4.7,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-deo-hat-sen-trung-muoi.jpg',
                ]),
                'description'     => 'Bánh dẻo nhân hạt sen kết hợp trứng muối, vỏ dẻo mềm thơm nước hoa bưởi đặc trưng.',
                'description_en'  => 'Snow skin mooncake with lotus and salted egg filling, soft chewy crust with distinctive pomelo blossom aroma.',
            ],

            // ======== BÁNH PÍA ========
            [
                'name'            => 'Bánh Pía Nhân Sầu Riêng Như Lan',
                'name_en'         => 'Durian Pia Cake Nhu Lan',
                'code'            => 'NL-BP-001',
                'price'           => 55000,
                'cost_price'      => 32000,
                'quantity'        => 150,
                'category_id'     => $banhPia?->id,
                'manufacturer_id' => $nhuLan?->id,
                'in_stock'        => true,
                'ratings'         => 4.4,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/banh-pia-sau-rieng.jpg',
                ]),
                'description'     => 'Bánh pía đặc sản Sóc Trăng nhân sầu riêng béo ngậy, vỏ bánh nhiều lớp giòn xốp đặc trưng.',
                'description_en'  => 'Soc Trang specialty pia cake with rich durian filling, characteristic multi-layered crispy crust.',
            ],

            // ======== HỘP QUÀ ========
            [
                'name'            => 'Hộp Quà Trung Thu Cao Cấp Kinh Đô 4 Bánh',
                'name_en'         => 'Kinh Do Premium Mooncake Gift Box 4 Pieces',
                'code'            => 'KD-HQ-001',
                'price'           => 320000,
                'cost_price'      => 200000,
                'quantity'        => 50,
                'category_id'     => $hopQua?->id,
                'manufacturer_id' => $kinhDo?->id,
                'in_stock'        => true,
                'ratings'         => 4.9,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/hop-qua-kinh-do-4-banh.jpg',
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/hop-qua-kinh-do-4-banh-2.jpg',
                ]),
                'description'     => 'Hộp quà Trung Thu cao cấp Kinh Đô gồm 4 bánh nướng hỗn hợp: 2 bánh thập cẩm, 1 bánh đậu xanh, 1 bánh hạt sen. Hộp thiết kế sang trọng, phù hợp làm quà biếu.',
                'description_en'  => 'Kinh Do premium Mid-Autumn gift box with 4 mixed mooncakes: 2 mixed nuts, 1 mung bean, 1 lotus seed. Luxurious box design, perfect for gifting.',
            ],
            [
                'name'            => 'Hộp Quà Trung Thu Bibica 6 Bánh',
                'name_en'         => 'Bibica Mooncake Gift Box 6 Pieces',
                'code'            => 'BB-HQ-001',
                'price'           => 420000,
                'cost_price'      => 260000,
                'quantity'        => 40,
                'category_id'     => $hopQua?->id,
                'manufacturer_id' => $bibica?->id,
                'in_stock'        => true,
                'ratings'         => 4.6,
                'images'          => json_encode([
                    'https://res.cloudinary.com/dksm6utoo/image/upload/v1/mid-autumn/hop-qua-bibica-6-banh.jpg',
                ]),
                'description'     => 'Hộp quà Trung Thu Bibica cao cấp gồm 6 bánh đa dạng hương vị: nướng và dẻo. Hộp thiết kế đỏ vàng truyền thống, sang trọng.',
                'description_en'  => 'Bibica premium gift box with 6 assorted mooncakes: baked and snow skin varieties. Traditional red-gold design, elegant.',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['code' => $product['code']],
                $product
            );
        }

        $this->command->info('✅ ProductSeeder: Tạo ' . count($products) . ' sản phẩm mẫu thành công!');
    }
}
