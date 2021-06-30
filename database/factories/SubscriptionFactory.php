<?php

use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'subscription_id'   => random_int(1, 10),
        'subscription_type' => Subscription::TYPE_STORY,
        'user_id'           => 1,
    ];
});
