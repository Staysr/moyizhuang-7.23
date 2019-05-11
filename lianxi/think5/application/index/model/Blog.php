<?php
namespace app\index\model;

use think\Model;


class Blog extends Model {
	// 时间字段的自动完成
	protected $autoWriteTimestamp = true;
	protected $updateTime = 'updated';
	protected $createTime = "created";
	protected $auto = []; 
	protected $insert = [
		'views' => 1,
		'uid',
	]; 
	protected $update = [];

	protected function setUidAttr() {
		return session('user.id') ?? 1;
	}

	public function author() {
		return $this->belongsTo('User', 'uid');
	}
	public function comments() {
		return $this->morphMany('comment',['comment_type','comment_id'],'blog')
			->order('created DESC')
			->paginate();
	}
	//获取当前模型名称,对应轻容热情如火comment_type;
	public function getName(){
		//当前模型名称
		return $this->name;
	}
}
