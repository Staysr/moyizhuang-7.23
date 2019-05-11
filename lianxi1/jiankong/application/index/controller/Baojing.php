<?php
namespace app\index\controller;
use app\index\controller\Common;
use app\index\model\Baojing as BaojingModel;
class Baojing extends Common{

	public function baojing(){

		$baojing = new BaojingModel();
		$lists = $baojing->order('id','desc')->select();
		$this -> assign('lists',$lists);
		return $this->fetch();
	}
}
