<?php

namespace App\Console\Commands;

use App\Models\Composition;
use App\Models\LoreItem;
use App\Models\Notification;
use App\Models\Notion;
use App\Models\Short;
use App\Models\Story;
use App\Models\Subscription;
use App\Models\User;
use App\Scopes\UserIdScope;
use DB;
use Illuminate\Console\Command;
use Log;
use Mockery\Exception;

class ActualizeNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:actualize-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check users subscriptions and add notifications if is need';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	try {
	        $query = Subscription::withoutGlobalScope(UserIdScope::class);
		    $subs = (clone $query)->whereNotNull('content_type')->get();
		    
		    if (0 === $subs->count()) {
		        return true;
		    }
		    
		    $updatedModels = $subs->map(function ($sub) {
			    /**
			     * @var Subscription $sub
			     */
		        switch ($sub->content_type) {
				    case Composition::class:
					    $contentQuery = Story::isPublic()->byCompositionId($sub->content_id)->where('updated_at', '>', $sub->updated_at); break;
				    case User::class:
					    $contentQuery = Story::isPublic()->byUserId($sub->content_id)->where('updated_at', '>', $sub->updated_at); break;
				    default:
					    $contentQuery = $sub->content_type::isPublic()->where('updated_at', '>', $sub->updated_at);
			    }
			
			    return $contentQuery->with('user')->get()->map(function ($content) use ($sub) {
				    return [
					    'message'      => Notification::getNotificationText($content, $content->user),
					    'content_id'   => $content->id,
					    'content_type' => $sub->content_type,
					    'user_id'      => $sub->user_id,
				    ];
			    });
		    })->flatten(1)->toArray();
		    
		    DB::table('notifications')->insertOrIgnore($updatedModels);
		    $query->update(['updated_at' => now()]);
		    
	    } catch (Exception $e) {
    		Log::error('Возникла ошибка при актуализации уведомлений. Текст ошибки: ' . $e->getMessage());
		    return false;
	    }
	    
	    return true;
    }
}
