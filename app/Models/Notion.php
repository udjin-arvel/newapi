<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Notion
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $tag_id
 * @property string $title
 * @property string $text
 * @property string $explanation
 * @property string $poster
 * @property int    $type
 */
class Notion extends AModel
{
    use SoftDeletes;
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            /**
             * @var Notion $model
             */
//            $model->tag_id = Tag::create([
//                'name'    => $tag = tagized($model->title),
//                'stem'    => $tag,
//                'user_id' => optional(Auth::user())->id ?? 1,
//            ])->id;
        });
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tag()
    {
        return $this->hasOne(Tag::class, 'id', 'tag_id');
    }
}
