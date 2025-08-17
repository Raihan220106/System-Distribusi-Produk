<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory()->create([
        'name' => "Admin1" ,
        'email' => 'admin@123.com' ,
        'password' => Hash::make('admin12345'),
       ]);

        User::factory()->create([
        'name' => "Admin2" ,
        'email' => 'admin@12345.com' ,
        'password' => Hash::make('admin123456'),
       
        ]);
    }
}
