<?php

namespace Index\Controller;

use Think\Controller;

class AbouttpController extends BaseController
{
    //公司状况
    public function index()
    {

            $this->display();

    }
    //企业文化
    public function  company_status(){
        $dataname = "system";
        $data = '';
        $list =  $this->selectfinddata($dataname,$data);
        //print_r($list);
        $this->assign('list', $list);
        $this->display();
    }
    public function about_history (){
        $dataname = "course";
        $data = '';
        $list =  $this->selectdata($dataname,$data);

        $list1 =  $this->selectfinddata($dataname,$data);

        $this->assign('list', $list);
        //print_r($list);
        $this->assign('list1', $list1);
        $this->display();
    }
    //发展历史ajax
    public function ajaxdata(){
       $id = I('post.id');
       $dataname = 'course';
       $list = M($dataname)->where("id = $id")->select();
        $msg = '成功';
        $code = 200;
        echo json_encode(['data' => $list, 'code' => $code, 'msg' => $msg]);
    }
    //荣誉证书
    public  function certificate(){
        $dataname = "credential";
        $data = '';
        $list = $this->selectdata($dataname,$data);
        $this->assign('list', $list);
        $this->display();
    }

    //全部查询
    private function selectdata($dataname, $data)
    {
        $list = M($dataname)->where($data)->select();
        if ($list) {
            return $list;

        } else {
            return false;
        }
    }

    //$limt查询
    private function selectdatalimt($dataname, $data, $limt)
    {
        $list = M($dataname)->where($data)->limit($limt)->select();
        if ($list) {
            return $list;

        } else {
            return false;
        }
    }
    //查询一条
    private function selectfinddata($dataname, $data){
        $list = M($dataname)->where($data)->find();
        if ($list) {
            return $list;

        } else {
            return false;
        }
    }
}