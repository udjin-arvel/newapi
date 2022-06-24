<?php

namespace App\Models;

use App\Exceptions\TBError;
use App\Models\Traits\Posterable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property string $password
 * @property int    $level
 * @property int    $experience
 * @property int    $status
 * @property string $poster
 * @property string $info
 * @property string $email
 * @property string $created_at
 * @property mixed  $subscriptions
 * @property array  $stories
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
	use HasApiTokens,
		Posterable,
		Notifiable;

    /**
     * Статус пользователя
     */
	const STATUS_ADMIN     = 'admin';
	const STATUS_MODERATOR = 'moderator';
	const STATUS_CORRECTOR = 'corrector';
	const STATUS_WRITER    = 'writer';
	const STATUS_READER    = 'reader';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'status',
        'poster',
        'age',
        'sex',
        'city',
        'info',
        'level',
        'experience',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	/**
	 * Проверка может ли пользователь редактировать данный контент
	 *
	 * @param mixed $content
	 * @return bool
	 */
    public function canRedact($content): bool
    {
    	return !empty($content->user_id)
		    && ($content->user_id === $this->id || in_array($this->status, [self::STATUS_ADMIN, self::STATUS_MODERATOR]));
    }
    
	/**
	 * @return HasMany
	 */
	public function views()
	{
		return $this->hasMany(View::class);
	}
	
	/**
	 * @return HasMany
	 */
	public function rewards()
	{
		return $this->hasMany(Reward::class);
	}
	
	/**
	 * @return HasMany
	 */
	public function bookmarks()
	{
		return $this->hasMany(Bookmark::class);
	}
	
	/**
	 * @return HasMany
	 */
	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
    
    /**
     * Сменить пароль
     *
     * @param array $data
     * @return bool
     * @throws TBError
     */
	public function changePassword($data) {
        if (empty($data['password']) ||
            empty($data['new_password']) ||
            !Hash::check($data['password'], $this->password)
        ) {
            throw new TBError(TBError::INCORRECT_DATA);
        }

        $this->password = Hash::make($data['new_password']);
        return $this->save();
    }

    /**
     * Получить hash пользователя для подтверждения почты
     * @return string
     */
    public function getUserHash()
    {
        $solt = '@thebook!';
        $stringForCrypt = $this->email . $this->name . $this->created_at . $solt;

        return md5($stringForCrypt);
    }

    /**
     * Получить ссылку по которой можно будет подтвердить почту пользователя
     * @return string
     */
    public function getConfirmUrl()
    {
        $http = 'https://';
        $host = $_SERVER['HTTP_HOST'];
        $hash = $this->getUserHash();

        return $http . $host . '/confirm?email='. $this->email . '&hash=' . $hash;
    }
	
	/**
	 * Обновить опыт пользователю
	 *
	 * @param int $amount
	 * @return bool
	 */
    public function updateExpAmount(int $amount): bool
    {
    	$this->experience += $amount;
    	return $this->save();
    }
    
	/**
	 * @return bool
	 */
    public function isAdmin(): bool
    {
    	return $this->status === self::STATUS_ADMIN;
    }
}

