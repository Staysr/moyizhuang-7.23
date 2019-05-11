<?php
namespace app\admin\controller;
use think\Controller;
use dx\api_demo\SmsDemo;
use think\Loader;
class Api extends Controller{

	//管理员列表
	public function ceshi($content){

		$tel = "18332026588";

		$msg = new SmsDemo();
		$data =$msg->sendSms($tel,$content);
		dump($data);

	}






}

	


	




