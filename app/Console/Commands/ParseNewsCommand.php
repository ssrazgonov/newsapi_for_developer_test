<?php

namespace App\Console\Commands;

use App\Jobs\ParseNewsByRandomThemeJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class ParseNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts jobs for parsing news';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Queue::push(new ParseNewsByRandomThemeJob());
    }
}
