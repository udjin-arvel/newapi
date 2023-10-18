<?php

namespace App\Http\Controllers\Traits;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Resources\ImageResource;
use App\Models\BaseModel;
use App\Models\Image;
use Log;

/**
 * Trait GalleryUploadTrait
 *
 * @package App\Http\Controllers\Traits
 * @mixin Controller
 */
trait GalleryUploadTrait
{
	/**
	 * @param GalleryRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	protected function saveGallery(GalleryRequest $request)
	{
		if (empty($this->model)) {
			return $this->sendSuccess([]);
		}
		
		$model = $this->model::findOrFail($request->get('contentId'));
		$directory = $this->directory ?? '';
		
		if ($request->hasfile('gallery')) {
			foreach ($request->file('gallery') as $key => $file) {
				$filename = ImageHelper::saveFileAndResize($file, $directory);
				
				$image = new Image([
					'title'        => ($model->title ?? 'Gallery') . uniqid(' pic#'),
					'filename'     => $filename,
					'directory'    => $directory,
					'content_id'   => $model->id,
					'content_type' => get_class($model),
					'user_id'      => \Auth::id(),
				]);
				
				if (! $image->save()) {
					ImageHelper::deleteImageWithThumbnails($directory);
					Log::error('Не удалось сохранить изображение для понятия: ' . $model->id);
				}
			}
		}
		
		return (ImageResource::collection($model->images))
			->response()
			->setStatusCode(200);
	}
    
    /**
     * @param $model
     * @return bool
     */
	protected function removeContentGallery($model): bool
    {
        if (empty($this->model)) {
            return false;
        }
    
        $directory = $this->directory ?? '';
        $removed = ImageHelper::deleteImageWithThumbnails($model->poster);
    
        $model->images->each(function ($image) use ($directory, &$removed) {
            Log::info($image->filename . '-' . $directory);
            $removed = ImageHelper::deleteImageWithThumbnails($image->filename, $directory) || $removed;
        });
        
        return $removed;
    }
}

