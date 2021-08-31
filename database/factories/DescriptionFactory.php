<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Composition;
use App\Models\Description;
use App\Models\Notion;
use App\Models\Story;
use Faker\Generator as Faker;

$factory->define(Description::class, function (Faker $faker) {
	return [
		'title'        => $faker->word,
		'text'         => $faker->realText(500),
		'type'         => [Description::TYPE_CHARACTER, Description::TYPE_PLACE, Description::TYPE_PLOT][random_int(0, 2)],
		'content_id'   => random_int(1, 10),
		'content_type' => [Story::class, Composition::class, Notion::class][random_int(0, 2)],
		'user_id'      => 1,
		'importance'   => random_int(1, 10),
		'is_public'    => (bool) random_int(0, 1),
	];
});
