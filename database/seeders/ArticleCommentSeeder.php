<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleComment::factory(10)
            ->sequence(fn (Sequence $sequence) => [
                'article_id' => Article::all()->random()->id,
                // 'user_id' => User::all()->random()->id,
            ])
            ->create();
    }
}
