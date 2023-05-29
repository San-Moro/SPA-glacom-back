<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::all();
        return response()->json([
            'success' => true,
            'result' => $articles
        ]);
    }

    public function show($slug)
    {
        $article = Article::all()->where('slug', $slug)->first();
        if ($article) {
            return response()->json([
                'success' => true,
                'article' => $article,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Nessun Appartamento trovato",
            ]);
        }
    }
}
