<?php

namespace Database\Seeders;

use App\Models\Cinema;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class CinemaSeeder extends Seeder
{
    public function run()
    {
        $cinemaNames = [
            'Thamada', 'Thwin', 'Top Royal', 'Nay Pyi Taw', 'Shae Saung', 'Dagon Center 2',
            'Waziya', 'North Oakalapa', 'Tarmwe', 'South Dagon', 'Gamonepwint', 'Thanlyin',
            'Sein Gay Har', 'Myayadanar (TKT)', 'Shwe Pyi Thar (YGN)', 'North Dagon', 'Nawaday',
            'Win Light', 'Masoeyein', 'Central Point', 'San Pya (MGY)', 'Bayint (MLM)', 'Shwe Pyi Thar (PT)',
            'Myaung Mya', 'Bago Icon', 'Taungoo Icon', 'Pyay Tun Thiri', 'Yama'
        ];

        $faker = Faker::create();

        foreach ($cinemaNames as $name) {
            Cinema::create([
                'name' => $name,
                'hall_ids' => json_encode(range(1, 4)), // Stores [1,2,3,4] as JSON
                'showtime_ids' => json_encode(range(1, 3)), // Stores [1,2,3] as JSON
                'ticketprice_ids' => json_encode(range(1, 4)), // Stores [1,2,3,4] as JSON
            ]);
        }
    }
}
