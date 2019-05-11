<?php
include_once 'head.php';
?>

<body>
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
      </div>
      <div class="modal-body">
      <?php echo $conf['modal']?>
	 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明开始-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">查询内容是什么？该输入什么？</h4>
      </div>
      	<li class="list-group-item"><font color="red">请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息</font></li>
      	<li class="list-group-item">例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单</li>
      	<li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
      	<li class="list-group-item">例如您购买的是快手商品，需要输入作品链接里“userid=”后面的数字，输入快手号是一般是查询不到的</li>
      	<li class="list-group-item">例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的</li>
      	<li class="list-group-item"><font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明结束-->
<!--版本介绍-->
<div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" align="left"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">版本介绍</h4></div><div class="block"><div class="table-responsive"><table class="table table-borderless table-vcenter"><thead><tr><th style="width: 100px;">功能</th><th class="text-center" style="width: 20px;">普及版/专业版</th></tr></thead><tbody><tr class="active"><td>专属代刷平台</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class=""><td>三种在线支付接口</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class="success"><td>专属网站域名</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class=""><td>赚取用户提成</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class="info"><td>赚取下级分站提成</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class=""><td>设置商品价格</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class="warning"><td>设置下级分站商品价格</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr><tr class=""><td>搭建下级分站</td><td class="text-center"><span style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span><span style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span></td></tr></tbody></table></div><center style="color: #b2b2b2;"><small><em>* 自己的能力决定着你的收入！</em></small></center></div></div></div></div>
<!--版本介绍-->
<div id="page-container" class="header-fixed-top sidebar-visible-lg-full ">
	<div id="sidebar">
		<div id="sidebar-brand" class="themed-background">
			<a href="index.php" class="sidebar-title"> <i class="fa fa-qq"></i><span class="sidebar-nav-mini-hide"><?php echo mb_substr($conf['sitename'],0,10,'utf-8')?></span></a>
		</div>
		<div id="sidebar-scroll">
			<div class="sidebar-content">
				<ul class="sidebar-nav">
					<li><a href="./" class=" active">　<i class="icon">&#xe664;</i><span class="sidebar-nav-mini-hide">　网站首页</span></a></li>
					<?php if($conf['fenzhan_buy']==1){?>
					<li><a href="./user/regsite.php">　<i class="fa fa-star sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">开通分站</span></a></li>
					<?php }?>
					<li><a href="./user/">　<i class="icon">&#xe601;</i><span class="sidebar-nav-mini-hide">　管理后台</span></a></li>
					<?php if(!empty($conf['invite_tid'])){?>
					<li><a target="_blank" href="./?mod=invite">　<i class="fa fa-gift sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">推广中心</span></a></li>
					<?php }?>
					<?php if(!empty($conf['appurl'])){?>
					<li><a target="_blank" href="<?php echo $conf['appurl']; ?>">　<i class="fa fa-android sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">APP下载</span></a></li>
					<?php }?>
					<li><a href="./?mod=tools">　<i class="icon">&#xe608;</i><span class="sidebar-nav-mini-hide">　实用工具</span></a></li>
					<li><a href="./?mod=about">　<i class="icon">&#xe6f6;</i><span class="sidebar-nav-mini-hide">　关于我们</span></a></li>
				</ul>
			</div>
		</div>
		<div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
			<div class="text-center">
				<small>2019 <i class="fa fa-heart text-danger"></i> <a href="./"> <?php echo $conf['sitename']?></a></small><br>
			</div>
		</div>
	</div>
	<div id="main-container">
	<header class="navbar navbar-inverse navbar-fixed-top">
	<ul class="nav navbar-nav-custom">
		<li><a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();"> <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight"id="sidebar-toggle-mini"></i><i class="fa fa-bars fa-fw"id="sidebar-toggle-full"></i> 菜单</a></li>
	</ul>
	<ul class="nav navbar-nav-custom pull-right">
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
			<img src="<?php echo ($islogin2==1)?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/img/user.png'?>" alt="avatar">
			</a>
			<ul class="dropdown-menu dropdown-menu-right">
			<?php if($islogin2==1){?>
				<li class="dropdown-header text-center">
					<strong><?php echo $userrow['user']?></strong>
				</li>
				<li>
					<a href="./user/">
					<i class="fa fa-user fa-fw pull-right"></i>
					用户中心
					</a>
				</li>
				<li>
					<a href="./user/uset.php?mod=user">
					<i class="fa fa-pencil-square fa-fw pull-right"></i>
					密码修改
					</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="./user/login.php?logout">
					<i class="fa fa-power-off fa-fw pull-right"></i>
					退出登录
					</a>
				</li>
			<?php }else{?>
				<li class="dropdown-header text-center">
					<strong>未登录</strong>
				</li>
				<li>
					<a href="./user/login.php">
					<i class="fa fa-user fa-fw pull-right"></i>
					登录
					</a>
				</li>
				<li>
					<a href="./user/reg.php">
					<i class="fa fa-plus-circle fa-fw pull-right"></i>
					注册
					</a>
				</li>
			<?php }?>
			</ul>
		</li>
	</ul>
