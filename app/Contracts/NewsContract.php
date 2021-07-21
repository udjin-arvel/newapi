<?php
    
namespace App\Contracts;

use App\Contracts\Interfaces\HasCreate;
use App\Contracts\Interfaces\HasDelete;
use App\Contracts\Interfaces\HasUpdate;
use App\Models\LoreItem;
use App\Models\News;
use App\Models\Notion;
use App\Models\Story;
use App\Models\User;

/**
 * Class NewsContract
 * @package App\Contracts
 */
class NewsContract implements HasCreate, HasUpdate, HasDelete
{
    /**
     * @param Story|Notion|LoreItem|User $model
     * @param string $methodName
     * @return string
     */
    public function getNewsTextByModel($model, string $methodName): string
    {
        $className = get_class($model);
        
        if ($className === User::class) {
            return "Новый пользователь <i>{$model->name}</i> вступил в нашу секту.";
        }
        
        $user = User::find($model->user_id);
        $userPart = $user !== null ? " пользователем <i>{$user->name}</i>" : '';
        
        switch ($className) {
            case Story::class:
                $bodyPart = $methodName === 'wasCreate'
                    ? "Новая история «{$model->title}» была создана"
                    : "История «{$model->title}» была обновлена";
                break;
            case Notion::class:
                $bodyPart = $methodName === 'wasCreate'
                    ? "Новое понятие «{$model->title}» было создано"
                    : "Понятие «{$model->title}» было обновлено";
                break;
            case LoreItem::class:
                $bodyPart = $methodName === 'wasCreate'
                    ? "Новый элемент лора «{$model->title}» был создан"
                    : "Элемент лора «{$model->title}» был обновлен";
                break;
            default:
                return '';
        }
        
        return "{$bodyPart}{$userPart}.";
    }
    
    /**
     * @param Story|Notion|LoreItem|User $model
     */
    public function wasCreate($model)
    {
        if ($text = $this->getNewsTextByModel($model, __FUNCTION__)) {
            News::create([
                'content_id'   => $model->id,
                'content_type' => get_class($model),
                'text'         => $text,
            ]);
        }
    }
    
    /**
     * @param Story|Notion|LoreItem|User $model
     */
    public function wasUpdate($model)
    {
        if ($text = $this->getNewsTextByModel($model, __FUNCTION__)) {
            News::updateOrCreate([
                'content_id'   => $model->id,
                'content_type' => get_class($model),
            ], [
                'text'       => $text,
                'updated_at' => now(),
            ]);
        }
    }
    
    /**
     * @param Story|Notion|LoreItem|User $model
     * @throws \Exception
     */
    public function wasDelete($model)
    {
        News::where([
            'content_id'   => $model->id,
            'content_type' => get_class($model),
        ])->delete();
    }
}