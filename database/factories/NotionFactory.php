<?php

use App\Models\Notion;
use Faker\Generator as Faker;

$factory->define(Notion::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'text' => $faker->realText(500),
        'type' => $faker->word,
        'poster' => 'https://i.pinimg.com/564x/92/6b/fe/926bfec664ba55c4898538fb28ef93d0.jpg',
        'user_id' => 1,
    ];
});