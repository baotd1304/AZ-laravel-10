<?php

namespace Database\Seeders;

use App\Models\UserCatalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userCatalogue = [[
            'name' => 'Quản trị viên',
            'image' => fake()->imageUrl(),
        ],[
            'name' => 'Cộng tác viên',
            'image' => fake()->imageUrl(),
        ],[
            'name' => 'Biên tập viên',
            'image' => fake()->imageUrl(),
        ],[
            'name' => 'Khách hàng',
            'image' => fake()->imageUrl(),
        ]];
        UserCatalogue::insert($userCatalogue);
    }
}
