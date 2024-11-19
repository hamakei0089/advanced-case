<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $param = [
            'name' => '管理太郎',
            'userid' => 'administrator1',
            'password' => Hash::make('administrator1'),
        ];
        DB::table('administrators')->insert($param);

    $param = [
            'name' => '管理次郎',
            'userid' => 'administrator2',
            'password' => Hash::make('administrator2'),
        ];
        DB::table('administrators')->insert($param);

    }
}
