<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $language = [[
            'name' => 'Việt Nam',
            'canonical' => 'vn',
            'user_id' => 1,
            'image' => fake()->imageUrl(),
        ],[
            'name' => 'Anh',
            'canonical' => 'en',
            'user_id' => 1,
            'image' => fake()->imageUrl(),
        ],[
            'name' => 'Trung Quốc',
            'canonical' => 'cn',
            'user_id' => 1,
            'image' => fake()->imageUrl(),
        ],[
            'name' => 'Nhật Bản',
            'canonical' => 'jp',
            'user_id' => 1,
            'image' => fake()->imageUrl(),
        ]];
        Language::insert($language);
    }
}
