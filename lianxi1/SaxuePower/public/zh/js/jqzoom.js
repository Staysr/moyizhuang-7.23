// JavaScript Document
(function($){
	$.fn.jqueryzoom = function(options){
	var settings = {
		xzoom: 400,		//zoomed width default width
		yzoom: 300,		//zoomed div default width
		offset: 10,		//zoomed div default offset
		position: "right"  //zoomed div default position,offset position is to the right of the image
	};
	if(options) {
		$.extend(settings, options);
	}
	$(this).hover(function(){
		var imageLeft = $(this).get(0).offsetLeft;
		var imageRight = $(this).get(0).offsetRight;
		var imageTop =  $(this).get(0).offsetTop;
		var imageWidth = $(this).get(0).offsetWidth;
		var imageHeight = $(this).get(0).offsetHeight;
		var bigimage = $(this).parent().attr("href");
		if($("span.zxx_image_zoom_div").get().length == 0){
			$(this).after("<span class='zxx_image_zoom_div'><img class='bigimg' src='"+bigimage+"'/></span>");
		}
		if(settings.position == "right"){
			leftpos = imageLeft + imageWidth + settings.offset;
		}else{
			leftpos = imageLeft - settings.xzoom - settings.offset;
		}
		$("span.zxx_image_zoom_div").css({ top: imageTop,left: leftpos });
		$("span.zxx_image_zoom_div").width(settings.xzoom);
		$("span.zxx_image_zoom_div").height(settings.yzoom);
		$("span.zxx_image_zoom_div").show();
			$(document.body).mousemove(function(e){
			var bigwidth = $(".bigimg").get(0).offsetWidth;
			var bigheight = $(".bigimg").get(0).offsetHeight;
			var scaley ='x';
			var scalex= 'y';
			if(isNaN(scalex)|isNaN(scaley)){
			var scalex = Math.round(bigwidth/imageWidth) ;
			var scaley = Math.round(bigheight/imageHeight);
			}
			mouse = new MouseEvent(e);
			scrolly = mouse.y - imageTop - ($("span.zxx_image_zoom_div").height()*1/scaley)/2 ;
			$("span.zxx_image_zoom_div").get(0).scrollTop = scrolly * scaley  ;
			scrollx = mouse.x - imageLeft - ($("span.zxx_image_zoom_div").width()*1/scalex)/2 ;
			$("span.zxx_image_zoom_div").get(0).scrollLeft = (scrollx) * scalex ;
			});
		},function(){
		   $("span.zxx_image_zoom_div").hide();
		   $(document.body).unbind("mousemove");
		   $(".lenszoom").remove();
		   $("span.zxx_image_zoom_div").remove();
		});
	}
})(jQuery);

function MouseEvent(e) {
	this.x = e.pageX
	this.y = e.pageY
}


