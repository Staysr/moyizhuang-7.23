<?php
namespace Admin\Controller;
class JobController extends BaseController {
    /**
     * 招聘岗位列表
     */
    public function job_list(){
        $job = M('job');

        $count = $job->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $job->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 删除岗位
     */
    public function job_del(){
        M('job')->delete(I('post.id'));
    }


    /**
     * 添加案例分类
     */
    public function job_add(){
        if(IS_POST){
            $res = M('job')->add($_POST);
            if($res){
                $this->success('添加成功',U('Job/job_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑案例分类
     */
    public function job_update(){
        if(IS_POST){
            $res = M('job')->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('Job/job_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('job')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 解决方案列表
     */
    public function solution_list(){
        $solution = M('solution');

        $count = $solution->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $solution->limit($Page->firstRow . ',' . $Page->listRows)->order('add_time desc')->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加方案
     */
    public function solution_add(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('solution')->add($_POST);
            if($res){
                $this->success('修改成功',U('Job/solution_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑案例
     */
    public function solution_update(){
        if(IS_POST){
            if($_FILES['pic']['name']){
                $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            }
            $res = M('solution')->save($_POST);
            if($res){
                $this->success('添加成功',U('Job/solution_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('solution')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除案例
     */
    public function solution_del(){
        M('solution')->delete(I('post.id'));
    }




	
}
