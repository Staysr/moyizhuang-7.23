<?php
namespace app\index\controller;

use think\Controller;
use think\Validate;
use think\Request;
use app\index\model\User as UserModel;
class User extends Controller{
	public function login(){
     return $this->fetch();
	}
	public function doLogin(){
       $data = request()->param();
       //判断密码和用户名
		if (!captcha_check($data['captcha'])) {
			//验证码
			$this->error('验证码非法');
		};
		//验证密码和账号
	     $rule=[
             'username'=>'require',
             'password'=>'require'
	     ];
	     //登入错误提示
	     $message=[
             'username.require'=>'用户名不能为空',
             'password.require'=>'密不能为空'
	     ];
	     //实例化类
	     $v = new Validate($rule,$message);
	     if (!$v->check($data)) {
	     	$this->error($v->getError());
	     	$username = $data['username'];
	     	$password = md5($data['password']);
	     	$user = db('user')
	     	->where('username', 'eq',$username)
	     	->where('password','eq',$password)
	     	->file();
	     	if ($user) {
	     		session('user',$user);
	     		$this->success('登入成功');
	     	}else{
	     		$this->error('登入失败');
	     	}
	     }

	}
	//前台用户登入控制器
	public function register(){
		return $this->fetch();
		
    }
    public function doRegister(Request $request){
       //验证码验证
    	$data = $request->param();
    	
		if (empty($data['captcha']) || !captcha_check($data['captcha'])) {
			$this->error("验证码非法");
		};
    	$model = new UserModel;
    	$res = $model->allowField(true)->validate(true)->save($data);
    	if ($res) {
    	$this->success('注册成功');

    	}else{
    		$this->error('注册失败');
    	}
    }
}
