<?php

use Illuminate\Database\Seeder;

class SetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sets')->insert([
            'user_id' => 2,
            'language1_id' => 1,
            'language2_id' => 2,
            'subcategory_id' => 1,
            'name' => 'Dyscypliny 1',
            'set' => 'hokej;ice hockey;golf;golf;szachy;chess;wspinaczka;climbing;narciarstwo;skiing;kolarstwo;cycling;żeglarstwo;sailing',
            'hidden' => 0
        ]);

        DB::table('sets')->insert([
            'user_id' => 3,
            'language1_id' => 1,
            'language2_id' => 2,
            'subcategory_id' => 1,
            'name' => 'Dyscypliny 2',
            'set' => 'koszykówka;basketball;piłka nożna;football;łucznictwo;archery;pływanie;swimming;nurkowanie;diving;skoki narciarskie;ski-jumping',
            'hidden' => 0
        ]);
    }
}
