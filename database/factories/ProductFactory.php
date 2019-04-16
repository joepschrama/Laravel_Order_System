<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    $faker = \Faker\Factory::create();
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        'name' => $faker->foodName(),
        'price' => '9.99',
        'description' => 'Eten',
        'ingredients' => $faker->vegetableName(),
        'category_id' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
