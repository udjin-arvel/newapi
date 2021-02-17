<?php

use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'book_id'   => random_int(1, 10),
        'series_id' => random_int(1, 10),
        'user_id'   => random_int(1, 2),
    ];
});
