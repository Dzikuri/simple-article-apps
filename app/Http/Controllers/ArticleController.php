<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $model = Article::query();
            return DataTables::of($model)
                ->addColumn('status',function ($model) use ($request){
                    $statusHtml = ($model->active) ? '<span class="label label-success">Active</span>' :'<span class="label label-danger">Deactivated</span>';
                    return $statusHtml;
                })

                ->addColumn('actions', function ($model) use ($request) {
                    $id = $model->id;
                    $link = $request->url();
                    //Edit Button
                    $actionHtml = '<a href="'.$link.'/edit/'.$id.' " class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a>';
                    //Delete Button
                    $actionHtml .='<a href="'.$link.'/delete/'.$id.'" data-delete-url="'.$link.'/delete/'.$id.'" class="btn btn-danger btn-sm delete-data" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></a>';

                    return $actionHtml;
                })
                ->rawColumns(['actions','status'])
                ->make(true);
        }
        return view('admin.posts.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array();
        //Get key value pair data from categories table for populating in dropdown:
        $categories = ArticleCategory::pluck("title","id");
        $data['post_tags'] = array();
        $data['categories'] = $categories;
        return view("admin.posts.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'is_draft' => 'required',
            'category_id'=>'required|numeric',
            'featured_image'=>'required'
        ]);
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['slug'] = Str::slug($inputs['title'], '-');


        if($inputs['featured_image'])
        {
            $image_path = uploadWithThumb($inputs['featured_image'],'article');
            $inputs['featured_image'] = $image_path;
        }


        Article::create($inputs);
        $request->session()->flash('success', 'Post Successfull!');

        return redirect("cms/article");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article,$id)
    {
        $posts = Article::where('id',$id)->with('category')->with('comments')->first();
        $data['post'] = $posts;
		return view("blog.post", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = array();
        $post = Article::where('id',$id)->first();

        $data['post'] = $post;
        $data['categories'] = ArticleCategory::pluck("title","id");

        return view("admin.posts.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'is_draft' => 'required',
            'category_id'=>'required|numeric',

        ]);

        $inputs = $request->only(['title','content','is_draft','category_id']);


        $inputs['title'] = Str::slug($inputs['title'], '-');
        if($request->hasFile('featured_image'))
        {
            $image_path = uploadWithThumb($inputs['featured_image'],'images/blog');
            $inputs['featured_image'] = $image_path;
        }
        Article::where('id', $id)->update($inputs);
        \Session::flash('success','Post Updated Successfully');
        return redirect(url('cms/article'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Article::where("id",$id)->delete();
        \Session::flash('info','Post deleted Successfully');
        return redirect(url('cms/article'));
    }
}
