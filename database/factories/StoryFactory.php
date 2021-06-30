<?php

use App\Models\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'eon' => random_int(1, 7),
        'epigraph' => Str::random(50),
        'is_published' => (bool) random_int(0, 1),
        'user_id' => 1,
        'composition_id' => random_int(1, 10) > 7 ? random_int(1, 10) : null,
        'chapter' => random_int(1, 10) > 5 ? random_int(1, 50) : null,
    ];
});
