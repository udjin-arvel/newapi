<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fragment
 * @package App\Models
 *
 * @property int    $story_id
 * @property int    $order
 * @property string $text
 */
class Fragment extends AModel
{
    use SoftDeletes;

    protected $fillable = [
      'text',
      'order',
      'poster',
      'remark',
    ];
    
    /**
     * История, которой принадлежит фрагмент
     */
    public function story()
    {
        return $this->belongsTo(Composition::class);
    }
}
