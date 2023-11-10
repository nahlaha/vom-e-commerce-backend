<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Seed the languages
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            ['id' => 1, 'name' => 'en'],
            ['id' => 2, 'name' => 'ar'],
        ]);
    }
}
