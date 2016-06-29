<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Articles extends Controller
{
    public function __construct()
    {
        view()->share('active_articles', 'active');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = \App\Article::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.admin.articles', 15));


        $page = 'Статьи';

        return view('admin.article.index', compact('articles', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Adding the Article';
        $article = new Article();
        $article->resource_type = "youtube";
        $submit_text = "Add Article";

        return view('admin.article.add', compact('article', 'page', 'submit_text'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\Admin\ArticleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Admin\ArticleRequest $request)
    {
        $article = new Article();
        $article->fill($request->only('title', 'text', 'resource_type'));
        $response = $article->apply_resource('create', $request);

        if($response !== null)
            return $response;

        $article->save();

        return redirect()
            ->route('admin.article.index')
            ->with('success_message', 'Article was successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $page = 'Editing the Article';
        $page_second_title = $article->title;
        $submit_text = "Save Article";

        return view('admin.article.edit', compact('article', 'page', 'submit_text', 'page_second_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Admin\ArticleRequest $request, Article $article)
    {
        $article->fill($request->only('title', 'text', 'resource_type'));


        $response = $article->apply_resource('edit', $request);
        if($response !== null)
            return $response;

        $article->save();

        return redirect()->route('admin.article.index')->with('success_message', 'Articles was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        if($article->resource_type == 'image')
        {
            if(!starts_with($article->image, 'http'))
                unlink($article->image);
        }

        $article->delete();

        return redirect()->route('admin.article.index')->with('success_message', 'Articles was successfully deleted');

    }
}
