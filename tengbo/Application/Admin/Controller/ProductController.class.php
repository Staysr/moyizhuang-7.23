<?php
namespace Admin\Controller;
class ProductController extends BaseController {
    /**
     * 产品分类
     */
    public function product_class_list(){
        $product_class = M('product_class');

        $list = $product_class->field('id,sort,class_name,add_time')->where(['pid'=>0])->order('sort')->select();
        foreach($list as $k => $v){
            $class2 = $product_class->field('id,sort,class_name,add_time')->where(['pid'=>$v['id']])->order('sort')->select();
            foreach($class2 as $kk => $vv){
                $class3 = $product_class->field('id,sort,class_name,add_time')->where(['pid'=>$vv['id']])->order('sort')->select();
                $class2[$kk]['class3'] = $class3 ? :[];
            }
            $list[$k]['class2'] = $class2 ? :[];
        }

        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 添加分类
     */
    public function product_class_add(){
        $product_class = M('product_class');
        if(IS_POST){
            $pid = $_POST['class2'] ? :$_POST['class1'];
            $res = $product_class->add(['pid'=>$pid,'class_name'=>$_POST['class_name']]);
            if($res){
                $product_class->where(['id'=>$res])->setField('sort',$res);
                $this->success('添加成功',U('Product/product_class_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $class1 = $product_class->field('id,class_name')->where(['pid'=>0])->order('sort')->select();
            $class2 = $product_class->field('id,class_name')->where(['pid'=>$class1[0]['id']])->order('sort')->select();

            $this->assign('class1',$class1);
            $this->assign('class2',$class2);
            $this->display();
        }
    }

    /**
     * 编辑分类
     */
    public function product_class_update(){
        $product_class = M('product_class');
        if(IS_POST){
            $res = $product_class->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('Product/product_class_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $info = $product_class->find(I('get.id'));

            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 获取下级分类
     */
    public function getClass(){
        $list = M('product_class')->field('id,class_name')->where(['pid'=>I('post.id')])->order('sort')->select();
        $this->ajaxReturn($list);
    }

    /**
     * 获取2级和3级分类
     */
    public function get_class(){
        $class2 = M('product_class')->field('id,class_name')->where(['pid'=>I('post.id')])->order('sort')->select();
        $class3 = M('product_class')->field('id,class_name')->where(['pid'=>$class2[0]['id']])->order('sort')->select();
        $this->ajaxReturn([$class2,$class3]);
    }

    /**
     * 分类排序
     */
    public function product_class_sort(){
        M('product_class')->where(['id'=>I('post.id')])->setField('sort',I('post.sort'));
    }

    /**
     * 删除分类
     */
    public function product_class_del(){
        $product_class = M('product_class');
        $cid = I('post.id');
        switch (I('post.level')){
            case 1:
            case 2:
                $count = $product_class->where(['pid'=>$cid])->count();
                if($count){
                    $this->ajaxReturn(['code'=>0,'msg'=>'存在下级分类,删除失败']);
                }else{
                    $product_class->delete($cid);
                    $this->ajaxReturn(['code'=>1,'msg'=>'删除成功']);
                }
            break;
            case 3:
                $count = M('product')->where(['class3'=>$cid])->count();
                if($count){
                    $this->ajaxReturn(['code'=>0,'msg'=>'分类下存在产品,删除失败']);
                }else{
                    $product_class->delete($cid);
                    $this->ajaxReturn(['code'=>1,'msg'=>'删除成功']);
                }
            break;
        }
    }



    /**
     * 产品列表
     */
    public function product_list(){
        $product = M('product p');
        $product_class = M('product_class');

        I('class1') && $where['p.class1'] = I('class1');
        I('class2') && $where['p.class2'] = I('class2');
        I('class3') && $where['p.class3'] = I('class3');
        I('title') && $where['p.title'] = ['like','%'.I('title').'%'];
        I('stime') && I('etime') && $where['p.add_time'] = array('between', [I('stime').' 00:00:00', I('etime').' 23:23:59']);
        I('stime') && empty(I('etime')) && $where['p.add_time'] = array('egt', I('stime').' 00:00:00');
        I('etime') && empty(I('stime')) && $where['p.add_time'] = array('elt', I('etime').' 23:23:59');

        $count = $product->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();
        $list = $product
            ->where($where)
            ->field('p.id,p.title,p.pic,p.add_time,c1.class_name cname1,c2.class_name cname2,c3.class_name cname3')
            ->join('tb_product_class c1 ON c1.id=p.class1')
            ->join('tb_product_class c2 ON c2.id=p.class2')
            ->join('tb_product_class c3 ON c3.id=p.class3')
            ->order('p.add_time desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        $class1 = $product_class->field('id,class_name')->where(['pid'=>0])->order('sort')->select();
        if(I('class2')){
            $class2 = $product_class->field('id,class_name')->where(['pid'=>I('class1')])->order('sort')->select();
            $class3 = $product_class->field('id,class_name')->where(['pid'=>I('class2')])->order('sort')->select();
        }

        $this->assign('class1',$class1);
        $this->assign('class2',$class2);
        $this->assign('class3',$class3);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加产品
     */
    public function product_add(){
        if(IS_POST){
            $_FILES['pic2']['name'] && $_POST['pic2'] = $this->upload($_FILES['pic2'],'img/');
            $_FILES['pic3']['name'] && $_POST['pic3'] = $this->upload($_FILES['pic3'],'img/');
            $_FILES['pic4']['name'] && $_POST['pic4'] = $this->upload($_FILES['pic4'],'img/');
            $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $_POST['pic1'] = $this->upload($_FILES['pic1'],'img/');

            $res = M('product')->add($_POST);
            if($res){
                $this->success('添加成功',U('Product/product_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $product_class = M('product_class');
            $class1 = $product_class->field('id,class_name')->where(['pid'=>0])->order('sort')->select();
            $class2 = $product_class->field('id,class_name')->where(['pid'=>$class1[0]['id']])->order('sort')->select();
            $class3 = $product_class->field('id,class_name')->where(['pid'=>$class2[0]['id']])->order('sort')->select();

            $this->assign('class1',$class1);
            $this->assign('class2',$class2);
            $this->assign('class3',$class3);
            $this->display();
        }
    }

    /**
     * 编辑产品
     */
    public function product_update(){
        $product = M('product');
        if(IS_POST){
            $_FILES['pic']['name'] && $_POST['pic'] = $this->upload($_FILES['pic'],'img/');
            $_FILES['pic1']['name'] && $_POST['pic1'] = $this->upload($_FILES['pic1'],'img/');
            $_FILES['pic2']['name'] && $_POST['pic2'] = $this->upload($_FILES['pic2'],'img/');
            $_FILES['pic3']['name'] && $_POST['pic3'] = $this->upload($_FILES['pic3'],'img/');
            $_FILES['pic4']['name'] && $_POST['pic4'] = $this->upload($_FILES['pic4'],'img/');

            $res = $product->save($_POST);
            if($res !== false){
                $this->success('修改成功',U('Product/product_list'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $product_class = M('product_class');
            $info = $product->find(I('get.id'));

            $class1 = $product_class->field('id,class_name')->where(['pid'=>0])->order('sort')->select();
            $class2 = $product_class->field('id,class_name')->where(['pid'=>$info['class1']])->order('sort')->select();
            $class3 = $product_class->field('id,class_name')->where(['pid'=>$info['class2']])->order('sort')->select();

            $this->assign('class1',$class1);
            $this->assign('class2',$class2);
            $this->assign('class3',$class3);
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除产品
     */
    public function product_del(){
        M('product')->delete(I('post.id'));
    }



	
}
