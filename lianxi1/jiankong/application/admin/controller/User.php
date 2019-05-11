<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Users;
use app\admin\model\Danwei;
class User extends Common{

	//用户列表
	public function user_list(){
		$users = Users::paginate(10);
		$this->assign('users',$users);
		return $this->fetch();
	}

	//用户编辑
	public function user_edit($id){
		$user = Users::get($id);
		if(request()->isAjax()){
			$data = request()->param();
			$validate = validate('User');
	   		if(!$validate->check($data)){
	               	$error = $validate->getError();
	                return ['error'=> $error];
	            }

	        $users = new Users;

	        if($user['password']!=$data['password']){
	        	$data['password'] = md5($data['password']);
	        }
	        $res = $users->allowField(true)->save($data,['id'=>$id]);
	        if($res){
	        	return ['status'=>1];
	        }else {
	        	return ['error'=> '更新失败'];
	        }
			return;
		}


		$danwei = Danwei::all();
		$this->assign('danwei',$danwei);
		$this->assign('user',$user);
		return $this->fetch();
	}

	//用户删除
	public function user_del($id){
		if($id){
			if(Users::destroy($id)){
				return ['status'=>1,'messign'=>'删除成功！'];
			} else {
				return ['status'=>2,'error'=>'删除失败！'];
			}

		}

	}

}

	
		
	




