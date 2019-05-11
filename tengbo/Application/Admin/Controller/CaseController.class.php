<?php
namespace Admin\Controller;
class CaseController extends BaseController {
    /**
     * 案例分类
     */
    public function case_class_list(){
        $case_class = M('case_class');

        $count = $case_class->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $case_class->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加案例分类
     */
    public function case_class_add(){
        if(IS_POST){
            $res = M('case_class')->add($_POST);
            if($res){
                $this->success('添加成功',U('Case/case_class_list'));
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
    public function case_class_update(){
        if(IS_POST){
            $res = M('case_class')->save($_POST);
            if($res){
                $this->success('添加成功',U('Case/case_class_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('case_class')->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除案例分类
     */
    public function case_class_del(){
        M('case_class')->delete(I('post.id'));
    }

    /**
     * 案例列表
     */
    public function case_list(){
        $case = M('case c');

        I('cid') && $where['c.cid'] = I('cid');
        I('title') && $where['c.title'] = ['like','%'.I('title').'%'];
        I('stime') && I('etime') && $where['c.add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['c.add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['c.add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $case->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $case
            ->where($where)
            ->field('c.*,cc.class_name')
            ->join('tb_case_class cc ON c.cid=cc.id')
            ->order('c.add_time desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        $class = M('case_class')->select();

        $this->assign('list',$list);
        $this->assign('class',$class);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加案例
     */
    public function case_add(){
        if(IS_POST){
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $res = M('case')->add($_POST);
            if($res){
                $this->success('添加成功',U('Case/case_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $class = M('case_class')->select();
            $this->assign('class',$class);
            $this->display();
        }
    }

    /**
     * 编辑案例
     */
    public function case_update(){
        if(IS_POST){
            if($_FILES['pic']['name']){
                $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            }
            $res = M('case')->save($_POST);
            if($res){
                $this->success('添加成功',U('Case/case_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = M('case')->find(I('get.id'));
            $class = M('case_class')->select();

            $this->assign('class',$class);
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除案例
     */
    public function case_del(){
        M('case')->delete(I('post.id'));
    }




	
}