</header>

<div id="page-content">
<div class="col-sm-12 col-md-9 col-lg-6 center-block" style="float: none;">
	<div class="widget-content themed-background-flat img-logo-about">
        <p class="desc"><?php echo $conf['sitename']?></p>
		<p class="descp">　最专业的空间业务代刷平台</p>
	</div>
	<div class="widget-content themed-background-muted text-center"style="margin: 0 0 10px;">
	
		<div class="btn-group btn-group-justified">
			<div class="btn-group">
				<a class="btn btn-default" href="#ptgg" data-toggle="modal"><font color="#ff0000"><i class="icon">&#xe6df;</i> 平台公告</font></a>
			</div>
			<div class="btn-group">
				<a class="btn btn-default" href="#help" data-toggle="modal"><i class="icon">&#xe606;</i> 帮助</font></a>
			</div>
		</div>
		<div class="modal fade" align="left" id="ptgg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header-tabs">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<ul class="nav nav-tabs" data-toggle="tabs">
							<li class="active"><a href="#zhu-modal">系统公告</a></li>
							<li><a href="#modal">网站公告</a></li>
						</ul>
					</div>
					<div class="modal-body">
						<div class="tab-content">
							<div class="tab-pane active" id="zhu-modal"><?php echo $conf['anounce']?></div>
							<div class="tab-pane" id="modal"><?php echo $conf['modal']?></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
					</div>
				</div>
			</div>
		</div>

		
		<div class="modal fade" id="chaxun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" align="left">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">订单查询</h4>
					</div>
					<div class="modal-body">
						<div class="col-xs-12 well well-sm"style="font-size: 12px;"><font color="#5c90d2"><i class="fa fa-cog"></i></font> 待处理：订单等待处理中。<br/>
