<?php
$lang = array (
'404'							=>"抱歉! 页面没有找到",
'operate_success'				=>"完成相应操作",
'operate_error'					=>"没有选择操作对象",
'form_error'					=>"表单没有填写完整",
'error_nodefine'				=>'错误未定义',
'undefined_action'				=>"非法操作，请返回",
'check_error'					=>'认证码不正确或已过期',
'login_pwd_error'				=>"密码错误，您还可以尝试 \\1 次",
'login_forbid'					=>"已经连续 6 次密码输入错误，您将在 10 分钟内无法正常登录，还剩余 \\1 秒",
'login_empty'					=>"用户名或密码为空",
'login_have'					=>"您已经为会员身份，请不要重复登录",

'password_change'				=>"用户密码已更改, 需要重新登录",

'not_login'						=>"您还没有登录或注册，暂时不能使用此功能",
'user_not_exists'				=>"用户\\1不存在",
'guest_info'					=>"无法查看游客的个人资料",
'profile_error'					=>"您没有查看会员资料的权限",

'illegal_customimg'				=>"自定义头像地址必须以http开头",

'pro_custom_fail'				=>"要使用自定义头像功能前提: 请先删除上传的头像",
'pro_loadimg_fail'				=>"您已经上传过头像，要重新上传头像请先删除原来上传的头像",
'pro_loadimg_limit'				=>"上传的头像超过指定大小\\1 KB",
'pro_loadimg_ext'				=>"只允许上传 jpg/jpeg/png/bmp/gif 类型的文件",

'reg_repeat'					=>"您已经是注册成员，请不要重复注册",
'reg_close'						=>"对不起，目前网站禁止新用户注册，请返回",
'reg_active_fail'				=>"激活失败，错误原因：用户名不存在或验证参数有误！",
'reg_active_success'			=>"您的帐号已经激活！",
'reg_email_fail'				=>"帐号需要激活，激活邮件发送失败，请联系管理员！",
'reg_email_success'				=>"您的帐号需要激活，我们已经发送了一封邮件到您的邮箱，请查收！",

'illegal_username'				=>"此用户名包含不可接受字符或被管理员屏蔽，请选择其它用户名",
'illegal_password'				=>"密码包含不可接受字符，请使用英文和数字",
'illegal_email'					=>"E-Mail信箱没有填写或不符合检查标准，请确认没有错误",
'username_same'					=>"此用户名已经被注册，请选择其它用户名",
'honor_limit'					=>"自定义头衔长度不可超过 \\1 字节",
'sign_limit'					=>"签名不可超过 \\2 字节",
'password_confirm'				=>"两次密码输入不一致，请重新输入",
'not_password'		    		=>"密码不能小于6个字符",
'not_oldpwd'		    		=>"请填写原密码",
'pwd_error'		    	    	=>"原密码错误，请重新填写",

'msg_limit'						=>"发送失败，请不要在 \\1 秒内连续性的发送短消息",
'msg_subject_limit'				=>"标题不得大于75字节，内容不得大于1500字节",
'msg_empty'						=>"用户名，标题或内容为空",
'msg_error'						=>"该短消息不存在",
'sebox_full'                    =>"您的发件箱容量已满，请删除部分信息",
'rebox_full'					=>'收件人信箱已满，发送失败',
'msg_touser_error'				=>'收件人不存在',
'msg_touser_myself'				=>'不能给自己发送短消息',

'group_read'					=>"您所在的用户组不具备浏览视频的权限",
'group_play'					=>"您所在的用户组不具备播放视频的权限",
'group_post'					=>"您所在的用户组不具备发布视频的权限",
'group_msg_post'				=>"您所在的用户组不具备发送短消息权限",
'group_msg_max'					=>"您所在的用户组不具备发送短消息权限 (最大短消息数目<=0)",

'change_groupid_0'				=>'用户组不存在或已过期',
'change_groupid_1'				=>'用户组切换成功',
'special_group_empty'			=>'没有可以购买的用户组',
'special_group_error'			=>'用户组不存在或不可以购买',
'buygroup_pwd_error'			=>'密码错误',
'buygroup_days_error'			=>'购买天数不能小于\\1天',
'buygroup_credit_error'			=>'积分不够，购买失败',
'buygroup_no_need'				=>'您已经是该用户组永久成员，无须购买',
'buygroup_success'				=>'购买成功',

'class_illegal'					=>"无效的类别ID",
'classpw_pwd_error'				=>"密码错误,请重新输入密码",
'classpw_guest'					=>"游客无权登录加密版块",
'class_guest'					=>"此栏目为正规栏目，只允许会员访问",
'class_visit'					=>"对不起，本栏目为认证版块，您没有访问此栏目的权限",
'class_guestlimit'				=>"对不起，本栏目只允许注册会员进入",
'class_creditlimit'				=>"该版块设置了限制积分访问，以下积分为访问该版块需要的最低积分要求<br /><br />
									<center>
									<style type=\"text/css\">.msgtable{border: solid 1px #ddd;} .msgtable th{border: solid 1px #ddd; padding: 5px 10px; background-color: #f3f3f3; text-align: center;} .msgtable td{padding: 5px 10px; border: solid 1px #ddd; text-align: center;}</style>
									<table class=\"msgtable\">
									<tr><th width=\"150\">积分名称</th><th width=\"150\">积分要求</th><th width=\"150\">您现在的积分</th></tr>
									<tr><td>威望</td><td>\\1</td><td>\\2</td></tr>
									<tr><td>金钱</td><td>\\3</td><td>\\4</td></tr>
									<tr><td>发贴数</td><td>\\5</td><td>\\6</td></tr>
									</table>
									</center>",
'read_guest'					=>"此视频属于正规栏目，只允许会员访问",
'read_visit'					=>"对不起，您访问的视频属于认证栏目，您没有访问此栏目的权限",
'read_guestlimit'				=>"对不起，视频所在的栏目只允许注册会员进入",
'read_password'					=>"对不起，此视频所在的栏目需要密码才能访问",

'ban_info'  					=>"未验证用户不能发布视频",
'post_type'  					=>"频道等级不能发表新视频，请选择频道的下级栏目",
'post_guest'					=>"所属栏目为正规版块，只允许会员发布视频",
'post_noper'					=>"所属栏目为认证栏目，您不具备在此栏目发布视频的权限",
'post_upload_error'				=>'视频上传出错，请返回重试',

'play_guest'					=>"您播放的视频属于正规栏目，只允许会员播放",
'play_noper'					=>"您播放的视频属于认证栏目，您没有访问此栏目的权限",
'play_credit_buy'				=>"您没有播放此视频的权限",
'play_guestlimit'				=>"对不起，本视频只允许注册会员播放",
'play_creditlimit'				=>"您还没有达到视频所在栏目的积分要求",
'play_password'					=>"视频所在栏目需要密码才能访问",

'video_illegal'					=>"无效的视频ID",
'video_error'					=>"视频不存在",

'article_illegal'				=>'无效的文档ID',
'article_not_exists'			=>'文档不存在',

'del_error'						=>"没有选择要删除的选项",
'del_success'					=>"完成删除操作",

'modify_vod_error'				=>"您不具备编辑此视频的权限",
'delete_vod_error'				=>"您不具备删除此视频的权限",

'data_error'					=>"您要访问的链接无效",
'have_report'					=>"视频您已经举报过了，谢谢参与",

'no_condition'					=>"条件不足，请填写关键词",
'reply_empty'					=>"您还没有填写评论内容",

'hack_hidden'					=>'插件没有被启用',
'hack_error'					=>'未安装此插件或此插件无前台显示!',

'outextcredits_nomerge'			=>'系统没有与其它应用进行整合，或其应用不支持积分兑换',
'outextcredits_nodefined'		=>'管理员没有设定此应用的积分兑换方案',
'outextcredits_success'			=>'恭喜, 积分兑换成功',
'outextcredits_fail'			=>'抱歉, 请求失败',
'outextcredits_error'			=>'请求数据不合法',
'outextcredits_passerror'		=>'密码错误, 无法进行兑换操作',

'outextcredits_need'			=>"抱歉, 您的积分不足, 无法进行兑换操作<br /><br />
									<center>
									<style type=\"text/css\">.msgtable{border: solid 1px #ddd;} .msgtable th{border: solid 1px #ddd; padding: 5px 10px; background-color: #f3f3f3; text-align: center;} .msgtable td{padding: 5px 10px; border: solid 1px #ddd; text-align: center;}</style>
									<table class=\"msgtable\">
									<tr><th width=\"150\">积分名称</th><th width=\"150\">积分要求</th><th width=\"150\">您现在的积分</th></tr>
									<tr><td>\\1</td><td>\\2</td><td>\\3</td></tr>
									</table>
									</center>",

'email_error'					=>"您输入的用户名和email地址不符",
'sendpwd_limit'					=>"发送失败: 请不要在 60 秒内连续性的使用此功能",
'mail_success'					=>"我们已经发送您的密码到您的注册邮箱，请注意查收!",
'mail_failed'					=>"由于服务器邮件系统配置不正确，邮件发送失败",
'password_change_success'		=>"完成密码修改",
'password_confirm_fail'			=>"密码验证失败",

'pv_user_0'						=>'系统注册失败',
'pv_user_-1'					=>'用户名不合法',
'pv_user_-2'					=>'用户名包含不允许注册的词语',
'pv_user_-3'					=>'用户名已存在',
'pv_user_-4'					=>'Email格式不正确',
'pv_user_-5'					=>'Email已经被注册',
'pv_user_-6'					=>'旧密码不正确',

'uc_error_nodefine'				=>'错误未定义',

'uc_active_-1'					=>'您的帐号需要激活才能使用',
'uc_active_-2'					=>"用户<strong>\\1</strong>已激活",
'uc_active_-3'					=>"帐号激活失败",

'uc_login_-1'					=>'密码错误',

'uc_register_-1'				=>'用户名不合法',
'uc_register_-2'				=>'包含不允许注册的词语',
'uc_register_-3'				=>'用户名已经存在',
'uc_register_-4'				=>'Email 格式有误',
'uc_register_-5'				=>'Email 不允许注册',
'uc_register_-6'				=>'Email 已经被注册',

'uc_edit_1'						=>'更新成功',
'uc_edit_0'						=>'没有做任何修改',
'uc_edit_-1'					=>'旧密码不正确',
'uc_edit_-4'					=>'Email格式有误',
'uc_edit_-5'					=>'Email不允许注册',
'uc_edit_-6'					=>'Email已经被注册',
'uc_edit_-7'					=>'没有做任何修改',
'uc_edit_-8'					=>'该用户受保护无权限更改',

'mobile_class_disable_access'	=>'不具备访问该栏目的权限',
'ads_close'						=>'管理员没有开启宣传推广功能',
);
?>