<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at;
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $birthday
 * @property Address $address
 * @property string $addr_si_do
 * @property string $addr_si_gun_gu
 * @property string $addr_dong_ri
 * @property bool $addr_is_mountain
 * @property string $addr_jibun_number
 * @property string $addr_road_name
 * @property int $addr_is_basement
 * @property string $addr_building_number
 * @property string $addr_detail
 * @property string $addr_point_x
 * @property string $addr_point_y
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
        'addr_si_do',
        'addr_si_gun_gu',
        'addr_dong_ri',
        'addr_is_mountain',
        'addr_jibun_number',
        'addr_road_name',
        'addr_is_basement',
        'addr_building_number',
        'addr_detail',
        'addr_point_x',
        'addr_point_y',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'datetime',
    ];

    protected $appends = [
        'address',
    ];

    public function setAddressAttribute(Address $address)
    {
        $this->attributes['addr_si_do'] = $address->getSiDo();
        $this->attributes['addr_si_gun_gu'] = $address->getSiGunGu();
        $this->attributes['addr_dong_ri'] = $address->getDongRi();
        $this->attributes['addr_is_mountain'] = $address->isMountain();
        $this->attributes['addr_jibun_number'] = $address->getJibunNumber();
        $this->attributes['addr_road_name'] = $address->getRoadName();
        $this->attributes['addr_is_basement'] = $address->getIsBasement();
        $this->attributes['addr_building_number'] = $address->getBuildingNumber();
        $this->attributes['addr_detail'] = $address->getDetail();
        $this->attributes['addr_point_x'] = $address->getPoint()->getX();
        $this->attributes['addr_point_y'] = $address->getPoint()->getY();
    }

    public function getAddressAttribute()
    {
        return new Address(
            $this->attributes['addr_si_do'],
            $this->attributes['addr_si_gun_gu'],
            $this->attributes['addr_dong_ri'],
            $this->attributes['addr_is_mountain'],
            $this->attributes['addr_jibun_number'],
            $this->attributes['addr_road_name'],
            $this->attributes['addr_is_basement'],
            $this->attributes['addr_building_number'],
            $this->attributes['addr_detail'],
            new Point(
                $this->attributes['addr_point_x'],
                $this->attributes['addr_point_y']
            )
        );
    }
}
