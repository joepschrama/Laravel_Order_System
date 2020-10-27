<?php

use Faker\Generator as Faker;
use App\UserRole;

$factory->define(UserRole::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween($min = 2, $max = 11),
        'role_id' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
