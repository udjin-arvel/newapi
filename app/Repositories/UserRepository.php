<?php
	
namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends Repository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }
}