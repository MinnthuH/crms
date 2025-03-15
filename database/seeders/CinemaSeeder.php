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
                'hall_id' => $faker->numberBetween(1, 3), // Random hall_id between 1 and 4
                'showtime_id' => $faker->numberBetween(1, 3), // Random showtime_id between 1 and 10
                'ticketprice_id' => $faker->numberBetween(1, 4), // Random ticketprice_id between 1 and 5
                
            ]);
        }
    }
}
