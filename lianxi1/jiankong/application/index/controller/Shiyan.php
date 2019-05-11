<?php
namespace app\index\controller;
use app\index\controller\Common;
use app\index\model\Shiyan as ShiyanModel;
use app\index\model\Danwei;
use app\index\model\Biaozhun;
use app\index\model\Baojing;
use app\admin\controller\Api;

class Shiyan extends Common{


	public function  dxbj(){

		//短信报警、报警
		$request = request();
		if($request->isAjax()){
			$data = $request->param();
			static $content = array();
			$baojing = Biaozhun::get(1);


			//温度检测
			if($data['startwendu']?$data['startwendu'] < $baojing['wendumin']:null){
				$content['startwendu'] = '开始温度过低！';
			}elseif($data['startwendu']?$data['startwendu'] > $baojing['wendumax']:null){
				$content['startwendu'] = '开始温度过高！';
			}
			if($data['endwendu']?$data['endwendu'] < $baojing['wendumin']:null){
				$content['endwendu'] = '结束温度过低！';
			}elseif($data['endwendu']?$data['endwendu'] > $baojing['wendumax']:null){
				$content['endwendu'] = '结束温度过高！';
			}

			//湿度检测
			if($data['startshidu']?$data['startshidu'] < $baojing['shidumin']:null){
				$content['startshidu'] = '开始湿度过低！';
			}elseif($data['startshidu']?$data['startshidu'] > $baojing['shidumax']:null){
				$content['startshidu'] = '开始湿度过高！';
			}
			if($data['endshidu']?$data['endshidu'] < $baojing['shidumin']:null){
				$content['endshidu'] = '结束湿度过低！';
			}elseif($data['endshidu']?$data['endshidu'] > $baojing['shidumax']:null){
				$content['endshidu'] = '结束湿度过高！';
			}

			//氧气检测
			if($data['startyangqi']?$data['startyangqi'] < $baojing['yangqimin']:null){
				$content['startyangqi'] = '开始氧气过低！';
			}elseif($data['startyangqi']?$data['startyangqi'] > $baojing['yangqimax']:null){
				$content['startyangqi'] = '开始氧气过低！';
			}
			if($data['endyangqi']?$data['endyangqi'] < $baojing['yangqimin']:null){
				$content['endyangqi'] = '结束氧气过低！';
			}elseif($data['endyangqi']?$data['endyangqi'] > $baojing['yangqimax']:null){
				$content['endyangqi'] = '结束氧气过低！';
			}

			//二氧化碳检测
			if($data['starteryang']?$data['starteryang'] < $baojing['eryangmin']:null){
				$content['starteryang'] = '开始二氧化碳过低！';
			}elseif($data['starteryang']?$data['starteryang'] > $baojing['eryangmax']:null){
				$content['starteryang'] = '开始二氧化碳过高！';
			}
			if($data['enderyang']?$data['enderyang'] < $baojing['eryangmin']:null){
				$content['enderyang'] = '开始二氧化碳过低！';
			}elseif($data['enderyang']?$data['enderyang'] > $baojing['eryangmax']:null){
				$content['enderyang'] = '结束二氧化碳过高！';
			}


			//如果有报警则发送短信和保存到报警列表
			if($content){
				$content = implode('',$content);
				//发送报警短信
				// $api = new Api();
				// $api->ceshi($content);

				//把报警保存到报警列表
				$baojing = new Baojing();
				static $res = array();
				$res['danweiname'] = $data['danwei'];
				$res['status'] = $content;
				$res['time'] = time();
				$baojing_list = $baojing->allowField(true)->save($res);
					if($baojing_list){
						return ['status'=>1,'error'=>'有报警！'];
					}				
			}


		}
	}



	public function sysz(){

		$request = request();
		if($request->isAjax()){
			$data = $request->param();

			// $validate = validate('Shiyanzhongxin');
			// if(!$validate->check($data)){
		 //        $val = $validate->getError();
			// 	return ['error'=>$val];
			// }


			$users = new ShiyanModel();
			$res = $users-> allowField(true)->save($data);
			if($res){
				$saveid = $users->id;
				return ['status'=>1,'id'=>$saveid];
			}else {
				return ['error'=>'添加失败！'];
			}

			return;
		}

		$danwei = Danwei::get(session('userdanweiid'));
		$this->assign('danwei',$danwei);
		return $this->fetch();

	}





	public function syjg($id){

		//获取数据$data 和报警规则$baojing
		$data = ShiyanModel::get($id);
		$this->assign('data',$data);
		return $this->fetch();
	}



    	

}

	




	




