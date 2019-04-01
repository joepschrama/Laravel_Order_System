<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'served' => false,
            'time' => Carbon::now(),
            'done' => false,
            'table_id' => 1,
        ]);
    }
}
