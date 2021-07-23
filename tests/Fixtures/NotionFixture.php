<?php

namespace Tests\Fixtures;

use App\Models\Story;

class NotionFixture
{
    public const notionFeature1 = [
        'id'             => null,
        'title'          => 'Новая история',
        'chapter'        => 2,
        'epigraph'       => 'Какой-то эпиграф',
        'is_published'   => true,
        'composition_id' => null,
        'user_id'        => 1,
        'type'           => Story::TYPE_STORY,
        'fragments'      => [
            [
                'text'  => 'Фрагмент 1',
                'order' => 1,
            ],
            [
                'text'  => 'Фрагмент 2',
                'order' => 2,
            ],
        ],
    ];
}
