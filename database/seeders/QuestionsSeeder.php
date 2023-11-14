<?php

namespace Database\Seeders;

use App\Models\Questions;
use Database\Factories\QuestionsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        Questions::factory()->count(10)->create();
    }
}

