<?php

namespace App\Model;

use Illuminate\Support\Facades\Cache;
use Illuminate\Cache\TaggableStore;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ZdSysUser extends Authenticatable implements JWTSubject
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;
    
    protected $table = "zd_sys_user";
    
    protected $hidden = ['password'];
    protected $appends = ['merchants'];

    protected $fillable = [
        'phone',
        'password',
        'role',
        'manager',
        'name',
        'sex',
        'authority_level',
        'job_number',
        'contact',
        'birthday',
        'status'
    ];
    
    /**
     * 密码加密
     *
     * @param $value
     * @return string
     */
    protected function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }
    
    /**
     * 多对多关联角色表
     * @method role
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function roles()
    {
        return $this->belongsTo(ZdSysRole::class, 'role', 'id');
    }
    
    /**
     * 多对多关联城市表
     * @method categorys
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function categorys()
    {
        return $this->belongsTo(ZdCategory::class, 'role', 'id');
    }

    /**
     * 关联大队长
     * drivers
     * @author luffyzhao@vip.126.com
     */
    public function drivers(){
        return $this->belongsToMany(ZdDriver::class, 'zd_sys_user_driver', 'user_id', 'driver_id');
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
    
    /**
     * 在缓存开启状态下缓存用户下的所有角色
     * @method cachedRoles
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @author luffyzhao@vip.126.com
     */
    public function cachedRole()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey       = get_class($this) . '_for_role_' . $this->{$userPrimaryKey};
        
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags('ZdAuth')->remember(
                $cacheKey,
                Config::get('cache.ttl'),
                function () {
                    return $this->roles()->first();
                }
            );
        }
        else return $this->roles()->first();
    }

    /**
     * 后台人员所绑定的商户
     *
     * @author Mark
     * @date   2018/9/19 16:20
     */
    public function getMerchantsAttribute()
    {
        $user = auth('api')->user();
        $keys = [1 => 'advice_id', 2 => 'running_id', 4 => 'quality_id'];
        if ($user->role != 1 && $user->roles->authority == 1) {
            if ($user->authority_level == 0) {
                return true;
            } else {
                $result = ZdMerchant::where(
                    [$keys[$user->authority_level] => $user->id]
                )->get(['id'])->pluck('id')->toArray();

                return $result;
            }
        } else {
            return true;
        }
    }
    
}
