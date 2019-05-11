<?php
if(!defined('VER'))exit('非法访问!');
$title = "版本信息";
require_once(PATH.'Admin/header.php');
$info = file_get_contents('http://auth.lxlby.cn/api/info.php');
?>
<style>
	.info{
		font-size:16px;
		text-shadow: 0px 0px 8px #00BAFF;
	}
</style>
<aside class="lg-side">
<div class="inbox-head">
<h3>版本信息</h3>
</div>
<div class="inbox-body">
<p class="info">作者:拾年 QQ:211154860</p>
<p class="info">版本号:V3.0.1</p>
<p class="info">更新时间:2017-07-23</p>
<p class="info">更新内容:</p>
<p class="info">
1.框架重构 代码优化 整理结构<br>
2.更换密码加密算法<br>
3.安装时可以自定义管理员用户名密码<br>
4.安装时可以自定义数据表前缀(可以同一数据库建多个同学录)<br>
5.更换首页模板<br>
6.网站版权支持后台修改<br>
7.首页加入随机背景接口 (1.官方API 2.绚丽彩虹API 3.蓝柒API)<br>
8.管理员可以在后台设置副管理<br>
9.相册机制修改 全部用户都可以上传图片<br>
10.内页更换排版<br>
11.移除QQ小工具功能(个人认为同学录不需要这些东西)<br>
12.网站公告可以使用html代码<br>
13.加强部分表单的格式验证<br>
14.修复重复加载jquery问题<br>
15.加入官方播放器<br>
16.可以修改网页默认缩放比例(0.9时手机页面可兼容绚丽播放器)
</p>
<p class="info">如在使用过程中出现Bug,请向作者进行反馈,我们会及时修复</p>
</div>
</aside>
<?php
require_once(PATH.'Admin/footer.php');
?>