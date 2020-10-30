<?php

namespace App\Services\Article;

use SimplePie_Item;
use App\Models\Article;
use Symfony\Component\DomCrawler\Crawler;

class ArticleService
{
    private ArticleFactory $articleFactory;

    private ArticleRepository $articleRepository;

    /**
     * @param ArticleFactory $articleFactory
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleFactory $articleFactory, ArticleRepository $articleRepository)
    {
        $this->articleFactory = $articleFactory;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param string $guid
     * @return mixed
     */
    public function getByGuid(string $guid)
    {
        return $this->articleRepository->getByGuid($guid);
    }

    /**
     * @param SimplePie_Item $item
     * @param Crawler $article
     * @return Article|null
     */
    public function create(SimplePie_Item $item, Crawler $article)
    {
        return $this->articleFactory->create(
            $item->get_id(),
            $item->get_title(),
            $article->text(),
            $article->html()
        );
    }
}
