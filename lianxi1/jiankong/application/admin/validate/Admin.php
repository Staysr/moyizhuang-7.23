<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{

    protected $rule = [
        ['name','require|max:50|unique:admin','姓名必须|姓名最多不能超过50个字符|已经注册'],
        ['password','require|max:60','密码必须|密码最多不能超过60个字符'],
        ['repassword','require|confirm:password','确认密码不能为空|密码两次输入不一致'],
        ['captcha|验证码','require|captcha','验证码必须|验证码不正确！']

    ];
    protected $scene=[
        'login'=>['name'=>'require|max:25','password','captcha'],
        'add'=>['name','password','repassword'],
        'edit'=>['name','password','repassword'],
        
    ];
}