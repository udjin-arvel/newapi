<?php
    
namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\User;
use App\Models\View as Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ViewRepository
 * @package App\Repositories
 */
class UserViewRepository extends Repository
{
    /**
     * Название таблицы
     */
    const TABLE_NAME = 'views';
    
    /**
     * Тип просмотра
     */
    const VIEW_TYPE_STORY  = 'story';
    const VIEW_TYPE_NOTION = 'notion';
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Model::class;
    }


    /**
     * Зафиксировать просмотр истории
     *
     * @param {array} $data
     * @return bool
     * @throws TBError
     */
    public static function viewed($data)
    {
        if (empty($data['content_id'])) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        $record = DB::table(self::TABLE_NAME)
            ->where('content_id', $data['content_id'])
            ->where('content_type', $data['content_type'])
            ->where('user_id', $data['user_id'])
            ->get();

        if (count($record) > 0) {
            return true;
        }

        return (new Model)->setRawAttributes($data)->save();
    }
    
    /**
     * Получить список просмотренных историй пользователя
     *
     * @param User $user
     * @param bool $inverse
     * @return array
     */
    public static function getStoriesViewsByUser($user, $inverse = false)
    {
        $result = Model::where('user_id', $user->id)
            ->where('content_type', self::VIEW_TYPE_STORY)
            ->select(['content_id'])
            ->groupBy('content_id')
            ->get()
            ->pluck('content_id')
            ->toArray();
        
        return $inverse ? array_flip($result) : $result;
    }
}
