<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $data = [];

        $number_comments = ArticleComment::count();
        $number_article = Article::count();

        $data['number_comments'] = $number_comments;
        $data['number_article'] = $number_article;

        return view('admin.dashboard', $data);
    }
}
