<?php
namespace Admin\Controller;
class SystemController extends BaseController {
    /**
     * 合作单位列表
     */
    public function cooperator_list(){
        $cooperator = M('cooperator');

        $count = $cooperator->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $cooperator->limit($Page->firstRow . ',' . $Page->listRows)->order('sort')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加合作单位
     */
    public function cooperator_add(){
        if(IS_POST){
            $data['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('cooperator')->add($data);
            if($res){
                M('cooperator')->where(['id'=>$res])->setField('sort',$res);
                $this->success('添加成功',U('System/cooperator_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑合作单位
     */
    public function cooperator_update(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('cooperator')->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('System/cooperator_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('cooperator')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除合作单位
     */
    public function cooperator_del(){
        M('cooperator')->delete(I('post.id'));
    }

    /**
     * 合作单位修改排序
     */
    public function cooperator_sort(){
        M('cooperator')->where(['id'=>I('post.id')])->setField('sort',I('post.sort'));
    }




    /**
     * 公司历程列表
     */
    public function course_list(){
        $course = M('course');

        $count = $course->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $course->limit($Page->firstRow . ',' . $Page->listRows)->order('year')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加历程
     */
    public function course_add(){
        if(IS_POST){
            $res = M('course')->add($_POST);
            if($res){
                $this->success('修改成功',U('System/course_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑历程
     */
    public function course_update(){
        if(IS_POST){
            $res = M('course')->save($_POST);
            if($res){
                $this->success('修改成功',U('System/course_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('course')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除历程
     */
    public function course_del(){
        M('course')->delete(I('post.id'));
    }




    /**
     * 荣誉证书列表
     */
    public function credential_list(){
        $credential = M('credential');

        $count = $credential->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $credential->limit($Page->firstRow . ',' . $Page->listRows)->order('sort')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 荣誉证书添加
     */
    public function credential_add(){
        if(IS_POST){
            $data['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('credential')->add($data);
            if($res){
                M('credential')->where(['id'=>$res])->setField('sort',$res);
                $this->success('添加成功',U('System/credential_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 荣誉证书修改
     */
    public function credential_update(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('credential')->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('System/credential_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('cooperator')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 荣誉证书删除
     */
    public function credential_del(){
        M('credential')->delete(I('post.id'));
    }

    /**
     * 荣誉证书修改排序
     */
    public function credential_sort(){
        M('credential')->where(['id'=>I('post.id')])->setField('sort',I('post.sort'));
    }



    /**
     * 轮播图列表
     */
    public function banner_list(){
        $banner = M('banner');

        $count = $banner->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $banner->limit($Page->firstRow . ',' . $Page->listRows)->order('sort')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 轮播图添加
     */
    public function banner_add(){
        if(IS_POST){
            $data['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('banner')->add($data);
            if($res){
                M('banner')->where(['id'=>$res])->setField('sort',$res);
                $this->success('添加成功',U('System/banner_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 轮播图修改
     */
    public function banner_update(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('banner')->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('System/banner_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('banner')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 轮播图删除
     */
    public function banner_del(){
        M('banner')->delete(I('post.id'));
    }

    /**
     * 轮播图修改排序
     */
    public function banner_sort(){
        M('banner')->where(['id'=>I('post.id')])->setField('sort',I('post.sort'));
    }



    /**
     * 在线留言列表
     */
    public function leave_word_list(){
        $leave_word = M('leave_word');

        I('phone') && $where['phone'] = ['like','%'.I('phone').'%'];
        I('stime') && I('etime') && $where['add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $leave_word->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $leave_word->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('add_time desc')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 删除留言
     */
    public function leave_word_del(){
        M('leave_word')->delete(I('post.id'));
    }



    /**
     * 项目团队人员
     */
    public function team_staff_list(){
        $team_staff = M('team_staff');

        $count = $team_staff->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $team_staff->limit($Page->firstRow . ',' . $Page->listRows)->order('sort')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 项目团队人员添加
     */
    public function team_staff_add(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('team_staff')->add($_POST);
            if($res){
                M('team_staff')->where(['id'=>$res])->setField('sort',$res);
                $this->success('添加成功',U('System/team_staff_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 项目团队人员修改
     */
    public function team_staff_update(){
        if(IS_POST){
            if($_FILES['pic']['name']){
                $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            }

            $res = M('team_staff')->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('System/team_staff_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('team_staff')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 项目团队人员删除
     */
    public function team_staff_del(){
        M('team_staff')->delete(I('post.id'));
    }

    /**
     * 项目团队人员修改排序
     */
    public function team_staff_sort(){
        M('team_staff')->where(['id'=>I('post.id')])->setField('sort',I('post.sort'));
    }


    /**
     * 联系我们基本信息
     */
    public function contact_us(){
        $contact_us = M('contact_us');
        if(IS_POST){
            $_FILES['project1']['name'] && $_POST['project1'] = $this->upload($_FILES['project1'],'img/');
            $_FILES['project2']['name'] && $_POST['project2'] = $this->upload($_FILES['project2'],'img/');
            $_FILES['project3']['name'] && $_POST['project3'] = $this->upload($_FILES['project3'],'img/');
            $_FILES['project4']['name'] && $_POST['project4'] = $this->upload($_FILES['project4'],'img/');
            $_FILES['project5']['name'] && $_POST['project5'] = $this->upload($_FILES['project5'],'img/');
            $_FILES['project6']['name'] && $_POST['project6'] = $this->upload($_FILES['project6'],'img/');
            $_FILES['pic1']['name'] && $_POST['pic1'] = $this->upload($_FILES['pic1'],'img/');
            $_FILES['pic2']['name'] && $_POST['pic2'] = $this->upload($_FILES['pic2'],'img/');

            $res = $contact_us->save($_POST);
            if($res !== false){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = $contact_us->find();

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 关于腾博基础信息
     */
    public function system(){
        $system = M('system');
        if(IS_POST){
            $_FILES['pic1']['name'] && $_POST['pic1'] = $this->upload($_FILES['pic1'],'img/');
            $_FILES['pic2']['name'] && $_POST['pic2'] = $this->upload($_FILES['pic2'],'img/');
            $_FILES['pic3']['name'] && $_POST['pic3'] = $this->upload($_FILES['pic3'],'img/');
            $_FILES['pic4']['name'] && $_POST['pic4'] = $this->upload($_FILES['pic4'],'img/');

            $res = $system->save($_POST);
            if($res !== false){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = $system->find();

            $this->assign('info',$info);
            $this->display();
        }
    }












}
