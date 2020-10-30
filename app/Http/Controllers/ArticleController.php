<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Artisan;

class ArticleController extends Controller
{
    private const ARTICLES_PER_PAGE = 15;

    public function index()
    {
        $articles = Article::paginate(self::ARTICLES_PER_PAGE);

        return view('article.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        return view('article.show', ['article' => $article]);
    }

    public function parse()
    {
        Artisan::call('article:parse');

        return redirect()->route('article.index');
    }

    public function clean()
    {
        Artisan::call('article:clean');

        return redirect()->route('article.index');
    }
}
