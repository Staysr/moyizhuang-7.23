<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Danwei;
use app\admin\model\Shebei;
class Gongsi extends Common{

	//单位列表
	public function danwei_list(){
		$danwei = Danwei::order('id', 'desc')->paginate(10);
		$this->assign('danwei',$danwei);
		return $this->fetch();
	}


	//添加单位
	public function danwei_add(){

		if(request()->isAjax()){
			$data = request()->param();
			$validate = validate('Gongsi');
			if(!$validate->check($data)){
	               	$error = $validate->getError();
	                return ['error'=> $error];      
			}
			$admin = new Danwei();
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

	//用户编辑
	public function danwei_edit($id){


		if(request()->isAjax()){
			$data = request()->param();
			$validate = validate('Gongsi');
			if(!$validate->check($data)){
	               	$error = $validate->getError();
	                return ['error'=> $error];      
			}
			$admin = new Danwei();
			if($admin->allowField(true)->save($data,['id'=>$id])){
	        		return ['status'=>1];
			}else {
	               	
	                return ['error'=> '更新失败'];
			}
			return;

		}

		$danwei = Danwei::get($id);
		$this->assign('danwei',$danwei);
		return $this->fetch();
	}

	//单位删除
	public function danwei_del($id){
		
	
		if($id){
			if(Danwei::destroy($id)){
				return ['status'=>1,'messign'=>'删除成功！'];
			} else {
				return ['error'=>'删除失败！'];
			}

		}

	}







}

	


	




