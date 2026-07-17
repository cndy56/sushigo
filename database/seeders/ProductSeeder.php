<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Nigiri (category_id: 1)
            [
                'category_id' => 1,
                'name'         => 'Salmon Nigiri',
                'slug'         => 'salmon-nigiri',
                'description'  => 'Nasi sushi dengan topping salmon segar premium.',
                'price'        => 25000,
                'stock'        => 50,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name'         => 'Tuna Nigiri',
                'slug'         => 'tuna-nigiri',
                'description'  => 'Nasi sushi dengan topping tuna merah segar.',
                'price'        => 28000,
                'stock'        => 50,
                'is_available' => true,
            ],
            // Maki Roll (category_id: 2)
            [
                'category_id' => 2,
                'name'         => 'California Roll',
                'slug'         => 'california-roll',
                'description'  => 'Maki roll dengan isian kepiting, alpukat, dan mentimun.',
                'price'        => 45000,
                'stock'        => 30,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name'         => 'Spicy Tuna Roll',
                'slug'         => 'spicy-tuna-roll',
                'description'  => 'Maki roll isi tuna dengan saus pedas yang menggugah selera.',
                'price'        => 48000,
                'stock'        => 30,
                'is_available' => true,
            ],
            // Sashimi (category_id: 3)
            [
                'category_id' => 3,
                'name'         => 'Salmon Sashimi',
                'slug'         => 'salmon-sashimi',
                'description'  => 'Irisan salmon premium tanpa nasi, segar dan lembut.',
                'price'        => 65000,
                'stock'        => 20,
                'is_available' => true,
            ],
            // Temaki (category_id: 4)
            [
                'category_id' => 4,
                'name'         => 'Ebi Temaki',
                'slug'         => 'ebi-temaki',
                'description'  => 'Kerucut nori dengan udang segar, alpukat, dan sayuran.',
                'price'        => 35000,
                'stock'        => 40,
                'is_available' => true,
            ],
            // Uramaki (category_id: 5)
            [
                'category_id' => 5,
                'name'         => 'Dragon Roll',
                'slug'         => 'dragon-roll',
                'description'  => 'Uramaki premium dengan topping alpukat dan udang tempura.',
                'price'        => 75000,
                'stock'        => 25,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name'         => 'Rainbow Roll',
                'slug'         => 'rainbow-roll',
                'description'  => 'Uramaki colorful dengan berbagai topping ikan segar.',
                'price'        => 80000,
                'stock'        => 25,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}