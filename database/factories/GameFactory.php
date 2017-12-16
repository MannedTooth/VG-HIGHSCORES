<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'nickname' => $faker->unique()->lexify('????'),
    ];
});
