<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [[
            'name' => 'Bao Admin',
            'phone' => '0702312866',
            'role' => 1,
            'active' => 1,
            'email' => 'baotd1304@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'remember_token' => Str::random(10),
        ],[
            'name' => 'Tran Bao',
            'phone' => '0702312866',
            'role' => 0,
            'active' => 0,
            'email' => 'tdb1304@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'remember_token' => Str::random(10),
        ]];
        User::insert($user);
        User::factory()->count(200)->create();
    }
}
