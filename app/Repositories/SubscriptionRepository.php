<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Helpers\Assert;
use App\Models\Book;
use App\Models\Series;
use App\Models\Subscription;
use App\Models\User;
use DB;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class SubscriptionRepository extends Repository
{
    
    const TYPES = [
        'sub-type-book'   => Book::class,
        'sub-type-series' => Series::class,
        'sub-type-author' => User::class,
    ];
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Subscription::class;
    }
    
    /**
     * @param $data
     * @return int
     * @throws TBError
     */
    public function save(array $data): int
    {
        Assert::keysExist(['content_id', 'content_type'], $data, TBError::DATA_NOT_FOUND);
        Assert::keyExists(self::TYPES, $data['content_type'], TBError::DATA_NOT_FOUND);
        
        return DB::table('someTable')->insertGetId([
            'content_id'   => $data['content_id'],
            'content_type' => self::TYPES[$data['content_type']],
            'user_id'      => $this->user->id,
        ]);
    }
}