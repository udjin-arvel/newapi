<?php

namespace App\Events;

use App\Models\Notion;
use App\Models\Story;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class UpdateNotifications
 * @package App\Events
 *
 * @property Model $model
 * @property Story $story
 * @property Notion $notion
 * @property string $action
 */
class UpdateNotifications
{
    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;
    
    /**
     * @var Model
     */
    public $model;
    
    /**
     * @var string
     */
    public $action;
    
    const TARGET_CREATED = 'target-created';
    const TARGET_UPDATED = 'target-updated';
    
    /**
     * Create a new event instance.
     *
     * @param Model $model
     * @param string $action (TARGET_CREATED|TARGET_UPDATED)
     */
    public function __construct(Model $model, string $action)
    {
        $this->model  = $model;
        $this->action = $action;
    }
}
