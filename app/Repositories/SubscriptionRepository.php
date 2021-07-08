<?php

namespace App\Repositories;

use App\Models\Subscription;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class SubscriptionRepository extends CrudRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass(): string
    {
        return Subscription::class;
    }
}