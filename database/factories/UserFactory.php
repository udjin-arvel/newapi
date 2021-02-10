<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'demo',
        'email' => 'demo@demo.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$JKF2F61vUNyL.v0T4OkGY.YhD5kXxCowjiI0B/GECQEGS7hmoQAuq', // 1111
        'remember_token' => Str::random(10),
    ];
});
