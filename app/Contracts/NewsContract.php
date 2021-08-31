<?php
    
namespace App\Contracts;

use App\Models\News;

/**
 * Class NewsContract
 * @package App\Contracts
 */
class NewsContract extends AbstractContract
{
    /**
     * Контракт на создание
     */
    public function create()
    {
	    $className = get_class($this->model);
	    $title = $this->model->title ?? $this->model->name;
	    
        News::create([
            'content_id'   => $this->model->id,
            'content_type' => $className,
            'text'         => News::getNewsText($className, $title, News::ACTION_CREATE),
        ]);
    }
	
	/**
	 * Контракт на обновление
	 */
	public function update()
	{
		$className = get_class($this->model);
		$title = $this->model->title ?? $this->model->name;
		
		News::create([
			'content_id'   => $this->model->id,
			'content_type' => get_class($this->model),
			'text'         => News::getNewsText($className, $title, News::ACTION_UPDATE),
		]);
	}
	
	/**
	 * Контракт на удаление
	 */
	public function delete()
	{
		News::where([
			'content_id'   => $this->model->id,
			'content_type' => get_class($this->model),
		])->delete();
	}
}