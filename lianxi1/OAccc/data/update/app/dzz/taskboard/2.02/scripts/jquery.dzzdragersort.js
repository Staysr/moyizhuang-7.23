/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

(function($){
  $.fn.dzzdragersort = function(options,recall) {
	var opt={
		'pscrollContainer':$('#taskboard_container'), //滚动层
		'pcontentContainer':$('#catlist_container'), //内容层
		'scrollContainer':$('.bs-main-container'), //滚动层
		'contentContainer':$('.main-content'), //内容层
		'itemselector':'.task-item',
		'delay':500,
		'layout':0,
		'hoder_div_css':'background:#F4F4F4;border-bottom:1px solid #e1e1e1;border-top:1px solid #fff',
		'width_correct':0,
		'height_correct':0,
		'scrollspeed':10,
		'addspeed':5
	}
	options=$.extend(opt,options);
	//console.log(options);
	var onmousemove=document.onmousemove;
	var onmouseup=document.onmouseup;
	var onselectstart=document.onselectstart;
	var tach=false,draging=false;
	var oldxx=0,oldyy=0,tl=0,tt=0;
	var container=$(this);
	var wid=null;
    var itemdiv=$('<div/>');
	var scrollTimer=0;
var scrollt=0;
var scrolltid='';
var scrolltf={top:0,bottom:0};
var scrolll=0;
var scrolllid='';
var scrolllf={left:0,right:0};
var scrollspeed=options.scrollspeed;
var scrolladdspeed=options.scrollspeed;
var mousedx=0;
var mousedy=0;
	var AttachEvent=function(e){ 
		if(tach) return;
		onmousemove=document.onmousemove;
		onmouseup=document.onmouseup;
		onselectstart=document.onselectstart;
		
		try{
			document.onselectstart=function(){return false;}
			if(e.preventDefault) e.preventDefault();
			else{
				if(_this.setCapture) _this.setCapture();
				window.event.returnValue=false;
			}
		}catch(e){};
		tach=1;
	};
	var  dfire=function(e){
		$(document).trigger(e);
	}
	var DetachEvent=function(e){
		if(!tach) return;
		document.onmousemove=onmousemove;
		document.onmouseup=onmouseup;
		document.onselectstart=onselectstart;
		try{
			if(_this.releaseCapture) _this.releaseCapture();
		}catch(e){}
		tach=0;
		
	};
	var Mousedown=function(e){
		if(e.button==2) return ;
		draging=false;
		tach=false;
		var XX=e.clientX;
		var YY=e.clientY;
		oldxx=XX;
		oldyy=YY;
		var p=_this.offset();
		tl=XX-p.left;
		tt=YY-p.top;
		AttachEvent(e);
		//console.log([oldxx,oldyy,tl,tt]);
		document.onmousemove=function(e){Move(e?e:window.event);};
	};
	var Mouseup=function(e){
		if(tach) DetachEvent(e);
		if(draging) {
			Moved(e);
		}
	};
	var PreMove=function(e){
		$('#_blank').empty().show();
		draging=true;
		task_panel_close();
		if(!tach) AttachEvent(e);
		var p=_this.offset();
		_this.before('<div id="kp_widget_holder" style="'+options['hoder_div_css']+'"></div>');
		wid = $("#kp_widget_holder");
		wid.css({"height":_this.outerHeight(true)-parseInt(_this.css('margin-top'))-parseInt(_this.css('margin-bottom')), "width":_this.outerWidth(true)-parseInt(_this.css('margin-left'))-parseInt(_this.css('margin-right')),'margin-left':parseInt(_this.css('margin-left')),'margin-right':parseInt(_this.css('margin-right')),'margin-top':parseInt(_this.css('margin-top')),'margin-bottom':parseInt(_this.css('margin-bottom'))});

		// 保持原来的宽高
		//_this.css({"width": _this.outerWidth(true)-options['width_correct'], "height":_this.outerHeight(true)-options['height_correct'], "position":"absolute", opacity: 0.9, "z-index": 5000, "left":p.left-options['width_correct'], "top":p.top-options['height_correct'],'border':'1px solid #E2E2E2'}).appendTo('body');
		_this.css({"width": _this.outerWidth(true)-parseInt(_this.css('margin-left'))-parseInt(_this.css('margin-right')), "height":_this.outerHeight(true)-parseInt(_this.css('margin-top'))-parseInt(_this.css('margin-bottom')), "position":"absolute", opacity: 0.9, "z-index": 5000, "left":p.left-parseInt(_this.css('margin-left')), "top":p.top-parseInt(_this.css('margin-top')),'border':'1px solid #D2D2D2','transform':_this.closest('.layout-0').length>0?'rotate(5deg)':''}).appendTo('body');
		//Duplicate();
	 	Createblank();
		//return;
		document.onmouseup=function(e){Moved(e?e:window.event);return false;};
	};
	var Move=function(e){   
		e=e?e:window.event;
		//console.log('move');
		try{
		window.event.returnValue=false;
		}catch(e){}
		var XX=e.clientX;
		var YY=e.clientY;
		mousedx=XX-oldxx;
		mousedy=YY-oldyy;
		if(!draging && (XX!=oldxx || YY!=oldyy)){//不再原位置，表示拖动开始;
			PreMove();
			
		}
		oldxx=XX;
		oldyy=YY;
		if(!draging) return;
		//console.log([XX,YY,oldxx,oldyy]);
		if(mousedy>0){
			 $('#_blank .scrollingtop').hide();
			 if(options.layout>0 && scrolltf.bottom<1) $('#_blank .scrollingbottom').show();
			 else $('#_blank .scrollingbottom').show();
		}else{
			 $('#_blank .scrollingbottom').hide();
			 $('#_blank .scrollingtop').show();
			 if(options.layout>0 && scrolltf.top<1) $('#_blank .scrollingtop').show();
			 else $('#_blank .scrollingtop').show();
		}
		if(mousedx>0){
			 if(scrolllf.right<1){
				  $('#_blank .scrollingright').show();
			 }
			 $('#_blank .scrollingleft').hide();
			
		}else{
			if(scrolllf.left<1){
				$('#_blank .scrollingleft').show();
			 }
			 $('#_blank .scrollingright').hide();
			
		}
		
		_this.css('left',(XX-tl));
		_this.css('top',(YY-tt));
		
	};
	var Moved=function(e){
		$('#_blank').hide();
		if(tach) DetachEvent(e);
		
		// 拖拽回位，并删除虚线框
		var p = wid.offset();
		var data={}
		data.catid=wid.parent().attr('catid');
		data.taskid=_this.attr('taskid');
		data.prevtaskid=wid.prev()?wid.prev('.task-item').attr('taskid'):0;
		_this.animate({"left":p.left-parseInt(wid.css('margin-left')), "top":p.top-parseInt(wid.css('margin-top'))}, 200, function() {
			_this.removeAttr("style");
			wid.replaceWith(_this);
			
			if(typeof recall=='function'){
				recall(data);
			}
			draging = null;
			if(_this.hasClass('catlist') && options.scroll_direction=='vertical'){
				jQuery('body').removeClass('dragerHide');
				var p0=options.contentContainer.offset();
				var p1=_this.offset();
				options.scrollContainer.scrollTop(p1.top-p0.top);
			}
		});
		
	};

	var scrolling=function(scrollContainerid,flag){
		var d=5;
		
		scrolladdspeed=scrollspeed;
		if(scrollTimer) window.clearInterval(scrollTimer);
		if(flag=='top'){//向上滚动
			scrolltid=scrollContainerid;
			scrollt=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolltid.replace('_shadow_',''))).scrollTop(scrollt-scrolladdspeed);
				var scrollv=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
				
				if(scrollt==scrollv){
					window.clearInterval(scrollTimer);
					scrolltf.top=1;
					$('#'+scrolltid+' .scrollingtop').hide();
				}
				scrollt=scrollv;
				$('#'+scrolltid).find('.contentContainer:first').css('top',-scrollv);
				scrolltf.bottom=1;
			},50);
		}else if(flag=='bottom'){
			scrolltid=scrollContainerid;
			scrollt=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolltid.replace('_shadow_',''))).scrollTop(scrollt+scrolladdspeed);
				var scrollv=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
				if(scrollt==scrollv){
					window.clearInterval(scrollTimer);
					scrolltf.bottom=1;
					$('#'+scrolltid+' .scrollingbottom').hide();
				}
				scrollt=scrollv;
				$('#'+scrolltid).find('.contentContainer:first').css('top',-scrollv);
				scrolltf.top=0;
			},50);
		}else if(flag=='left'){
			scrolllid=scrollContainerid;
			scrolll=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft(scrolll-scrolladdspeed);
				var scrollv=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
				if(scrolll==scrollv){
					window.clearInterval(scrollTimer);
					$('#'+scrolllid+' .scrollingleft').hide();
					scrolllf.left=1;
				}
				scrolll=scrollv;
				
				$('#'+scrolllid).find('.contentContainer:first').css('left',-scrollv);
				scrolllf.right=0;
			},50);
		}else if(flag=='right'){
			scrolllid=scrollContainerid;
			scrolll=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
			
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft(scrolll+scrolladdspeed);
				var scrollv=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
				if(scrolll==scrollv){
					window.clearInterval(scrollTimer);
					$('#'+scrolllid+' .scrollingright').hide();
					scrolllf.right=1;
				}
				scrolll=scrollv;
				
				$('#'+scrolllid).find('.contentContainer:first').css('left',-scrollv);
				scrolllf.left=0;
			},50);
		}
	}
	var Createblank=function(){
		//创建滚动层
		var frage=document.createDocumentFragment();
		
		//创建横向滚动层
		    var p0=options.pscrollContainer.offset();
		    var el_pscrollContainer=$('<div id="_shadow_'+options.pscrollContainer.attr('id')+'" style="position:absolute;left:'+p0.left+'px;top:'+p0.top+'px;height:'+options.pscrollContainer.outerHeight(true)+'px;width:'+options.pscrollContainer.outerWidth(true)+'px;background: url(dzz/images/b.gif);"></div>').appendTo(frage);
			if(layout<1){
				var el_scrollleft=itemdiv.clone().css({position:'absolute','z-index':110,'left':-50,top:0,height:'100%',width:200,'background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingleft').appendTo(el_pscrollContainer);
				el_scrollleft.on('mouseenter',function(e){
					scrolling($(this).data('scrollContainer'),'left');
					return false;
				});
				el_scrollleft.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollright=itemdiv.clone().css({position:'absolute','z-index':110,'right':-50,'top':0,height:'100%',width:200,'background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingright').appendTo(el_pscrollContainer);
				el_scrollright.on('mouseenter',function(){
					scrolling($(this).data('scrollContainer'),'right');
					return false;
				});
				el_scrollright.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
			}else{
				//创建滚动层
				var el_scrolltop=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,top:-50,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingtop').appendTo(el_pscrollContainer);
				el_scrolltop.on('mouseover',function(e){
					scrolling($(this).data('scrollContainer'),'top');
				});
				el_scrolltop.on('mouseout',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollbottom=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,'bottom':-50,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingbottom').appendTo(el_pscrollContainer);
				el_scrollbottom.on('mouseover',function(){
					scrolling($(this).data('scrollContainer'),'bottom');
					
				});
				el_scrollbottom.on('mouseout',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
			}
			if(options.layout>0){
				var el_pcontentContainer=$('<div class="contentContainer" style="position:absolute;left:'+(-options.pscrollContainer.scrollLeft())+'px;top:'+(-options.pscrollContainer.scrollTop())+'px;width:'+(options.pcontentContainer.outerHeight(true))+'px;height:'+(options.pcontentContainer.outerWidth(true))+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_pscrollContainer);
			}else{
				var el_pcontentContainer=$('<div class="contentContainer" style="position:absolute;left:'+(-options.pscrollContainer.scrollLeft())+'px;top:0px;height:'+(options.pcontentContainer.outerWidth(true))+'px;width:'+(options.pcontentContainer.outerWidth(true))+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_pscrollContainer);
			}
		
		
		options.scrollContainer.each(function(){
			var el=$(this);
			var p=el.offset();
			p.left-=p0.left;
			p.top-=p0.top;
			var marginleft=isNaN(parseInt(_this.css('margin-left')))?0:parseInt(_this.css('margin-left'));
			var margintop=isNaN(parseInt(_this.css('margin-top')))?0:parseInt(_this.css('margin-top'));
			var el_container=$('<div id="_shadow_'+this.id+'" style="position:absolute;left:'+(p.left+options.pscrollContainer.scrollLeft()-marginleft)+'px;top:'+(p.top+options.pscrollContainer.scrollTop()-margintop)+'px;height:'+(el.outerHeight(true)-margintop)+'px;width:'+(el.outerWidth(true)-marginleft)+'px;background: url(dzz/images/b.gif);" ></div>').appendTo(el_pcontentContainer);
				el_container.on('mouseenter',function(e){
					 //wid.appendTo('#'+this.id.replace('_shadow_',''));
					 if($('#'+this.id.replace('_shadow_','')).children().length<3) wid.insertBefore($('#'+this.id.replace('_shadow_','')).find('.task-append').get(0));
				});
			
			var el_contentContainer=$('<div class="contentContainer" style="position:relative;left:'+(-el.scrollLeft())+'px;top:'+(-el.scrollTop())+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_container);
			
			el.find(options.itemselector).each(function(){
				var el1=$(this);
				
				//var p=el1.position();
				var el_item=itemdiv.clone().css({height:el1.outerHeight(true)-parseInt(el1.css('margin-bottom')),'margin-bottom':el1.css('margin-bottom'),width:el1.outerWidth(true),'background':'url(dzz/images/b.gif)'/*,'border':'1px solid red'*/}).attr('id','_shadow_'+this.id).appendTo(el_contentContainer);
				el_item.on('mouseenter',function(e){
						wid.insertBefore(document.getElementById((this.id).replace('_shadow_','')));
						return false;
				});
				
			});
			
			if(options.layout<1){
				if(el.find('.task-container').height()>el.height()){
					//创建滚动层
					var el_scrolltop=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,top:-50,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer','_shadow_'+this.id).addClass('scrollingtop').appendTo(el_container);
					el_scrolltop.on('mouseenter',function(e){
						scrolling($(this).data('scrollContainer'),'top');
						return false;
					});
					el_scrolltop.on('mouseleave',function(){
						if(scrollTimer) window.clearInterval(scrollTimer);
						return false;
					});
					var el_scrollbottom=itemdiv.clone().css({position:'absolute','z-index':101,'left':0,'bottom':-50,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer','_shadow_'+this.id).addClass('scrollingbottom').appendTo(el_container);
					el_scrollbottom.on('mouseenter',function(){
						scrolling($(this).data('scrollContainer'),'bottom');
					});
					el_scrollbottom.on('mouseleave',function(){
						if(scrollTimer) window.clearInterval(scrollTimer);
						return false;
					});
				}
			}
			
		});
		document.getElementById('_blank').appendChild(frage);
	}
	
	container.find(options.itemselector).each(function(){
		$(this).off('mousedown.drag').on('mousedown.drag',function(e){
			e=e?e:window.event;
			var tag = e.srcElement ? e.srcElement :e.target;
			
			if(tag.type=="text"||tag.type=="textarea"){
				return true;
			}	
			_this=$(this);	
			
			Mousedown(e?e:window.event);
			dfire('mousedown');
			return false;
		});
		$(this).off('mouseup.drag').on('mouseup.drag',function(e){
			e=e?e:window.event;
			var tag = e.srcElement ? e.srcElement :e.target;
			
			if(tag.type=="text"||tag.type=="textarea"){
				return true;
			}		
			Mouseup(e?e:window.event);
			dfire('mouseup');
			return false;
		});
	});
	
}
})(jQuery);

(function($){
  $.fn.dzzdragersort_catlist = function(options,recall) {
	var opt={
		'scrollContainer':$('.bs-main-container'), //滚动层
		'contentContainer':$('.main-content'), //内容层
		'itemselector':'.catlist',
		'delay':500,
		'layout':0,
		'hoder_div_css':'margin:25px 5px 5px 0;float:left;background:#F4F4F4;',
		'width_correct':0,
		'height_correct':0,
		'scrollspeed':10,
		'addspeed':5
	}
	options=$.extend(opt,options);
	//console.log(options);
	var onmousemove=document.onmousemove;
	var onmouseup=document.onmouseup;
	var onselectstart=document.onselectstart;
	var tach=false,draging=false;
	var oldxx=0,oldyy=0,tl=0,tt=0;
	var container=$(this);
	var wid=null;
    var itemdiv=$('<div/>');
	var scrollTimer=0;
var scrollt=0;
var scrolltid='';
var scrolltf={top:0,bottom:0};
var scrolll=0;
var scrolllid='';
var scrolllf={left:0,right:0};
var scrollspeed=options.scrollspeed;
var scrolladdspeed=options.scrollspeed;
var mousedx=0;
var mousedy=0;
	var AttachEvent=function(e){ 
		if(tach) return;
		onmousemove=document.onmousemove;
		onmouseup=document.onmouseup;
		onselectstart=document.onselectstart;
		
		try{
			document.onselectstart=function(){return false;}
			if(e.preventDefault) e.preventDefault();
			else{
				if(_this.setCapture) _this.setCapture();
				window.event.returnValue=false;
			}
		}catch(e){};
		tach=1;
	};
	var  dfire=function(e){
		$(document).trigger(e);
	}
	var DetachEvent=function(e){
		if(!tach) return;
		document.onmousemove=onmousemove;
		document.onmouseup=onmouseup;
		document.onselectstart=onselectstart;
		try{
			if(_this.releaseCapture) _this.releaseCapture();
		}catch(e){}
		tach=0;
		
	};
	var Mousedown=function(e){
		if(e.button==2) return ;
		draging=false;
		tach=false;
		var XX=e.clientX;
		var YY=e.clientY;
		oldxx=XX;
		oldyy=YY;
		var p=_this.offset();

		tl=XX-p.left;
		tt=YY-p.top;
		AttachEvent(e);
		//console.log([oldxx,oldyy,tl,tt]);
		document.onmousemove=function(e){Move(e?e:window.event);};
	};
	var Mouseup=function(e){
		if(tach) DetachEvent(e);
		if(draging) {
			Moved(e);
		}
	};
	var PreMove=function(e){
		$('#_blank').empty().show();
		draging=true;
		if(!tach) AttachEvent(e);
		if(_this.hasClass('catlist') && options.layout>0){
			jQuery('body').addClass('dragerHide');
		}
		task_panel_close();
		var marginTop=parseInt(_this.css('margin-top'));
		var marginRight=parseInt(_this.css('margin-right'));
		var marginBottom=parseInt(_this.css('margin-bottom'));
		var marginLeft=parseInt(_this.css('margin-left'));
		var p=_this.offset();
		wid=jQuery('<div id="kp_widget_holder" style="'+options['hoder_div_css']+'"></div>');
		//_this.before('<div id="kp_widget_holder" style="'+options['hoder_div_css']+'"></div>');
		//wid = $("#kp_widget_holder");
		wid.css({"height":_this.outerHeight(true)-marginTop-marginBottom, "width":_this.outerWidth(true)-marginLeft-marginBottom,'margin-top':marginTop,'margin-right':marginRight,'margin-bottom':marginBottom,'margin-left':marginLeft});
		wid.insertBefore(_this);
		// 保持原来的宽高
		_this.css({"width": _this.outerWidth(true)-marginLeft-marginRight, "height":_this.outerHeight(true)-marginTop-marginBottom, "position":"absolute","background-color":_this.css('backgroundColor'), opacity: 0.9, "z-index": 5000, "left":p.left+marginLeft, "top":p.top+marginTop,'transform':_this.closest('.layout-0').length>0?'rotate(5deg)':0}).appendTo('body');
	 	Createblank();
		document.onmouseup=function(e){Moved(e?e:window.event);return false;};
	};
	var Move=function(e){   
		e=e?e:window.event;
		//console.log('move');
		try{
		window.event.returnValue=false;
		}catch(e){}
		var XX=e.clientX;
		var YY=e.clientY;
		mousedx=XX-oldxx;
		mousedy=YY-oldyy;
		if(!draging && (XX!=oldxx || YY!=oldyy)){//不再原位置，表示拖动开始;
			PreMove();

		}
		oldxx=XX;
		oldyy=YY;
		if(!draging) return;
		//console.log([XX,YY,oldxx,oldyy]);
		
		if(mousedx>0){
			 if(scrolllf.right<1){
				  $('#_blank .scrollingright').show();
			 }
			 $('#_blank .scrollingleft').hide();
			
		}else{
			if(scrolllf.left<1){
				$('#_blank .scrollingleft').show();
			 }
			 $('#_blank .scrollingright').hide();
			
		}
		if(mousedy>0){
			 $('#_blank .scrollingtop').hide();
			 if(options.layout>0 && scrolltf.bottom<1) $('#_blank .scrollingbottom').show();
			 else $('#_blank .scrollingbottom').show();
		}else{
			 $('#_blank .scrollingbottom').hide();
			 $('#_blank .scrollingtop').show();
			 if(options.layout>0 && scrolltf.top<1) $('#_blank .scrollingtop').show();
			 else $('#_blank .scrollingtop').show();
		}
		
		/*if(options.layout<1)*/ _this.css('left',(XX-tl));
		/*else*/ _this.css('top',(YY-tt));
		
	};
	var Moved=function(e){
		$('#_blank').hide();
		if(tach) DetachEvent(e);
		
		// 拖拽回位，并删除虚线框
		var p = wid.offset();
		var data={}
		
		_this.animate({"left":p.left, "top":p.top}, 200, function() {
			_this.removeAttr("style");
			wid.replaceWith(_this);
			
			if(typeof recall=='function'){
				recall(data);
			}
			draging = null;
			if(_this.hasClass('catlist') && options.layout>0){
				jQuery('body').removeClass('dragerHide');
				var p0=options.contentContainer.offset();
				var p1=_this.offset();
				options.scrollContainer.scrollTop(p1.top-p0.top);
			}
		});
		
	};
	/*var Duplicate=function(){
		copy=_this.clone().appendTo('body').get(0);
		var p=_this.offset();
		//console.log(p);
		copy.style.cssText="position:absolute;left:"+(p.left-parseInt(_this.css('margin-left')))+"px;top:"+(p.top-parseInt(_this.css('margin-top')))+"px;width:"+(_this.outerWidth(true)-parseInt(_this.css('margin-left')))+"px;height:"+(_this.outerHeight(true)-parseInt(_this.css('margin-top')))+"px;opacity:0.8;z-index:5000;";
	}*/
	var scrolling=function(scrollContainerid,flag){
		var d=5;
		
		scrolladdspeed=scrollspeed;
		//console.log(scrollspeed);
		if(scrollTimer) window.clearInterval(scrollTimer);
		if(flag=='top'){//向上滚动
			scrolltid=scrollContainerid;
			scrollt=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolltid.replace('_shadow_',''))).scrollTop(scrollt-scrolladdspeed);
				var scrollv=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
				
				if(scrollt==scrollv){
					window.clearInterval(scrollTimer);
					scrolltf.top=1;
					$('#'+scrolltid+' .scrollingtop').hide();
				}
				scrollt=scrollv;
				$('#'+scrolltid).find('.contentContainer:first').css('top',-scrollv);
				scrolltf.bottom=1;
			},50);
		}else if(flag=='bottom'){
			scrolltid=scrollContainerid;
			scrollt=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolltid.replace('_shadow_',''))).scrollTop(scrollt+scrolladdspeed);
				var scrollv=$('#'+(scrolltid.replace('_shadow_',''))).scrollTop();
				if(scrollt==scrollv){
					window.clearInterval(scrollTimer);
					scrolltf.bottom=1;
					$('#'+scrolltid+' .scrollingbottom').hide();
				}
				scrollt=scrollv;
				$('#'+scrolltid).find('.contentContainer:first').css('top',-scrollv);
				scrolltf.top=0;
			},50);
		}else if(flag=='left'){
			scrolllid=scrollContainerid;
			scrolll=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft(scrolll-scrolladdspeed);
				var scrollv=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
				if(scrolll==scrollv){
					window.clearInterval(scrollTimer);
					$('#'+scrolllid+' .scrollingleft').hide();
					scrolllf.left=1;
				}
				scrolll=scrollv;
				
				$('#'+scrolllid).find('.contentContainer:first').css('left',-scrollv);
				scrolllf.right=0;
			},50);
		}else if(flag=='right'){
			scrolllid=scrollContainerid;
			scrolll=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
			
			scrollTimer=window.setInterval(function(){
				scrolladdspeed+=options.addspeed;
				$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft(scrolll+scrolladdspeed);
				var scrollv=$('#'+(scrolllid.replace('_shadow_',''))).scrollLeft();
				if(scrolll==scrollv){
					window.clearInterval(scrollTimer);
					$('#'+scrolllid+' .scrollingright').hide();
					scrolllf.right=1;
				}
				scrolll=scrollv;
				
				$('#'+scrolllid).find('.contentContainer:first').css('left',-scrollv);
				scrolllf.left=0;
			},50);
		}
	}
	var Createblank=function(){
		//创建滚动层
		var frage=document.createDocumentFragment();
		
	
		options.scrollContainer.each(function(){
			var el=$(this);
			var p0=el.offset();
		
			 var el_scrollContainer=$('<div id="_shadow_'+options.scrollContainer.attr('id')+'" style="position:absolute;left:'+p0.left+'px;top:'+p0.top+'px;height:'+options.scrollContainer.outerHeight(true)+'px;width:'+options.scrollContainer.outerWidth(true)+'px;background: url(dzz/images/b.gif);"></div>').appendTo(frage);
				
			if(layout<1){
				var el_scrollleft=itemdiv.clone().css({position:'absolute','z-index':110,'left':-50,top:0,height:'100%',width:200,'background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).addClass('scrollingleft').appendTo(el_scrollContainer);
				el_scrollleft.on('mouseenter',function(e){
					scrolling($(this).data('scrollContainer'),'left');
					return false;
				});
				el_scrollleft.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollright=itemdiv.clone().css({position:'absolute','z-index':110,'right':-50,'top':0,height:'100%',width:200,'background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).addClass('scrollingright').appendTo(el_scrollContainer);
				el_scrollright.on('mouseenter',function(){
					scrolling($(this).data('scrollContainer'),'right');
					return false;
				});
				el_scrollright.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
			}else{
				//创建滚动层
				var el_scrolltop=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,top:-50,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).addClass('scrollingtop').appendTo(el_scrollContainer);
				el_scrolltop.on('mouseover',function(e){
					scrolling($(this).data('scrollContainer'),'top');
				});
				el_scrolltop.on('mouseout',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollbottom=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,'bottom':-50,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).addClass('scrollingbottom').appendTo(el_scrollContainer);
				el_scrollbottom.on('mouseover',function(){
					scrolling($(this).data('scrollContainer'),'bottom');
					
				});
				el_scrollbottom.on('mouseout',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
			}
			if(options.layout>0){
				var el_contentContainer=$('<div class="contentContainer" style="position:absolute;left:'+(-options.scrollContainer.scrollLeft())+'px;top:'+(-options.scrollContainer.scrollTop())+'px;width:100%;height:'+(options.contentContainer.outerWidth(true))+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_scrollContainer);
			}else{
				var el_contentContainer=$('<div class="contentContainer" style="position:absolute;left:'+(-options.scrollContainer.scrollLeft())+'px;top:0px;height:100%;width:'+(options.contentContainer.outerWidth(true))+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_scrollContainer);
			}
			el.find(options.itemselector).each(function(){
				var el1=$(this);
				
				//var p=el1.position();
				if(options.layout<1){
					var el_item=itemdiv.clone().css({height:'100%',width:el1.outerWidth(true)-parseInt(el1.css('margin-left'))-parseInt(el1.css('margin-right')),'margin-left':el1.css('margin-top'),'margin-top':el1.css('margin-top'),'float':'left','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_'+this.id).appendTo(el_contentContainer);
				}else{
					var el_item=itemdiv.clone().css({height:el1.outerHeight(true)-parseInt(el1.css('margin-top'))-parseInt(el1.css('margin-bottom')),width:el1.outerWidth(true)-parseInt(el1.css('margin-left'))-parseInt(el1.css('margin-right')),'margin-left':el1.css('margin-top'),'margin-top':el1.css('margin-top'),'float':'left','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_'+this.id).appendTo(el_contentContainer);
				}
				el_item.on('mouseenter',function(e){
						wid.insertBefore(document.getElementById((this.id).replace('_shadow_','')));
						return false;
				});
				
			});
			var el2=el.find(options.itemselector).last();
				if(options.layout<1){
					var el_item2=itemdiv.clone().css({height:'100%',width:el2.outerWidth(true)-parseInt(el2.css('margin-left'))-parseInt(el2.css('margin-right')),'margin-left':el2.css('margin-top'),'margin-top':el2.css('margin-top'),'float':'left','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_last_'+el2.attr('id')).appendTo(el_contentContainer);
				}else{
					var el_item2=itemdiv.clone().css({height:el2.outerHeight(true)-parseInt(el2.css('margin-top'))-parseInt(el2.css('margin-bottom')),width:el2.outerWidth(true)-parseInt(el2.css('margin-left'))-parseInt(el2.css('margin-right')),'margin-left':el2.css('margin-top'),'margin-top':el2.css('margin-top'),'float':'left','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_last_'+el2.attr('id')).appendTo(el_contentContainer);
				}
				el_item2.on('mouseenter',function(e){
						wid.insertAfter(document.getElementById((this.id).replace('_shadow_last_','')));
						return false;
				});
			
		});
		document.getElementById('_blank').appendChild(frage);
	}
	
	container.find(options.itemselector+' .catlist-header').each(function(){
		$(this).off('mousedown.drag').on('mousedown.drag',function(e){
			e=e?e:window.event;
			var tag = e.srcElement ? e.srcElement :e.target;
		
			if(tag.type=="text"||tag.type=="textarea"){
				return true;
			}	
			_this=$(this).parent();	
			
			Mousedown(e?e:window.event);
			dfire('mousedown');
			return false;
		});
		$(this).off('mouseup.drag').on('mouseup.drag',function(e){
			e=e?e:window.event;
			var tag = e.srcElement ? e.srcElement :e.target;
			
			if(tag.type=="text"||tag.type=="textarea"){
				return true;
			}		
			Mouseup(e?e:window.event);
			dfire('mouseup');
			return false;
		});
	});
	
}
})(jQuery);
