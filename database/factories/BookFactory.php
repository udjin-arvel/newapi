<?php

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->realText(500),
        'poster' => $faker->imageUrl(),
        'user_id' => 1,
        'era' => random_int(1, 7),
    ];
});
