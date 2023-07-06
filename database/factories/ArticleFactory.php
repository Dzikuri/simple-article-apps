<?php

namespace Database\Factories;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->realText(200),
            'is_draft' => false,
            'featured_image' => '/uploads/article/colour-math-function-1170167.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
