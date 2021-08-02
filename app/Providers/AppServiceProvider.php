<?php

namespace App\Providers;

use App\Services\NewsApiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind(NewsApiClient::class, function ($app) {
//            return new NewsApiClient();
//        });
    }
}
