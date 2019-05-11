<?php
echo '<div id="mainbg"></div>
<div id="bottom">
	<div style="width:1000px; margin:auto; height:50px;">
		<div id="bottom_l">
			<img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_tel.png" style="position:absolute; left:10px; top:10px;" />
			总机：<span style="font-family:Arial, Tahoma; font-size:16px; font-weight:bold;">'.$this->_tpl_vars['saxue_tel'].'</span>　　
			传真：<span style="font-family:Arial, Tahoma; font-size:16px; font-weight:bold;">'.$this->_tpl_vars['saxue_fax'].'</span>　　
			服务热线：<span style="font-family:Arial, Tahoma; font-size:16px; font-weight:bold;">'.$this->_tpl_vars['saxue_exp1'].'</span>
		</div>
		<div id="bottom_r" onclick="location.href=\'/feedback/\';"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_mail.png" style="margin-right:8px;" />在线留言</div>
	</div>
</div>
<script type="text/javascript">
$("#bottom_r").hover(function(){
	$(this).stop().animate({\'backgroundColor\':\'#D90000\'},450);
},function(){
	$(this).stop().animate({\'backgroundColor\':\'#F90\'},300);
});
</script>
<div id="foot">
	<div style="width:1000px; margin:auto; padding-top:20px; padding-bottom:10px;">
		<div style="width:620px; float:left;">
			<p style="font-size:16px; color:#333; border-bottom:1px dotted #AAA; padding-bottom:10px;">关于我们</p>
			<p style="line-height:190%; color:#999; margin-top:10px;">互联网软件有限公司成立于2000年，目前，公司拥有专业技术服务团队500余人。十余年来，互软用持续创新的发展理念，为客户提供从电子政务、医疗信息 化、企业信息化领域的软件产品与解决方案，先后与500多个政府部门和企事业单位合作完成千余项示范案例，帮助政府和企事业单位打造出一个信息时代下“智慧城市”的管理与服务新模式。</p>
			<p style="margin-top:20px;">&copy; 2014 互联网软件有限公司 版权所有&nbsp;&nbsp;'.$this->_tpl_vars['saxue_beian'].'</p>    
		</div>
		<div class="fMenu">
			<a href="#">首页</a>
			<a href="#">关于我们</a>
			<a href="#">资讯动态</a>
			<a href="#">产品中心</a>
		</div>
		<div class="fMenu">
			<a href="#">营销网络</a>
			<a href="#">服务支持</a>
			<a href="#">联系我们</a>
			<a href="http://www.saxue.com" target="_blank" style="color:#999;">SaxuePower 技术支持</a>
		</div>
	</div>
</div>
<div style="display:none;">'.$this->_tpl_vars['saxue_tongji'].'</div>';
?>