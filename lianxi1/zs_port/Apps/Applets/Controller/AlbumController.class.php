<?php
/**
 * Date: 2018/11/7
 * Time: 18:07
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Controller;

use Common\Controller\AppletsController;
use Applets\Model\IntegralModel;

class AlbumController extends AppletsController
{
    public function __construct()
    {
        parent::__construct();
        $tmpData = $this->getPost("data");
        $this->postData = $this->decrypt($tmpData);
        $this->AlbumModel = D('album');
        $this->AlbumMusicModel = M('album_music');
        $this->favorModel = D("favor");
        $this->IntegralModel = new IntegralModel();
    }
    /**
     *  统计播放
     */
    public function playsUp(){
        $this->AlbumModel->playsUp($this->postData['id']); //专辑
        $this->AlbumMusicModel->where("id = {$this->postData['mid']}")->setInc('listen_num',1);
        $this->arrReturn('', "成功", 200);
    }

    /**
     *  检查积分是否足够
     */
    public function integralSatisfaction(){
        if(!isset($this->postData['uid']) || !isset($this->postData['integral'])){
            $this->arrReturn('', "参数错误", 201);
        }
        $integral = $this->IntegralModel->user_integral($this->postData['uid'])['integral'];
        if(!$integral || $integral < $this->postData['integral']){
            $this->arrReturn('', "积分不足", 201);
        }
        $this->arrReturn($integral, "成功", 200);
    }
}