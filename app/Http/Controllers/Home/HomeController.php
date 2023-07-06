<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show home page
     *
     *
     * @return view
     */
    public function index()
    {

    	$data = array();
        $data['recent_posts'] = Article::OrderBy('created_at', 'Desc')->where('is_draft', false)->limit(6)->get();
        $data['post_categories'] = ArticleCategory::latest()->limit(25)->get();
        // $data['tags'] =  TagsModel::has('posts')->get();
        // $data['featured_posts'] = PostsModel::where('featured_post', '1')->get();
    	return view('home',$data);
    }
}
