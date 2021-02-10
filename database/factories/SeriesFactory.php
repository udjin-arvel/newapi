<?php

use App\Models\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->realText(500),
        'user_id' => 1,
        'era' => random_int(1, 7),
    ];
});
