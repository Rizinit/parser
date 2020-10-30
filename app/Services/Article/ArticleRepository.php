<?php

namespace App\Services\Article;

use App\Models\Article;

class ArticleRepository
{
    /**
     * @param string $guid
     * @return mixed
     */
    public function getByGuid(string $guid)
    {
        return Article::where('guid', $guid)->first();
    }
}
