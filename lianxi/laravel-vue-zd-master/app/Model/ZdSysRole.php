<?php

namespace App\Model;

use Illuminate\Cache\TaggableStore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ZdSysRole extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;
    
    protected $table = "zd_sys_role";
    
    protected $fillable = ['name', 'remark', 'is_admin', 'authority'];
    
    /**
     * 多对多关联权限模型
     * @method perms
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function perms()
    {
        return $this->belongsToMany(ZdSysRule::class, 'zd_sys_role_rule', 'role_id', 'rule_id');
    }
    
    /**
     * 用户模型
     * @method users
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function users()
    {
        return $this->hasMany(ZdSysUser::class, 'role', 'id');
    }
    
    /**
     * 不显示or包含超级管理员
     * @param Builder $query
     * @return Builder
     */
    public function scopeHideSuper(Builder $query)
    {
        return $query->where('is_admin', '=', 0);
    }
    
    /**
     * 缓存角色下所有的权限
     * @method cachedPermissions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     *
     * @author luffyzhao@vip.126.com
     */
    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey       = get_class($this) . '_for_role_' . $this->$rolePrimaryKey;
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags('BaseAuth')->remember(
                $cacheKey,
                Config::get('cache.ttl', 60),
                function () {
                    if ($this->getAttribute('is_admin') === 0) {
                        return $this->perms()->get();
                    }
                    else {
                        return ZdSysRule::all();
                    }
                }
            );
        }
        else {
            if ($this->getAttribute('is_admin') === 0) {
                return $this->perms()->get();
            }
            else {
                return ZdSysRule::all();
            }
        }
    }
    
    /**
     * 多对多关联组织模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roleCategorys()
    {
        return $this->belongsToMany(ZdCategory::class, 'zd_sys_role_category', 'role_id', 'category_id');
    }
}
