<?php

namespace Database\Seeders;

use App\Models\Translatables;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslatableTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'language_id' => 1,
            'translatable_id' => 1,
            'translatable_type' => 'App\Models\PostCatalogue',
            'name' => 'Tên bài viết tiếng việt 1',
            'description' => 'mô tả tiếng việt 1',
            'content' => 'content tiếng việt 1',
        ],[
            'language_id' => 1,
            'translatable_id' => 2,
            'translatable_type' => 'App\Models\PostCatalogue',
            'name' => 'Tên bài viết tiếng việt 2',
            'description' => 'mô tả tiếng việt 2',
            'content' => 'content tiếng việt 2',
        ],[
            'language_id' => 2,
            'translatable_id' => 1,
            'translatable_type' => 'App\Models\PostCatalogue',
            'name' => 'Name postcatalogue 1',
            'description' => 'Description english 1',
            'content' => 'content english 1',
        ],[
            'language_id' => 2,
            'translatable_id' => 2,
            'translatable_type' => 'App\Models\PostCatalogue',
            'name' => 'Name postcatalogue 2',
            'description' => 'Description english 2',
            'content' => 'content english 2',
        ],[
            'language_id' => 3,
            'translatable_id' => 1,
            'translatable_type' => 'App\Models\PostCatalogue',
            'name' => 'Name in china 1',
            'description' => 'Description in china 1',
            'content' => 'Content in china 1',
        ],[
            'language_id' => 3,
            'translatable_id' => 2,
            'translatable_type' => 'App\Models\PostCatalogue',
            'name' => 'Name in china 2',
            'description' => 'Description in china 2',
            'content' => 'Content in china 2',
        ]];
        Translatables::insert($data);
    }
}
