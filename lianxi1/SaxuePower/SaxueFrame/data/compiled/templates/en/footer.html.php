<?php
echo '<div id="mainbg"></div>
<div id="bottom">
	<div style="width:1000px; margin:auto; height:50px;">
		<div id="bottom_l">
			<img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_tel.png" style="position:absolute; left:10px; top:10px;" />
			TEL：<span style="font-family:Arial, Tahoma; font-size:16px; font-weight:bold;">'.$this->_tpl_vars['saxue_tel'].'</span>　　
			FAX：<span style="font-family:Arial, Tahoma; font-size:16px; font-weight:bold;">'.$this->_tpl_vars['saxue_fax'].'</span>　　
			SERVICE：<span style="font-family:Arial, Tahoma; font-size:16px; font-weight:bold;">'.$this->_tpl_vars['saxue_exp1'].'</span>
		</div>
		<div id="bottom_r" onclick="location.href=\'/feedback/\';"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_mail.png" style="margin-right:8px;" />FeedBack</div>
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
			<p style="font-size:16px; color:#333; border-bottom:1px dotted #AAA; padding-bottom:10px;">About Us</p>
			<p style="line-height:190%; color:#999; margin-top:10px;">Internet Software Co., Ltd. was founded in 2000, at present, the company has professional technical service team of more than 500 people. More than ten years, with the development of the concept of mutual soft continuous innovation, to provide customers from the e-government, medical information, enterprise information field of software products and solutions.</p>
			<p style="margin-top:20px;">&copy; 2014 Internet Software Co., Ltd. Copyright</p>    
		</div>
		<div class="fMenu">
			<a href="/">Home</a>
			<a href="#">Aboun Us</a>
			<a href="#">News</a>
			<a href="#">Product</a>
		</div>
		<div class="fMenu">
			<a href="#">Marketing Network</a>
			<a href="#">Support</a>
			<a href="#">Contact</a>
			<a href="http://www.saxue.com" target="_blank" style="color:#999;">SaxuePower Support</a>
		</div>
	</div>
</div>
<div style="display:none;">'.$this->_tpl_vars['saxue_tongji'].'</div>';
?>