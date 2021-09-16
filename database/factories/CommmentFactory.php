<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\Story;
use App\Models\User;
use Faker\Generator as Faker;

$usersIds = User::select('id')->get()->pluck('id')->toArray();

$factory->define(Comment::class, function (Faker $faker) use ($usersIds) {
	return [
		'text'         => $faker->realText(500),
		'parent_id'    => random_int(5, 10),
		'content_id'   => random_int(1, 2),
		'content_type' => Story::class,
		'user_id'      => $usersIds[random_int(0, count($usersIds) - 1)],
	];
});
