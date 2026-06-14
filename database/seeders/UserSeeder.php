<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@grocery-mart.com'],
            [
                'fullname'   => 'Admin Grocery Mart',
                'password'   => Hash::make('admin@12345'),
                'role'       => 'admin',
                'is_verify'  => true,
                'is_locked'  => false,
                'avatar'     => '',
            ]
        );


        User::updateOrCreate(
            ['email' => 'tranhiepxyz02@gmail.com'],
            [
                'fullname'   => 'Trần Quang Hiệp',
                'password'   => Hash::make('user@12345'),
                'role'       => 'user',
                'phone'      => '0336029198',
                'is_verify'  => true,
                'is_locked'  => false,
                'avatar'     => '',
            ]
        );


        User::updateOrCreate(
            ['email' => 'duonghaly@gmail.com'],
            [
                'fullname'   => 'Dương Hà Ly',
                'password'   => Hash::make('user@12345'),
                'role'       => 'user',
                'phone'      => '0912345678',
                'is_verify'  => true,
                'is_locked'  => false,
                'avatar'     => '',
            ]
        );

        $this->command->info('UserSeeder: Tạo 1 admin + 2 users mẫu thành công!');
    }
}
