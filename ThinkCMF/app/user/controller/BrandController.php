<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use cmf\controller\UserBaseController;
use app\user\model\UserFavoriteModel;
use think\Db;

class BrandController extends UserBaseController
{

    /**
     * 个人中心我的收藏列表
     */
    public function index()
    {
        $list = Db::name('brand')->find();
        $this->assign("list", $list);
        return $this->fetch();
    }

    //荣誉资质方法
    public function honor()
    {
        $list = Db::name('qualification')->select();
        $this->assign("list", $list);
        //返回值
        return $this->fetch();

    }

    //公司团队
    public function team()
    {
        $list = Db::name('companyteam')->paginate();
        $this->assign('page', $list->render());//单独提取分页出来
        $this->assign("list", $list);
        return $this->fetch();
    }

    //新闻资讯
    public function news()
    {
        $list = Db::name('newsinfo')->select()->toArray();

        //$list1 = Db::name('newsinfo')->paginate()->toArray();
        
         
         
         
        foreach ($list as $k => $v) {
            $list[$k]['m'] = date('m', strtotime($list[$k]['published_time'])) . '-' . date('d', strtotime($list[$k]['published_time']));

            $list[$k]['y'] = date('Y', strtotime($list[$k]['published_time']));

        }
        //$this->assign('list1', $list1);//单独提取分页出来
        $this->assign("list", $list);
        return $this->fetch();
    }

    public function newsinfo($id)
    {
        $id = input("id");

        $list = Db::name('newsinfo')->where("id = $id")->find();

        $this->assign("list", $list);

        return $this->fetch();
    }

    //联系我们
    public function contact()
    {
        return $this->fetch();
    }

    //地图
    public function map()
    {
        return $this->fetch();
    }

    public function leave()
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
        $inster = Db::name('leave')->insert($data);
    }

    /**
     * 用户取消收藏
     */
    public function delete()
    {
        $id = $this->request->param("id", 0, "intval");
        $userFavoriteModel = new UserFavoriteModel();
        $data = $userFavoriteModel->deleteFavorite($id);
        if ($data) {
            $this->success("取消收藏成功！");
        } else {
            $this->error("取消收藏失败！");
        }
    }

    /**
     * 用户收藏
     */
    public function add()
    {
        $data = $this->request->param();
        $result = $this->validate($data, 'Favorite');

        if ($result !== true) {
            $this->error($result);
        }

        $id = $this->request->param('id', 0, 'intval');
        $table = $this->request->param('table');


        $findFavoriteCount = Db::name("user_favorite")->where([
            'object_id' => $id,
            'table_name' => $table,
            'user_id' => cmf_get_current_user_id()
        ])->count();

        if ($findFavoriteCount > 0) {
            $this->error("您已收藏过啦");
        }


        $title = base64_decode($this->request->param('title'));
        $url = $this->request->param('url');
        $url = base64_decode($url);
        $description = $this->request->param('description', '', 'base64_decode');
        $description = empty($description) ? $title : $description;
        Db::name("user_favorite")->insert([
            'user_id' => cmf_get_current_user_id(),
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'object_id' => $id,
            'table_name' => $table,
            'create_time' => time()
        ]);

        $this->success('收藏成功');

    }
}