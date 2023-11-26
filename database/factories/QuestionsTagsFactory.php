<?php

namespace Database\Factories;

use App\Helper\mHelper;
use App\Models\Questions;
use App\Models\QuestionsTags;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuestionsTagsFactory extends Factory
{
    protected $model = QuestionsTags::class;

    public function definition(): array
    {
        $count = Questions::all()->count();
        $name =   $this->faker->name();
        $self_link = mHelper::permalink($name);
        return [
            'question_id' => rand(1,$count),
            'name' => $name,
            'self_link' => $self_link,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
