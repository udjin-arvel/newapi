<?php

namespace App\Listeners;

use App\Events\UpdateNotifications;
use App\Models\Book;
use App\Models\Notification;
use App\Models\Notion;
use App\Models\Series;
use App\Models\Story;
use App\Models\Subscription;
use App\Models\User;
use DB;
use Log;
use Mockery\Exception;

class StartUpdateNotifications
{
    /**
     * Handle the event.
     *
     * @param  UpdateNotifications  $event
     * @return void
     */
    public static function handle(UpdateNotifications $event)
    {
        switch (get_class($event->model)) {
            case Story::class:
                $event->story = $event->model;
                self::handleStoryNotifications($event);
                break;
            case Notion::class:
                $event->notion = $event->model;
                self::handleNotionNotifications($event);
                break;
        }
    }
    
    public static function handleStoryNotifications(UpdateNotifications $event)
    {
        try {
            $notifications = [];
    
            Subscription::byAuthorId($event->story->user_id, 'or')
                ->byBookId($event->story->book_id, 'or')
                ->bySeriesId($event->story->series_id, 'or')
                ->get()
                ->map(function(Subscription $subscription) use ($event, &$notifications) {
                    $notificationTemplate = [
                        'content_type' => Notification::TYPE_STORY,
                        'content_id'   => $event->story->id,
                        'user_id'      => $subscription->user_id,
                    ];
                    
                    // Порядок кейсов важен, сообщение про книгу самое важное и вниз
                    switch ($subscription->subscription_type) {
                        case User::class: {
                            $notificationTemplate['message'] = ($event->action === UpdateNotifications::TARGET_CREATED ? "Добавлена новая" : "Обновлена")
                                . " история <a class='notification-link' href='/story/view/{$event->story->id}'>«{$event->story->title}»</a> автора, на которого вы подписаны (<i>{$event->story->user->name}</i>).";
        
                            break;
                        }
                        case Series::class: {
                            $notificationTemplate['message'] = ($event->action === UpdateNotifications::TARGET_CREATED ? "Добавлена новая" : "Обновлена")
                                . " история <a class='notification-link' href='/story/view/{$event->story->id}'>«{$event->story->title}»</a> в серии <a class='notification-link' href='/series/view/{$subscription->subscription_id}'>«{$event->story->series->title}»</a>.";
    
                            break;
                        }
                        case Book::class: {
                            $notificationTemplate['message'] = ($event->action === UpdateNotifications::TARGET_CREATED ? "Добавлена новая" : "Обновлена")
                                . " история <a class='notification-link' href='/story/view/{$event->story->id}'>«{$event->story->title}»</a> в книге <a class='notification-link' href='/book/view/{$subscription->subscription_id}'>«{$event->story->book->title}»</a>.";
        
                            break;
                        }
                    }
    
                    $notifications[$event->story->id] = $notificationTemplate;
                });
            
            DB::table('notifications')->insert($notifications);
            
        } catch (Exception $e) {
            Log::error('Не удалось обновить уведомления. Причина: ' . $e->getMessage());
        }
    }
    
    public static function handleNotionNotifications(UpdateNotifications $event)
    {
        try {
            $notifications = [];
            
            User::whoSubscribedOnNotions()->get()->map(function($user) use ($event, &$notifications) {
                /**
                 * @var User $user
                 */
                $notifications[] = [
                    'content_type' => Notification::TYPE_NOTION,
                    'content_id'   => $event->notion->id,
                    'user_id'      => $user->id,
                    'message'      => ($event->action === UpdateNotifications::TARGET_CREATED ? "Добавлено новое" : "Обновлено")
                        . " понятие - <a class='notification-link' href='/notion/view/{$event->notion->id}'>«{$event->notion->title}»</a> пользователем <i>{$user->name}</i>.",
                ];
            });
    
            DB::table('notifications')->insert($notifications);
            
        } catch (Exception $e) {
            Log::error('Не удалось обновить уведомления. Причина: ' . $e->getMessage());
        }
    }
}
