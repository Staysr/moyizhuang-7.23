<?php
namespace Personnelsystem\Controller;

use Think\Controller;
header("content-type:text/html;charset=utf-8");

class AboutController extends LoginTrueController
{
   public function index(){
        $this->display();
    }
}