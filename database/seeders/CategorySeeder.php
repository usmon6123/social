<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name'=>'php', 'self_link' => 'php']);
        Category::create(['name'=>'java', 'self_link' => 'java']);
        Category::create(['name'=>'java script', 'self_link' => 'java script']);
        Category::create(['name'=>'c++', 'self_link' => 'c++']);
        Category::create(['name'=>'html', 'self_link' => 'html']);
        Category::create(['name'=>'css', 'self_link' => 'css']);
        Category::create(['name'=>'bootstrap', 'self_link' => 'bootstrap']);
        Category::create(['name'=>'jQuery', 'self_link' => 'jQuery']);
    }
}
