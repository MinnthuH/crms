<?php

namespace Database\Seeders;

use App\Models\TicketPrice;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketPrice::create([
            'price' => 1000,

        ]);
        TicketPrice::create([
            'price' => 2000,

        ]); TicketPrice::create([
            'price' => 3000,

        ]);
        TicketPrice::create([
            'price' => 4000,

        ]);
        TicketPrice::create([
            'price' => 5000,

        ]);
    }
}
