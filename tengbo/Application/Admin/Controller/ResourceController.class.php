<?php
namespace Admin\Controller;
class ResourceController extends BaseController {
    /**
     * 精彩视频
     */
    public function video_list(){
        $great_video = M('great_video');

        I('title') && $where['title'] = ['like','%'.I('title').'%'];
        I('stime') && I('etime') && $where['add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $great_video->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $great_video->where($where)->order('add_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加视频
     */
    public function video_add(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('great_video')->add($_POST);
            if($res){
                $this->success('添加成功',U('Resource/video_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑视频
     */
    public function video_update(){
        if(IS_POST){
            if($_POST['pic']['name']){
                $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            }

            $res = M('great_video')->save($_POST);
            if($res){
                $this->success('修改成功',U('Resource/video_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('great_video')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除视频
     */
    public function video_del(){
        M('great_video')->delete(I('post.id'));
    }

    /**
     * 技术文章
     */
    public function article_list(){
        $skill_article = M('skill_article');

        I('title') && $where['title'] = ['like','%'.I('title').'%'];
        I('stime') && I('etime') && $where['add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $skill_article->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $skill_article->where($where)->order('add_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加技术文章
     */
    public function article_add(){
        if(IS_POST){
            $res = M('skill_article')->add($_POST);
            if($res){
                $this->success('添加成功',U('Resource/article_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑技术文章
     */
    public function article_update(){
        if(IS_POST){
            $res = M('skill_article')->save($_POST);
            if($res){
                $this->success('修改成功',U('Resource/article_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('skill_article')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除技术文章
     */
    public function article_del(){
        M('skill_article')->delete(I('post.id'));
    }


    /**
     * 常见问题
     */
    public function issue_list(){
        $issue = M('issue');

        I('title') && $where['title'] = ['like','%'.I('title').'%'];
        I('stime') && I('etime') && $where['add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $issue->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $issue->where($where)->order('add_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加常见问题
     */
    public function issue_add(){
        if(IS_POST){
            $res = M('issue')->add($_POST);
            if($res){
                $this->success('添加成功',U('Resource/issue_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑常见问题
     */
    public function issue_update(){
        if(IS_POST){
            $res = M('issue')->save($_POST);
            if($res){
                $this->success('修改成功',U('Resource/issue_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('issue')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除常见问题
     */
    public function issue_del(){
        M('issue')->delete(I('post.id'));
    }



	
}
