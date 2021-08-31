<?php
    
namespace App\Contracts;

use App\Models\LoreItem;
use App\Models\Notion;
use App\Models\Story;
use App\Models\View;

/**
 * Class ViewContract
 * @package App\Contracts
 */
class ViewContract extends AbstractContract
{
	protected $methods = [
		self::METHOD_ONE,
		self::METHOD_DELETE,
	];
	
	/**
	 * @param array $params
	 */
    public function one(array $params)
    {
	    $model = $params['model'];
	    $viewerId = $params['viewer_id'];
    	
        if ($model->user_id !== $viewerId) {
            View::firstOrCreate([
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
    public function delete($model)
    {
        View::where([
            'content_id'   => $model->id,
            'content_type' => get_class($model),
        ])->delete();
    }
}