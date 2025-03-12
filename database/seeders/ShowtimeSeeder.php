<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\ShowTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTime = Carbon::createFromFormat('H:i A', '9:30 AM'); // Start time 9:30 AM
        $endTime = Carbon::createFromFormat('H:i A', '8:30 PM');   // End time 8:30 PM

        while ($startTime <= $endTime) {
            ShowTime::create([
                'showtime' => $startTime->format('H:i'), // Store in 24-hour format (HH:mm)
            ]);
            $startTime->addMinutes(30); // Add 30 minutes to the current time
        }
    }
}
