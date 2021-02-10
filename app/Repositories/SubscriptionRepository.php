<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Book;
use App\Models\Subscription as Model;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class SubscriptionRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Model::class;
    }
    
    /**
     * @param $data
     * @return bool
     * @throws TBError
     */
    public function subscribe($data)
    {
        $author_id = !empty($data['author_id']) ? $data['author_id'] : null;
        $book_id   = !empty($data['book_id']) ? $data['book_id'] : null;
        
        if (!$author_id && !$book_id) {
            throw new TBError(TBError::DATA_NOT_FOUND);
        }
        
        if ($author_id) {
            if ((int)$author_id === (int)$this->user->id) {
                throw new TBError(TBError::SAME_PERSON_SUBSCRIBE);
            }
    
            $subscriptionExist = Model::where('user_id', $this->user->id)->where('author_id', $author_id)->exists();
            if ($subscriptionExist) {
                throw new TBError(TBError::SUBSCRIPTION_EXIST);
            }
        }
        
        if ($book_id) {
            $sameAuthor = Book::where('user_id', $this->user->id)->where('id', $book_id)->exists();
            if ($sameAuthor) {
                throw new TBError(TBError::SAME_PERSON_SUBSCRIBE);
            }
    
            $subscriptionExist = Model::where('user_id', $this->user->id)->where('book_id', $book_id)->exists();
            if ($subscriptionExist) {
                throw new TBError(TBError::SUBSCRIPTION_EXIST);
            }
        }
        
        $model = new Model;
    
        $model->author_id        = $author_id;
        $model->book_id          = $book_id;
        $model->user_id          = $this->user->id;
        $model->last_checking_at = date("Y-m-d H:i:s", strtotime('now'));
        
        return $model->save();
    }
}