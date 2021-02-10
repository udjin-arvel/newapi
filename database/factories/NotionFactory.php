<?php

use App\Models\Notion;
use Faker\Generator as Faker;

$factory->define(Notion::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'text' => $faker->realText(500),
        'type' => $faker->word,
        'poster' => $faker->imageUrl(),
        'user_id' => 1,
    ];
});