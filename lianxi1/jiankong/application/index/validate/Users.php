<?php
namespace app\index\validate;
use think\Validate;
class Users extends Validate
{

    protected $rule = [
        ['danwei','require|max:40','单位不能为空|单位名最多不能超过40个字符'],
        ['name','require|max:60|unique:users','姓名不能为空|最多不能超过60个字符|姓名已经注册！'],
        ['email','email','邮箱格式错误'],
        ['password','require|max:60','密码不能为空|密码最多不能超过30个字符'],
        ['repassword','require|confirm:password','确认密码不能为空|密码两次输入不一致'],
        ['tel','require|number|max:25','电话不能为空|电话必须为数字|最大不能超过25字符'],
       
        ['captcha|验证码','require|captcha','验证码不能为空|验证码不正确！'],
        ['danwei_name','require|max:40','单位不能为空|单位名最多不能超过40个字符'],


       
    ];
    protected $scene=[
        'login'=>['danwei','name'=>'require|max:25','password'],
        'register'=>['danwei','name','tel','email','password','repassword','captcha'],
        'danwei'=>['name','tel','email','password','repassword','captcha','danwei_name'],

    ];
}