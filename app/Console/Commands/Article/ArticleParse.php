<?php

namespace App\Console\Commands\Article;

use Illuminate\Console\Command;
use App\Services\Article\ArticleParserService;

class ArticleParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param ArticleParserService $articleParserService
     * @return void
     */
    public function handle(ArticleParserService $articleParserService)
    {
        if ($articleParserService->parse()) {
            $this->info('Successfully completed!');
        } else {
            $this->error('Command was interrupted. See log for details.');
        }
    }
}
