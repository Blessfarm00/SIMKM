<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'gambar_user' => null,
                'no_hp' => null,
                'password' => Hash::make('admin12'),
                'posisi' => 'Administrator',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'gambar_user' => null,
                'no_hp' => null,
                'password' => Hash::make('superadmin12'),
                'posisi' => 'superadmin',
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        User::insert($data);
    }
}
