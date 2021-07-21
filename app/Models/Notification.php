<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class Note
 * @package App\Models
 *
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $message
 * @property int     $user_id
 */
class Notification extends AModel
{
    use UserRelation;
    
    const TYPE_STORY   = 'type-story';
    const TYPE_NOTION  = 'type-notion';
    const TYPE_USER    = 'type-user';
    
    protected $fillable = [
        'content_id',
        'content_type',
        'message',
        'user_id',
    ];
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
    }
    
    /**
     * Метод-фабрика возвращает заголовок и текст новости по классу модели и состоянию создан/обновлен
     *
     * @param AModel $model
     * @param string $status - возможные значения: "created" и "updated"
     * @return string
     */
    public static function getMessageByModel($model, $status): string
    {
        $user = !empty($model->user_id) ? User::find($model->user_id) : null;
        
        switch (get_class($model)) {
            case Story::class:
                /**
                 * @var Story $model
                 */
                return ($status === 'created'
                        ? "Новая история «{$model->title}» была создана"
                        : "История «{$model->title}» была обновлена")
                    . ($user !== null ? " пользователем <i>{$user->name}</i>" : '')  . '.';
            case Notion::class:
                /**
                 * @var Notion $model
                 */
                return ($status === 'created'
                        ? "Новое понятие «{$model->title}» было создано"
                        : "Понятие «{$model->title}» было обновлено")
                    . ($user !== null ? " пользователем <i>{$user->name}</i>" : '')  . '.';
            case LoreItem::class:
                /**
                 * @var LoreItem $model
                 */
                return ($status === 'created'
                        ? "Новый элемент лора «{$model->title}» был создан"
                        : "Элемент лора «{$model->title}» был обновлен")
                    . ($user !== null ? " пользователем <i>{$user->name}</i>" : '')  . '.';
            default:
                return null;
        }
    }
}
