<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Movie (HUN)']);
        Category::create(['name' => 'Movie (ENG)']);
        Category::create(['name' => 'Series (HUN)']);
        Category::create(['name' => 'Series (ENG)']);
        Category::create(['name' => 'Music']);
        Category::create(['name' => 'Game']);
        Category::create(['name' => 'Program']);
        Category::create(['name' => 'E-book (HUN)']);
        Category::create(['name' => 'E-book (ENG)']);
    }
}
