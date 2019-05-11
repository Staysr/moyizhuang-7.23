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

$lang = array (
	'appname'=>'任务板',
	'do_success'=>'操作成功',
	//任务版
	'taskboard_create'	=>'创建任务板 ：<a href="{dzzscript}?mod=taskboard&op=list&tbid={tbid}" >{boardname}</a>',
	'taskboard_archive'	=>'归档任务板 ：<a href="{dzzscript}?mod=taskboard&op=list&tbid={tbid}" >{boardname}</a>',
	'taskboard_active'	=>'激活任务板 ：<a href="{dzzscript}?mod=taskboard&op=list&tbid={tbid}" >{boardname}</a>',
	'taskboard_restore'	=>'恢复任务板 ：<a href="{dzzscript}?mod=taskboard&op=list&tbid={tbid}" >{boardname}</a>',
	'taskboard_delete'	=>'删除任务板 ：<a href="{dzzscript}?mod=taskboard&op=list&tbid={tbid}" >{boardname}</a>',
	
	//任务列表
	'task_cat_rename'	=> '重命名任务列表<b>{oldcatname}</b>为<b>{catname}</b>',
	'task_cat_create'	=> '创建任务列表 ：<b>{catname}</b>',
	'task_cat_archive'	=> '归档任务列表 ：<b>{catname}</b>',
	'task_cat_active'	=> '激活任务列表 ：<b>{catname}</b>',
	'task_cat_restore'	=> '恢复任务列表 ：<b>{catname}</b>',
	'task_cat_delete'	=> '删除任务列表 ：<b>{catname}</b>',
	
	//任务
	'task_create'		=>'{intask}创建任务{/intask}创建任务：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_restore'		=>'{intask}恢复任务{/intask}恢复任务 ：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_active'		=>'{intask}激活任务{/intask}激活任务 ：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_archive'		=>'{intask}归档任务{/intask}归档任务 ：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_completed'	=>'{intask}完成任务{/intask}完成任务 ：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_uncompleted'	=>'{intask}}取消完成任务{/intask}取消完成任务 ：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_reopen'		=>'{intask}重新打开任务{/intask}重新打开任务 ：<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_delete'		=>'{intask}删除任务{/intask}删除任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>',
	'task_move'		=>'{intask}移动任务从列表<b>{ocatname}</b>到列表<b>{catname}</b>{/intask}移动任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>从列表<b>{ocatname}</b>到列表<b>{catname}</b>',
	
	//任务标签
	'task_label_add'	=>'{intask}设置任务的标签：<span class="label" style="background:{color}">{title}</span>{/intask}设置任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>的标签<span class="label" style="background:{color}">{title}</span></span>',
	'task_label_remove'	=>'{intask}移除任务的标签：<span class="label" style="background:{color}">{title}</span>{/intask}移除任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>的标签<span class="label" style="background:{color}">{title}</span></span>',
	
	//任务截止时间
	'task_endtime_add'		=>'{intask}设置任务截止时间：<b>{endtime}</b>{/intask}设置任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a> 截止时间<b>{endtime}</b>',
	'task_endtime_change'	=>'{intask}修改任务截止时间从<b>{oldendtime}</b>修改为<b>{endtime}</b>{/intask}将任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a> 截止时间从<b>{oldendtime}</b>修改为<b>{endtime}</b>',
	'task_endtime_cancel'	=>'{intask}取消任务截止时间，原截止时间是：<b>{endtime}</b>{/intask}将取消任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a> 截止时间,原截止时间为：<b>{endtime}</b>',
	

	//任务检查项
	'task_sub_complete'		=>'{intask}完成检查项<b>{subname}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上完成检查项<b>{subname}</b>',
	'task_sub_uncomplete'	=>'{intask}取消完成检查项<b>{subname}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上取消完成子项<b>{subname}</b>',
	'task_sub_add'			=>'{intask}添加检查项<b>{subname}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上增加检查项<b>{subname}</b>',
	'task_sub_delete'		=>'{intask}删除检查项<b>{subname}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上删除检查项<b>{subname}</b>',
	'task_sub_rename'		=>'{intask}修改检查项名称<b>{osubname}</b>为<b>{subname}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上修改子项<b>{osubname}</b>为<b>{subname}</b>',
	
	//任务工时
	'task_worktime_add'		=>'{intask}增加了工时：<b>{worktime}小时</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上增加了工时：<b>{worktime}小时</b>',
	'task_worktime_cancel'	=>'{intask}删除了工时：<b>{oldworktime}小时</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上删除了工时<b>{oldworktime}小时</b>',
	'task_worktime_change'	=>'{intask}修改工时从<b>{oldworktime}小时</b>修改为<b>{worktime}小时</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上把工时从<b>{oldworktime}小时</b>修改为<b>{worktime}小时</b>',
	
	//任务预算
	'task_money_add'		=>'{intask}增加预算：<b>￥{money}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上增加了预算：<b>￥{money}</b>',
	'task_money_cancel'	=>'{intask}删除预算：<b>￥{oldmoney}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上删除了预算<b>￥{oldmoney}</b>',
	'task_money_change'	=>'{intask}修改预算从<b>￥{oldmoney}</b>修改为<b>￥{money}>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上把预算从<b>￥{oldmoney}</b>修改为<b>￥{money}</b>',
	
	//任务关注
	'task_follow_add'		=>'{intask}提醒 <a href="user.php?uid={uid}">{username}</a> 关注任务{/intask}提醒 <a href="user.php?uid={uid}">{username}</a> 关注任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" ><b>{taskname}</b></a>',
	'task_follow_remove'	=>'{intask}移除 <a href="user.php?uid={uid}">{username}</a> 关注任务{/intask}移除<a href="user.php?uid={uid}">{username}</a> 关注任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" ><b>{taskname}</b></a>',
	
	//任务分配
	'task_assign_add'		=>'{intask}分配任务给<a href="user.php?uid={uid}">{username}</a>{/intask}分配任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a> 给 <a href="user.php?uid={uid}">{username}</a>',
	'task_assign_remove'	=>'{intask}取消分配任务给<a href="user.php?uid={uid}">{username}</a>{/intask}取消分配任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a> 给 <a href="user.php?uid={uid}">{username}</a>',
	
	//任务附件
	'task_attach_add'		=>'{intask}添加了文件<b>{filename}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{dzzscript}?mod=taskboard&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>添加文件<b>{filename}</b>',
	'task_attach_delete'	=>'{intask}删除了文件<b>{filename}</b>{/intask}删除了任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}">{taskname}</a>的文件<b>{filename}</b>',
	'task_attach_restore'	=>'{intask}恢复了文件<b>{filename}</b>{/intask}恢复了任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}">{taskname}</a>的文件<b>{filename}</b>',
	
	//任务评论
	'task_comment_add'		=>'{intask}发表了评论：<b>{comment}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上发表了评论：<b>{comment}</b>',
	'task_comment_add_reply'=>'{intask}回复了评论：<b>{comment}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上回复了评论：<b>{comment}</b>',
	
	'task_comment_delete'	=>'{intask}删除了评论：<b>{comment}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上删除了评论：<b>{comment}</b>',
	'task_comment_delete_reply'	=>'{intask}删除了回复：<b>{comment}</b>{/intask}在任务<a class="open-taskpanel" taskid="{taskid}" href="{modurl}&op=list&tbid={tbid}&taskid={taskid}" >{taskname}</a>上删除了回复：<b>{comment}</b>',
	
	
	
	'taskboard_user_admin_title'=>'任务板成员变化提醒',
	'taskboard_user_admin'=>'在任务板{boardname}中把你添加为：<b>管理员</b>，<a href="{url}" onclick=try{showTaskPanel(\'{taskid}\');return false}catch(e){}">快去看看吧</a>',
	'taskboard_user_admin_wx'=>'在任务板{boardname}中把你添加为：<b>管理员</b>',
	'taskboard_user_admin_redirecturl'=>'{url}',
	
	'taskboard_user_cooperation_title'=>'任务板成员变化提醒',
	'taskboard_user_cooperation'=>'在任务板{boardname}中把你添加为：<b>成员</b>，<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">快去看看吧</a>',
	'taskboard_user_cooperation_wx'=>'在任务板{boardname}中把你添加为：<b>成员</b>',
	'taskboard_user_cooperation_redirecturl'=>'{url}',
	
	'taskboard_user_follow_title'=>'任务板成员提醒',
	'taskboard_user_follow'=>'在任务板{boardname}中把你添加为：<b>关注成员</b>，<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">快去看看吧</a>',
	'taskboard_user_follow_wx'=>'在任务板{boardname}中把你添加为：<b>关注成员</b>',
	'taskboard_user_follow_redirecturl'=>'{url}',
	
	'taskboard_user_remove_title'=>'任务板成员移除提醒',
	'taskboard_user_remove'=>'在任务板{boardname}成员中把你：<b>移除了</a>',
	'taskboard_user_remove_wx'=>'在任务板{boardname}中把你：<b>>移除了</b>',
	'taskboard_user_remove_redirecturl'=>'',
	
	'taskboard_user_change_title'=>'任务板成员变更提醒',
	'taskboard_user_change'=>'在任务板{boardname}中把你设置为：<b>{perm}</b>，<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">快去看看吧</a>',
	'taskboard_user_change_wx'=>'在任务板{boardname}中把你设置为：<b>{perm}</b>',
	'taskboard_user_change_redirecturl'=>'{url}',
	
	//任务完成
	'task_completed_title'=>'任务完成提醒',
	'task_completed'		=>'完成任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>',
	'task_completed_wx'=>'完成任务：{taskname}',
	'task_completed_redirecturl'=>'{url}',
	
	'task_uncompleted_title'=>'任务取消完成提醒',
	'task_uncompleted'		=>'取消完成任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>',
	'task_completed_wx'=>'取消完成任务：{taskname}',
	'task_completed_redirecturl'=>'{url}',
	
	//任务关注
	'task_follow_add_title'=>'任务关注提醒',
	'task_follow_add'		=>'提醒你关注任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>',
	'task_follow_add_wx'=>'提醒你关注任务：{taskname}',
	'task_follow_add_redirecturl'=>'{url}',
	
	'task_follow_remove_title'=>'任务关注移除提醒',
	'task_follow_remove'	=>'移除你关注任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>',
	'task_follow_remove_wx'=>'移除你关注任务：{taskname}',
	'task_follow_remove_redirecturl'=>'{url}',
	
	//任务分配
	'task_assign_add_title'=>'任务分配提醒',
	'task_assign_add'		=>'分配给你任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>',
	'task_assign_add_wx'=>'分配给你任务：{taskname}',
	'task_assign_add_redirecturl'=>'{url}',
	
	'task_assign_remove_title'=>'任务分配取消提醒',
	'task_assign_remove'	=>'取消分配给你任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>',
	'task_assign_remove_wx'=>'取消分配给你任务：{taskname}',
	'task_assign_remove_redirecturl'=>'{url}',
	
	//评论
	'task_comment_at_title'	=>'提到(@)我的评论',
	'task_comment_at'	=>'在任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>的评论中提到我<b>{comment}</b>',
	'task_comment_at_wx'=>'在任务：{taskname}的评论中提到我<b>{comment}</b>',
	'task_comment_at_redirecturl'=>'{url}',
	
	//发表评论，通知任务执行者
	'task_comment_title'	=>'评论了任务',
	'task_comment'			=>'在任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}"><em>{taskname}</em></a>中发表了评论<b>{comment}</b>',
	'task_comment_wx'       =>'在任务：{taskname}中发表了评论<b>{comment}</b>',
	'task_comment_redirecturl'=>'{url}',
	
	//回复评论，通知被回复者
	'task_comment_reply_title'	=>'回复了我的评论',
	'task_comment_reply'		=>'在任务：<a href="{url}" onclick="try{showTaskPanel(\'{taskid}\');return false}catch(e){}">{taskname}</a>中回复了我的评论<b>{comment}</b>',
	'task_comment_reply_wx'     =>'在任务：{taskname} 中回复了我的评论<b>{comment}</b>',
	'task_comment_reply_redirecturl'=>'{url}',
	
	
	
	'set_up'=>'设置',
	'star_sign'=>'标星的',
	'new_change'=>'有新变化',
	'star_sign_or_cancel'=>'标星/取消标星',
	'sign_or_cancel'=>'标星/取消',
	'mine'=>'我的',
	'create_board'=>'创建任务板',
	'team_details'=>'团队详情' ,
	'new_team'=>'新建团队',
	'member'=>'成员',
	'participate_in'=>'我参与的',
	'create_new_board'=>'创建新任务板…',
	'other_visible'=>'其他可见的',
	'no_visible_board'=>'还没有可见的任务板',
	'search_username'=>'搜索用户名',
	'add_user'=>'添加成员',
	'manager'=>'管理员',
	'observer'=>'观察员',
	'team_manager'=>'团队管理员',
	'change_permissions'=>'改变权限',
	'remove'=>'移除',
	'send_in'=>'发送中...', 
	'resend'=>'再次发送',
	'send_the_invitation_again'=>'再次发送邀请邮件',
	'nonactivated'=>'未激活',
	'send_successfully'=>'发送成功',
	'privately_owned'=>'私有',
	'group_visibility'=>'团队可见范围',
	'anyone_can_view_this_group_but_only_members_of_the_group_can_create_new_board'=>'任何人都可以通过团队的地址查看此团队。但只有团队内成员才可以在团队内新建任务板。',
	'private_only_group_members_can_view_this_group'=>'私有，仅团队成员才能查看此团队。',
	'members_can_be_created_within_the_group'=>'成员可以在团队内创建',
	'open_board'=>'公开的任务板',
	'private_board'=>'私有的任务板',
	'public_collections_anyone_can_be_viewed_and_only_members_of_the_board_can_be_edited'=>'公开的任务板， 任何人（包括游客）都可以查看，仅此任务板成员才能编辑。',
	'group_visibility_board'=>'团队内可见的任务板',
	'within_the_group'=>'团队内可见',
	'within_the_group_you_can_see_the_board'=>'团队内可见的任务板，团队内成员都可以查看团队内可见的任务板。',
	'private_board_of_essays_that_only_members_can_view_or_edit'=>'私有的任务板，仅此任务板成员才能查看或编辑。',
	'membership_invitation_settings'=>'成员邀请设置（团队内任务板）',
	'any_personne'=>'任何人员',
	'anyone_can_be_invited'=>'可以邀请任何人。',
	'in_group'=>'团队内成员',
	'only_members_of_this_group_can_be_invited_to_join'=>'仅可以邀请本团队内成员加入。',
	'the_group_board_removes_permissions'=>'团队内任务板移除权限',
	'no_remove'=>'不允许移除',
	'allow_to_remove'=>'允许移除',
	'the_board_administrator_is_not_allowed_to_remove_his_collected_board_from_the_group'=>'不允许任务板管理员将他管理的任务板从团队中移除。',
	'the_board_administrator_is_allowed_to_remove_his_collected_board_from_the_group'=>'允许任务板管理员将他管理的任务板从团队中移除。',
	'deletion_team'=>'删除团队?',
	'deletion_team_sure'=>'删除团队',
	'no_notice'=>'还没有通知',
	'view_all_notifications'=>'查看所有通知',
	'there_is_no_relevant_notice'=>'没有相关的通知…',
	'all_notice'=>'全部通知',
	'synopsis'=>'简介(可选)',
	'group'=>'团队',
	'group_name'=>'团队名称',
	'for_better_collaboration_and_management'=>'是由人员和一些任务板组成。它可以将团队、公司、好友等团队在一起，以便于更好的协作和管理',
	'save_in_the'=>'保存中...',
	
	
	'cover_color'=>'封面颜色',
	'cover_image'=>'封面图片',
	'cover_image_size'=>'封面图片(建议1600px*2500px)',
	'remove_logo_image'=>'移除LOGO图片',
	'remove_cover_image'=>'移除封面图片',
	'base_setting'=>'基本设置',
	'group_profile'=>'团队简介',
	'logo_image'=>'LOGO图片',
	'upload_pictures_size'=>'上传图片（大小>128*128px）',
	'upload_pictures_size_big'=>'上传图片（大小>1440X500px）',
	'banner_image'=>'横幅图片',
	'the_group_name_cannot_be_empty'=>'团队名称不能为空',
	'name_cannot_be_empty'=>'名称不能为空',
	'remove_banner_image'=>'移除横幅图片',
	'change_the_permissions'=>'更改权限',
	'remove_rembers'=>'移除成员',
	'remove_users'=>'移除用户',
	'remove_administrative_permissions'=>'移除管理权限？',
	'lose_all_administrative_privileges_group'=>'此操作，您将失去所有的管理权限（团队设置、成员管理等）。如果想重新获得管理权限，需要其他的管理员将您重新设置为管理员!',
	'lose_all_administrative_privileges'=>'此操作，您将失去所有的管理权限（设置、成员管理等）。如果想重新获得管理权限，需要其他的管理员将您重新设置为管理员!',
	'sure_lose_all_administrative_privileges'=>'确定失去管理权限',
	'you_remove_the_user_from_the_group'=>'此操作，您从团队中移除此用户;不会移除任务板内的此成员;系统会给此用户发送消息通知',
	'leaving'=>'我要离开',
	'enter_user_name_or_mailbox_keyword_search'=>'输入用户名或邮箱关键词搜索, 也可以输入用户的邮箱地址邀请其加入。',
	'choice_add'=>'选择添加',
	'no_relevant_results'=>'没有相关结果',
	'added'=>'已添加',
	'can_view_create_edit'=>'可以查看、创建、编辑任务板,并可以修改任务板设置',
	'can_view_create_edit_group'=>'可以查看、创建、编辑团队内任务板，能够修改团队设置',
	'can_view_create_edit_cannot_modify_group_settings'=>'可以查看、创建、编辑团队内任务板，但不能够修改团队设置',
	'can_view_create_edit_cannot_modify_board_settings'=>'可以查看、创建、编辑任务板，但不能够修改任务板设置',
	'you_can_only_view_the_collection'=>'仅可以查看任务板',
	'you_can_only_view_the_collection_group'=>'仅可以查看团队内公开的任务板',
	'cannot_modify_this_user_permission'=>'不能修改此用户权限，至少有一位管理员',
	'system_sends_message_notification_to_the_user'=>'此操作，将从任务板中移除此用户;系统会给此用户发送消息通知',
	'the_private_group'=>'私有团队',
	'only_team_members_and_members_of_this_board_can_view'=>'仅团队成员和此任务板成员能查看',
	'pay_attention_to_share_objects'=>'请注意分享对象',
	'transcription_error'=>'转换错误！',
	'only_members_of_this_board_can_view'=>'仅此任务板成员能查看',
	'address'=>'地址',
	'WeChat'=>'微信',
	'QQ_friends'=>'QQ好友',
	'Qzone'=>'QQ空间',
	'sina_microblog'=>'新浪微博',
	'share_addresses_and_codes'=>'分享地址和二维码',
	'share_to_WeChat'=>'分享到微信',
	'share_to_QQ'=>'分享到QQ好友',
	'share_to_sina'=>'分享到新浪微博',
	'only_members_of_this_board_can_view_edit'=>'私有，仅此任务板成员能查看和编辑',
	'group_visibility_only_members_of_this_board_can_edit'=>'团队内可见，团队成员和此任务板成员都能查看，仅此任务板成员能编辑。',
	'open_only_members_of_this_board_can_edit'=>'公开， 任何人（包括游客）都可以查看，仅此任务板成员才能编辑。',
	'group'=>'团队',
	'share_the_WeChat_friends_circle'=>'分享到微信朋友圈',
	'codes_share_the_WeChat_friends_circle'=>'使用微信扫描二维码，分享到朋友圈',
	'members_of_the_collaboration'=>'协作成员',
	
	'rank_1'=>'关注成员',
	'rank_2'=>'协作成员',
	'rank_3'=>'管理员',
	'deletion'=>'删除中...',
	'deleting'=>'正在删除...',
	'the_taskboard_in_the_group_will_not_be_deleted'=>'此操作，将彻底删除此团队；团队内的任务板不会被删除，它们将出现在任务板成员的个人列表里。',
	'completely_delete'=>'彻底删除',
	'public'=>'公开'
);

?>