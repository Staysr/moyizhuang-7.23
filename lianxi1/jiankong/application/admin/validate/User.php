<?php
namespace app\admin\validate;
use think\Validate;
class User extends Validate
{

    protected $rule = [
        ['danwei','require|max:40','单位必须|单位名最多不能超过40个字符'],
        ['name','require|max:25|unique:users','姓名必须|姓名最多不能超过25个字符|姓名已注册！'],
        ['email','email','邮箱格式错误'],
        ['tel','require|number|max:25','电话不能为空|电话必须为数字|最大不能超过25字符'],
     
        ['password','require|max:60','，密码必须|密码最多不能超过60个字符'],
   
      
        ['repassword','require|confirm:password','确认密码不能为空|密码两次输入不一致'],
    ];

}