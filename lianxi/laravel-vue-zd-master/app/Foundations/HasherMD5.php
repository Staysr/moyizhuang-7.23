<?php

namespace App\Foundations;

use  Illuminate\Contracts\Hashing\Hasher;

class HasherMD5 implements Hasher
{
    /**
     * 仓库加密
     * @method make
     * @param string $value
     * @param array $options
     *
     * @return string
     *
     * @author luffyzhao@vip.126.com
     */
    public function make($value, array $options = [])
    {
        return md5($value);//根据后面加密规则来设置
    }

    /**
     * 验证
     * @method check
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if(empty($hashedValue)){
            return true;
        }
        return $this->make($value) === $hashedValue;
    }

    /**
     * 是否需要刷新
     * @method needsRehash
     * @param string $hashedValue
     * @param array $options
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }

    /**
     * Get information about the given hashed value.
     *
     * @param  string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return [];
    }
}