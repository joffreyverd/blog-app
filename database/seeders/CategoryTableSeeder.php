<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Economie']);
        Category::create(['name' => 'Politique']);
        Category::create(['name' => 'Art']);
        Category::create(['name' => 'Sport']);
        Category::create(['name' => 'Faits divers']);
    }
}
