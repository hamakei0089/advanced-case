<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepresentativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $param = [
            'name' => '代表太郎',
            'repid' => 'representative1',
            'password' => 'representative1',
        ];
        DB::table('representatives')->insert($param);

    $param = [
            'name' => '代表次郎',
            'repid' => 'representative2',
            'password' => 'representative2',
        ];
        DB::table('representatives')->insert($param);

    }
}
