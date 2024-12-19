<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 news
        for ($i = 0; $i < 10; $i++) {
            News::create([
                'user_id' => fake()->numberBetween(1, 50),
                'title' => fake()->sentence(),
                'content' => fake()->paragraph()
            ]);
        }
    }
}
