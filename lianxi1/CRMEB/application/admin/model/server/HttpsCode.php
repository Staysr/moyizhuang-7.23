<?php
/**
 *
 * @author: xaboy<365615158@qq.com>
 * @day: 2017/11/13
 */

namespace app\admin\model\server;

use traits\ModelTrait;
use basic\ModelBasic;

/**
 * 身份管理 model
 * Class SystemRole
 * @package app\admin\model\system
 */
class HttpsCode extends ModelBasic
{
    use ModelTrait;

    public static function systemPage()
    {
       $model=new self;
        return self::page($model);
    }


}