<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'theme_name', 'theme_code',
    ];

    const BitcoinCode = 'bitcoin';
    const LitecoinCode = 'litecoin';
    const RippleCode = 'ripple';
    const DashCode = 'dash';
    const EthereumCode = 'ethereum';

    private static $staticThemes = [
        'Bitcoin' => [
            'theme_name' => 'Bitcoin',
            'theme_code' => 'bitcoin'
        ],
        'Litecoin' => [
            'theme_name' => 'Litecoin',
            'theme_code' => 'litecoin'
        ],
        'Ripple' => [
            'theme_name' => 'Ripple',
            'theme_code' => 'ripple'
        ],
        'Dash' => [
            'theme_name' => 'Dash',
            'theme_code' => 'dash'
        ],
        'Ethereum' => [
            'theme_name' => 'Ethereum',
            'theme_code' => 'ethereum'
        ]
    ];

    public static function GetStaticThemes() {
        return self::$staticThemes;
    }

    public function News() {
        return $this->hasMany(News::class);
    }
}
