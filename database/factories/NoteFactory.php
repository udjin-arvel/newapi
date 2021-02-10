<?php

use App\Models\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'text' => $faker->realText(500),
        'importance' => random_int(1, 10),
        'user_id' => 1,
    ];
});
