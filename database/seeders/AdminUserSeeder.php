<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        AdminUser::create([
            'name' => 'Minthu',
            'email' => 'minthu@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
