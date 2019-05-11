<?php
namespace app\common\controller;

use think\Controller;

/**
 * 前台模块的控制器基础类
 */
class IndexBase extends Controller {
	/**
	 * 初始化函数
	 *
	 * 可以写针对整个前台模块都起作用的公共代码
	 */
	public function _initialize() {
		$cs = model('category')->where('recommend=1')->select();

		$this->assign('cs', $cs);
	}
}