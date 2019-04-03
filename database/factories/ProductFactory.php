<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => '9.99',
        'description' => $faker->text,
        'ingredients' => $faker->text,
        'category_id' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
