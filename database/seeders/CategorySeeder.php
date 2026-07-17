<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Nigiri',
                'slug'        => 'nigiri',
                'description' => 'Sushi nasi dengan topping ikan segar pilihan',
            ],
            [
                'name'        => 'Maki Roll',
                'slug'        => 'maki-roll',
                'description' => 'Sushi gulung klasik dengan nori di luar',
            ],
            [
                'name'        => 'Sashimi',
                'slug'        => 'sashimi',
                'description' => 'Irisan ikan segar premium tanpa nasi',
            ],
            [
                'name'        => 'Temaki',
                'slug'        => 'temaki',
                'description' => 'Sushi kerucut buatan tangan yang renyah',
            ],
            [
                'name'        => 'Uramaki',
                'slug'        => 'uramaki',
                'description' => 'Sushi gulung dengan nasi di bagian luar',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}