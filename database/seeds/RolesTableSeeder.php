<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roles = factory(Role::class, 3)->create();
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'kok',
        ]);
        DB::table('roles')->insert([
            'name' => 'bar',
        ]);
        DB::table('roles')->insert([
            'name' => 'ober',
        ]);
    }
}
