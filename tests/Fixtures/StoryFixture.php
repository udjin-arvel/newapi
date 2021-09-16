<?php

namespace Tests\Fixtures;

class StoryFixture extends BaseFixture
{
	/**
	 * @var array
	 */
	protected $template = [
		'title'          => 'string',
		'chapter'        => 'number|5:30',
		'epigraph'       => 'text|100',
		'is_public'      => 'boolean',
		'composition_id' => 'id|composition',
		'user_id'        => 'id|user',
		'type'           => 'type|story',
		'tags'           => 'ids|tag|1:5',
		
		'fragments|3:15' => [
			'text'  => 'text|200',
			'order' => 'number|20',
		],
		
		'descriptions|1:5' => [
			'title'        => 'string',
			'type'         => 'type|description',
			'text'         => 'text|200',
			'content_id'   => 'id|story',
			'content_type' => 'class|story',
			'user_id'      => 'id|user',
			'is_public'    => 'boolean',
		],
	];
}
