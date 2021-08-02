<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    const GROUP_BY_DATE = 'created_at';
    const GROUP_BY_THEME = 'theme';
    const GROUP_BY_SOURCE = 'source';

    protected $fillable = [
        'news_content', 'news_url', 'news_title', 'source_id', 'theme_id'
    ];

    public function Theme() {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }

    public function Source() {
        return $this->belongsTo(Source::class, 'source_id', 'id');
    }
}
