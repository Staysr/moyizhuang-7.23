<?php

/**
 * 专辑分类模型
 * @author
 */

namespace Applets\Model;

use Think\Model;

class AtypeModel extends Model {
    /**
     * 根据分类ID返回上一级分类，如果顶级分类则返回其本身
     * @param type $id
     * @return type
     */
    public function getTopById($id = 0) {
	$cateId = (int) $id;
	if (!$cateId) {
	    return array();
	}
	$info = $this->find($id);
	if ($info['parentid'] == 0) {
	    return $info;
	} else {
	    return $this->getTopById($info['parentid']);
	}
    }
    /**
     * 根据上级id得出当前菜单级别
     * @param type $parentid
     * @return int
     */
    public function getLevel($parentid = 0) {
	if (!$parentid) {
	    $parentInfo = $this->getOne($parentid);
	    return $parentInfo['level'] + 1;
	} else {
	    return 1;
	}
    }

    /**
     * 按级别返回
     * @param type $level
     * @param type $status
     * @return type
     */
    public function getListGroupByLevel($level = 3, $status = 1) {
	//查询第一级分类
	$tmpList = $topList = key2Array($this->getList(0, $status), 'id');
	//遍历第一级分类查询第二级分类
	foreach ($topList as $key => $topInfo) {
	    $twoList = $tmp = key2Array($this->getList($topInfo['id'], 0), 'id');
	    //是否查询第三级
	    if ($level == 3) {
		foreach ($twoList as $k => $twoInfo) {
		    $tmp[$k]['child'] = $this->getList($twoInfo['id'], 0);
		}
	    }
	    $tmpList[$key]['child'] = $tmp;
	}
	return $tmpList;
    }

    /**
     *  返回子类
     */
    public function subType($parentid){
        return $this->where("parentid = {$parentid} and status = 1")->select();

    }

}
