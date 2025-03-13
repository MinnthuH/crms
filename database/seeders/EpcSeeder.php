<?php

namespace Database\Seeders;

use App\Models\Epc;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EpcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Epc::create([
            'status' => 0,
            ]);

        Epc::create([
            'status' => 25,
            ]);

        Epc::create([
            'status' => 50,
            ]);

        Epc::create([
            'status' => 75,
            ]);

        Epc::create([
            'status' => 100,
            ]);
    }
}
