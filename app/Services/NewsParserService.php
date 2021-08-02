<?php

namespace App\Services;

use App\Models\News;
use App\Models\Source;
use App\Models\Theme;
use Illuminate\Support\Facades\Log;


class NewsParserService
{
    private $newsApiClient;
    private $randomTheme;
    private $newsHttpResult;
    private $currentUrl;

    public function __construct()
    {
        $this->newsApiClient = new NewsApiClient();
        $this->randomTheme = Theme::all()->random(1)->first();
//        $this->randomTheme = 'Bitcoin';
    }

    /**
     * Получение новости со случайно заданной темой
     *
     */
    public function GetLatestNewsByRandomTheme() {
        Log::debug("Создан запрос на получение новости с темой: $this->randomTheme->theme_name");

        $this->newsHttpResult = $this->newsApiClient->getNewsByTheme($this->randomTheme->theme_name);

        Log::debug("Ответ получен: ");
        Log::debug($this->newsHttpResult);

        if (!$this->checkIfResultEmpty()) {
            Log::debug("По данной теме нет результата");
            return;
        }

        $this->currentUrl = $this->getCurrentUrl();

        if ($this->NewsExistInDB()) {
            return;
        }

        Log::debug('Создание записи');

        $this->createCurrentNews();
    }

    /**
     *
     */
    private function createCurrentNews() {
        if (!$this->newsHttpResult) return;

        $newNews = News::create([
            'news_title' => $this->newsHttpResult['articles'][0]['title'],
            'news_content' => $this->newsHttpResult['articles'][0]['content'],
            'news_url' => $this->newsHttpResult['articles'][0]['url'],
        ]);

        $newNews->theme()->associate($this->randomTheme->id)->save();

        if (array_key_exists('source', $this->newsHttpResult['articles'][0])
            && !empty($this->newsHttpResult['articles'][0]['source'])) {

            $source = Source::where("source_code", $this->newsHttpResult['articles'][0]["source"]["id"])->firstOrCreate([
                "source_name" => $this->newsHttpResult['articles'][0]["source"]["name"],
                "source_code" => $this->newsHttpResult['articles'][0]["source"]["id"] == null
                    ? $this->newsHttpResult['articles'][0]["source"]["name"]
                    : $this->newsHttpResult['articles'][0]["source"]["id"],
            ]);

            $newNews->source()->associate($source->id)->save();
        } else {
            Log::debug("Источник новости не указан");
        }
    }

    /**
     * @return bool
     */
    private function checkIfResultEmpty() {
        if ($this->newsHttpResult["totalResults"] > 0) return true;
        return false;
    }

    /**
     * @return mixed
     */
    private function getCurrentUrl() {
        if (!$this->newsHttpResult) return;
        return $this->newsHttpResult['articles'][0]['url'];
    }

    /**
     * @return bool
     */
    private function  NewsExistInDB() {
        Log::debug('Проверка существующей записи');

        $news = News::where('news_url', $this->currentUrl)->get()->toArray();

        if (empty($news)) {
            Log::debug("Данная новость готова к обработке");
            return false;
        }

        Log::debug("Данная новость уже существует");
        return true;
    }

}
