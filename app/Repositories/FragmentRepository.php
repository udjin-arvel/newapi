<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Fragment;
use App\Models\Image;
use App\Models\Remark;
use Illuminate\Support\Facades\Storage;

/**
 * Class FragmentRepository
 * @package App\Repositories
 */
class FragmentRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Fragment::class;
    }
    
    /**
     * Сохранить фрагменты истории
     *
     * @param int $storyId
     * @param array $fragments
     * @return bool
     * @throws TBError
     */
    public static function saveFragments($fragments, $storyId)
    {
        if (!$storyId) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        foreach ($fragments as $key => $fragment) {
            /**
             * @type Fragment $model
             */
            if (Fragment::isFakeFragment($fragment)) {
                $model = new Fragment;
            } else {
                $model = Fragment::find($fragment['id']);
            }
            
            $model->text     = $fragment['text'];
            $model->order    = isset($fragment['order']) ? $fragment['order'] : $key;
            $model->story_id = $storyId;
        
            if ($fragment['image']) {
                if ($model->image !== $fragment['image']) {
                    Storage::disk('public')->delete($model->image);
                    $model->image = Image::storedImageFromBase64($fragment['image']);
                }
            } elseif (!empty($model->image)) {
                Storage::disk('public')->delete($model->image);
                $model->image = '';
            }
    
            if (!empty($fragment['remark']['text'])) {
                $model->image = $fragment['remark']['text'];
            }
        
            if (!$model->save()) {
                throw new TBError(TBError::SAVE_ERROR);
            }
        }
        
        return true;
    }
}