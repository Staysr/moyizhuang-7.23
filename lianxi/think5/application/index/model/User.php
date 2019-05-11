<?php

namespace app\index\model;

use think\Model;

/**
 * 前台用户模型
 */
class User extends Model {
	// 时间字段的自动完成
	protected $autoWriteTimestamp = true;
	protected $updateTime = false;
	protected $createTime = "created";


	protected function setPasswordAttr($value){
         return md5($value);
	}

	//关联模型
 public function blog(){
 	return $this->hasMany('Blog','uid')
 	->field('id,uid,title,created')
 	->order('created DESC')
 	->paginate();
 }
}