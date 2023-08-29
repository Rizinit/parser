<?php

namespace App\Services\Article;

use SimplePie\Item;
use App\Models\Article;

class ArticleService
{
    public function __construct(private ArticleFactory $articleFactory, private ArticleRepository $articleRepository)
    {
    }

    public function getByGuid(string $guid): mixed
    {
        return $this->articleRepository->getByGuid($guid);
    }

    public function create(Item $item, string $content): ?Article
    {
        return $this->articleFactory->create(
            $item->get_id(),
            $item->get_title(),
            $item->get_description(),
            $content,
        );
    }
}
