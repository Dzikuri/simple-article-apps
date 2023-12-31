<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleCategoryRequest $request)
    {
        // NOTE Validate The request input
        $validated = $request->validate();
        $validated = $request->safe()->only(['title']);

        // NOTE Store Data to database
        // $article = ArticleCategory::create([
        //     'title' => $validated->
        // ]);

        dd($validated);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category  = ArticleCategory::findOrFail($id);
    	$posts = Article::where('category_id',$id)->where('is_draft', false)->paginate(10);
    	$data['category'] = $category;
    	$data['posts'] = $posts;
        // dd($data);
    	return view('blog.category',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        //
    }
}
