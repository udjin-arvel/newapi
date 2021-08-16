<?php

namespace App\Contracts;

use App\Contracts\Interfaces\HasCreate;
use App\Contracts\Interfaces\HasDelete;
use App\Models\Composition;
use App\Models\LoreItem;
use App\Models\Notion;
use App\Models\Reward;
use App\Models\Story;
use App\Models\User;

/**
 * Class RewardContract
 * @package App\Contracts
 */
class RewardContract implements HasCreate, HasDelete
{
    /**
     * @param Story|Notion|LoreItem|Composition $model
     */
    public function wasCreate($model)
    {
        $user = User::find($model->user_id);
    
        if (null !== $user) {
            $className = get_class($model);
            $expAmount = Reward::getRewardAmountByClassName($className);
            
            $saved = Reward::create([
                'user_id'      => $user->id,
                'content_id'   => $model->id,
                'content_type' => $className,
                'exp_amount'   => $expAmount,
            ]);
            
            if ($saved) {
                $user->player->updateExpAmount($expAmount);
            }
        }
    }
    
    /**
     * @param Story|Notion|LoreItem|Composition $model
     * @throws \Exception
     */
    public function wasDelete($model)
    {
        $user = User::find($model->user_id);
    
        if (null !== $user) {
            $model = Reward::where([
                'user_id'      => $user->id,
                'content_id'   => $model->id,
                'content_type' => get_class($model),
            ])->first();
            
            if ($model->delete()) {
                $user->player->updateExpAmount(-$model->exp_amount);
            }
        }
    }
}