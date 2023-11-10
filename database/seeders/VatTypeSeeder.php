<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vat_types')->insert([
            ['id' => 1, 'name' => 'included'],
            ['id' => 2, 'name' => 'percentage'],
            ['id' => 3, 'name' => 'fixed'],
        ]);
    }
}
