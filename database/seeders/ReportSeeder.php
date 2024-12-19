<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            Report::create([
                'flood_location_id' => fake()->numberBetween(1, 5),
                'user_id' => fake()->numberBetween(1, 50),
                'subdistrict' => fake()->city(),
                'description' => fake()->sentence()
            ]);
        }

    }
}
