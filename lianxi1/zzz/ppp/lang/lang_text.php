<?php
$lang = array (
		/* ---------- common ----------*/
		//cc
		'cc_please_close'				=>'禁止访问, 请关闭CC防护功能',
		'cc_please_retry'				=>'禁止访问, 请刷新重试',

		//page
		'page_home'						=>'首页',
		'page_up'						=>'上一页',
		'page_down'						=>'下一页',
		'page_end'						=>'末页',

		/* ---------- admincp ----------*/
		'admincp_regmember'				=>'普通会员',

		/* ---------- global ----------*/
		//all
		'money'							=>'金钱',
		'rvrc'							=>'威望',
		'guest'							=>'游客',
		'check_error'					=>'认证码不正确或已过期',
		'guest_error'					=>'您还没有登录或注册，暂时不能使用此功能',
		'url_num'						=>'\\1',

		//reply
		'reply_group'					=>'您所在的用户组不具备发布评论的权限',
		'reply_class1'					=>'视频所在的栏目为正规版块，您不具备在此栏目发布评论的权限。',
		'reply_class2'					=>'视频所在的栏目为认证版块，您不具备在此栏目发布评论的权限。',
		'reply_gdcode_error'			=>'认证码错误',
		'reply_length_error'			=>'内容长度必须位于 \\1 - \\2 字节之间。',
		'reply_admin_check'				=>'评论提交成功，请等待管理员审核。',

		//ajax
		'ajax_star_error'				=>'您已经评过分了，感谢参与！',
		'ajax_star_success'				=>'影片评分成功，感谢参与！',

		'ajax_check_subject_no'			=>'已存在同名视频',
		'ajax_check_subject_yes'		=>'通过',
		'ajax_check_subject_empty'		=>'视频名称不能为空',

		'ajax_favorite_exists'			=>'您的收藏夹已经添加此影片，无须重复添加',
		'ajax_favorite_success'			=>'恭喜，添加成功',

		'ajax_check_gdcode_0'			=>'验证码错误',
		'ajax_check_gdcode_1'			=>'验证码正确',

		'ajax_check_username_-1'		=>'用户名不合法',
		'ajax_check_username_-2'		=>'包含禁止注册的词语',
		'ajax_check_username_-3'		=>'用户名已存在',
		'ajax_check_username_success'	=>'用户名可以注册',

		'ajax_check_email_0'			=>'Email格式有误',
		'ajax_check_email_1'			=>'Email已经被注册',
		'ajax_check_email_success'		=>"Email可以注册",

		'ajax_buy_video_1'				=>'您要访问的视频不存在',
		'ajax_buy_video_2'				=>'您要访问视频无需购买',
		'ajax_buy_video_3'				=>'积分不够，无法购买视频',
		'ajax_buy_video_4'				=>'您已经购买过该视频，无需重复购买',

		'ajax_resend_email_-1'			=>'没有权限执行此操作',
		'ajax_resend_email_-2'			=>'帐号无需激活',
		'ajax_resend_email_-3'			=>'用户不存在',
		'ajax_resend_email_0'			=>'24小时内只允许发送一次验证邮件',
		'ajax_resend_email_1'			=>'邮件发送成功',
		'ajax_resend_email_2'			=>'邮件发送失败',

		'uc_check_username_-1'			=>'用户名不合法',
		'uc_check_username_-2'			=>'包含禁止注册的词语',
		'uc_check_username_-3'			=>'用户名已经存在',

		'uc_check_email_-4'				=>'Email格式有误',
		'uc_check_email_-5'				=>'Email不允许注册',
		'uc_check_email_-6'				=>'Email已经被注册',

		//email
		'email_check_subject'			=>"激活您在 \\1 会员帐号的必要步骤!",
		'email_check_content'			=>"\\1，您好！<br />\\2欢迎您的到来！请点击以下网址激活您的帐号：<br /><a href=\"\\3/register.php?vip=activating&r_uid=\\4&r_pwd=\\5\" target=\"_blank\">\\3/register.php?vip=activating&r_uid=\\4&r_pwd=\\5</a><br /><br />您的注册名为：\\1<br />您的密码为：\\6<br />请尽快删除此邮件，以免别人偷看到您的密码！<br /><br />网站地址：<a href=\"\\3\" target=\"_blank\">\\3</a><br />本系统采用PHPvod Studio架设，欢迎访问：<a href=\"http://www.phpvod.com\" target=\"_blank\">http://www.phpvod.com</a>",
		'email_sendpwd_subject'			=>"\\1 密码重发",
		'email_sendpwd_content'			=>"请到下面的网址修改密码： <br /> <a href=\"\\1/sendpwd.php?action=getback&uid=\\2&submit=\\3\" target=\"_blank\">\\1/sendpwd.php?action=getback&uid=\\2&submit=\\3\</a> <br /><br />修改后请牢记您的密码！<br /><br />欢迎来到\\4，我们的网址是: <a href=\"\\1\" target=\"_blank\">\\1</a> <br />",

		//showmsg link text
		'showmsg_goback'				=>'返回继续操作',
		'showmsg_login'					=>'返回登录页面',
		'showmsg_home'					=>'返回首页',
		'showmsg_active_user'			=>'激活帐号',

		//uchomefeed
		'uchomefeed_postvideo_title_template'	=>'{username} 在 {wwwname} 发布了新视频 - 「{class}」{subject}',
		'uchomefeed_postreply_title_template'	=>'{username} 在 {wwwname} 发表了视频「{class}」{subject} 的评论',
		'uchomefeed_playvideo_title_template'	=>'{username} 在 {wwwname} 开始观看视频「{class}」{subject}({series})',
);
?>