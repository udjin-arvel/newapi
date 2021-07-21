<?php
    
namespace App\Contracts;

use App\Contracts\Interfaces\HasDelete;
use App\Contracts\Interfaces\HasView;
use App\Models\LoreItem;
use App\Models\Notion;
use App\Models\Story;
use App\Models\View;

/**
 * Class ViewContract
 * @package App\Contracts
 */
class ViewContract implements HasView, HasDelete
{
    /**
     * @param Notion|Story|LoreItem $model
     * @param int $viewerId
     */
    public function wasView($model, $viewerId)
    {
        if ($model->user_id !== $viewerId) {
            View::create([
                'content_id'   => $model->id,
                'content_type' => get_class($model),
                'user_id'      => $viewerId,
            ]);
        }
    }
    
    /**
     * @param Notion|Story|LoreItem $model
     * @throws \Exception
     */
    public function wasDelete($model)
    {
        View::where([
            'content_id'   => $model->id,
            'content_type' => get_class($model),
        ])->delete();
    }
}