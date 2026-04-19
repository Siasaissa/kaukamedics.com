<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Stethoscope', 'price' => 30000, 'image' => 'team-1.png'],
            ['name' => 'Blood Pressure Monitor', 'price' => 50000, 'image' => 'team-2.png'],
            ['name' => 'Thermometer', 'price' => 10000, 'image' => 'team-3.png'],
            ['name' => 'Syringe Set', 'price' => 8000, 'image' => 'team-4.png'],
            ['name' => 'Oxygen Mask', 'price' => 15000, 'image' => 'team-5.png'],
            ['name' => 'Surgical Gloves', 'price' => 5000, 'image' => 'team-6.png'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
