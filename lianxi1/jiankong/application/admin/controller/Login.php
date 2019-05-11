<?php
namespace app\admin\controller;
// use app\admin\controller\Common;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller{

//管理员登录
	public function login(){

		//判断用户是否登陆
    	if(session('?admin_id')){
    		$this->error('用户已登陆，无需重复登陆',url('index/index'));
    	}
	
		$request = request();
		if($request->isAjax()){
			$data = $request->param();
			$validate = validate('admin');
			if(!$validate->scene('login')->check($data)){
				$res = $validate->getError();
				return ['error'=>$res];
			}

			$user = Admin::get(['name' => $data['name']]);
			if($user){
					if($user['password']==md5($data['password'])){
						session('admin_id',$user['id']);
						session('admin_name',$user['name']);
						return ['status'=>1];
						
					} else {
						return ['error'=>'密码不正确'];
					}
			}else {
				return ['error'=>'用户名不存在'];	
			}

		}

		return $this->fetch();
	}

//管理员退出
    public function logout(){
    	//判断用户是否登陆
    	if(!session('?admin_id')){
    		$this->error('用户未登陆，无权访问',url('login/login'));
    	}
    
        session(null); 

        $this->redirect('login/login',302);
       
    }



}

	


	




