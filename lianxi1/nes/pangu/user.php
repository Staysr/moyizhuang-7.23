<?php
include ('../inc/aik.config.php');
?>
<?php 

	
define('API_YOU_PATH','TgEXEqC0LQNoaa4cvKWHRbsE5vJx_MEXf27o6rkZcMFgbVgg2w2ETEXJ0jqS9wHpkq6u5itduPW/A06OUonA4kgkXt/yS6Msp6E');//请勿修改此处,造成解析失败概不负责
	

//防盗链域名，多个用|隔开，（不设置盗链请留空，请填写授权是顶级域名的二级域名）
define('REFERER_URL',$aik['pangu_yuming']); //如：define('REFERER_URL', 'www.176yun.com|api.176yun.com|https:\/\/api.176yun.com');

//此处设置防盗信息及错误提示
define('ERROR', '啊哦，防盗链已开启！盗链可耻！');

//此处进行用户相关配置
$user = array(

		'uid' => $aik['pangu_uid'], //这里填写你的UID信息,用户授权UID，在 http://service.pangujiexi.com/ 平台可以查看到

		'token' => $aik['pangu_token'], //这里填写你的TOKEN信息,用户授权TOKEN，在 http://service.pangujiexi.com/ 平台可以查看到

		'path' => $aik['pangu_mulu'], //一般不用修改,除非你修改了Pangu目录名

		'hdd' => '3', //视频默认清晰度，1标清，2高清，3超清，4原画，如果没有高清会自动下降一级
		
		'autoplay' => '1', //用户设置PC自动播放,1:自动播放,0:不自动播放,默认0;

		'h5' => '1', //用户设置移动端自动播放：1:自动播放; 0:不自动播放,默认1;

		'updata' => '', //用户设置更新解析时间,暂时无效

		'dplayer' => '', //用户设置dplayer播放器右键,不设置请留空。填写实例:'dplayer' => '百度,https://www.baidu.com/'

		'hand' => '', //ckplayer播放器右键,例如:'hand'=>'盘古解析,https://pangujiexi.com/'

		'skin' => '1', //ckplayer播放器样式:1,2,3,4种样式,默认1;

		'ckhref' => '', //ckplayer播放器设置控制栏上方漂浮字体的点击跳转地址,需设置ckfont后才生效，不需要请留空;

		'ckfont' => '', //ckplayer播放器设置控制栏上方漂浮字体，不需要请留空。

		'cklogo' => '', //ckplayer播放器右上角logo标志,注意cklogo标志填写您logo标志的完整url地址，例如:https://pangujiexi.com/xxx.png;

		'lolink' => '', //用户设置防盗跳转,设置防盗验证时间lotime参数后才生效,填写实例:https://pangujiexi.com/

		'lotime' => '', //防盗二级措施,温馨提示:本设置仅当防盗链开启且数字大于0的时候才生效,设置多少秒后跳转设置:lolink参数,填写例如:10

		'ather' => '', //盘古解析服务器出现问题，自动跳转第三方的解析接口  //填写实例：'ather' => 'http://www.xxxxx.com/pangu/index.php?url=',

		'bdyun' => '', //百度网盘cookie,两个参数BDUSS,STOKEN这两个即可， //填写实例：'bdyun' => 'BDUSS=xxxxxx;STOKEN=xxxxxx;',					  

		'tyyun' => '', //天翼网盘cookie，获取整段的cookies即可
        
        'weiyun' => '', //腾讯微云cookie，获取整段的cookies即可,//目前暂未开放
        
        'icloud' => '', //苹果icloud cookie，获取整段的cookies即可,请在COOKIE后加上_MAC_UID=您的id//目前暂未开放			
		
		'title' => '', //用户设置解析页面title名称   //填写实例：'title' => '盘古视频解析API接口',
		
		'tongji' => '', //用户统计代码,例如:s4.cnzz.com/z_stat.php?id=xxxxx&web_id=xxxxx,无需添加http

		'ad' => ''//用户设置广告代码,例如:xxx.com/xxx,无需添加http,多个广告请用逗号分开
        )
				
//-----------------------修改区域结束---------------------------------------

 ?>