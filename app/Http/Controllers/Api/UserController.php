<?php

namespace App\Http\Controllers\API;

use App\Exceptions\TBError;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;

class UserController extends Controller
{
	public $successStatus = 200;
    
    /**
     * Авторизация через соцсети
     * @return Response
     * @throws TBError
     * @throws BindingResolutionException
     */
	public function auth()
    {
        if (User::where('email', '=', request()->get('email'))->first()) {
            return $this->login();
        } else {
            return $this->register();
        }
    }
    
    /**
     * Авторизация
     *
     * @return JsonResponse
     * @throws TBError
     * @throws BindingResolutionException
     */
	public function login()
	{
        if (Auth::attempt(request()->input())) {
            return $this->sendSuccess((Auth::user())->getAuthResponse());
        } else {
            throw new TBError(TBError::USER_AUTH_FAILED);
        }
	}
    
    /**
     * Регистрация
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
	public function register()
	{
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения',
            'email' => 'Поле :attribute должно быть вида: example@email.com',
            'unique' => 'Поле :attribute должно быть уникальным',
            'min' => 'Минимальное количество символов: 4',
        ];
        
        $validator = Validator::make(request()->input(), [
            'name' => 'required|min:4|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ], $messages);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
		
        $input = request()->input();
		$input['password'] = bcrypt(request()->get('password'));
        
        /**
         * @var User $user
         */
		$user = User::create($input);
        
        return $this->sendSuccess($user->getAuthResponse());
	}
	
    /**
     * Полная информация о пользователе
     *
     * @return JsonResponse
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
     * @return JsonResponse
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
     * @return JsonResponse
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
