<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ArticleParserService;

class ParseArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:articles';

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
        echo  $articleParserService->handle() ? 'Successfully completed!' : 'Command was interrupted. See log for details.';
    }
}
