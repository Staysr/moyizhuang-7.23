<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Admin as AdminModel;
class Admin extends Common{

	//管理员列表
	public function admin_list(){
		$admin = AdminModel::paginate(10);
		$this->assign('admin',$admin);
		return $this->fetch();
	}

	//管理员编辑
	public function admin_edit($id){
		$user = AdminModel::get($id);
		if(request()->isAjax()){
			$data = request()->param();

			$validate = validate('admin');
	   		if(!$validate->scene('edit')->check($data)){
	               	$error = $validate->getError();
	                return ['error'=> $error];
	            }

	        $admin = new AdminModel;
	        if($user['password']!=$data['password']){
	        	$data['password'] = md5($data['password']);
	        }

	        $res = $admin->allowField(true)->save($data,['id'=>$id]);
	        if($res){
	        	return ['status'=>1];
	        }else {
	        	return ['error'=> '更新失败'];
	        }
			return;
		}

		$user = AdminModel::get($id);

		$this->assign('admin',$user);

		return $this->fetch();
	}



	//用户删除
	public function admin_del($id){
		
	
		if($id){
			if(AdminModel::destroy($id)){
				return ['status'=>1,'messign'=>'删除成功！'];
			} else {
				return ['status'=>2,'error'=>'删除失败！'];
			}

		}

	}


	//添加管理员
	public function admin_add(){

		if(request()->isAjax()){
			$data = request()->param();
			$validate = validate('Admin');
			if(!$validate->scene('add')->check($data)){
	               	$error = $validate->getError();
	                return ['error'=> $error];      
			}

			$data['password'] = md5($data['password']);
			$admin = new AdminModel();
			if($admin->allowField(true)->save($data)){
	        		return ['status'=>1];
			}else {
	               	$error = $validate->getError();
	                return ['error'=> $error];
			}
	

			return;

		}

		return $this->fetch();

	}




}

	


	




