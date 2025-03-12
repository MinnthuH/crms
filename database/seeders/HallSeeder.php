<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hall::create([
            'name' => 'Hall 1',

        ]);
        Hall::create([
            'name' => 'Hall 2',

        ]);
        Hall::create([
            'name' => 'Hall 3',

        ]);
        Hall::create([
            'name' => 'Hall 4',
        ]);
    }
}
