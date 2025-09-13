<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'branch_id' => 1,
            'category_id' => 1,
            'name' => 'CC C Charity Tee',
            'cost' => 10.00,
            'price' => 18.00,
            'stock' => 50
        ]);

        Product::create([
            'branch_id' => 1,
            'category_id' => 1,
            'name' => 'PCWKR Naga Hoodie',
            'cost' => 30.00,
            'price' => 50.00,
            'stock' => 25
        ]);
    }
}
