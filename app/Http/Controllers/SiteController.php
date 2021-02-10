<?php

namespace App\Http\Controllers;

use App\Exceptions\TBError;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use App\Models\User;

class SiteController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmMail(Request $request)
    {
        $email = $request->email;
        $hash = $request->hash;
        $user = User::where('email', $email)->first();
        
        if (empty($user)) {
            $error = new TBError(TBError::USER_NOT_FOUND);
            return view('extra.message', ['message' => $error->getErrorMessage()]);
        }
    
        if (!empty($hash) && $user->canUserActivate($hash)) {
            $user->status = User::STATUS_ACTIVE;
            
            
            if ($user->save()) {
                $message = 'Пользователь успешно активирован';
                NewsRepository::makeNewsAboutPlayer($user);
    
                $user->player->level = 8;
                $user->player->save();
            } else {
                $message = 'Ошибка на сервере. Не удалось активировать пользователя';
            }
        } else {
            $message = 'Неверные данные активации';
        }
        
        return view('extra.message', ['message' => $message]);
    }
}
