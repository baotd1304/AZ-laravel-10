<?php

namespace Database\Seeders;

use App\Models\PostCatalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $postCatalogue = [
        //     'name' => 'Việt Nam',
        //     'canonical' => 'vn',
        //     'user_id' => 1,
        //     'image' => fake()->imageUrl(),
        // ];
        // PostCatalogue::insert($postCatalogue);
        PostCatalogue::factory()->count(30)->create();
    }
}
