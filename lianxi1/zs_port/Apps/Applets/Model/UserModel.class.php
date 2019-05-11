<?php
/**
 * Date: 2018/11/8
 * Time: 19:30
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Model;

use Think\Model;

class UserModel extends Model
{
    /**
     * 查询用户
     * @param type $conditions  条件值
     * @param type $type        描述$conditions的条件，1：用户id
     * @param type $openid 校验openid
     * @return type
     */
    public function getUser($conditions, $type = 1, $openid = false) {
        if ($type == 1) {
            $userInfo = $this->find($conditions);
        } else {
            return failed('错误的查询类型', 199);
        }

        if (empty($userInfo)) {
            return failed('用户不存在', 100);
        }

        if ($openid && $userInfo['openid'] != $openid) {
            return failed('用户信息错误', 101, $userInfo);
        }
        return success($userInfo);
    }

}