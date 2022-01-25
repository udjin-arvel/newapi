<?php

namespace App\Http\Controllers\API;

use App\Exceptions\TBError;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Авторизация
     *
     * @return JsonResponse
     * @throws TBError
     * @throws BindingResolutionException
     */
	public function login()
	{
		$credentials = [
			'email' => request()->get('email'),
			'password' => request()->get('password'),
		];
		
		if (! \Auth::attempt($credentials)) {
			throw new TBError(TBError::USER_AUTH_FAILED);
		}
		
		/**
		 * @var User $user
		 */
		$user = \Auth::user();
		
		return $this->sendSuccess([
			'user'  => $user,
			'token' => $user->createToken(env('APP_NAME', 'accessToken')),
		]);
	}
	
	/**
	 * Регистрация
	 *
	 * @return JsonResponse
	 * @throws BindingResolutionException
	 * @throws TBError
	 */
	public function register()
	{
		$messages = [
			'required' => 'Поле :attribute обязательно для заполнения',
			'email'    => 'Поле :attribute должно быть вида: example@email.com',
			'unique'   => 'Поле :attribute должно быть уникальным',
			'min'      => 'Минимальное количество символов: :min',
		];
		$validator = \Validator::make(request()->input(), [
			'name'     => 'required|min:4|unique:users',
			'email'    => 'required|email|unique:users',
			'password' => 'required',
		], $messages);
        
        if ($validator->fails()) {
        	throw new TBError($validator->errors());
        }
		
        $input = request()->input();
		$input['password'] = bcrypt(request()->get('password'));
        
        /**
         * @var User $user
         */
		$user = User::create($input);
        
        return $this->sendSuccess([
	        'user'  => new UserResource($user),
	        'token' => $user->createToken(env('APP_NAME', 'accessToken')),
        ]);
	}
	
	/**
	 * Изменение данных профиля
	 *
	 * @param Request $request
	 * @return JsonResponse
	 * @throws TBError
	 */
    public function editProfile(Request $request)
    {
	    if (! $request->exists(['age', 'sex', 'city', 'info'])) {
		    return $this->sendSuccess(\Auth::user());
	    }
	    
	    $user = \Auth::user();
	    $user->update($request->input());
	    
	    return $this->sendSuccess($user);
    }
	
	/**
	 * Сменить пароль пользователя
	 *
	 * @param Request $request
	 * @return JsonResponse
	 * @throws TBError
	 */
    public function changePassword(Request $request)
    {
        $user = \Auth::user();
        return $this->sendSuccess($user->changePassword($request->toArray()));
    }
}
