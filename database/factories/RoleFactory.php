<?php

use Faker\Generator as Faker;
use App\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement($roles = array ('admin','bar','kok')),
    ];
});
