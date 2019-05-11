<?php
if ( !isset( $saxueBanner ) ) {
		saxue_getconfigs( 'banner', 'banner' );
} 
function get_banner( $id, $type = '' ) {
		global $saxueBanner;
		if ( empty( $id ) || !isset( $saxueBanner[$id] ) || count( $saxueBanner[$id]['pics'] ) == 0 ) {
				return;
		} 
		if ( $type === '' ) {
				$type = $saxueBanner[$id]['type'];
		} else {
				$type = intval( $type );
		} 
		if ( $saxueBanner[$id]['width'] == 0 ) $saxueBanner[$id]['width'] = '100%';
		$html = '<style type="text/css">.saxue_banner{width:' . $saxueBanner[$id]['width'] . 'px!important;margin:auto;font-size:0px;overflow:hidden;}.saxue_banner ul{margin:0px;padding:0px;}</style>';
		switch ( $type ) {
				case 1:
						$html .= '<div class="saxue_banner">';
						$html .= '<a href="' . $saxueBanner[$id]['pics'][0]['link'] . '" title="' . $saxueBanner[$id]['pics'][0]['title'] . '">';
						$html .= '<img src="' . $saxueBanner[$id]['pics'][0]['url'] . '" alt="' . $saxueBanner[$id]['pics'][0]['title'] . '" style="width:' . $saxueBanner[$id]['width'] . 'px; height:' . $saxueBanner[$id]['height'] . 'px;">';
						$html .= '</a>';
						$html .= '</div>';
						break;
				case 2:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/banner1/flexslider.css" type="text/css">';
						$html .= '<script src="' . SAXUE_SKIN_SERVER . '/banner/banner1/jquery.flexslider-min.js"></script>';
						$html .= '<div class="saxue_banner"><div class="flexslider flexslider_flash flashfld"><ul class="slides list-none">';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<li><a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '"></a></li>';
						} 
						$html .= '</ul></div></div>';
						$html .= '<script type="text/javascript">$(document).ready(function(){$(".flashfld").flexslider({animation:"slide",controlNav:false});});</script>';
						break;
				case 3:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/banner2/style.css" type="text/css" media="screen">';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/banner2/banner.js"></script>';
						$html .= '<div class="saxue_banner"><div id="saxue_banner2" style="height:' . $saxueBanner[$id]['height'] . 'px;">';
						$html .= '<ul>';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<li>';
								$html .= '<a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '">';
								$html .= '</a>';
								$html .= '</li>';
						} 
						$html .= '</ul>';
						$html .= '</div></div>';
						break;
				case 4:
						$html .= '<link href="' . SAXUE_SKIN_SERVER . '/banner/banner3/css.css" rel="stylesheet" type="text/css">';
						$html .= '<script src="' . SAXUE_SKIN_SERVER . '/banner/banner3/jquery.bxSlider.min.js"></script>';
						$html .= '<div class="saxue_banner saxue_banner3" style="width:' . $saxueBanner[$id]['width'] . 'px; height:' . $saxueBanner[$id]['height'] . 'px;">';
						$html .= '<ul id="slider" class="list-none">';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<li><a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '"></a></li>';
						} 
						$html .= '</ul>';
						$html .= '</div>';
						$html .= '<script type="text/javascript">$(document).ready(function(){$("#slider").bxSlider({ mode:"vertical",autoHover:true,auto:true,pager: true,pause: 5000,controls:false});});</script>';
						break;
				case 5:
						$html .= '<div class="saxue_banner"></div>';
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/banner4/style.css" type="text/css" media="screen">';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/banner4/modernizr.min.js"></script>';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/banner4/box-slider-all.jquery.min.js"></script>';
						$html .= '<div id="viewport-shadow" class="trans saxue-banner4" style="height:' . $saxueBanner[$id]['height'] . 'px;width:' . $saxueBanner[$id]['width'] . 'px;">';
						$html .= '<a href="#" id="prev" class="trans"></a><a href="#" id="next" class="trans"></a>';
						$html .= '<div id="viewport"><div id="box">';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<figure class="slide">';
								$html .= '<a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '"';
								$html .= '</a>';
								$html .= '</figure>';
						} 
						$html .= '</div></div>';
						$html .= '<div class="slider-controls">';
						$html .= '<ul id="controls">';
						$i = 0;
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$d1 = $i == 0 ? ' current' : '';
								$html .= '<li><a class="goto-slide' . $d1 . '" href="#" data-slideindex="' . $i . '"></a></li>';
								$i++;
						} 
						$html .= '</ul>';
						$html .= '</div></div>';
						break;
				case 6:
						$files = $links = $texts = array();
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$files[] = $v['url'];
								$links[] = $v['link'];
								$texts[] = $v['title'];
						} 
						$html .= '<div class="saxue_banner">';
						$html .= '<script type="text/javascript">';
						$html .= 'var files="' . implode( '|', $files ) . '";';
						$html .= 'var links="' . implode( '|', $links ) . '";';
						$html .= 'var texts="";';
						$html .= 'document.write(\'<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '">';
						$html .= '<param name="movie" value="' . SAXUE_SKIN_SERVER . '/banner/banner5/flash.swf"><param name="quality" value="high">';
						$html .= '<param name="menu" value="false"><param name=wmode value="opaque">';
						$html .= '<param name="FlashVars" value="bcastr_file=\'+files+\'&bcastr_link=\'+links+\'&bcastr_title=\'+texts+\'&AutoPlayTime=6">';
						$html .= '<embed src="' . SAXUE_SKIN_SERVER . '/banner/banner5/flash.swf" wmode="opaque" FlashVars="bcastr_file=\'+files+\'&bcastr_link=\'+links+\'&bcastr_title=\'+texts+\'&AutoPlayTime=6" menu="false" quality="high" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">';
						$html .= '</object>\');';
						$html .= '</script></div>';
						break;
				case 7:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/nivo-slider/nivo-slider.css" type="text/css" media="screen" />';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/nivo-slider/jquery.nivo.slider.pack.js"></script>';
						$html .= '<style type="text/css">.saxue-banner6 img{ height:' . $saxueBanner[$id]['height'] . 'px!important;}</style>';
						$html .= '<div class="saxue_banner">';
						$html .= '<div class="slider-wrapper saxue-banner6" style="height:' . $saxueBanner[$id]['height'] . 'px;"><div id="slider" class="nivoSlider">';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '" />';
								$html .= '</a>';
						} 
						$html .= '</div></div></div>';
						$html .= '<script type="text/javascript">$(document).ready(function(){$("#slider").nivoSlider({effect:"random",pauseTime:5000,directionNav:false});});</script>';
						break;
				case 8:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/nivo-slider/nivo-slider.css" type="text/css" media="screen">';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/nivo-slider/jquery.nivo.slider.pack.js"></script>';
						$html .= '<style type="text/css">.saxue-banner7 img{ height:' . $saxueBanner[$id]['height'] . 'px!important;}</style>';
						$html .= '<div class="saxue_banner">';
						$html .= '<div class="slider-wrapper saxue-banner7" style="height:' . $saxueBanner[$id]['height'] . 'px;"><div id="slider" class="nivoSlider">';
						foreach( $saxueBanner[$id]['pics'] as $k => $v ) {
								$html .= '<a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '"';
								if ( $v['title'] ) $html .= ' title="#img_title_' . $k . '"';
								$html .= '></a>';
						} 
						$html .= '</div>';
						foreach( $saxueBanner[$id]['pics'] as $k => $v ) {
								if ( $v['title'] ) $html .= '<div id="img_title_' . $k . '" class="nivo-html-caption">' . $v['title'] . '</div>';
						} 
						$html .= '</div></div>';
						$html .= '<script type="text/javascript">$(document).ready(function(){$("#slider").nivoSlider({effect:"fade",slices:30,pauseTime:5000,directionNav:false});});</script>';
						break;
				case 9:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/nivo-slider/nivo-slider.css" type="text/css" media="screen">';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/nivo-slider/jquery.nivo.slider.pack.js"></script>';
						$html .= '<style type="text/css">.saxue-banner8 img{ height:' . $saxueBanner[$id]['height'] . 'px!important;}</style>';
						$html .= '<div class="saxue_banner">';
						$html .= '<div class="slider-wrapper saxue-banner8" style="height:' . $saxueBanner[$id]['height'] . 'px;"><div id="slider" class="nivoSlider">';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<a href="' . $v['link'] . '" title="' . $v['title'] . '">';
								$html .= '<img src="' . $v['url'] . '" alt="' . $v['title'] . '" width="' . $saxueBanner[$id]['width'] . '" height="' . $saxueBanner[$id]['height'] . '"';
								$html .= '</a>';
						} 
						$html .= '</div></div></div>';
						$html .= '<script type="text/javascript">$(document).ready(function(){$("#slider").nivoSlider({effect:"fade",animSpeed:200,pauseTime:5000,controlNav:false,afterLoad:function(){ 
								$(".saxue-banner8").live("hover",function(tm){
									if (tm.type == "mouseover" || tm.type == "mouseenter")$(this).addClass("saxue-banner8-hover");
									if (tm.type == "mouseout" || tm.type == "mouseleave")$(this).removeClass("saxue-banner8-hover");
								});
								$(".nivo-prevNav,.nivo-nextNav").attr("onselectstart","return false");
								$(".nivo-prevNav").live("hover",function(tm){
									if (tm.type == "mouseover" || tm.type == "mouseenter")$(this).addClass("nivo-prevNav-hover");
									if (tm.type == "mouseout" || tm.type == "mouseleave")$(this).removeClass("nivo-prevNav-hover");
								});
								$(".nivo-nextNav").live("hover",function(tm){
									if (tm.type == "mouseover" || tm.type == "mouseenter")$(this).addClass("nivo-nextNav-hover");
									if (tm.type == "mouseout" || tm.type == "mouseleave")$(this).removeClass("nivo-nextNav-hover");
								});
							}});});</script>';
						break;
				case 10:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/banner9/style.css" type="text/css" media="screen">';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/banner9/banner.js"></script>';
						$html .= '<div class="saxue_banner">';
						$html .= '<div class="saxue-bannar9" style="height:' . $saxueBanner[$id]['height'] . 'px"><div id="bannarbox" class="pic0"><div id="marquee">';
						$html .= '<ul id="mPics"><li id="li" style="height:' . $saxueBanner[$id]['height'] . 'px"><a href="#"></a></li></ul>';
						$html .= '<ul id="circle"></ul>';
						$html .= '</div></div></div></div>';
						$html .= '<style type="text/css">';
						foreach( $saxueBanner[$id]['pics'] as $k => $v ) {
								$html .= '.saxue-bannar9 .pic' . $k . ' #mPics li{ background:url(' . $v['url'] . ') 50% 50% no-repeat;}';
						} 
						$html .= '</style>';
						$html .= '<script type="text/javascript">var bannarbox = [';
						foreach( $saxueBanner[$id]['pics'] as $k => $v ) {
								if ( $k == 0 ) $html .= '{cn:"pic' . $k . '", btn:"btn' . $k . '", cs:"cnow", href:"' . $v['link'] . '"},';
								else $html .= '{cn:"pic' . $k . '", btn:"btn' . $k . '", cs:"", href:"' . $v['link'] . '"},';
						} 
						$html .= '];</script>';
						break;
				case 11:
						$html .= '<link rel="stylesheet" href="' . SAXUE_SKIN_SERVER . '/banner/banner10/style.css" type="text/css" media="screen">';
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/banner10/banner.js"></script>';
						$html .= '<style type="text/css">';
						$html .= '#home-switcher{width:' . $saxueBanner[$id]['width'] . 'px;height:' . $saxueBanner[$id]['height'] . 'px;top:0;}
								#home-switcher .content-frame{width:' . $saxueBanner[$id]['width'] . 'px;height:' . $saxueBanner[$id]['height'] . 'px;margin:0 0px;}
								#home-switcher,#home-switcher .moveable{min-width:' . $saxueBanner[$id]['width'] . 'px}
								.home-switcher .moveable .item{width:' . $saxueBanner[$id]['width'] . 'px;height:' . $saxueBanner[$id]['height'] . 'px;}
								#home-switcher .moveable .item .item-content{width:' . $saxueBanner[$id]['width'] . 'px;height:' . $saxueBanner[$id]['height'] . 'px;margin:0}
								#home-switcher .bigpagenation{width:' . $saxueBanner[$id]['width'] . 'px;bottom:10px;}
								#home-switcher .bigpagenation .xtcnetr{ width:' . $saxueBanner[$id]['width'] . 'px; margin:0px auto; text-align:center;}';
						$html .= '</style>';
						$html .= '<div class="saxue_banner">';
						$html .= '<div id="home-switcher" class="switcher home-switcher" show="1" fadein="0" pagebt="1" hidebt="0" showtime="500" movetime="500" showtime="500" decoration="0" animway="1" auto="1" autotime="5000" autoactive="0" use100="0">';
						$html .= '<div class="content-frame"><div class="moveable">';
						$k = 1;
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<a id="' . $k . '" href="' . $v['link'] . '" class="item active"><span class="item-content" style="background-image:url(' . $v['url'] . ')"></span></a>';
								++$k;
						} 
						$html .= '<div class="clear"></div></div></div><div class="clear"></div>';
						$html .= '<div class="bigpagenation"><div class="xtcnetr">';
						$k = 1;
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<a href="javascript:void(0);" class="pagenation-b" title="' . $k . '"></a>';
								++$k;
						} 
						$html .= '<div class="clear"></div></div></div></div></div>';
						$html .= '<script>$(document).ready(function(){horizontalSwitcher("home");});</script>';
						break;
				case 12:
						$html .= '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/banner/banner11/jquery.easing.1.3.js"></script>';
						$html .= '<style type="text/css">';
						$html .= '.saxue-banner11{clear:both; width:' . $saxueBanner[$id]['width'] . 'px; height:' . $saxueBanner[$id]['height'] . 'px; background:#FFF; position:relative; z-index:1; overflow:hidden;}.saxue-banner11 div{width:' . $saxueBanner[$id]['width'] . 'px; height:' . $saxueBanner[$id]['height'] . 'px; position:absolute; top:0; left:50%; margin-left:-50%; z-index:2; display:none;}';
						$html .= '</style>';
						$html .= '<div class="saxue_banner"><div class="saxue-banner11">';
						$k = 1;
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<div id="banner' . $k . '"><img src="' . $v['url'] . '" /></div>';
								++$k;
						} 
						$html .= '</div></div>';
						$html .= '<script type="text/javascript">
								var tab=1;
								var prev=null;
								function showBanner(tab,prev){
									if(prev==null){
										$("#banner"+tab).stop().fadeIn(400,"easeOutQuad");
									}else{		
										$("#banner"+prev).stop().fadeOut(400,"easeOutQuad",function(){
											$("#banner"+tab).stop().fadeIn(400,"easeOutQuad");	
										});
									}
								}
								//自动运行
								function autoShow(){
									tab++;	
									if(tab>=' . $k . '){
										tab=1;
										prev=' . ( $k - 1 ) . ';
									}else if(tab>0){
										prev=tab-1;	
									}
									showBanner(tab,prev);	
								}
								showBanner(1,prev);
								var auto=setInterval(function(){autoShow(tab,prev);},6000);
								</script>';
						break;
				case 13:
						$html = '<script src="' . SAXUE_SKIN_SERVER . '/banner/banner12/jquery.touchslider.min.js"></script>';
						$html .= '<link rel="stylesheet" type="text/css" href="' . SAXUE_SKIN_SERVER . '/banner/banner12/banner.css" media="all">';
						$html .= '<div class="touchslider touchslider-demo"><div id="tempDiv" class="touchslider-viewport" style="overflow:hidden;position:relative;"><div style="width:10000px">';
						foreach( $saxueBanner[$id]['pics'] as $v ) {
								$html .= '<div class="touchslider-item"><img src="' . $v['url'] . '" class="spic"></div>';
						} 
						$html .= '</div></div></div>';
						$html .= '<script>document.getElementById("tempDiv").style.height = document.documentElement.clientWidth*' . $saxueBanner[$id]['height'] . '/' . $saxueBanner[$id]['width'] . ' + "px";</script>';
						break;
		} 
		return str_replace( '100%px', '100%', $html );
} 
