<?php
	
namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Tag::class;
    }
    
    /**
     * @return array
     */
    public function getAll()
    {
        return collect(Tag::all(Tag::$getAllSelectors))->toArray();
    }
    
    /**
     * Сохранить теги
     *
     * @param array $tags
     * @param int $storyId
     * @return bool
     * @throws TBError
     */
    public static function saveTags($tags, $storyId) {
        if ($tags) {
            $relationsTagStory = [];
        
            foreach ($tags as $tag) {
                $model = Tag::find($tag['id']);
            
                if (null === $model) {
                    throw new TBError(TBError::CONTENT_NOT_FOUND);
                }
                
                if (!$model->save()) {
                    throw new TBError(TBError::SAVE_ERROR);
                }
            
                $relationsTagStory[] = [
                    'story_id' => $storyId,
                    'tag_id'   => $model->id
                ];
            }
        
            Tag::addRelation($relationsTagStory);
            
            return true;
        }
        
        return false;
    }
}