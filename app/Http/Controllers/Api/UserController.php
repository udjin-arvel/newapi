<?php

namespace App\Http\Controllers\API;

use App\Exceptions\TBError;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mail;

class UserController extends Controller
{
	public $successStatus = 200;
    
    
    /**
     * Авторизация
     *
     * @return Response
     * @throws TBError
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
	public function login()
	{
        if (Auth::attempt(request()->input())) {
            $user = Auth::user();
            
            $success['user'] = $user->getDataForJson();
            $success['token'] = $user->createToken(env('APP_NAME', 'accessToken')); // php artisan passport:client --personal
            
            return $this->sendSuccess($success);
        } else {
            throw new TBError(TBError::USER_AUTH_FAILED);
        }
	}
    
    /**
     * Регистрация
     *
     * @param Request $request
     * @return Response
     * @throws TBError
     */
	public function register(Request $request)
	{
        $input = $request->toArray();
	    
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения',
            'email' => 'Поле :attribute должно быть вида: example@email.com',
            'unique' => 'Поле :attribute должно быть уникальным',
        ];
        
		$validator = Validator::make($input, [
			'email' => 'nullable|email|unique:users',
			'password' => 'required',
			'c_password' => 'required|same:password',
		], $messages);
		
		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], $this->successStatus);
		}
		
		$input['password'] = bcrypt($input['password']);
        
        /**
         * @var User $user
         */
		$user = User::create($input);
        if ($user->save()) {
            $user->createPlayer();
            
            if (!$input['is_social']) {
                $this->sendMailConfirmation($user);
            }
        } else {
            throw new TBError(TBError::SERVER_ERROR);
        }
        
        $success['name'] = $user->name;
        
        return $this->sendSuccess($success);
	}
    
    /**
     * Полная информация о пользователе
     *
     * @return Response
     * @throws TBError
     */
	public function details()
	{
		$user = Auth::user();
		
		if (empty($user)) {
		    throw new TBError(TBError::USER_NOT_FOUND);
        }
		
        return $this->sendSuccess($user);
	}
	
    /**
     * Сменить пароль пользователя
     *
     * @param Request $request
     * @return Response
     * @throws TBError
     */
    public function changePassword(Request $request) {
        $user = Auth::user();
        
        if (!$user) {
            throw new TBError(TBError::USER_NOT_FOUND);
        }
    
        return $this->sendSuccess($user->changePassword($request->toArray()));
    }
    
    /**
     * Редактирование персональных данных пользователя
     *
     * @param UserRepository $repository
     * @param Request $request
     * @return Response
     * @throws TBError
     */
    public function editProfile(UserRepository $repository, Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'name' => 'required|min:4'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->successStatus);
        }
    
        $input = $request->toArray();
    
        return $this->sendSuccess($repository->editProfile($input));
	}
    
    /**
     * Отправить письмо с подтверждением почты с помощью SMTP
     * @param User $user
     */
    public function sendMailConfirmation(User $user)
    {
        Mail::send('extra.mail', ['name' => $user->name, 'url' => $user->getConfirmUrl()], function ($message) use ($user) {
            $message->to($user->email, 'Email confirmation')->subject('Email confirmation');
            $message->from('admin@thebook.arvelov.com', 'Arvelov - The Book');
        });
    }
}
