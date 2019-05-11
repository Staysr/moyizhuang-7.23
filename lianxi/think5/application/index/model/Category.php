<?php
namespace app\index\model;

use think\Model;

/**
 * 前台分类模型
 */
class Category extends Model {
	public function getChildrenIds($cid, $target = []) {
		$cs = $this->field('id')
			->where('pid', 'eq', $cid)
			->select();

		foreach ($cs as $c) {
			array_push($target, $c->id);
			$target = $this->getChildrenIds($c->id, $target);
		}
		return $target;
	}
}
