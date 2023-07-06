<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory(10)
            ->sequence(fn (Sequence $sequence) => [
                'category_id' => ArticleCategory::all()->random()->id,
                'user_id' => User::all()->random()->id,
            ])
            ->create();
    }
}
