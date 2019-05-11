<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title>后台管理中心</title>
		<link rel="stylesheet" href="/tengbo/Public/admin/css/pintuer.css">
		<link rel="stylesheet" href="/tengbo/Public/admin/css/admin.css">
		<script src="/tengbo/Public/admin/js/jquery.js"></script>
	</head>

	<body style="background-color:#f2f9fd;">
		<div class="header bg-main">
			<div class="logo margin-big-left fadein-top">
				<h1><img src="/tengbo/Public/admin/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" onclick="window.history.go(0)"/>后台管理中心</h1>
			</div>
			<div class="head-l">
				<a class="button button-little bg-green" href="http://127.0.0.1/tengbo/index.php" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;
				<a class="button button-little bg-red" href="<?php echo U('Login/logout');?>"><span class="icon-power-off"></span> 退出登录</a>
			</div>
		</div>
		<div class="leftnav">
			<div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
			<h2><span class="icon-user"></span>管理员管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Admin/admin_list');?>" target="right"><span class="icon-caret-right"></span>管理员列表</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>产品管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Product/product_class_list');?>" target="right"><span class="icon-caret-right"></span>产品分类管理</a>
				</li>
				<li>
					<a href="<?php echo U('Product/product_list');?>" target="right"><span class="icon-caret-right"></span>产品管理</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>技术资源管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Resource/video_list');?>" target="right"><span class="icon-caret-right"></span>精彩视频</a>
				</li>
				<li>
					<a href="<?php echo U('Resource/article_list');?>" target="right"><span class="icon-caret-right"></span>技术文章</a>
				</li>
				<li>
					<a href="<?php echo U('Resource/issue_list');?>" target="right"><span class="icon-caret-right"></span>常见问题</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>动态聚焦</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Dynamic/dynamic_list',array('type'=>1));?>" target="right"><span class="icon-caret-right"></span>行业动态</a>
				</li>
				<li>
					<a href="<?php echo U('Dynamic/dynamic_list',array('type'=>2));?>" target="right"><span class="icon-caret-right"></span>公司动态</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>案例管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Case/case_class_list');?>" target="right"><span class="icon-caret-right"></span>案例分类管理</a>
				</li>
				<li>
					<a href="<?php echo U('Case/case_list');?>" target="right"><span class="icon-caret-right"></span>案例管理</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>招聘管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Job/job_list');?>" target="right"><span class="icon-caret-right"></span>招聘岗位管理</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>解决方案管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('Job/solution_list');?>" target="right"><span class="icon-caret-right"></span>解决方案管理</a>
				</li>
			</ul>
			<h2><span class="icon-pencil-square-o"></span>基础信息管理</h2>
			<ul style="display:none">
				<li>
					<a href="<?php echo U('System/cooperator_list');?>" target="right"><span class="icon-caret-right"></span>合作单位</a>
				</li>
				<li>
					<a href="<?php echo U('System/course_list');?>" target="right"><span class="icon-caret-right"></span>公司历程</a>
				</li>
				<li>
					<a href="<?php echo U('System/credential_list');?>" target="right"><span class="icon-caret-right"></span>荣誉证书</a>
				</li>
				<li>
					<a href="<?php echo U('System/banner_list');?>" target="right"><span class="icon-caret-right"></span>首页轮播图</a>
				</li>
				<li>
					<a href="<?php echo U('System/leave_word_list');?>" target="right"><span class="icon-caret-right"></span>在线留言列表</a>
				</li>
				<li>
					<a href="<?php echo U('System/team_staff_list');?>" target="right"><span class="icon-caret-right"></span>项目团队人员</a>
				</li>
				<li>
					<a href="<?php echo U('System/contact_us');?>" target="right"><span class="icon-caret-right"></span>联系我们基础信息</a>
				</li>
				<li>
					<a href="<?php echo U('System/system');?>" target="right"><span class="icon-caret-right"></span>关于腾博基础信息</a>
				</li>
			</ul>
		</div>
		
		<script type="text/javascript">
			$(function() {
				$(".leftnav h2").click(function() {
					$(this).next().slideToggle(200);
					$(this).toggleClass("on");
				})
				$(".leftnav ul li a").click(function() {
					$("#a_leader_txt").text($(this).text());
					$(".leftnav ul li a").removeClass("on");
					$(this).addClass("on");
				})
			});
		</script>
		<ul class="bread">
			<li>
				<a href="javascript:;" target="right" class="icon-home">首页</a>
			</li>
			<li>
				<a href="javascript:;" id="a_leader_txt">后台首页</a>
			</li>
		</ul>
		<div class="admin">
			<iframe scrolling="auto" rameborder="0" src="<?php echo U('Index/home');?>" name="right" width="100%" height="100%"></iframe>
		</div>
	</body>

</html>