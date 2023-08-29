<?php

namespace App\Services\Article;

use SimplePie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class ArticleParserService
{
    private const SELECTOR = '.col-content p:not([class])';
    private const RSS_FEEDS = ['https://www.ceskenoviny.cz/sluzby/rss/zpravy.php'];
    private const ITEMS_LIMIT = 15;

    public function __construct(private ArticleService $articleService)
    {
    }

    public function parse(): bool
    {
        /** @var SimplePie $feed */
        $feed = Feeds::make(self::RSS_FEEDS, self::ITEMS_LIMIT);

        $errors = $feed->error();

        if (!empty($errors)) {
            $message = is_string($errors) ? $errors : json_encode($errors);

            Log::error($message);

            return false;
        }

        $client = new HttpBrowser(HttpClient::create());

        foreach ($feed->get_items() as $item) {
            $article = $this->articleService->getByGuid($item->get_id());

            if ($article) {
                continue;
            }

            $crawler = $client->request('GET', $item->get_permalink());

            $texts = $crawler->filter(self::SELECTOR)->each(fn($node) => sprintf('<p>%s</p>', $node->text()));

            $this->articleService->create($item, implode($texts));
        }

        return true;
    }
}
