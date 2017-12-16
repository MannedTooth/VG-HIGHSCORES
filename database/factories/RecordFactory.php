<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'unit' => $faker->unique()->word,
        'time' => $faker->boolean,
        'reversed' => $faker->boolean,
    ];
});
