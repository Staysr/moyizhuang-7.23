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
	};
	options=$.extend(opt,options);
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
	 
	var rectarr=[];

	var  dfire=function(e){
		$(document).trigger(e);
	};
	
	var Mousedown=function(e){
		var touch=e.touches[0];
		draging=false;
		var XX=touch.clientX;
		var YY=touch.clientY;
		oldxx=XX;
		oldyy=YY;
		var p=_this.offset();
		tl=XX-p.left;
		tt=YY-p.top;
		
	
		
	};
	var Mouseup=function(e){
		if(draging) {
			Moved(e);
			return false;
		}
	};
	var PreMove=function(){
		$('#_blank').empty().show();
		draging=true;
		task_panel_close();
		var p=_this.offset();
		_this.before('<div id="kp_widget_holder" style="'+options['hoder_div_css']+'"></div>');
		wid = $("#kp_widget_holder");
		wid.css({"height":_this.outerHeight(true)-parseInt(_this.css('margin-top'))-parseInt(_this.css('margin-bottom')), "width":_this.outerWidth(true)-parseInt(_this.css('margin-left'))-parseInt(_this.css('margin-right')),'margin-left':parseInt(_this.css('margin-left')),'margin-right':parseInt(_this.css('margin-right')),'margin-top':parseInt(_this.css('margin-top')),'margin-bottom':parseInt(_this.css('margin-bottom'))});

		// 保持原来的宽高
		_this.css({"width": _this.outerWidth(true)-parseInt(_this.css('margin-left'))-parseInt(_this.css('margin-right')), "height":_this.outerHeight(true)-parseInt(_this.css('margin-top'))-parseInt(_this.css('margin-bottom')), "position":"absolute", opacity: 0.9, "z-index": 5000, "left":p.left-parseInt(_this.css('margin-left')), "top":p.top-parseInt(_this.css('margin-top')),'border':'1px solid #D2D2D2','transform':_this.closest('.layout-0').length>0?'rotate(5deg)':''}).appendTo('body');
	 	Createblank();
		//_this.off('touchend');
		
	};
	var Move=function(e){   
		
		var touch=e.touches[0];
		var XX=touch.clientX;
		var YY=touch.clientY;
		mousedx=XX-oldxx;
		mousedy=YY-oldyy;

		oldxx=XX;
		oldyy=YY;
		if(!draging) return;
		checkarea(XX,YY);
		if(mousedy>5){
			 $('#_blank .scrollingtop').hide();
			 if(options.layout>0 && scrolltf.bottom<1) $('#_blank .scrollingbottom').show();
			 else $('#_blank .scrollingbottom').show();
		}else if(mousedy<-5){
			 $('#_blank .scrollingbottom').hide();
			 $('#_blank .scrollingtop').show();
			 if(options.layout>0 && scrolltf.top<1) $('#_blank .scrollingtop').show();
			 else $('#_blank .scrollingtop').show();
		}
		if(mousedx>5){
			 if(scrolllf.right<1){
				  $('#_blank .scrollingright').show();
			 }
			 $('#_blank .scrollingleft').hide();
			
		}else if(mousedx<-5){
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
		_this.off('touchend.drag');
		_this.off('touchmove.drag');
		draging=false;
		if(scrollTimer) window.clearInterval(scrollTimer);
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
	var getAreaFlag=function(el,x,y){
	
		if(!el || el.length<1 || el.is(':hidden')){
			return false;
		}
		
		var p=el.offset();
		var rect=[p.left,p.top,p.left+el.width(),p.top+el.height()];
		if(x>rect[0] && x<=rect[2] && y>rect[1] && y<= rect[3]){
			return true;
		}
		return false;
	}
	var oldel=null;
    var checkarea=function(x,y){//检测移动到哪个区域
		var el=jQuery('#_blank');
		//先判断水平滚动条
		if(options.layout<1){
			
		
			var scrollleft=el.find('#scrollLeft');
			var flag=getAreaFlag(scrollleft,x,y);
			if(flag){//进入事件
				if(oldel!='scrollLeft') {
					scrollleft.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrollleft.trigger('mouseover');
					scrollleft.trigger('mouseenter');
				}

				oldel='scrollLeft';
				return;
			}

			var scrollright=el.find('#scrollRight');
			flag=getAreaFlag(scrollright,x,y);
			if(flag){//进入事件
				if(oldel!='scrollRight') {
					scrollright.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrollright.trigger('mouseover');
					scrollright.trigger('mouseenter');
				}
				oldel='scrollRight';
				return;
			}
		}else{
			var scrolltop=el.find('#scrollTop');
			var flag=getAreaFlag(scrolltop,x,y);
			if(flag){//进入事件
				if(oldel!='scrollTop') {
					scrolltop.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrolltop.trigger('mouseover');
				}

				oldel='scrollTop';
				return;
			}

			var scrollbottom=el.find('#scrollBottom');
			flag=getAreaFlag(scrollbottom,x,y);
			if(flag){//进入事件
				if(oldel!='scrollBottom') {
					scrollbottom.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrollbottom.trigger('mouseover');
				}
				oldel='scrollBottom';
				return;
			}
		}
		//判断列表内滚动
		var listContainer=el.find('.listContainer');
		for(var i = 0 ;i < listContainer.length ; i++){
			var cat=listContainer.eq(i);
			flag=getAreaFlag(cat,x,y);
			if(flag){//如果进入此列表，
				//先查询上下滚动条
				var scrolltop=cat.find('.scrollingtop');
				var flag1=getAreaFlag(scrolltop,x,y);
				if(flag1){
					if(oldel!=scrolltop.attr('id')) {
						scrolltop.trigger('mouseenter');
						if(oldel){
							$('#'+oldel).trigger('mouseleave');
							$('#'+oldel).trigger('mouseout');
						}
					}else{
						scrolltop.trigger('mouseover');
						scrolltop.trigger('mouseenter');
					}
					
					oldel=scrolltop.attr('id');
					return;
				}
				
				var scrollbottom=cat.find('.scrollingbottom');
				flag1=getAreaFlag(scrollbottom,x,y);
				if(flag1){
					if(oldel!=scrollbottom.attr('id')) {
						scrollbottom.trigger('mouseenter');
						if(oldel){
							$('#'+oldel).trigger('mouseleave');
							$('#'+oldel).trigger('mouseout');
						}
					}else{
						scrollbottom.trigger('mouseenter');
						scrollbottom.trigger('mouseover');
					}
					
					oldel=scrollbottom.attr('id');
					return;
				}
				//检测任务列表
				var taskItems=cat.find('.contentContainer>.taskItem');
				for(var j=0;j<taskItems.length;j++){
					var itemid=taskItems.get(j).id;
					flag1=getAreaFlag(taskItems.eq(j),x,y);
					
					if(flag1){
						if(oldel!=itemid) {
							taskItems.eq(j).trigger('mouseenter');
							if(oldel){
								$('#'+oldel).trigger('mouseleave');
								$('#'+oldel).trigger('mouseout');
							}
						}else{
							taskItems.eq(j).trigger('mouseenter');
							taskItems.eq(j).trigger('mouseover');
						}
						
						oldel=itemid;
						return;
					}
				}
				if(oldel!=cat.attr('id')) {
					cat.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
						cat.trigger('mouseenter');
					cat.trigger('mouseover');
				}
				
				oldel=cat.attr('id');
				return;
			}
		}
		if(oldel){
			$('#'+oldel).trigger('mouseleave');
			$('#'+oldel).trigger('mouseout');
			oldel=null;
		}
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
		    var pscrollContainer_width=options.pscrollContainer.outerWidth(true);
		    var pscrollContainer_height=options.pscrollContainer.outerHeight(true);
		    var el_pscrollContainer=$('<div id="_shadow_'+options.pscrollContainer.attr('id')+'" style="position:absolute;left:'+p0.left+'px;top:'+p0.top+'px;height:'+pscrollContainer_height+'px;width:'+pscrollContainer_width+'px;background: url(dzz/images/b.gif);"></div>').appendTo(frage);
			if(layout<1){
				var el_scrollleft=itemdiv.clone().css({position:'absolute','z-index':110,'left':0,top:0,height:'100%',width:100,'background':'url(dzz/images/b.gif)'}).attr('id','scrollLeft').data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingleft').appendTo(el_pscrollContainer);
				
				el_scrollleft.on('mouseenter',function(e){
					scrolling($(this).data('scrollContainer'),'left');
					return false;
				});
				el_scrollleft.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollright=itemdiv.clone().css({position:'absolute','z-index':110,'right':0,'top':0,height:'100%',width:100,'background':'url(dzz/images/b.gif)'}).attr('id','scrollRight').data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingright').appendTo(el_pscrollContainer);
			
				el_scrollright.on('mouseenter',function(){
					scrolling($(this).data('scrollContainer'),'right');
					return false;
				});
				el_scrollright.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
				
			}else{
				//创建滚动层
				var el_scrolltop=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,top:0,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).attr('id','scrollTop').data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingtop').appendTo(el_pscrollContainer);
				
				el_scrolltop.on('mouseenter',function(e){
					scrolling($(this).data('scrollContainer'),'top');
				});
				el_scrolltop.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollbottom=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,'bottom':0,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).attr('id','scrollBottom').data('scrollContainer',el_pscrollContainer.attr('id')).addClass('scrollingbottom').appendTo(el_pscrollContainer);
				
				el_scrollbottom.on('mouseenter',function(){
					scrolling($(this).data('scrollContainer'),'bottom');
					
				});
				el_scrollbottom.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
			}
			if(options.layout>0){
				var el_pcontentContainer=$('<div class="contentContainer" style="position:absolute;left:'+(-options.pscrollContainer.scrollLeft())+'px;top:'+(-options.pscrollContainer.scrollTop())+'px;width:'+(pscrollContainer_height)+'px;height:'+(pscrollContainer_height)+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_pscrollContainer);
			}else{
				var el_pcontentContainer=$('<div class="contentContainer" style="position:absolute;left:'+(-options.pscrollContainer.scrollLeft())+'px;top:0px;height:'+(pscrollContainer_height)+'px;width:'+(pscrollContainer_width)+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_pscrollContainer);
			}
		
		
		options.scrollContainer.each(function(){
			var el=$(this);
			var p=el.offset();
			p.left-=p0.left;
			p.top-=p0.top;
			var marginleft=isNaN(parseInt(_this.css('margin-left')))?0:parseInt(_this.css('margin-left'));
			var margintop=isNaN(parseInt(_this.css('margin-top')))?0:parseInt(_this.css('margin-top'));
			var el_container=$('<div id="_shadow_'+this.id+'" class="listContainer" style="position:absolute;left:'+(p.left+options.pscrollContainer.scrollLeft()-marginleft)+'px;top:'+(p.top+options.pscrollContainer.scrollTop()-margintop)+'px;height:'+(el.outerHeight(true)-margintop)+'px;width:'+(el.outerWidth(true)-marginleft)+'px;background: url(dzz/images/b.gif);" ></div>').appendTo(el_pcontentContainer);
				el_container.on('mouseenter',function(){
					 //wid.appendTo('#'+this.id.replace('_shadow_',''));
					 if($('#'+this.id.replace('_shadow_','')).children().length<3) wid.insertBefore($('#'+this.id.replace('_shadow_','')).find('.task-append').get(0));
				});
			
			if(options.layout<1){
				
				if(el.find('.task-container').height()>el.height()){
					//创建滚动层
					var el_scrolltop=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,top:0,height:100,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer','_shadow_'+this.id).attr('id','scrolltop_'+this.id).addClass('scrollingtop').appendTo(el_container);
					el_scrolltop.on('mouseenter',function(e){
						scrolling($(this).data('scrollContainer'),'top');
						return false;
					});
					el_scrolltop.on('mouseleave',function(){
						if(scrollTimer) window.clearInterval(scrollTimer);
						return false;
					});
					var el_scrollbottom=itemdiv.clone().css({position:'absolute','z-index':101,'left':0,'bottom':0,height:100,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer','_shadow_'+this.id).attr('id','scrollbottom_'+this.id).addClass('scrollingbottom').appendTo(el_container);
					el_scrollbottom.on('mouseenter',function(){
						scrolling($(this).data('scrollContainer'),'bottom');
					});
					el_scrollbottom.on('mouseleave',function(){
						if(scrollTimer) window.clearInterval(scrollTimer);
						return false;
					});
				}
			}
			var el_contentContainer=$('<div class="contentContainer" style="position:relative;left:'+(-el.scrollLeft())+'px;top:'+(-el.scrollTop())+'px;background: url(dzz/images/b.gif);"></div>').appendTo(el_container);
			
			el.find(options.itemselector).each(function(){
				var el1=$(this);
				
				//var p=el1.position();
				var el_item=itemdiv.clone().css({height:el1.outerHeight(true),width:'100%','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_'+this.id).addClass('taskItem').appendTo(el_contentContainer);
				el_item.on('mouseenter',function(e){
						wid.insertBefore(document.getElementById((this.id).replace('_shadow_','')));
						return false;
				});
				
			});
			
		});
		document.getElementById('_blank').appendChild(frage);
		
	}
	
	container.find(options.itemselector).each(function(){
		$(this).off('touchstart.drag').on('touchstart.drag',function(e){
			_this=$(this);	
		 	Mousedown(e);
		});
		$(this).off('longTap.drag').on('longTap.drag',function(e){
			//var touch=e.touches[0];
			//var tag = touch.target;
			var tag = e.srcElement ? e.srcElement : e.target;
			if(tag.type=="text" || tag.type=="textarea"){
				return true;
			}	
			
			PreMove();
			$(this).off('touchmove.drag').on('touchmove.drag',function(e){
				e.preventDefault(); 
				e.stopPropagation();
				Move(e);
				return false;
			});
			$(this).off('touchend.drag').on('touchend.drag',function(e){
				e.preventDefault(); 
					e.stopPropagation();
				Moved(e);
				return false;
			});
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
	 var tapdelay=200;
	var tapTimer=null;
	var  dfire=function(e){
		$(document).trigger(e);
	}
	
	var Mousedown=function(e){
		
		var touch=e.touches[0];
		draging=false;
		var XX=touch.clientX;
		var YY=touch.clientY;
		oldxx=XX;
		oldyy=YY;
		var p=_this.offset();
		tl=XX-p.left;
		tt=YY-p.top;
		/*tapTimer=window.setTimeout(function(){
			PreMove();
		},tapdelay);*/
	};
	  var Mouseup=function(e){
		  //if(tapTimer) window.clearTimeout(tapTimer);
		  if(draging){
			  return false;
		  }
		  return true;
	  };

	var PreMove=function(){
		$('#_blank').empty().show();
		draging=true;
		if(_this.hasClass('catlist') && options.layout>0){
			jQuery('body').addClass('dragerHide');
		}
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
		_this.css({"width": _this.outerWidth(true)-marginLeft-marginRight, "height":_this.outerHeight(true)-marginTop-marginBottom, "position":"absolute","background-color":_this.css('backgroundColor'), opacity: 0.9, "z-index": 5000, "left":p.left,"margin-top":0,"margin-left":0, "top":p.top,'transform':_this.closest('.layout-0').length>0?'rotate(5deg)':0}).appendTo('body');
	 	Createblank();
		
	};
	var Move=function(e){  
		
		var touch=e.touches[0];
		var XX=touch.clientX;
		var YY=touch.clientY;
		mousedx=XX-oldxx;
		mousedy=YY-oldyy;
		
		oldxx=XX;
		oldyy=YY;
		if(!draging) return;
		checkarea(XX,YY);
		if(mousedx>5){
			 if(scrolllf.right<1){
				  $('#_blank .scrollingright').show();
			 }
			 $('#_blank .scrollingleft').hide();
			
		}else if(mousedx<-5){
			if(scrolllf.left<1){
				$('#_blank .scrollingleft').show();
			 }
			 $('#_blank .scrollingright').hide();
			
		}
		if(mousedy>5){
			 $('#_blank .scrollingtop').hide();
			 if(options.layout>0 && scrolltf.bottom<1) $('#_blank .scrollingbottom').show();
			 else $('#_blank .scrollingbottom').show();
		}else if(mousedy<-5){
			 $('#_blank .scrollingbottom').hide();
			 $('#_blank .scrollingtop').show();
			 if(options.layout>0 && scrolltf.top<1) $('#_blank .scrollingtop').show();
			 else $('#_blank .scrollingtop').show();
		}
		
		_this.css('left',(XX-tl));
		_this.css('top',(YY-tt));
		
	};
	var Moved=function(e){
		$('#_blank').hide();
		_this.off('touchend.drag');
		if(scrollTimer) window.clearInterval(scrollTimer);
		_this.off('touchmove.drag');
		draging=false;
		// 拖拽回位，并删除虚线框
		var p = wid.offset();
		var data={};
		
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
	var getAreaFlag=function(el,x,y){
	
		if(!el || el.length<1 || el.is(':hidden')){
			return false;
		}
		var p=el.offset();
		var rect=[p.left,p.top,p.left+el.width(),p.top+el.height()];
		if(options.layout<1){
		   if(x>rect[0] && x<=rect[2]){
				return true;
			}
		}else{
			 if(y>rect[1] && y<=rect[3]){
				return true;
			}
		}
		return false;
	}
	var oldel=null;
    var checkarea=function(x,y){//检测移动到哪个区域
		var el=jQuery('#_blank');
		if(options.layout<1){
			//先判断水平滚动条
			var scrollleft=el.find('#scrollLeft1');
			var flag=getAreaFlag(scrollleft,x,y);
			if(flag){//进入事件
				if(oldel!='scrollLeft1') {
					scrollleft.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrollleft.trigger('mouseenter');
				}

				oldel='scrollLeft1';
				return;
			}

			var scrollright=el.find('#scrollRight1');
			flag=getAreaFlag(scrollright,x,y);
			if(flag){//进入事件
				if(oldel!='scrollRight1') {
					scrollright.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrollright.trigger('mouseenter');
				}
				oldel='scrollRight1';
				return;
			}
		}else{
			//先判断列表模式滚动条
			var scrolltop=el.find('#scrollTop1');
			flag=getAreaFlag(scrolltop,x,y);
			if(flag){//进入事件
				if(oldel!='scrollTop1') {
					scrolltop.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrolltop.trigger('mouseenter');
				}

				oldel='scrollTop1';
				return;
			}

			var scrollbottom=el.find('#scrollBottom1');
			flag=getAreaFlag(scrollbottom,x,y);
			if(flag){//进入事件
				if(oldel!='scrollBottom1') {
					scrollbottom.trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					scrollbottom.trigger('mouseenter');
				}
				oldel='scrollBottom1';
				return;
			}
		}
		
		var taskItems=el.find('.catItem');
		for(var j=0;j<taskItems.length;j++){
			var itemid=taskItems.get(j).id;
			flag1=getAreaFlag(taskItems.eq(j),x,y);
			if(flag1){
				if(oldel!=itemid) {
				
					taskItems.eq(j).trigger('mouseenter');
					if(oldel){
						$('#'+oldel).trigger('mouseleave');
						$('#'+oldel).trigger('mouseout');
					}
				}else{
					taskItems.eq(j).trigger('mouseenter');
				}

				oldel=itemid;
				return;
			}
		}
		//判断列表内滚动
		
		if(oldel){
			$('#'+oldel).trigger('mouseleave');
			$('#'+oldel).trigger('mouseout');
			oldel=null;
		}
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
		
	
		options.scrollContainer.each(function(){
			var el=$(this);
			var p0=el.offset();
		
			 var el_scrollContainer=$('<div id="_shadow_'+options.scrollContainer.attr('id')+'" style="position:absolute;left:'+p0.left+'px;top:'+p0.top+'px;height:'+options.scrollContainer.outerHeight(true)+'px;width:'+options.scrollContainer.outerWidth(true)+'px;background: url(dzz/images/b.gif);"></div>').appendTo(frage);
				
			if(layout<1){
				var el_scrollleft=itemdiv.clone().css({position:'absolute','z-index':110,'left':0,top:0,height:'100%',width:150,'background':'url(dzz/images/b.gif)'}).attr('id','scrollLeft1').data('scrollContainer',el_scrollContainer.attr('id')).addClass('scrollingleft').appendTo(el_scrollContainer);
				el_scrollleft.on('mouseenter',function(e){
					scrolling($(this).data('scrollContainer'),'left');
					return false;
				});
				el_scrollleft.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollright=itemdiv.clone().css({position:'absolute','z-index':110,'right':0,'top':0,height:'100%',width:150,'background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).attr('id','scrollRight1').addClass('scrollingright').appendTo(el_scrollContainer);
				el_scrollright.on('mouseenter',function(){
					scrolling($(this).data('scrollContainer'),'right');
					return false;
				});
				el_scrollright.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
					
				});
			}else{
				//创建滚动层
				var el_scrolltop=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,top:0,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).attr('id','scrollTop1').addClass('scrollingtop').appendTo(el_scrollContainer);
				el_scrolltop.on('mouseenter',function(e){
					scrolling($(this).data('scrollContainer'),'top');
				});
				el_scrolltop.on('mouseleave',function(){
					if(scrollTimer) window.clearInterval(scrollTimer);
				});
				var el_scrollbottom=itemdiv.clone().css({position:'absolute','z-index':100,'left':0,'bottom':0,height:150,width:'100%','background':'url(dzz/images/b.gif)'}).data('scrollContainer',el_scrollContainer.attr('id')).attr('id','scrollBottom1').addClass('scrollingbottom').appendTo(el_scrollContainer);
				el_scrollbottom.on('mouseenter',function(){
					scrolling($(this).data('scrollContainer'),'bottom');
					
				});
				el_scrollbottom.on('mouseleave',function(){
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
					var el_item=itemdiv.clone().css({height:'100%',width:el1.outerWidth(true)-parseInt(el1.css('margin-left'))-parseInt(el1.css('margin-right')),'margin-left':el1.css('margin-left'),'margin-top':el1.css('margin-top'),'float':'left','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_'+this.id).addClass('catItem').appendTo(el_contentContainer);
				}else{
					var el_item=itemdiv.clone().css({height:el1.outerHeight(true),width:'100%','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_'+this.id).addClass('catItem').appendTo(el_contentContainer);
				}
				el_item.on('mouseenter',function(e){
						wid.insertBefore(document.getElementById((this.id).replace('_shadow_','')));
						return false;
				});
				
			});
			var el2=el.find(options.itemselector).last();
				if(options.layout<1){
					var el_item2=itemdiv.clone().css({height:'100%',width:el2.outerWidth(true)-parseInt(el2.css('margin-left'))-parseInt(el2.css('margin-right')),'margin-left':el2.css('margin-left'),'margin-top':el2.css('margin-top'),'float':'left','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_last_'+el2.attr('id')).addClass('catItem').appendTo(el_contentContainer);
				}else{
					var el_item2=itemdiv.clone().css({height:el2.outerHeight(true),width:'100%','background':'url(dzz/images/b.gif)'}).attr('id','_shadow_last_'+el2.attr('id')).addClass('catItem').appendTo(el_contentContainer);
				}
				el_item2.on('mouseenter',function(e){
						wid.insertAfter(document.getElementById((this.id).replace('_shadow_last_','')));
						return false;
				});
			
		});
		document.getElementById('_blank').appendChild(frage);
	}
	
	container.find(options.itemselector+' .catlist-header').each(function(){
		
		$(this).off('touchstart.drag').on('touchstart.drag',function(e){
			_this=$(this).parent();	
		 	Mousedown(e);
		});
		$(this).off('longTap.drag').on('longTap.drag',function(e){
			//var touch=e.touches[0];
			//var tag = touch.target;
			var tag = e.srcElement ? e.srcElement : e.target;
			if(tag.type=="text" || tag.type=="textarea"){
				return true;
			}	
			PreMove();
			 $(this).off('touchmove.drag').on('touchmove.drag',function(e){
					e.preventDefault(); 
				    e.stopPropagation();
					Move(e);
				   
				});
				$(this).off('touchend.drag').on('touchend.drag',function(e){
					e.preventDefault(); 
					e.stopPropagation();
					Moved(e);
				});
				
		});
	});
	
}
})(jQuery);
