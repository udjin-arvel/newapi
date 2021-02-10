<?php
	
namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 * @property User $model
 */
class UserRepository
{
    public function __construct()
    {
        $this->model = Auth::user();
    }
    
    /**
     * Отредактировать пользователя
     *
     * @param array $data
     * @return array
     * @throws TBError
     */
    public function editProfile($data)
    {
    
    }
}