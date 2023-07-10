<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\cms\auth\LoginController;
use App\Http\Controllers\cms\DashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleComment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get("/cms",[LoginController::class, 'showLoginForm'])->name('login');
Route::post("/login",[LoginController::class,'login']);
Route::get("/blog/post/{id}",[ArticleController::class, 'show'])->name('post');
Route::post("/blog/post/{id}/save-comment",[ArticleCommentController::class, 'store']);
Route::get("/blog/category/{id}",[ArticleCategoryController::class,'show'])->name('post_category');
// Route::get('blog/search', [SearchController::class,'index'])->name('blog.search');

Route::get('article', function () {
    return Article::with('category')->with('comments')->get();
});

Route::group([
    'prefix' => 'cms',
    'middleware' => []
], function () {
    Route::get("/logout",[LoginController::class,'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('article/category/create', [Article::class, 'create']);
    Route::get('article', [ArticleController::class, 'index'])->name('posts.index');
    Route::get('article/create', [ArticleController::class, 'create'])->name('posts.create');
    Route::post('article/store', [ArticleController::class, 'store'])->name('posts.store');
    Route::get('article/edit/{id}', [ArticleController::class, 'edit'])->name('posts.edit');
    Route::patch('article/update/{id}', [ArticleController::class, 'update'])->name('posts.update');
    Route::delete('article/delete/{id}', [ArticleController::class, 'destroy'])->name('posts.delete');
    Route::get('/comments',[ArticleCommentController::class,"index"])->name('admin.comments');
    Route::get('/comments/{id}/edit',[ArticleCommentController::class,"edit"])->name("admin.comments.edit");
    Route::patch('/comments/{id}',[ArticleCommentController::class,"update"])->name('admin.comments.update');
    Route::delete('/comments/{id}',[ArticleCommentController::class,"destroy"])->name('admin.comments.delete');
});
