<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;
class IndexController extends HomeBaseController
{
    public function index()
    {
        $list = Db::name('firsteague')->select();
        $list1 = Db::name('honors')->select();
        $marquee = Db::name('marquee')->select();
        $honors_index = Db::name('honors_index')->select();
        $this->assign("list", $list);
        $this->assign("list1", $list1);
        $this->assign("marquee", $marquee);
        $this->assign("honors_index", $honors_index);

        return $this->fetch(':index');
    }
    //主页加盟方法
    public function league()
    {
       $username = input('username');//姓名
       $phone = input('phone');//手机号
       $cite = input('cite');//地址
       $leave = input('leave');//留言
            $data = [];
            $data['username'] = $username;
            $data['phone'] = $phone;
            $data['cite'] = $cite;
            $data['leave'] = $leave;
            $data['add_time'] = time();
            $inster = Db::name('league')->insert($data);
    }
    public function joinshop()
    {
        return $this->fetch();
    }
}
