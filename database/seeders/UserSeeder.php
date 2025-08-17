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
            'name' => 'Barista2',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
         ]);    
         User::create([
            'name' => 'Barista',
            'email' => 'user@coba.com',
            'password' => Hash::make('password'),
        ]);
    }
}
