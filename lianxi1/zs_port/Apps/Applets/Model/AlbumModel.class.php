<?php
/**
 * Date: 2018/11/8
 * Time: 20:37
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Model;

use Think\Model;

class AlbumModel extends Model
{

    /**
     * 购买成功人数累加
     * @param type $id
     * @param type $up
     */
    public function addUp($id, $up = 1) {
        $this->where("id = {$id}")->setInc('buy_person',$up);
    }

    /**
     * 更新播放次数
     * @param type $id
     * @param type $up
     */
    public function playsUp($id, $up = 1) {
        $this->where("id = {$id}")->setInc('r_plays',$up);
    }

}
