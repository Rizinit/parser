<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Components\ContentPreparer;

class ContentPreparerTest extends TestCase
{
    /**
     * @var ContentPreparer
     */
    private ContentPreparer $contentPreparer;

    /**
     * @return void
     */
    public function testDescription(): void
    {
        $string = 'test test test';

        $this->assertIsString($this->contentPreparer->description($string));

        $this->assertStringContainsString($string, $this->contentPreparer->description($string));

        $this->assertStringContainsString('test', $this->contentPreparer->description($string, 4));
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->contentPreparer = new ContentPreparer();
    }
}
