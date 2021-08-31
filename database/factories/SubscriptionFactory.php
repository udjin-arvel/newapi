<?php

use App\Models\Subscription;

$factory->define(Subscription::class, function () {
	$type      = [
		Subscription::TYPE_USER,
		Subscription::TYPE_NOTION,
		Subscription::TYPE_LORE_ITEM,
		Subscription::TYPE_COMPOSITION
	][random_int(0, 3)];
	$contentId = $type === Subscription::TYPE_COMPOSITION ? random_int(1, 10) : null;
	return [
		'content_id' => $contentId,
		'type'       => $type,
		'user_id'    => 1,
	];
});
