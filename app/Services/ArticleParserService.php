<?php

namespace App\Services;

use Goutte\Client;
use App\Models\Article;
use App\Components\ContentPreparer;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class ArticleParserService
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * @var ContentPreparer
     */
    private ContentPreparer $contentPreparer;

    /**
     * @var string
     */
    private string $articleSelector = '.article__text';

    /**
     * @var string[]
     */
    private array $rssFeeds = ['http://static.feed.rbc.ru/rbc/logical/footer/news.rss'];

    /**
     * @var int
     */
    private int $itemsLimit = 15;

    /**
     * @param Client $client
     * @param ArticleService $articleService
     * @param ContentPreparer $contentPreparer
     */
    public function __construct(Client $client, ArticleService $articleService, ContentPreparer $contentPreparer)
    {
        $this->client = $client;
        $this->articleService = $articleService;
        $this->contentPreparer = $contentPreparer;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $feed = Feeds::make($this->rssFeeds, $this->itemsLimit);

        if ($feed->error()) {
            //logging

            return false;
        }

        foreach ($feed->get_items() as $item) {
            if ($this->articleService->getByGuid($item->get_id())) {
                continue;
            }

            $crawler = $this->client->request('GET', $item->get_permalink());

            if (!$crawler) {
                continue;
            }

            $article = $crawler->filter($this->articleSelector);

            Article::create([
                'guid' => $item->get_id(),
                'title' => $item->get_title(),
                'description' => $this->contentPreparer->description($article->text()),
                'content' => $this->contentPreparer->content($article->html()),
            ]);
        }

        return true;
    }
}
