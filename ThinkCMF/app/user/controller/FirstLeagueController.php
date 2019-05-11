<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use think\Db;
use cmf\controller\AdminBaseController;

class FirstLeagueController extends AdminBaseController
{
    /**
     * 资源管理列表
     * @adminMenu(
     *     'name'   => '资源管理',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => 'file',
     *     'remark' => '资源管理列表',
     *     'param'  => ''
     * )
     */
    public function index()
    {

        return $this->fetch();
    }

    /**
     * 删除文件
     * @adminMenu(
     *     'name'   => '删除文件',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除文件',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id            = $this->request->param('id');
        $file_filePath = Db::name('asset')->where('id', $id)->value('file_path');
        $file          = 'upload/' . $file_filePath;
        $res = true;
        if (file_exists($file)) {
            $res = unlink($file);
        }
        if ($res) {
            Db::name('asset')->where('id', $id)->delete();
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

}