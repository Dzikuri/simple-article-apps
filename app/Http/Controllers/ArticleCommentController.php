<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleCommentRequest;
use App\Http\Requests\UpdateArticleCommentRequest;
use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $model = ArticleComment::orderBy("created_at", "desc");
            return DataTables::of($model)
                // ->addColumn('actions', function ($model) use ($request) {
                //     $id = $model->id;
                //     $link = $request->url();
                //     //Edit Button
                //     $actionHtml = '<a href="'.$link.'/edit/'.$id.' " class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a>';
                //     //Delete Button
                //     $actionHtml .='<a href="'.$link.'/delete/'.$id.'" data-delete-url="'.$link.'/delete/'.$id.'" class="btn btn-danger btn-sm delete-data" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></a>';
                //     return $actionHtml;
                // })
                ->addColumn('article',function ($model) use ($request){
                    //Show Post title on which user has Commented
                    $actionHtml = $model->article->title;
                    return $actionHtml;
                })

                ->rawColumns(['actions','status'])
                ->make(true);
        }
    	return view('admin.comments.list');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleCommentRequest $request,$id)
    {
        $inputs = $request->all();

        $validate = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'comment' => 'required',
        ]);

        $post = Article::findOrFail($id);

        $comment  = new ArticleComment();
        $comment->fill($inputs);
        $comment->article_id = $post->id;
        $comment->save();

        return back()->with("success","Success! Your Comment will be live after verification by admin");
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleComment $articleComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleComment $articleComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleCommentRequest $request, ArticleComment $articleComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleComment $articleComment)
    {
        //
    }
}
