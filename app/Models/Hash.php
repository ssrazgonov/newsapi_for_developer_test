<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    protected $table = "news_hashes";

    protected $fillable = [
        'news_hash', 'news_id'
    ];

    public function News() {
        return $this->belongsTo(News::class);
    }


}
