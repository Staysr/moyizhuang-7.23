<?php

namespace Applets\Controller;

use Common\Controller\AppletsController;

class IndexController extends AppletsController {
	public function __construct() {
		parent::__construct();
		$tmpData = $this->getPost("data");
		$this->postData = $this->decrypt($tmpData);
        $this->adModel = M('ad');
        $this->AlbumModel = M('album');
        $this->home_menusModel = M('home_menus');
        $this->AlbumMusicModel = M('album_music');
        $this->AtypeModel = D("Atype");
        $this->favorModel = D("favor");
        $this->OrderModel = M("Order");
	}
    /**
     * test
     */
    public function test(){
        echo C("SERVER_URL");
    $test = $this->decrypt('jtpk4e5bFhyJavBycYFg0w%2BRVTmpNDFh8HYUFtSOZ40%3D');
    print_r($test);
    }
    /**
     * 获取首页轮播图
     */
    public function getAd() {
        $post = isset($this->postData['type']) ? (int) $this->postData['type'] : 1;
        $time = time();
        $where = "post_id = {$post} and status =1 and start_time < {$time} and end_time > {$time}";
        $list = $this->adModel->where($where)->order("list_order desc")->field("id,title,path,url,video")->select();

        $this->arrReturn($list, "成功", 200);
    }

