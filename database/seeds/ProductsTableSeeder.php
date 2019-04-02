<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Tomatensoep',
            'price' => '12.99',
            'description' => 'Romige tomatensoep met balletjes en een broodplankje',
            'ingredients' => 'Tomaat',
            'category_id' => '1',
        ]);
    }
}
