<?php

namespace App\Services\Article;

use SimplePie;
use Goutte\Client;
use Illuminate\Support\Facades\Log;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class ArticleParserService
{
    /** @var Client */
    private Client $client;

    /** @var ArticleService */
    private ArticleService $articleService;

    /** @var string */
    private string $articleSelector = '.article__text';

    /** @var string[] */
    private array $rssFeeds = ['http://static.feed.rbc.ru/rbc/logical/footer/news.rss'];

    /** @var int */
    private int $itemsLimit = 15;

    /**
     * @param Client $client
     * @param ArticleService $articleService
     */
    public function __construct(Client $client, ArticleService $articleService)
    {
        $this->client = $client;
        $this->articleService = $articleService;
    }

    /**
     * @return bool
     */
    public function parse(): bool
    {
        /** @var SimplePie $feed */
        $feed = Feeds::make($this->rssFeeds, $this->itemsLimit);

        $errors = $feed->error();

        if (!empty($errors)) {
            $message = is_string($errors) ? $errors : json_encode($errors);

            Log::error($message);

            return false;
        }

        foreach ($feed->get_items() as $item) {
            $articleModel = $this->articleService->getByGuid($item->get_id());

            if ($articleModel) {
                continue;
            }

            $crawler = $this->client->request('GET', $item->get_permalink());

            $article = $crawler->filter($this->articleSelector);

            $this->articleService->create($item, $article);
        }

        return true;
    }
}
