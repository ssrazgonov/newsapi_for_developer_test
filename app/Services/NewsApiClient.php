<?php


namespace App\Services;


use http\Client;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsApiClient
{

    private $key;
    private $url;

    private  $client;

    /**
     * NewsApiClient constructor.
     */
    public function __construct()
    {
        $this->key = config('services.news_api_key');
        $this->url = config('services.news_api_url');

        Log::debug('Create News API client ' . $this->key);
    }

    /**
     * @param $theme
     */
    public function getNewsByTheme($theme) {


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->key,
        ])->get($this->url . 'everything/', [
            'q' => $theme,
            'pageSize' => 1
        ]);

        return $response->json();
    }
}
