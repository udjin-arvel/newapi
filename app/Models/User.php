<?php

namespace App\Models;

use App\Exceptions\TBError;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;
use Mockery\Exception;

/**
 * Class User
 * @package App\Models
 *
 * @property Player $player
 *
 * @property int    $id
 * @property string $name
 * @property string $password
 * @property int    $level
 * @property int    $experience
 * @property int    $status
 * @property string $poster
 * @property int    $age
 * @property string $sex
 * @property string $city
 * @property string $info
 * @property string $email
 * @property string $created_at
 * @property string $full_name
 * @property int    $clan
 * @property mixed  $subscriptions
 * @property int    $player_id
 * @property array  $stories
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    /**
     * @static
     */
    public static function boot()
    {
        parent::boot();
        
        self::created(function($model) {
            /**
             * @var User $model
             */
            $model->createPlayer();
        });
    }
    
    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    
    /**
     * Пользователь, что создал книгу
     * @return BelongsToAlias
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    
    /**
	 * @return HasMany
	 */
	public function stories()
	{
		return $this->hasMany(Story::class)->orderBy('created_at', 'DESC');
	}
    
    /**
     * @return HasMany
     */
    public function views()
    {
        return $this->hasMany(UserView::class);
	}
    
    /**
     * @return HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Создание эксземпляра Player для пользователя
     *
     * @param array $data
     * @return Player
     * @throws TBError
     */
    public function createPlayer($data = [])
    {
        if (!empty($this->player)) {
            return $this->player;
        }
        
        $player = new Player;
        
        $player->user_id = $this->id;
        $player->login   = $data['name'] ?? Player::DEFAULT_LOGIN;
        
        if (!$player->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        $this->player_id = $player->id;
    
        if (!$this->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $player;
    }
    
    /**
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getAuthResponse(): array
    {
        return [
            'user' => $this->getDataForJson(),
            'token' => $this->createToken(env('APP_NAME', 'accessToken')),
        ];
    }
	
	/**
     * Получить доступную по API информацию о пользователе
	 * @return array
	 */
	public function getDataForJson()
	{
	    $data = [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'created_at' => $this->created_at,
        ];
	    
        return $data;
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
            throw new TBError(TBError::PASSWORD_INCORRECT);
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
     * Совпадают ли user hash, можно ли активировать пользователя
     *
     * @param string $hash
     * @return bool
     */
    public function canUserActivate($hash)
    {
        $realHash = $this->getUserHash();
        return $realHash === $hash;
    }
    
    /**
     * Уполномоченные статусы
     * @return array
     */
    public static function entitledStatuses(): array
    {
        return [
            Player::STATUS_USER,
            Player::STATUS_WRITER,
            Player::STATUS_MODERATOR,
            Player::STATUS_ADMIN
        ];
    }
    
    /**
     * @return bool
     */
    public function isUserWithRights(): bool
    {
        return in_array($this->status, self::entitledStatuses());
    }
}

