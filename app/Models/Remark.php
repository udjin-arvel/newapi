<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Remark
 * @package App\Models
 *
 * @property string $text
 * @property int    $importance
 * @property int    $content_id
 * @property string $content_type
 */
class Remark extends Model
{
    /**
     * Типы примечаний
     */
    const TYPES = [
        'story'       => Story::class,
        'notion'      => Notion::class,
        'loreitem'    => LoreItem::class,
        'composition' => Composition::class,
    ];
}
