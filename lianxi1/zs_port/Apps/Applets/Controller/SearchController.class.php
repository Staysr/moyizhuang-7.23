<?php
/**
 * Date: 2018/11/8
 * Time: 19:27
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Controller;

use Common\Controller\AppletsController;

class SearchController extends AppletsController
{
	
    /**
     * 构造方法，自动解析post请求数据
     */
    public function __construct()
    {
        parent::__construct();
        $tmpData = $this->getPost("data");
        $this->postData = $this->decrypt($tmpData);
		$this->AlbumModel = M('album');
		$this->AlbumMusicModel = M('album_music');
    }
	
	public function index(){
		 $aData = $this->postData;
		 $album = $this->pic_host($this->AlbumModel->field("id,title,pic,is_free,memo1,m_num,f_plays")->where("title like '%{$aData['value']}%' and status = 1")->order('list_order desc, id desc')->select(),"pic");
         $this->arrReturn($album,"专辑获取成功",200);

		
	}

}