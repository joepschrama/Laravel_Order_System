<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'kok',
            'email' => 'kok@kok.com',
            'password' => bcrypt('kok'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'bar',
            'email' => 'bar@bar.com',
            'password' => bcrypt('bar'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ober',
            'email' => 'ober@ober.com',
            'password' => bcrypt('ober'),
        ]);

        $users = factory(User::class, 10)->create();
    }
}
