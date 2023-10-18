<?php

namespace App\Models;

use App\Models\Traits\Imageable;
use App\Models\Traits\Posterable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Character
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property int $birthday_eon
 * @property string|array $character
 * @property string $habitat
 * @property string $ability
 * @property string $race
 * @property string $poster
 * @property float $power_level
 * @property bool $is_public
 */
class Character extends BaseModel
{
    use UserRelation,
        Imageable,
        Posterable,
        Taggable;
    
    /**
     * Характеристики персонажей
     */
    const TRAITS = [
        'Перфекционист',
        'Болезненный',
        'Циник',
        'Трус',
        'Тщеславный',
        'Смелый',
        'Подлый',
        'Мудрый',
        'Исследователь',
        'Дотошный',
        'Садист',
        'Внимательный',
        'Добродушный',
        'Ловкий',
        'Оратор',
        'Наглый',
        'Благородный',
        'Герой',
        'Нимфоман',
        'Развратный',
        'Коварный',
        'Хитрый',
        'Бесполезный',
        'Манипулятор',
        'Дерзкий',
        'Психопат',
        'Властный',
        'Жадный',
        'Могущественный',
        'Гуманист',
        'Расчетливый',
        'Лицемер',
        'Популярный',
        'Лжец',
        'Бессовестный',
        'Щедрый',
        'Ироничный',
        'Совестливый',
        'Гений',
        'Красивый',
        'Самовлюбленный',
        'Религиозный',
        'Упрямый',
        'Фетишист',
        'Извращенец',
        'Фанатик',
        'Рациональный',
        'Скромный',
        'Нонконформист',
        'Зануда',
        'Сноб',
        'Талантливый',
        'Высокомерный',
        'Амбициозный',
        'Мерзавец',
        'Харизматичный',
        'Язвительный',
        'Пугливый',
        'Безумный',
        'Решительный',
        'Грубый',
        'Агрессивный',
        'Мазохист',
        'Дисциплинированный',
        'Верный',
        'Романтичный',
        'Честный',
        'Эгоист',
        'Хладнокровный',
        'Тревожный',
        'Ленивый',
        'Надежный',
        'Невезучий',
        'Корыстолюбивый',
        'Жестокий',
        'Жалостливый',
        'Эрудированный',
        'Умный',
        'Находчивый',
        'Болтливый',
        'Гордый',
        'Смазливый',
        'Милый',
        'Веселый',
        'Терпиливый',
        'Молчаливый',
        'Малодушный',
        'Выносливый',
        'Полезный',
        'Сильный',
        'Слабый',
        'Глупый',
        'Тщедушный',
    ];
    
    /**
     * Классы существ
     */
    const POWER_CLASSES_V1 = [
        'mortal'          => 'Смертный, Морталес',
        'over_mortality'  => 'Преодолевший смертность, Дезапан',
        'demigod'         => 'Полубог, Демигод',
        'pseudo_god'      => 'Псевдобог, Демиург',
        'god'             => 'Бог',
        'deus'            => 'Бог второго преобразования, Деус',
        'traimas'         => 'Бог третьего преобразования, Траймас',
        'supreme_god'     => 'Высший бог, Дион',
        'pseudo_essence'  => 'Псевдосущность, Органта',
        'essence'         => 'Сущность',
        'essence_domina'  => 'Сущность-домина, Супримарх',
        'supreme_essence' => 'Высшая сущность, Манифестация',
        'absolute'        => 'Абсолют, Имманенталь',
    ];
    const POWER_CLASSES_V2 = [
        'mortal'          => 'Смертный',
        'demigod'         => 'Полубог,',
        'god'             => 'Бог',
        'supreme_god'     => 'Высший бог',
        'essence'         => 'Сущность',
        'supreme_essence' => 'Высшая сущность',
        'absolute'        => 'Абсолют',
    ];
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'character',
        'habitat',
        'ability',
        'race',
        'poster',
        'birthday_eon',
        'power_level',
        'is_public',
        'user_id',
    ];
    
    /**
     * @param array $value
     */
    public function setCharacterAttribute(array $value)
    {
        $this->attributes['character'] = implode(',', $value);
    }
    
    /**
     * @return array
     */
    public function getCharacterAttribute(): array
    {
        return isset($this->attributes['character']) ? explode(',', $this->attributes['character']) : [];
    }
    
    /**
     * @return string
     */
    public function getPowerClass(): string
    {
        $level = (int) $this->power_level;
        $powerClass = array_values(self::POWER_CLASSES)[$level - 1] ?? self::POWER_CLASSES['mortal'];
        
        return "($this->power_level) $powerClass";
    }
}
