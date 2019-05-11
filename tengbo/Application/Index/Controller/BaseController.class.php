<?php
namespace Index\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize() {
        $product_class = M('product_class')->field('id,class_name')->where(['pid'=>0])->order('sort')->select();
        $solution_class = M('solution')->field('id,title')->select();
        $case_class=M('case_class')->field('id,class_name')->select();

        $assign = array(
            'product_class'=>$product_class,
            'solution_class'=>$solution_class,
            'case_class'=>$case_class
        );

        $this->assign($assign);
    }

}