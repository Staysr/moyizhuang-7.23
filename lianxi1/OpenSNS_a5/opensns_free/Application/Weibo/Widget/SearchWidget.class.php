<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 11:45
 * @author 路飞<lf@ourstu.com>
 */

namespace Weibo\Widget;

use Think\Controller;
use Weibo\Model\WeiboModel;

class SearchWidget extends Controller
{
    public function render()
    {
        $this->assignWeibo('create_time');
        $this->display(T('Application://Weibo@Widget/search'));
    }

    public function assignWeibo($field = 'create_time')
    {
        $keywords = I('post.keywords','','text');

        if($keywords) {
            $field = modC('WEIBO_SHOW_ORDER_FIELD', $field, 'Weibo');
            $order = modC('WEIBO_SHOW_ORDER_TYPE', 'desc', 'Weibo');

            $param['order'] = $field . ' ' . $order;
            $param['where'] = array('status' => 1, 'content' => array('like', '%' . $keywords . '%'));
            require_once(APP_PATH . 'Weibo/Common/function.php');
            $weiboModel = D('Weibo/Weibo');
            $data = $weiboModel->getWeiboList($param);
            foreach ($data as $key => $v) {
                $data[$key] = $weiboModel->getWeiboDetail($v);
            }

            unset($v);
        }

        foreach ($data as $key=>$vo){
            $content=M('weibo')->where(array('id'=>$vo['id']))->getField('content');
            $count_orign=substr_count($content,'***');
            $count_now=substr_count($vo['content'],'***');
            if($count_orign!=$count_now){
                unset($data[$key]);
            }
        }
        unset($key,$vo);
        //搜索的时候 没有权限看的微博不搜出来 zxh
        $uid=is_login();
        foreach ($data as $key=>$vo){
            if(empty($vo['crowd_id'])){
                continue;
            }
            $invisible=M('weibo_crowd')->where(array('id'=>$vo['crowd_id']))->getField('invisible');
            if($invisible==0){
                continue;
            }
            $is_crowd_member=M('weibo_crowd_member')->where(array('crowd_id'=>$vo['crowd_id'],'uid'=>$uid))->count();

            if($is_crowd_member>0){
                continue;
            }
            //删除无权限的微博
            unset($data[$key]);
        }
        unset($vo,$key);
        $this->assign('keywords', $keywords);
        $this->assign('weibo', $data);
    }
}