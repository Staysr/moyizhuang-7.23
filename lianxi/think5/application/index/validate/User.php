<?php
namespace app\index\validate;

use think\Validate;

/**
 * 用户验证器
 */
class User extends Validate {
	// 验证规则
	protected $rule = [
		'username' => 'require|length:2,100|unique:user',
		'password' => 'require|min:6',
		'repassword' => 'require|confirm:password',
		'email' => 'email',
		// 手机号格式: 0133-3333-3333
		'phone' => 'regex:/^0?1[345678]\d{1}-?\d{4}-?\d{4}$/',
	];

	// 提示消息
	protected $message = [
		'username.require' => "用户名必须填写",
		'username.length' => "用户名长度非法(2-100位)",
		'username.unique' => "用户名被占用,请重试",
		'password.require' => "密码必须填写",
		'password.min' => "密码最短是6位",
		'repassword.require' => "确认密码不能为空",
		'repassword.confirm' => "两次输入的密码不一致,请重新输入",
		'phone.regex' => '手机号非法',
	];
}