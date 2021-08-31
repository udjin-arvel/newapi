<?php

namespace Tests\Fixtures;

use App\Models\Story;

class StoryFixture
{
    const storyFeature1 = [
        'id'             => null,
        'title'          => 'Новая история',
        'chapter'        => 2,
        'epigraph'       => 'Какой-то эпиграф',
        'is_public'   => true,
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

    const storyFeature2 = [
        'title'          => 'Новая история',
        'chapter'        => 2,
        'epigraph'       => 'Какой-то эпиграф',
        'is_public'   => true,
        'composition_id' => 1,
        'user_id'        => 1,
        'type'           => Story::TYPE_STORY,
        'fragments' => [
            [
                'text'  => 'Фрагмент 1',
                'order' => 1,
            ],
            [
                'text'  => 'Фрагмент 2',
                'order' => 2,
            ],
        ],
    
        'tags' => [
            1,
            20,
        ],
    ];
}
