<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'henk',
            'email' => 'henk@gmail.com',
            'password' => bcrypt('henk'),
        ]);
    }
}