<font color="#FF6347"><i class="fa fa-exclamation-circle"></i></font> 异　常：请联系客服处理。<br/>
<font color="#46c37b"><i class="fa fa-check-circle"></i></font> 已完成：已经提交到服务器内，直到已刷完。
</div>
						<div id="result2" class="form-group table-responsive" style="display:none;">
						<table class="table table-striped">
							<thead><tr><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
							<tbody id="list"></tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" align="left" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">帮助FAQ</h4>
					</div>
					<div class="modal-body">
						<a href="javascript:void(0)" class="widget"></a>
						<center>
							<a href="javascript:void(0)" class="widget"></a><div id="demo-acc-faq" class="accordion"><a href="javascript:void(0)" class="widget"></a><div class="panel panel-trans pad-top"><a href="javascript:void(0)" class="widget"></a><a href="#demo-acc-faq1" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">下单很久了都没有开始刷呢？</a><div id="demo-acc-faq1" class="mar-ver collapse" aria-expanded="false" style="height: 0px;">由于本站采用全自动订单处理，难免会出现漏单，部分单子处理时间可能会稍长一点，不过都会完成，最终解释权归本站所有。超过24小时没处理请联系客服！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq2" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">ＱＱ空间业务类下单方法讲解</a><div id="demo-acc-faq2" class="mar-ver collapse" aria-expanded="false">1.下单前：空间必须是所有人可访问,必须自带1~4条原创说说!<br>2.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq3" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">空间说说赞相关下单方法讲解</a><div id="demo-acc-faq3" class="mar-ver collapse" aria-expanded="false">1.下单前：空间必须是所有人可访问,必须自带1条原创说说!转发的说说不能刷！<br>2.在“QQ号码”栏目输入QQ号码，点击下面的获取说说ID并选择你需要刷的说说的ID，下单即可。<br>3.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq4" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">全民Ｋ歌业务类下单方法讲解</a><div id="demo-acc-faq4" class="mar-ver collapse" aria-expanded="false">1.打开你的全名k歌<br>2.复制你全名k歌里面的需要刷的歌曲链接<br>3.例如：你歌曲链接是：<font color="#ff0000">https://kg.qq.com/node/play?s= <font color="green">881Zbk8aCfIwA8U3</font> &amp;g_f=personal</font><br>4.然后把s=后面的 <font color="green">881Zbk8aCfIwA8U3</font> 链接填入到歌曲ID里面，然后提交购买。</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq5" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">快手业务类代刷下单方法讲解</a><div id="demo-acc-faq5" class="mar-ver collapse" aria-expanded="false">1.需要填写用户ID和作品ID，比如<font color="#ff0000">http://www.kuaishou.com/i/photo/lwx?userId= <font color="green">294200023</font> &amp;photoId= <font color="green">1071823418</font></font> (分享作品就可以看到“复制链接”了)<br>2.用户ID就是 <font color="green">294200023</font> 作品ID就是 <font color="green">1071823418</font> ，然后在分别把用户ID和作品ID填上，请勿把两个选项填反了，不给予补单！</div></div><div class="panel panel-trans pad-top"><a href="#demo-acc-faq6" class="text-semibold text-lg text-main collapsed" data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">永久ＱＱ会员/钻下单方法讲解</a><div id="demo-acc-faq6" class="mar-ver collapse" aria-expanded="false">1.下单之前，先确认输的信息是不是正确的!<br>2.Q会员/钻因为需要人工处理，所以每天不定时开刷，24小时-48小时内到账！</div></div></div>
						</center>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<div class="block" style="min-height: 310px;">
		<div class="block-title">
			<ul class="nav nav-tabs" style="background: linear-gradient(to right,pink ,#5ccdde,#8ae68a,#e0e0e0);">
				<li><a href="#onlinebuy" data-toggle="tab"><i class="icon">&#xe658;</i> 下单 </a></li>
				<li><a href="#query" data-toggle="tab"><i class="icon">&#xe607;</i> 查询 </a></li>
				<li <?php if($conf['gift_open']==0){?>class="hide"<?php }?>><a href="#gift" data-toggle="tab"><i class="icon">&#xe6c8;</i> 抽奖</a></li>
				<li><a href="#chat" data-toggle="tab" ><i class="icon">&#xe642;</i> 赚钱 </a></li>
				<li class="dropdown pull-right">
					<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">更多 <i class="icon">&#xe60c;</i></a>
					<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="myTabDrop1" style="margin-top: 4px;">
						<li class="dropdown-header">More</li>
						<li class="divider"></li>
						<li <?php if($conf['iskami'] == 0)echo 'class="hide"'?>><a href="#kami" tabindex="-1" data-toggle="tab">卡密下单</a></li>
						<li <?php if(empty($conf['lqqapi']))echo 'class="hide"'?>><a href="#lqq" data-toggle="tab">拉圈圈赞</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade fade-up in active" id="onlinebuy">
