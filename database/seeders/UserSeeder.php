<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            // 'name' => 'user',
            // 'email' => 'user@example.com',
            // 'password' => Hash::make('password'),

            'name' => 'Barista',
            'email' => 'user@coba.com',
            'password' => Hash::make('password'),
        ]);
    }
}
