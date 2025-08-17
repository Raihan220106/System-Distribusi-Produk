<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        foreach (['Espresso','Latte','Cappuccino','Mocha','Americano'] as $p) {
            Product::create([
            'name' => $p,
            'price' => rand(10000,30000),
            'active' => true,
        ]);

        }
    }
}
