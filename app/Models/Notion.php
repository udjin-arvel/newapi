<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
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
            $model->tag_id = Tag::create([
                'tag'     => $tag = GlobalHelper::tagized($model->text),
                'stem'    => $tag,
                'user_id' => Auth::user()->id,
            ])->id;
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
