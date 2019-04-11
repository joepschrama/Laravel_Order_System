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
        DB::table('categories')->insert([
            'name' => 'Voorgerecht',
        ]);
        DB::table('categories')->insert([
            'name' => 'Hoofdgerecht',
        ]);
        DB::table('categories')->insert([
            'name' => 'Desert',
        ]);
        DB::table('categories')->insert([
            'name' => 'Dranken',
        ]);
    }
}
