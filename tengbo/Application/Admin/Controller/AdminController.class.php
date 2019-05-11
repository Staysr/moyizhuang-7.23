<?php
namespace Admin\Controller;
class AdminController extends BaseController {
	//管理员列表
	public function admin_list(){
        $list = M('admin')->select();
		
		$this->assign('list',$list);
		$this->display();
	}
	
	/**
	 * 修改管理员
	 */
	public function admin_update(){
		if(IS_POST){
			$res = M('admin')->where(['id'=>I('get.id')])->setField('password',md5($_POST['password']));
			if($res !== false){
				$this->success('修改成功',U('Admin/admin_list'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$info = M('admin')->find(I('get.id'));

			$this->assign('info',$info);
			$this->display();
		}
	}
	
	/**
	 * 添加管理员
	 */
	public function admin_add(){
		if(IS_POST){
			$count = M('admin')->where(['username'=>$_POST['username']])->count();
			if($count){
				$this->error('用户名已存在');
			}else{
				$_POST['password'] = md5($_POST['password']);
				$res = M('admin')->add($_POST);
				if($res){ 
					$this->success('添加成功',U('Admin/admin_list'));
				}else{
					$this->error('添加失败');
				}
			}
		}else{
			$this->display();
		}
	}
	
	/**
	 * 删除管理员
	 */
	public function admin_del(){
		M('admin')->delete(I('post.id'));
	}
	






}
