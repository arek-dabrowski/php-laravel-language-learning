<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'role_id' => 1,
            'name' => 'User',
            'email' => 'user@xx.cc',
            'password' => Hash::make('user')
        ],[
            'role_id' => 2,
            'name' => 'Editor',
            'email' => 'editor@xx.cc',
            'password' => Hash::make('editor')
        ],[
            'role_id' => 3,
            'name' => 'SuperEditor',
            'email' => 'supereditor@xx.cc',
            'password' => Hash::make('supereditor')
        ],[
            'role_id' => 10,
            'name' => 'Admin',
            'email' => 'admin@xx.cc',
            'password' => Hash::make('admin')
        ]]);
    }
}
