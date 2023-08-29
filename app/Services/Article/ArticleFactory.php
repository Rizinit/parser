<?php

namespace App\Services\Article;

use App\Models\Article;
use Illuminate\Database\QueryException;

class ArticleFactory
{
    /**
     * @param string $guid
     * @param string $title
     * @param string $description
     * @param string $content
     * @return Article|null
     */
    public function create(string $guid, string $title, string $description, string $content): ?Article
    {
        try {
            return Article::create([
                'guid' => $guid,
                'title' => $title,
                'description' => $description,
                'content' => $content,
            ]);
        } catch (QueryException) {
            return null;
        }
    }
}
