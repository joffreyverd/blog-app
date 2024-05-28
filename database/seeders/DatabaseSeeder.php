<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Martine',
            'email' => 'martine@lesportecles.com',
        ]);
        $this->call([CategoryTableSeeder::class]);
        Article::factory(250)->create();
    }
}
