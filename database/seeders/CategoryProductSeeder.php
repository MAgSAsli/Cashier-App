<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Minuman' => [
                ['name' => 'Aqua 600ml', 'code' => 'MNM001', 'price' => 3000, 'stock' => 100],
                ['name' => 'Teh Botol Sosro', 'code' => 'MNM002', 'price' => 5000, 'stock' => 80],
                ['name' => 'Coca Cola 330ml', 'code' => 'MNM003', 'price' => 7000, 'stock' => 60],
                ['name' => 'Kopi Kapal Api', 'code' => 'MNM004', 'price' => 4000, 'stock' => 50],
                ['name' => 'Susu Ultra 250ml', 'code' => 'MNM005', 'price' => 6000, 'stock' => 70],
            ],
            'Makanan' => [
                ['name' => 'Indomie Goreng', 'code' => 'MKN001', 'price' => 3500, 'stock' => 150],
                ['name' => 'Chitato 68g', 'code' => 'MKN002', 'price' => 10000, 'stock' => 40],
                ['name' => 'Oreo Original', 'code' => 'MKN003', 'price' => 8000, 'stock' => 55],
                ['name' => 'Roti Tawar Sari Roti', 'code' => 'MKN004', 'price' => 15000, 'stock' => 30],
                ['name' => 'Biskuit Roma', 'code' => 'MKN005', 'price' => 6000, 'stock' => 60],
            ],
            'Kebersihan' => [
                ['name' => 'Sabun Lifebuoy', 'code' => 'KBR001', 'price' => 5000, 'stock' => 45],
                ['name' => 'Shampo Pantene 170ml', 'code' => 'KBR002', 'price' => 18000, 'stock' => 30],
                ['name' => 'Pasta Gigi Pepsodent', 'code' => 'KBR003', 'price' => 12000, 'stock' => 40],
                ['name' => 'Deterjen Rinso 800g', 'code' => 'KBR004', 'price' => 22000, 'stock' => 25],
            ],
            'Rokok' => [
                ['name' => 'Gudang Garam Merah', 'code' => 'RKK001', 'price' => 25000, 'stock' => 50],
                ['name' => 'Sampoerna Mild', 'code' => 'RKK002', 'price' => 28000, 'stock' => 50],
                ['name' => 'Djarum Super', 'code' => 'RKK003', 'price' => 24000, 'stock' => 40],
            ],
            'Alat Tulis' => [
                ['name' => 'Pulpen Pilot', 'code' => 'ATK001', 'price' => 5000, 'stock' => 80],
                ['name' => 'Buku Tulis Sidu', 'code' => 'ATK002', 'price' => 4000, 'stock' => 100],
                ['name' => 'Pensil 2B Faber', 'code' => 'ATK003', 'price' => 3000, 'stock' => 90],
            ],
        ];

        foreach ($data as $categoryName => $products) {
            $category = Category::create(['name' => $categoryName]);
            foreach ($products as $product) {
                Product::create(array_merge($product, ['category_id' => $category->id]));
            }
        }
    }
}
