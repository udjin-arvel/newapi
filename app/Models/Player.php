<?php

namespace App\Models;

use App\Exceptions\TBError;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * Class Player
 * @package App\Models
 *
 * @property User $user
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $age
 * @property int    $sex
 * @property string $poster
 * @property string $city
 * @property string $login
 * @property string $info
 * @property int    $clan
 */
class Player extends Model
{
    use UserTrait;
    
    const DEFAULT_LOGIN = 'Читатель';
    
    /**
     * Кланы-стороны Игрока
     */
    const CLAN_OUT   = 'no-clan';
    const CLAN_DARK  = 'dark-clan';
    const CLAN_GOLD  = 'gold-clan';
    const CLAN_LIGHT = 'light-clan';
    
    /**
     * Статус игрока
     */
    const STATUS_USER      = 'user';
    const STATUS_WRITER    = 'writer';
    const STATUS_MODERATOR = 'moderator';
    const STATUS_ADMIN     = 'admin';
    
    /**
     * Player constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        $user = Auth::user();
        if ($user) {
            $this->user = $user;
        }
    }
    
    /**
     * Получить название клана
     * @return array
     */
    public static function getClanTitles()
    {
        return [
            self::CLAN_OUT   => 'Нет клана',
            self::CLAN_DARK  => 'Темный клан',
            self::CLAN_GOLD  => 'Золотой клан',
            self::CLAN_LIGHT => 'Светлый клан',
        ];
    }
    
    /**
     * Выбрать сторону пользователя
     *
     * @param int $clanType
     * @throws TBError
     */
    public function chooseClan(int $clanType): void
    {
        $this->clan = $clanType;
        if (!$this->save()) {
            throw new TBError(TBError::CHOICE_SIDE_FAILED);
        }
    }
}
