<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TBError
 * @package App\Exceptions
 */
class TBError extends Exception
{
    /**
     * Ошибки пользователя
     */
	const UNKNOWN_ERROR     = 'unknown-error';
	const SERVER_ERROR      = 'server-error';
	const USER_AUTH_FAILED  = 'user-auth-failed';
	const INCORRECT_DATA    = 'data-not-found';
	const CONTENT_NOT_FOUND = 'content-not-found';
	const SAVE_ERROR        = 'save-error';
	const DELETE_ERROR      = 'delete-error';
	const PERMISSIONS_ERROR = 'permissions-error';
 
	/**
	 * @var array
	 */
	private $errorMessages = [
		self::UNKNOWN_ERROR     => 'Неизвестная ошибка',
		self::SERVER_ERROR      => 'Ошибка сервера',
		self::USER_AUTH_FAILED  => 'Неверный логин или пароль',
		self::INCORRECT_DATA    => 'Некорректные данные',
		self::CONTENT_NOT_FOUND => 'Контент не найден',
		self::SAVE_ERROR        => 'Возникла ошибка при сохранении',
		self::DELETE_ERROR      => 'Возникла ошибка при удалении',
		self::PERMISSIONS_ERROR => 'Ошибка доступа',
	];
	
	/**
	 * @var array
	 */
	private $errorCodes = [
		self::UNKNOWN_ERROR     => Response::HTTP_EXPECTATION_FAILED,
		self::SERVER_ERROR      => Response::HTTP_INTERNAL_SERVER_ERROR,
		self::USER_AUTH_FAILED  => Response::HTTP_FORBIDDEN,
		self::INCORRECT_DATA    => Response::HTTP_BAD_REQUEST,
		self::CONTENT_NOT_FOUND => Response::HTTP_NOT_FOUND,
		self::SAVE_ERROR        => Response::HTTP_BAD_REQUEST,
		self::DELETE_ERROR      => Response::HTTP_BAD_REQUEST,
		self::PERMISSIONS_ERROR => Response::HTTP_FORBIDDEN,
	];
	
	/**
	 * Текущая ошибка
	 * @var string
	 */
	protected $error;
	
	/**
	 * TBError constructor.
	 * @param string $error
	 */
	public function __construct(string $error)
	{
		parent::__construct($error);
		$this->error = $error ?: self::UNKNOWN_ERROR;
	}
	
	/**
	 * Получить сообщение по ошибке
	 * @return string
	 */
	public function getErrorMessage(): string
	{
		return $this->errorMessages[$this->error] ?? 'Неизвестная ошибка';
	}
	
	/**
	 * @return int
	 */
	public function getErrorCode(): int
	{
		return $this->errorCodes[$this->error] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
	}
 
	/**
	 * Вывод ошибки [формирование JSON ответа с ошибкой для API]
	 * @return \Illuminate\Http\Response
	 */
    public function render()
    {
	    return response()->json([
		    'error' => $this->getErrorMessage(),
		    'code'  => $this->getErrorCode(),
	    ], 200);
    }
}