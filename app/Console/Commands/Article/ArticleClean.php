<?php

namespace App\Console\Commands\Article;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArticleClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean articles';

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
     * @return void
     */
    public function handle(): void
    {
        $table = app(Article::class)->getTable();

        DB::table($table)->truncate();

        $this->info('Successfully completed!');
    }
}
