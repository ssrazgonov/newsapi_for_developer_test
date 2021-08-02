<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $newsService;

    public function __construct()
    {
        $this->newsService = new NewsService();
    }

    public function showAllNewsGroupByDate() {
        if ($news = $this->newsService->getAllNews(News::GROUP_BY_DATE)) {
            return response()->json([$news]);
        }

        return response()->json([], 404);
    }

    public function showAllNewsGroupByTheme() {
        if ($news = $this->newsService->getAllNews(News::GROUP_BY_THEME)) {
            return response()->json([$news]);
        }

        return response()->json([], 404);
    }

    public function showAllNewsGroupBySource() {
        if ($news = $this->newsService->getAllNews(News::GROUP_BY_SOURCE)) {
            return response()->json([$news]);
        }

        return response()->json([], 404);
    }
}
