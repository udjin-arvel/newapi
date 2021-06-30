<?php

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $tag = $faker->word;
    
    return [
        'name' => $tag,
        'stem' => $tag,
        'user_id' => 1,
    ];
});
