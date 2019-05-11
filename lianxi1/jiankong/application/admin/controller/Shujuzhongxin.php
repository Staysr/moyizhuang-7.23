<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Shiyan;

class Shujuzhongxin extends Common{

	// //曲线图
	// public function quxiantu($id){
	// 	$data = Shiyan::get($id);

	// 	$this->assign('data',$data);
	// 	return $this->fetch();
	// }

	//实验数据管理列表
	public function shujuzhi_list(){


    		//自动删除前七天的数据;
			$create_time = Shiyan::table('Shiyan')->where('create_time','<= time',strtotime('-7 days'))->select();
			foreach ($create_time as $time){
			    Shiyan::destroy($time['id']);
			}
	

		$data = Shiyan::paginate(10);
		$this->assign('data',$data);
		return $this->fetch();


	}

	public function shujuzhi_edit($id){
		

		if(request()->isAjax()){
			$data = request()->param();
			$validate = validate('Shiyan');
			if(!$validate->check($data)){
	               	$error = $validate->getError();
	                return ['error'=> $error];      
			}
			$admin = new Shiyan();
			if($admin->allowField(true)->save($data,['id'=>$id])){
	        		return ['status'=>1];
			}else {
	               	
	                return ['error'=> '更新失败'];
			}
			return;

		}


		$data = Shiyan::get($id);
		$this->assign('data',$data);
		return $this->fetch();
	}

	//数据删除
	public function shujuzhi_del($id){
		
	
		if($id){
			if(Shiyan::destroy($id)){
				return ['status'=>1,'messign'=>'删除成功！'];
			} else {
				return ['error'=>'删除失败！'];
			}

		}

	}

}

	
		
	