<?php include TEMPLATE_ROOT.'default/shop.inc.php'; ?>
		</div>
		<div class="tab-pane fade fade-up in" id="query">
			<?php echo $conf['gg_search']?>
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-btn">
					<select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px"><option value="0">下单账号</option><option value="1">订单号</option></select>
				</div>
				<input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="请输入要查询的内容（留空则显示最新订单）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
				<span class="input-group-btn"><a href="#cxsm" data-toggle="modal" class="btn btn-warning"><i class="glyphicon glyphicon-exclamation-sign"></i></a></span>
			</div></div>
			<input type="submit" id="submit_query" href="#chaxun" class="btn btn-primary btn-block" value="立即查询" target="_blank" data-toggle="modal">
		</div>
		
		<div class="tab-pane fade fade-up in" id="gift">
			<div class="widget-content themed-background-flat text-right clearfix animation-pullup">  
			<a id="start" style="display:block;"><img src="http://img.zcool.cn/community/01551058b02bfda801219c77b73408.gif" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
			</a>
			<a  id="stop" style="display:none;"><img src="http://pic.58pic.com/58pic/14/79/67/04q58PICzcN_1024.jpg" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
			</a>
			<p></p>
			<h4 id="roll" class="widget-heading h4"><i class="icon">&#xe600;</i>猛击小人进行抽奖</h4>
		</div><hr>
		<li class="list-group-item bord-top">奖品内容：<br>　　个性标签赞、QQ名片赞、空间访客、全民K歌粉丝、超级会员、好莱坞会员<br></li>
		<div id="result"></div><br/>
		<div class="giftlist" style="display:none;"><strong>最近中奖记录</strong><ul id="pst_1"></ul></div>
		</div>
		<div class="tab-pane fade fade-up in" id="chat">
		
		<div class="tab-pane active in" id="Substation">
		<table class="table table-borderless table-pricing" style="margin-bottom: 0px;">
            <tbody>
                <tr class="active">
                    <td>
                        <h4><i class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price']?></strong> / <i class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price2']?></strong><br><small>普及版 / 专业版两种分站供你选择</small></h4>
                    </td>
                </tr>
				<tr>
                    <td>宝妈、学生等网络兼职首选</td>
                </tr>
                <tr>
                    <td><strong>轻轻松松日赚100+不是梦</strong></td>
                </tr>
                <tr class="active">
                    <td>
						<a href="#userjs" data-toggle="modal" class="btn btn-effect-ripple  btn-info" style="overflow: hidden; position: relative;"><span class="btn-ripple animate" style="height: 100px; width: 100px; top: -21.1px; left: 13px;"></span><i class="fa fa-th-list"></i> 功能介绍</a>
                        <a href="user/regsite.php" target="_blank" class="btn btn-effect-ripple  btn-danger" style="overflow: hidden; position: relative;"><span class="btn-ripple animate" style="height: 98px; width: 98px; top: -33.1px; left: 16px;"></span><i class="fa fa-arrow-right"></i> 马上开通</a>
						<a href="user/" target="_blank" class="btn btn-effect-ripple btn-primary"><i class="fa fa-arrow-right"></i> 分站后台</a>
                    </td>
                </tr>
				</tbody>
			</table>
			</div>

		</div>
		
		<div class="tab-pane fade fade-right in" id="kami">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">输入卡密</div>
				<input name="km" id="km" value="" class="form-control" required="" onkeydown="if(event.keyCode==13){submit_checkkm.click()}" type="text">
			</div></div>
			<input id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密" type="submit">
			<div id="km_show_frame" style="display:none;">
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">商品名称</div>
				<input name="name" id="km_name" value="" class="form-control" disabled="" type="text">
			</div></div>
			<div id="km_inputsname"></div>
			<div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
			<input id="submit_card" class="btn btn-primary btn-block" value="立即购买" type="submit">
			<div id="result1" class="form-group text-center" style="display:none;">
			</div>
			</div>
		</div>

		<div class="tab-pane fade fade-right in" id="lqq">
			<div class="alert alert-success">免费拉取QQ名片圈圈赞99+，输入QQ号并提交即可！</div>
			<div class="tab-pane fade in" id="lqq">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">请输入QQ</div>
						<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
					</div>
				</div>
				<input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交"><br>
				<div id="result3" class="form-group text-center" style="display:none;"></div>
			</div>
        </div>
		
    </div>
</div>

<div class="col-md-auto box" <?php if($conf['hide_tongji']==1){?>style="display:none;"<?php }?>>
<div class="panel panel-default layui-anim layui-anim-scaleSpring">
<div class="panel-heading text-center" style="background: linear-gradient(to right,#14b7ff,#5ccdde,#b221ff);">
<font color="#fff">站点统计</font>
</div>
<div class="panel-body">
<table class="table table-bordered">
<tbody>
<div class="row text-center">
<div class="col-xs-3">
<h5 class="widget-heading"><small>订单总数</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_orders"></span>条</a></h5>
</div>
<div class="col-xs-3">
<h5 class="widget-heading"><small>今日订单</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_orders2"></span>条</a></h5>
</div>
<div class="col-xs-3">
<h5 class="widget-heading"><small>累计交易额</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_money"></span>元</a></h5>
</div>
<div class="col-xs-3">
<h5 class="widget-heading"><small>今日交易额</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_money1"></span>元</a></h5>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<!--音乐代码-->
<div id="audio-play" <?php if(empty($conf['musicurl'])){?>style="display:none;"<?php }?>>
  <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
    <audio loop="loop" src="<?php echo $conf['musicurl']?>" id="media" preload="preload"></audio>
  </div>
</div>
<!--音乐代码-->

<script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.staticfile.org/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
<script src="<?php echo $cdnserver?>assets/maidong/js/marquee.js"></script>
<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
});
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>