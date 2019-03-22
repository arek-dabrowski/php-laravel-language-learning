<?php

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([[
            'category_id' => 1,
            'name' => 'Dyscypliny',
            'description' => 'Disciplines'
        ],[
            'category_id' => 1,
            'name' => 'Piłka nożna',
            'description' => 'Football'
        ],[
            'category_id' => 2,
            'name' => 'Domowe',
            'description' => 'Pets'
        ],[
            'category_id' => 2,
            'name' => 'Podstawowe',
            'description' => 'Basic'
        ],[
            'category_id' => 3,
            'name' => 'Środki transportu',
            'description' => 'Means of transport'
        ],[
            'category_id' => 3,
            'name' => 'Samochód',
            'description' => 'Car'
        ],[
            'category_id' => 4,
            'name' => 'Owoce',
            'description' => 'Fruits'
        ],[
            'category_id' => 4,
            'name' => 'Warzywa',
            'description' => 'Vegetables'
        ]]);
    }
}
