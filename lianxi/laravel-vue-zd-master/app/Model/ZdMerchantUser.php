<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Hash;

use Illuminate\Notifications\Notifiable;

class ZdMerchantUser extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_merchant_user";

    protected $fillable = [
        'name',
        'password',
        'status',
        'merchant_id',
        'phone',
        'role',
        'device_token',
        'os',
        'os_version',
        'model',
        'app_version',
        'resolution'
    ];

    protected $hidden = ['password', 'pivot'];

    /**
     * 商户
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date 2018/6/20 10:32
     */
    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    /**
     * 设置密码
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
