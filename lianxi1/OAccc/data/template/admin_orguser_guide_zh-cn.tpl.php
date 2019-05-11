<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:1:{s:81:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/orguser/template/guide.htm";i:1536850350;}*/?>
<div style="padding:10px 20px 0 30px;line-height:2.5">
<h4><strong>组织管理使用说明</strong></h4>
	<ul class="">
		<li><img src="dzz/system/images/organization.png" />&nbsp;选中机构为设置机构信息</li>
		<li><img src="dzz/system/images/department.png" />&nbsp;选中部门为设置部门信息</li>
		<li><img src="dzz/system/images/user.png" />&nbsp;选中人员为设置人员信息</li>
		<li>人员、部门、机构可直接拖拽移动更换位置。移动是更换人员所属部门、和更换部门上级机构或上级部门。</li>
		<li>按住 <img src="admin/orguser/images/ctrl.png"> 键移动人员或部门为复制。用于将人员同时加入多个部门。</li>
		<li>按住 <img src="admin/orguser/images/ctrl.png"> 键可多选，多选后松开 <img src="admin/orguser/images/ctrl.png"> 键移动为批量移动。 不松开 <img src="admin/orguser/images/ctrl.png"> 键移动为批量复制。</li>
		<li>在部门、机构、人员上点鼠标右键可出现右键菜单。菜单中有对应的更多操作。</li>
	</ul>
	<div class="alert alert-warning" style="color:#444;text-shadow:1px 1px 1px #FFF;margin-top:30px;">
		<h4><strong>删除用户说明：</strong></h4>
		<ul>
			<li>所有机构、部门中删除用户，只是从本机构，或部门中移除，用户将不能再拥有本机构或部门的所有使用权限，不是将用户从系统中删除。</li>
			<li>当用户没有所属机构和部门时会出现在“未加入机构用户列表”中。 “未加入机构用户列表”只有系统管理员可管理。</li>
			<li style="color:red">系统管理员在“未加入机构用户列表”中删除用户，用户会在系统中彻底删除，并且删除用户所有系统数据及保存文件。请管理员谨慎使用，确定成员要删除后再删除。</li>
		</ul>
	</div>
</div>