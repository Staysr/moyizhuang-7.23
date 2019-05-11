<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Users as UsersModel;
use app\index\model\Danwei;
class Users extends Controller{


	//用户登录
	public function login(){
    	if(session('?userid')){
    		$this->error('用户已登陆，无需重新登陆',url('index/index'));
    	}
		$request = request();
		if($request->isAjax()){
			$data = $request->param();
			$validate = validate('Users');
			if(!$validate->scene('login')->check($data)){
		        $val = $validate->getError();
				return ['error'=>$val];
			}

			$user = UsersModel::get(['name' => $data['name']]);
			if($user){
				if($user['danwei']==$data['danwei']){

					if($user['password']==md5($data['password'])){

						session('userid',$user['id']);
						session('username',$user['name']);
						session('userdanweiid',$user['danwei']);

						return ['status'=>1]; 
					} else {
					
						return ['error'=>'密码不正确'];
					}

				}else{
					return ['error'=>'所在单位有误！'];
				}

			}else {
				
				return ['error'=>'用户名不存在'];	
			}

		}

		$danwei = Danwei::all();
		$this->assign('danwei',$danwei);


		return $this->fetch();
	}



	//用户注册
	public function zhuce(){

		$request = request();
		if($request->isAjax()){
			$data = $request->param();
							
			if(!$data['danwei_name']){ 
				//判断数据是否合法
				$validate = validate('Users');
				if(!$validate->scene('register')->check($data)){
			        $val = $validate->getError();
					return ['error'=>$val];
				}

				//如果都合法则添加用户
				if($data){
					$data['password']=md5($data['password']);
				}
				$users = new UsersModel();
				$res = $users-> allowField(true)->save($data);
				$idd = $users->id;
				if($res){
							session('userid',$idd);
							session('username',$data['name']);
							session('userdanweiid',$data['danwei']);	
								
							return ['status'=>1]; 
							
				}else {
					return ['error'=>'注册失败！'];
					
				}
				return;
			


			
			} else {
				//判断数据是否合法
				$validate = validate('Users');
				if(!$validate->scene('danwei')->check($data)){
		   			$val = $validate->getError();
					return ['error'=>$val];					
				}
				//如果都合法则添加单位
				$users = new Danwei();
				if($users-> allowField(true)->save($data)){
					//添加成功后获取单位id;
					$data['danwei'] = $users->id;		
				}else {
					return ['error'=>'单位注册失败！'];
				}
				//添加了单位以后则添加用户
				if($data){
					$data['password']=md5($data['password']);
				}
				$users = new UsersModel();
				$res = $users-> allowField(true)->save($data);
				$idd = $users->id;
				if($res){
							session('userid',$idd);
							session('username',$data['name']);
							session('userdanweiid',$data['danwei']);						
							return ['status'=>1]; 							
				}else {
					return ['error'=>'注册失败！'];
					
				}
				return;
			}
		}

		//没有post提交

		$danwei = Danwei::all();
		$this->assign('danwei',$danwei);
		return $this->fetch();
	}


	//用户退出
    public function logout(){
    	if(!session('?userid')){
    		$this->error('用户未登陆，无权访问',url('users/login'));
    	}
        session(null); 
        $this->redirect('login',302);
    }

   

}

	


	




