<?php


namespace App\Services;


use App\Models\News;

class NewsService
{
    public function __construct()
    {
    }

    public function getAllNews($groupBy = null) {

        if ($groupBy == News::GROUP_BY_DATE) {
            return News::all()->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('d-M-y');
            });
        } elseif($groupBy == News::GROUP_BY_THEME) {
            return News::with('theme')->get()->groupBy(function ($query) {
                return $query->theme->theme_name;
            });
        } elseif($groupBy == News::GROUP_BY_SOURCE) {
            return News::with('source')->get()->groupBy(function ($query) {
                return $query->source->source_name;
            });
        }
    }
}
