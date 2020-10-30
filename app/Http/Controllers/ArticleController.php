<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    private const ARTICLES_PER_PAGE = 15;

    public function index()
    {
        return view('article.index', ['articles' => Article::paginate(self::ARTICLES_PER_PAGE)]);
    }

    public function show(int $id)
    {
        return view('article.show', ['article' => Article::findOrFail($id)]);
    }
}
