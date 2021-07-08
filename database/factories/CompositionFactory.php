<?php

use App\Models\Composition;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Composition::class, function (Faker $faker) {
    return [
        'user_id'     => optional(User::first())->id,
        'title'       => $faker->word,
        'description' => $faker->realText(500),
        'poster'      => 'https://i.pinimg.com/564x/2e/e3/e0/2ee3e0d384bb431d2c9b54c30ad0b2e1.jpg',
        'era'         => random_int(1, 7),
        'type'        => random_int(0, 1) ? Composition::TYPE_BOOK : Composition::TYPE_SERIES,
    ];
});
