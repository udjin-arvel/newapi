<?php

namespace App\Contracts;

use App\Models\Composition;
use App\Models\LoreItem;
use App\Models\Notification;
use App\Contracts\Interfaces\HasCreate;
use App\Contracts\Interfaces\HasDelete;
use App\Contracts\Interfaces\HasUpdate;
use App\Models\Notion;
use App\Models\Story;
use App\Models\Subscription;
use App\Models\User;

/**
 * Class NotificationContract
 * @package App\Contracts
 */
class NotificationContract implements HasCreate, HasUpdate, HasDelete
{
    /**
     * @param Notion|Story|LoreItem $model
     * @return Subscription[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSubscriptionsByModel($model)
    {
        /**
         * @var Subscription $query
         */
        $query = Subscription::select('subscriptions.*');
    
        switch (get_class($model)) {
            case Story::class:
                $query = $query->byUserId($model->user_id);
            
                if ($model->composition_id) {
                    $query = $query->orWhere(function ($query) {
                        /**
                         * @var Subscription $query
                         */
                        return $query->byType(Composition::class);
                    });
                }
                break;
            case Notion::class:
                $query = $query->byType(Notion::class);
                break;
            case LoreItem::class:
                $query = $query->byType(LoreItem::class);
                break;
        }
    
        return $query->get();
    }
    
    /**
     * @param Notion|Story|LoreItem $model
     * @param string $subscriptionType
     * @param string $methodName
     * @return string
     */
    public function getNotificationTextByModel($model, $subscriptionType, $methodName): string
    {
        $text = '';
        $user = User::find($model->user_id);
        
        if (null !== $user) {
            $text .= "Пользователь <i>{$user->name}</i> ";
            $text .= $methodName === 'wasCreate' ? "создал " : "обновил ";
            
            switch (get_class($model)) {
                case Story::class:
                    $text .= "историю «{$model->title}»";
                    $text .= $subscriptionType === Composition::class
                        ? " к композиции «{$model->composition->title}»."
                        : ".";
                    break;
                case Notion::class:
                    $text .= "понятие «{$model->title}».";
                    break;
                case LoreItem::class:
                    $text .= "элемент лора «{$model->title}».";
                    break;
            }
        }
        
        return $text;
    }
    
    /**
     * @param Notion|Story|LoreItem $model
     */
    public function wasCreate($model)
    {
        $this->getSubscriptionsByModel($model)->each(function ($subscription) use ($model) {
            $text = $this->getNotificationTextByModel($model, $subscription->content_type, 'wasCreate');
        
            if ($text) {
                Notification::create([
                    'content_id'   => $model->id,
                    'content_type' => get_class($model),
                    'message'      => $text,
                    'user_id'      => $subscription->user_id,
                ]);
            }
        });
    }
    
    /**
     * @param Notion|Story|LoreItem $model
     */
    public function wasUpdate($model)
    {
        $this->getSubscriptionsByModel($model)->each(function ($subscription) use ($model) {
            $text = $this->getNotificationTextByModel($model, $subscription->content_type, 'wasUpdate');
    
            if ($text) {
                Notification::create([
                    'content_id'   => $model->id,
                    'content_type' => get_class($model),
                    'message'      => $text,
                    'user_id'      => $subscription->user_id,
                ]);
            }
        });
    }
    
    /**
     * @param Notion|Story|LoreItem $model
     * @throws \Exception
     */
    public function wasDelete($model)
    {
        Notification::where([
            'content_id'   => $model->id,
            'content_type' => get_class($model),
        ])->delete();
    }
}