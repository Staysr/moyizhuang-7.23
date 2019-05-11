<?php

namespace Index\Controller;

use Think\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $dataname = "banner";
        $data = '';
        $list = $this->selectdata($dataname, $data);
        if ($list) {
            $dataname = "dynamic";
            $data = '';
            $limit = 2;
            $list1 = $this->selectdatalimt($dataname, $data, $limit);

                $dataname = "solution";
                $data = '';
//                $limit = 2;
                $list2 = $this->selectdata($dataname, $data);
//
                $this->assign('list', $list);
             $this->assign('index', "index");
                $this->assign('list1', $list1);
                $this->assign('list2',$list2);
                $this->display();

        } else {
            $this->display();
        }
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
}