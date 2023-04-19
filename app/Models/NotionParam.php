<?php

namespace App\Models;

/**
 * Class NotionParam
 * @package App\Models
 *
 * @property string $title
 * @property string $value
 * @property int    $order
 * @property int    $notion_id
 */
class NotionParam extends BaseModel
{
    protected $fillable = [
        'title',
        'value',
        'order',
        'notion_id',
    ];

    /**
     * Композиция, которой принадлежит история.
     */
    public function notion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Notion::class);
    }
}
