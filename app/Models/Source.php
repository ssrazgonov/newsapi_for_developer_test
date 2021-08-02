<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'source_name', 'source_code',
    ];

    public function News() {
        return $this->hasMany(News::class);
    }
}
