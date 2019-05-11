<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
$eventshow=array(
	//任务版
	'taskboard_create'	=>array('icon'=>'dzz dzz-view-list',			'color'=>'blue'),
	'taskboard_archive'	=>array('icon'=>'dzz dzz-archive',	          	'color'=>'purple'),
	'taskboard_active'	=>array('icon'=>'dzz dzz-view-list-alt',			'color'=>'yellow'),
	'taskboard_restore'	=>array('icon'=>'dzz dzz-view-list-alt',			'color'=>'yellow'),
	'taskboard_delete'	=>array('icon'=>'dzz dzz-view-list-alt',			'color'=>'red'),

    //任务列表
	'task_cat_create'	=>array('icon'=>'dzz dzz-view-list',			'color'=>'blue'),
	'task_cat_delete'	=>array('icon'=>'dzz dzz-view-list',			'color'=>'red'),
	'task_cat_rename'	=>array('icon'=>'dzz dzz-view-list',			'color'=>'orange'),
	'task_cat_restore'	=>array('icon'=>'dzz dzz-view-list',			'color'=>'yellow'),
	'task_cat_active'	=>array('icon'=>'dzz dzz-view-list',			'color'=>'yellow'),
	'task_cat_archive'	=>array('icon'=>'dzz dzz-archive',	'color'=>'purple'),
	
	//任务
	'task_create'		=>array('icon'=>'dzz dzz-add',			'color'=>'blue'),
	'task_restore'		=>array('icon'=>'dzz dzz-restore',		'color'=>'yellow'),
	'task_active'		=>array('icon'=>'dzz dzz-restore',		'color'=>'yellow'),
	'task_archive'		=>array('icon'=>'dzz dzz-archive',	'color'=>'orange'),
	'task_completed'	=>array('icon'=>'dzz dzz-check-box',		'color'=>'green'),
	'task_uncompleted'	=>array('icon'=>'dzz dzz-check-box-outline-blank',	'color'=>'red'),
	'task_delete'		=>array('icon'=>'dzz dzz-delete',		'color'=>'red'),
	'task_move'			=>array('icon'=>'dzz dzz-arrow-forward',	'color'=>'orange'),
	
	//任务标签
	'task_label_add'	=>array('icon'=>'dzz dzz-label',		'color'=>'blue'),
	'task_label_remove'=>array('icon'=>'dzz dzz-label',		'color'=>'red'),
	
	//任务关注
	'task_follow_add'	=>array('icon'=>'dzz dzz-visibility',		'color'=>'purple'),
	'task_follow_remove'=>array('icon'=>'dzz dzz-visibility-off',	'color'=>'red'),
	
	//任务分配
	'task_assign_add'	=>array('icon'=>'dzz dzz-member',			'color'=>'green'),
	'task_assign_remove'=>array('icon'=>'dzz dzz-member',			'color'=>'red'),
	
	//任务截止时间
	'task_endtime_add'		=>array('icon'=>'dzz dzz-clock',		'color'=>'yellow'),
	'task_endtime_change'	=>array('icon'=>'dzz dzz-clock',		'color'=>'yellow'),
	'task_endtime_cancel'	=>array('icon'=>'dzz dzz-clock',		'color'=>'yellow'),
	
	//任务附件
	'task_attach_add'		=>array('icon'=>'dzz dzz-attachment','color'=>'blue'),
	'task_attach_delete'	=>array('icon'=>'dzz dzz-attachment','color'=>'red'),
	'task_attach_restore'	=>array('icon'=>'dzz dzz-attachment','color'=>'blue'),
	
	
	//任务检查项
	'task_sub_complete'		=>array('icon'=>'dzz dzz-check-box',	'color'=>'green'),
	'task_sub_uncomplete'	=>array('icon'=>'dzz dzz-check-box-outline-blank','color'=>'red'),
	'task_sub_add'			=>array('icon'=>'dzz dzz-menu',	'color'=>'blue'),
	'task_sub_delete'		=>array('icon'=>'dzz dzz-menu',	'color'=>'red'),
	'task_sub_rename'		=>array('icon'=>'dzz dzz-menu',	'color'=>'yellow'),
	
	
	//任务工时
	'task_worktime_add'		=>array('icon'=>'dzz dzz-clock','color'=>'blue'),
	'task_worktime_cancel'	=>array('icon'=>'dzz dzz-clock','color'=>'red'),
	'task_worktime_change'	=>array('icon'=>'dzz dzz-clock','color'=>'purple'),
	
	//任务预算
	'task_money_add'		=>array('icon'=>'dzz dzz-money','color'=>'blue'),
	'task_money_cancel'		=>array('icon'=>'dzz dzz-money','color'=>'red'),
	'task_money_change'		=>array('icon'=>'dzz dzz-money','color'=>'purple'),
	
	'task_comment_add'		=>array('icon'=>'dzz dzz-comment','color'=>'blue'),
	'task_comment_delete'	=>array('icon'=>'dzz dzz-comment','color'=>'red'),
	'task_comment_at'		=>array('icon'=>'dzz dzz-comment','color'=>'purple'),
	);