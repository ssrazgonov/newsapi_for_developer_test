<?php

namespace App\Jobs;

use App\Models\Theme;
use App\Services\NewsApiClient;
use App\Services\NewsParserService;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class ParseNewsByRandomThemeJob extends Job implements ShouldBeUnique
{
    private  $newsManager;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @param NewsParserService $newsManager
     * @return void
     */
    public function handle(NewsParserService $newsManager)
    {
        $newsManager->GetLatestNewsByRandomTheme();
    }
}
