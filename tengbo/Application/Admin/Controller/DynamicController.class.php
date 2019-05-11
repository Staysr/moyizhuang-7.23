<?php
namespace Admin\Controller;
class DynamicController extends BaseController {
    /**
     * 动态聚焦
     */
    public function dynamic_list(){
        $dynamic = M('dynamic');

        $where['type'] = I('type');
        I('title') && $where['title'] = ['like','%'.I('title').'%'];
        I('stime') && I('etime') && $where['add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $dynamic->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $dynamic->where($where)->order('add_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加动态聚焦
     */
    public function dynamic_add(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('dynamic')->add($_POST);
            if($res){
                $this->success('添加成功',U('Dynamic/dynamic_list',array('type'=>I('get.type'))));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑动态聚焦
     */
    public function dynamic_update(){
        if(IS_POST){
            if($_POST['pic']['name']){
                $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            }

            $res = M('dynamic')->save($_POST);
            if($res){
                $this->success('修改成功',U('Dynamic/dynamic_list',array('type'=>I('get.type'))));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('dynamic')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除动态聚焦
     */
    public function dynamic_del(){
        M('dynamic')->delete(I('post.id'));
    }

    /**
     * 推荐到首页
     */
    public function is_home(){
        $dynamic = M('dynamic');
        $home = $dynamic->where(['id'=>I('post.id')])->getField('is_home');

        if($home){
            //取消推荐
            $dynamic->where(['id'=>I('post.id')])->setField('is_home',0);
            $this->ajaxReturn(['code'=>1,'msg'=>'取消推荐成功']);
        }else{
            //推荐
            $count = $dynamic->where(['is_home'])->count();
            if($count >= 2){
                $this->ajaxReturn(['code'=>0,'msg'=>'最多推荐两条']);
            }else{
                $dynamic->where(['id'=>I('post.id')])->setField('is_home',1);

                $this->ajaxReturn(['code'=>1,'msg'=>'推荐成功']);
            }
        }
    }

    /**
     * 推荐到公司动态首页
     */
    public function  is_recommend(){
        $dynamic = M('dynamic');
        $dynamic->where(['is_recommend'=>1])->setField('is_recommend',0);
        $dynamic->where(['id'=>I('post.id')])->setField('is_recommend',1);
    }

	
}
