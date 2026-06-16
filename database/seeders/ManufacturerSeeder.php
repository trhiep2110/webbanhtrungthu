<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $manufacturers = [
            ['name' => 'Kinh Đô'],
            ['name' => 'Bibica'],
            ['name' => 'Hữu Nghị'],
            ['name' => 'Đồng Khánh'],
            ['name' => 'Thu Hương Bakery'],
            ['name' => 'Như Lan'],
        ];

        foreach ($manufacturers as $manufacturer) {
            Manufacturer::updateOrCreate(['name' => $manufacturer['name']], $manufacturer);
        }

        $this->command->info('ManufacturerSeeder: Tạo ' . count($manufacturers) . ' thương hiệu thành công!');
    }
}
