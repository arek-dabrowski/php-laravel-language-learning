<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([[
            'id' => 1,
            'name' => 'użytkownik',
            'description' => 'Istota ludzka'
        ],[
            'id' => 2,
            'name' => 'redaktor',
            'description' => 'Kilka dodatkowych opcji'
        ],[
            'id' => 3,
            'name' => 'superredaktor',
            'description' => 'Jeszcze więcej opcji'
        ],[
            'id' => 10,
            'name' => 'administrator',
            'description' => 'Bóg'
        ]]);
    }
}
