<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function login(){
		if(IS_POST){
			$verify = new\Think\Verify();
			if($verify->check($_POST['code'])){
				$admin = M('admin')->where(['username'=>$_POST['username'],'password'=>md5($_POST['password'])])->find();
				//验证账号密码
				if($admin){
					session('admin',$admin);
					$this->redirect('Index/index');
				}else{
					$this->success('用户名或密码错误');
				}
			}else{
				$this->error('验证码错误','Login/login',3);
			}
		}else{
			$this->display();
		}
	}
	
	public function logout(){
		session('admin',null);
		$this->redirect('Login/login');
	}
	
	public function verify(){
		$Verify = new \Think\Verify(['length'=>4]);
		$Verify->entry();
	}
	
	
	
}
