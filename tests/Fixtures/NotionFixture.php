<?php

namespace Tests\Fixtures;

use App\Models\Notion;

class NotionFixture
{
	const notionFeature1 = [
		'title'          => 'Понятие. Какое-то новое',
		'text'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non suscipit nisi. Vestibulum posuere libero vel nulla posuere, a elementum libero varius. Aenean ultricies at elit sed facilisis. Maecenas dignissim nulla lorem, at elementum lorem condimentum tempus. Ut risus quam, fringilla nec metus et, mattis elementum tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent aliquam velit ac pulvinar facilisis.',
		'type'           => Notion::TYPE_DEFINITION,
		'poster'         => 'https://i.pinimg.com/564x/31/e6/5a/31e65ac78d31de8efe44cdf62f782367.jpg',
		'user_id'        => 1,
		'is_public'      => true,
		'level'          => 1,
	];
	
	const notionFeature2 = [
		'title'          => '111Старое понятие. Id 1',
		'text'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non suscipit nisi. Vestibulum posuere libero vel nulla posuere, a elementum libero varius. Aenean ultricies at elit sed facilisis. Maecenas dignissim nulla lorem, at elementum lorem condimentum tempus. Ut risus quam, fringilla nec metus et, mattis elementum tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent aliquam velit ac pulvinar facilisis.',
		'type'           => Notion::TYPE_CHARACTER,
		'poster'         => 'https://i.pinimg.com/564x/6e/9a/8a/6e9a8a013a31b94bd5a0df749256ec8e.jpg',
		'user_id'        => 1,
		'is_public'      => true,
		'level'          => 2,
		'tags'           => [1, 2, 3],
	];
}
