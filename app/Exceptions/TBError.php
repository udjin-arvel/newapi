<?php

namespace App\Exceptions;

use Exception;

/**
 * Class TBError
 * @package App\Exceptions
 */
class TBError extends Exception
{
    /**
     * Коды ошибок
     */
    const CODE_500 = 500; // Server Error
    const CODE_501 = 501; // Not Implemented
    const CODE_400 = 400; // Bad Request
    const CODE_401 = 401; // Unauthorized
    const CODE_403 = 403; // Forbidden
    const CODE_404 = 404; // Not Found
    const CODE_405 = 405; // Method Not Allowed
    
    /**
     * Ошибки сервера
     */
    const SERVER_ERROR = 'server-error';
    
    /**
     * Ошибки пользователя
     */
    const NOT_AUTHORIZED        = 'not-authorized';
    const USER_NOT_CONFIRMED    = 'user-not-confirmed';
    const USER_NOT_FOUND        = 'user-not-found';
    const PASSWORD_INCORRECT    = 'password-incorrect';
    const USER_AUTH_FAILED      = 'user-auth-failed';
    const USER_HAS_BEEN_BANNED  = 'user-has-been-banned';
    const USER_HAS_BEEN_DELETED = 'user-has-been-deleted';
    const EDIT_PROFILE_FAILED   = 'edit-profile-failed';
    const CHOICE_SIDE_FAILED    = 'choose-side-failed';
    const CREATE_DIALOG_FAILED  = 'create-dialog-failed';
    const REMOVE_DIALOG_FAILED  = 'remove-dialog-failed';
    const STORY_SAVE_FAILED     = 'story-save-failed';
    const STORY_NOT_FOUND       = 'story-not-found';
    const NOTE_NOT_FOUND        = 'note-not-found';
    const NOTION_NOT_FOUND      = 'notion-not-found';
    const DIALOG_NOT_FOUND      = 'dialog-not-found';
    const BOOK_NOT_FOUND        = 'book-not-found';
    const BOOK_SAVE_FAILED      = 'book-save-failed';
    const NOTION_SAVE_FAILED    = 'notion-save-failed';
    const DATA_NOT_FOUND        = 'data-not-found';
    const CONTENT_NOT_FOUND     = 'content-not-found';
    const SAVE_ERROR            = 'save-error';
    const METHOD_NOT_EXIST      = 'method-not-exist';
    const DELETE_ERROR          = 'delete-error';
    const PERMISSIONS_ERROR     = 'permissions-error';
    const SAME_PERSON_SUBSCRIBE = 'same-person-subscribe';
    const SUBSCRIPTION_EXIST    = 'subscription-exist';
    const NOT_ENOUGH_RESOURCES  = 'not-enough-resources';
    const IMPOSSIBLE_OPERATION  = 'impossible-operation';
    const MASS_SAVING_ERROR     = 'mass-saving-error';
    const BIG_FILE              = 'big-file';
    const WRONG_IMAGE_MIME      = 'wrong-image-mime';
    const REPOSITORY_ERROR      = 'repository-error';
    const MODEL_ERROR           = 'model-error';
    const LIKE_ERROR            = 'like-error';
	
	/**
	 * Получить все сообщения по ошибкам
	 * @return array
	 */
	public static function getErrorsMessages()
	{
		return [
			self::SERVER_ERROR          => 'Ошибка сервера',
			self::USER_NOT_CONFIRMED    => 'Акаунт не активирован. Подтвердите почту',
			self::NOT_AUTHORIZED        => 'Сперва авторизуйтесь',
			self::USER_NOT_FOUND        => 'Пользователь не найден',
			self::PASSWORD_INCORRECT    => 'Неверный пароль',
			self::USER_AUTH_FAILED      => 'Неверный логин или пароль',
			self::USER_HAS_BEEN_BANNED  => 'Пользователь забанен',
			self::USER_HAS_BEEN_DELETED => 'Пользователь удален',
			self::EDIT_PROFILE_FAILED   => 'Не удалось изменить профиль',
			self::STORY_NOT_FOUND       => 'История не найдена',
			self::NOTE_NOT_FOUND        => 'Заметка не найдена',
			self::DIALOG_NOT_FOUND      => 'Диалог не найден',
			self::NOTION_NOT_FOUND      => 'Понятие не найдено',
			self::BOOK_NOT_FOUND        => 'Книга не найдена',
			self::CHOICE_SIDE_FAILED    => 'Не удалось выбрать сторону',
			self::CREATE_DIALOG_FAILED  => 'Не удалось создать диалог',
			self::REMOVE_DIALOG_FAILED  => 'Не удалось удалить диалог',
			self::STORY_SAVE_FAILED     => 'Не удалось сохранить историю',
			self::BOOK_SAVE_FAILED      => 'Не удалось сохранить книгу',
			self::NOTION_SAVE_FAILED    => 'Не удалось сохранить понятие',
			self::DATA_NOT_FOUND        => 'Некорректные данные',
			self::CONTENT_NOT_FOUND     => 'Контент не найден',
			self::METHOD_NOT_EXIST      => 'Метод не существует',
			self::SAVE_ERROR            => 'Возникла ошибка при сохранении',
			self::DELETE_ERROR          => 'Возникла ошибка при удалении',
			self::PERMISSIONS_ERROR     => 'Ошибка доступа',
			self::SAME_PERSON_SUBSCRIBE => 'Нельзя подписаться на себя же',
			self::SUBSCRIPTION_EXIST    => 'Вы уже подписаны',
			self::NOT_ENOUGH_RESOURCES  => 'Недостаточно средств',
			self::IMPOSSIBLE_OPERATION  => 'Невозможная операция',
			self::MASS_SAVING_ERROR     => 'Ошибка массового сохранения',
			self::BIG_FILE              => 'Файл слишком тяжелый',
			self::WRONG_IMAGE_MIME      => 'Нечитаемый формат изображения',
			self::REPOSITORY_ERROR      => 'Ошибка репозитория',
			self::MODEL_ERROR           => 'Ошибка модели',
			self::LIKE_ERROR            => 'Ошибка в работе лайков/дизлайков',
		];
	}
    
    /**
     * Текущая ошибка
     * @var string
     */
    protected $error;
    
    /**
     * TBError constructor.
     * @param string $error
     */
    public function __construct($error)
    {
        $this->error = $error;
    }
    
    /**
     * Логирование ошибки
     * @return void
     */
    public function report()
    {
    }
    
    /**
     * Вывод ошибки [формирование JSON ответа с ошибкой для API]
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->json(['success' => false, 'error' => $this->getErrorMessage()], 200);
    }
    
    /**
     * Получить текст ошибки
     * @return string
     */
    public function getErrorMessage()
    {
        $messages = self::getErrorsMessages();
        
        if (empty($this->error)) {
            return $messages[self::SERVER_ERROR];
        }
        
        $errorMessage = empty($messages[$this->error])
            ? $messages[self::SERVER_ERROR]
            : $messages[$this->error];
        
        return $errorMessage;
    }
    
    /**
     * Сгенерировать текст ошибки
     *
     * @param string $name
     * @return string
     */
    public static function getErrorMessageByName(string $name): string
    {
        return (new TBError($name))->getErrorMessage();
    }
}