<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        //dd($articles);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        //dd($request->validated());
        $val_data = $request->validated();
        $val_data['slug'] = Article::generateSlug($val_data['title']);
        //if the image file is there then save in storage/app/public/uploads_img
        if($request->hasFile('cover_image')) {
            $image_path = Storage::put('uploads_img', $request->cover_image);
            $val_data['cover_image'] = $image_path;
        }
        $article = Article::create($val_data);
        return redirect()->route('admin.articles.index')->with('message', "L'articolo $article->title è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Article::generateSlug($val_data['title']);
        if($request->hasFile('cover_image')) {
            // delete previous image if it exists
            if($article->cover_image) {
                Storage::delete($article->cover_image);
            }
            $image_path = Storage::put('uploads_img', $request->cover_image);
            $val_data['cover_image'] = $image_path;
        }
        $article->update($val_data);
        return redirect()->route('admin.articles.index')->with('message', "$article->title è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('message', "$article->title è stato eliminato");
    }
}