    /**
     *  首页列表
     */
    public function head(){
        $size = isset($this->postData['size']) ? (int) $this->postData['size'] : 15;
        $list = $this->pic_host($this->AlbumModel->where("status = 1 and home = 2")->order("list_order desc")->field("id,title,pic,is_free,memo1")->limit($size)->select(),"pic");
        $this->arrReturn($list, "成功", 200);
    }
    /**
     *  导航
     */
    public function menus(){
        $list = $this->pic_host($this->home_menusModel->where("status = 1")->order("list_order desc, id asc")->field("id,name,pic,url")->limit(10)->select(),"pic");
        $this->arrReturn($list, "成功", 200);
    }
    /**
     * 专辑详情  (无用户id 时使用)
     */
public function album(){
    if(isset($this->postData['id'])){
        $id = $this->postData['id'];
    }else{
        $this->arrReturn('', "请求专辑错误", 201);
    }
    $album_list = $this->pic_host($this->AlbumModel->where("status = 1")->find($id),"pic");
    $album_music = $this->pic_host($this->AlbumMusicModel->where("album_id = {$id} and issue = 1")->select(),"pic");
    $album_list['album_music'] = $album_music;
    $this->arrReturn($album_list, "成功", 200);
}
    /**
     * 专辑详情
     * is_free 1、免费 2、现金 3、积分 4、积分+现金
     */
    public function album_1(){
        if(isset($this->postData['id']) && isset($this->postData['uid'])){
            $id = $this->postData['id'];
            $uid = $this->postData['uid'];
        }else{
            $this->arrReturn('', "请求专辑错误", 201);
        }
        $album_list = $this->pic_host($this->AlbumModel->where("status = 1")->find($id),"pic");
        //是否已购买
        if($album_list['is_free'] > 1){
            $isBuy = $this->OrderModel->where("user_id = {$uid} and album_id = {$id} and status = 2")->find();
            if($isBuy){
                $album_list['isBuy'] = true;
            }else{
                $album_list['isBuy'] = false;
            }
        }else{
            $album_list['isBuy'] = false;
        }

        //喜欢
        $ablum_favor = $this->favorModel->where("a_id = {$album_list['id']} and uid = {$uid} and type = 1")->find();
        if($ablum_favor){
            $album_list['ablum_favor'] = true;
        }
        $album_music = $this->pic_host($this->AlbumMusicModel->where("album_id = {$id} and issue = 1")->order("list_order desc,id asc")->select(),"pic");
        $album_list['album_music'] = $album_music;
        $this->arrReturn($album_list, "成功", 200);
    }
    /**
     *  专辑名and图片
     */
    public function album_name(){
        if(isset($this->postData['id'])){
            $id = $this->postData['id'];
        }else{
            $this->arrReturn('', "请求专辑错误", 201);
        }
        $album_list = $this->pic_host($this->AlbumModel->field("title,pic")->where("status = 1")->find($id),"pic");
        $this->arrReturn($album_list, "成功", 200);
    }
    /**
     * 音频播放
     */
public function queryStory(){
  $id = $this->postData['id']; //音频
    $one_music = $this->pic_host($this->AlbumMusicModel->where("issue = 1")->field('title,id,like_num,listen_num,pic,price,duration,duration_1,music_url')->find($id),"pic","music_url");
    $this->arrReturn($one_music, "成功", 200);
}
/**
 * 专辑列表
 */
public function play(){
    $id = $this->postData['list_id']; //专辑
    $uid = $this->postData['uid']; //用户
    $mid = $this->postData['mid']; //音频id

    $album_list = $this->AlbumModel->where("status = 1")->find($id);
    //是否已购买
    if($album_list['is_free'] > 1){
        $isBuy = $this->OrderModel->where("user_id = {$uid} and album_id = {$id} and status = 2")->find();
        if($isBuy){
            //返回全部列表
            $album_music = $this->pic_host($this->AlbumMusicModel->where("album_id = {$id} and issue = 1")->order("list_order desc,id asc")->field('album_id,title,id,like_num,listen_num,pic,price,duration,duration_1,music_url')->select(),"pic","music_url");
        }else{
            //返回一条
            $album_music = $this->pic_host($this->AlbumMusicModel->where("album_id = {$id} and issue = 1 and id = {$mid}")->order("list_order desc,id asc")->field('album_id,title,id,like_num,listen_num,pic,price,duration,duration_1,music_url')->select(),"pic","music_url");
        }
    }else{
        $album_music = $this->pic_host($this->AlbumMusicModel->where("album_id = {$id} and issue = 1")->order("list_order desc,id asc")->field('album_id,title,id,like_num,listen_num,pic,price,duration,duration_1,music_url')->select(),"pic","music_url");
    }

    $this->arrReturn($album_music, "成功", 200);
}
/**
 * 最近播放
 */
public function recently(){
    $inid = rtrim(ltrim($this->postData['inid'],","),","); //音频id
    $album_music = $this->pic_host($this->AlbumMusicModel->where("id in ({$inid}) and issue = 1")->field('album_id,title,id,like_num,listen_num,pic,price,duration,duration_1,music_url')->select(),"pic","music_url");
    $this->arrReturn($album_music, "成功", 200);
}
/**
 *  专辑分类列表
 *  @typeId
 */
public function albumList(){
    $typeId = (int)$this->postData['typeId']; //主类
    // 子类
//    $subType = $this->AtypeModel->subType($typeId);
    //全部
    $list = $this->pic_host($this->AlbumModel->where("album_type_one = {$typeId} and status = 1")->order("list_order desc,id asc")->field("id,title,pic,is_free,memo1,m_num,f_plays,list_pic")->select(),"pic","list_pic");
    //主类名称
    $typeTitle = $this->AtypeModel->field("title")->find($typeId);
////分类下专辑
//    $arr = array();
//    foreach ($subType as $item){
//       $arr[] = $this->pic_host($this->AlbumModel->where("album_type_two = {$item['id']} and status = 1")->order("list_order desc")->field("id,title,pic,is_free,memo1,m_num,f_plays")->select(),"pic");
//    }
//    array_unshift($subType,array("title"=>"全部"));
//    array_unshift($arr,$list);

    $all = array('typeTitle'=>$typeTitle['title'],'arr'=>$list);
    $this->arrReturn($all, "成功", 200);
}

/**
 *  点赞
 */
 public function addFavor(){
     $aData = $this->postData;
     $uid = $aData['uid'];
     $a_id = $aData['a_id'];
     $type = $aData['type'];
$where = "uid = {$uid} and a_id = {$a_id} and type = {$type}";
     $list = $this->favorModel->where($where)->find();
     if($list){
         $this->favorModel->delete($list['id']);
         $this->arrReturn(false, "成功", 200);
     }else{
         unset($aData["action"]);
         $aData['add_time'] = time();
         $this->favorModel->add($aData);
         $this->arrReturn(true, "成功", 200);
     }
 }

 /**
  * 我喜欢的 列表
  */
 public function likeList(){
     $uid = $this->postData['uid'];
     $albumLike =  $this->favorModel->field("a_id")->where("uid = {$uid} and type = 1")->select(); //$this->pic_host( ,"pic","")
     $albumList_arr = $this->inString($albumLike,'a_id');
     $albumList = $albumList_arr ? $this->pic_host($this->AlbumModel->where("id in ({$albumList_arr}) and status = 1")->order("list_order desc")->field("id,title,pic,is_free,memo1,m_num,f_plays")->select(),"pic") : ""; //专辑

     $musicLike = $this->favorModel->where("uid = {$uid} and type = 2")->select();
     $musicList_arr = $this->inString($musicLike,'id');
     $musicList = $musicList_arr ? $this->pic_host($this->AlbumMusicModel->where("id in ({$musicList_arr}) and issue = 1")->field('album_id,title,id,like_num,listen_num,pic,price,duration,duration_1,music_url')->select(),"pic","music_url") : ''; //音频

     $arr = array("albumList"=>$albumList,"musicList"=>$musicList);
     $this->arrReturn($arr, "成功", 200);
 }

}
