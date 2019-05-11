<?php
namespace app\index\controller;

use app\common\controller\IndexBase;
use app\index\model\Blog as BlogModel;
class Blog extends IndexBase{
	//初始化方法
	public function _initialize(){
       parent::_initialize();
       		$newest = db('blog')
			->field('id,title')
			->order('created DESC')
			->limit(5)
			->select();
		// 最热博客
		$hotest = db('blog')
			->field('id,title,views')
			->order('views DESC')
			->limit(5)
			->select();

		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);

	}
	//显示博客
	public function blogList(){
      $blogs = BlogModel::field('id,title,uid,created,views,content')
         ->order('created DESC')
         ->paginate();
         //查询
         $slide = db('blog')
           ->field('id,title,image')
           ->where('image','neq','')
           ->order('created DESC')
           ->limit(4)
           ->select();
          $this->assign('data',$blogs);
           $this->assign('slide',$slide);
           return $this->fetch();

	}
	public function user1(){
      return $this->fetch();	
  }
     public function all1(){
        $blogs = BlogModel::field('id,title,uid,created,views,content')
         ->order('created DESC')
         ->paginate();
        $slide = db('blog')
        ->field('id,title,image')
        ->where('image','neq','')
        ->order('created DESC')
        ->limit(4)
        ->select();
        $this->assign('data',$blogs);
        $this->assign('slide',$slide);
        return $this->fetch();
    }
    public function FunctionName($value='')
    {
      
    }
}