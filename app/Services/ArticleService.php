<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
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
