<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->all();

        if (empty($categoryIds)) {
            return;
        }

        $products = [
            ['name' => 'Wireless Mouse', 'price' => 25.99],
            ['name' => 'Bluetooth Headset', 'price' => 79.50],
            ['name' => 'Gaming Keyboard', 'price' => 59.00],
            ['name' => 'USB-C Hub', 'price' => 42.75],
            ['name' => 'Portable SSD 1TB', 'price' => 109.99],
            ['name' => 'Smart Watch', 'price' => 149.00],
            ['name' => 'Laptop Cooling Pad', 'price' => 32.00],
            ['name' => 'Noise Cancelling Earbuds', 'price' => 89.00],
        ];

        foreach ($products as $index => $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'category_id' => $categoryIds[$index % count($categoryIds)],
                    'slug' => Str::slug($product['name']),
                    'price' => $product['price'],
                    'description' => $product['name'] . ' for daily and professional use.',
                    'status' => true,
                    'is_featured' => $index < 3,
                ]
            );
        }
    }
}
