<?php

use App\Models\LoreItem;
use Faker\Generator as Faker;

$factory->define(LoreItem::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'text' => $faker->realText(500),
        'poster' => $faker->imageUrl(),
        'user_id' => 1,
        'is_public' => (bool) random_int(0, 1),
    ];
});
