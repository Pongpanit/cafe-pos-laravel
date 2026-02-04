<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Coffee', 'Tea', 'Cold Drinks', 'Pastries'];
        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }
    }
}
