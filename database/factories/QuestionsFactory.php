<?php

namespace Database\Factories;

use App\Helper\mHelper;
use App\Models\Questions;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuestionsFactory extends Factory
{
    protected $model = Questions::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(5);
        return [
            'user_id' => 1,
            'title' => $title,
            'self_link' => mHelper::permalink($title),
            'text' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

