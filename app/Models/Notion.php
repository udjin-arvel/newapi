<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Notion
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $title
 * @property string $text
 * @property string $main_image
 * @property int    $type
 */
class Notion extends Model
{
    use SoftDeletes;
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();
    
        static::creating(function ($model) {
            $model->tag_id = Tag::create([
                'tag'     => $tag = GlobalHelper::tagized($model->text),
                'stem'    => $tag,
                'user_id' => Auth::user()->id,
            ])->id;
        });
    }
}
