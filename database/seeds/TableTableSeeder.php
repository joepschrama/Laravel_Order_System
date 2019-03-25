<?php

use Illuminate\Database\Seeder;

class TableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
            'table_nr' => '1',
            'amount_of_seats' => '6'
        ]);
    }
}
