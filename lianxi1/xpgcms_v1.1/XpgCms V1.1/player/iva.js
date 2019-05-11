/*
	//方式一iframe：全屏不能用，无弹出播放，播放窗口可以小一些
	MacPlayer.Html = '<iframe border="0" src="'+SitePath+'player/iva.html?u='+encodeURIComponent(MacPlayer.PlayUrl)+'" width="100%" height="'+MacPlayer.Height+'" marginWidth="0" frameSpacing="0" marginHeight="0" frameBorder="0" scrolling="no" vspale="0" noResize></iframe>';
	MacPlayer.Show();

*/

/*
	//方式二js：全屏可用，有弹出播放。建议播放窗口大小 960 * 580
*/


document.write('<link rel="stylesheet" type="text/css" href="http://7xjfim.com2.z0.glb.qiniucdn.com/Iva.css"><script type="text/javascript" src="http://7xjfim.com2.z0.glb.qiniucdn.com/Iva.js"></script><script type="text/javascript" src="http://7xjfim.com2.z0.glb.qiniucdn.com/Iva_Compatible.js"></script><style type="text/css">#playerCnt{width:100%;height:100%;margin:0 auto;background-origin:content-box;background-size:cover;}</style>');

MacPlayer.Html = '<div id="playerCnt"></div>';
MacPlayer.Show();


setTimeout(function(){
	document.getElementById('playerCnt').style.height = MacPlayer.Height + 'px';
	var ivaInstance = new Iva('playerCnt', {
		appkey: 'EyPKeiUt',
		video: MacPlayer.PlayUrl,
		type: 0,
		title: '',
		cover: '',
		cms:'0',
		logoPosition: 'right',
		autoplay: true
	});
},
MacPlayer.Second * 1000 - 1000);

