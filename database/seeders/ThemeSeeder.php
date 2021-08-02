<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themesForSeed = Theme::GetStaticThemes();

        foreach ($themesForSeed as $theme) {
            Theme::create($theme);
        }

    }
}
