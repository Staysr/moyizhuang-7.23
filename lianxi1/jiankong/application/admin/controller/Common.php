<?php
namespace app\admin\controller;
use think\Controller;

class Common extends Controller{


    protected function _initialize()
    {

    	//判断用户是否登陆
    	if(!session('?admin_id')){
    		$this->error('用户未登陆，无权访问',url('login/login'));
    	}
       
    }



	
}



?>