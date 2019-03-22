<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([[
            'name' => 'Sport',
            'description' => 'Sport'
        ],[
            'name' => 'Zwierzęta',
            'description' => 'Animals'
        ],[
            'name' => 'Transport',
            'description' => 'Transport'
        ],[
            'name' => 'Jedzenie',
            'description' => 'Food'
        ]]);
    }
}
