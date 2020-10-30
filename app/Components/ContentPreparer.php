<?php

namespace App\Components;

use Illuminate\Support\Str;

class ContentPreparer
{
    private const DEFAULT_TEXT_LIMIT = 200;

    /**
     * @param string $text
     * @param int|null $textLimit
     * @return string
     */
    public function description(string $text, int $textLimit = null): string
    {
        return Str::limit(trim(strip_tags($text)), $textLimit ?: self::DEFAULT_TEXT_LIMIT);
    }

    /**
     * @param string $html
     * @return string
     */
    public function content(string $html): string
    {
        return preg_replace('/\s\s+/', ' ', trim(clean($html)));
    }
}
