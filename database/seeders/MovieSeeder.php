<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            'name' => 'The Shawshank Redemption',
        ]);

        Movie::create([
            'name' => 'The Godfather',
        ]);

        Movie::create([
            'name' => 'The Dark Knight',
        ]);

        Movie::create([
            'name' => 'Pulp Fiction',
        ]);

        Movie::create([
            'name' => 'The Lord of the Rings: The Return of the King',
        ]);
    }
}
