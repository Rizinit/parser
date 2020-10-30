<?php

namespace App\Services\Article;

use App\Models\Article;
use App\Components\Parser\ContentPreparer;

class ArticleFactory
{
    /** @var ContentPreparer */
    private ContentPreparer $contentPreparer;

    /**
     * @param ContentPreparer $contentPreparer
     */
    public function __construct(ContentPreparer $contentPreparer)
    {
        $this->contentPreparer = $contentPreparer;
    }

    /**
     * @param string $guid
     * @param string $title
     * @param string $description
     * @param string $content
     * @return Article|null
     */
    public function create(string $guid, string $title, string $description, string $content)
    {
        try {
            return Article::create([
                'guid' => $guid,
                'title' => $title,
                'description' => $this->contentPreparer->description($description),
                'content' => $this->contentPreparer->content($content),
            ]);
        } catch (\Exception $exception) {
            return null;
        }
    }
}
