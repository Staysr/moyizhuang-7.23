<?php
namespace app\common\controller;

use think\Controller;

/**
 * 管理后台的控制器基类
 */
class Admin extends Controller {
	/**
	 * 初始化方法
	 */
	protected function _initialize() {
		if (!session('?admin')) {
			$this->redirect(url('admin/user/login'));
		}
	}
}
