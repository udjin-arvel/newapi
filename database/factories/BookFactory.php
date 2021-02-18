<?php

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->realText(500),
        'poster' => 'https://i.pinimg.com/564x/2e/e3/e0/2ee3e0d384bb431d2c9b54c30ad0b2e1.jpg',
        'user_id' => 1,
        'era' => random_int(1, 7),
    ];
});
