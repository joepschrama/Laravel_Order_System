<?php

use Illuminate\Database\Seeder;
use App\UserRole;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
        
        DB::table('user_roles')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);
        
        DB::table('user_roles')->insert([
            'user_id' => 3,
            'role_id' => 3,
        ]);
        
        DB::table('user_roles')->insert([
            'user_id' => 4,
            'role_id' => 4,
        ]);
        
        $userRoles = factory(UserRole::class, 7)->create();
    }
}
