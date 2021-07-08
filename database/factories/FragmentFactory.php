<?php

use App\Models\Fragment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Fragment::class, function (Faker $faker) {
    return [
        'text'     => $faker->realText(1000),
        'order'    => random_int(0, 50),
        'story_id' => random_int(1, 20),
    ];
});
