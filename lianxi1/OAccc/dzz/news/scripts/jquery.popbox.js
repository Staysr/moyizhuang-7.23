/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

(function($){

  $.fn.popbox = function(options){
	var box=$('.popbox');
	if(!box.length){
		box=$('<div class="popbox"></div>').appendTo('body');
	}
	var me=$(this);
	
	var dataurl=[];
	var current=0;
	var open= function(event){
		    
			if(event) event.preventDefault();
			if(me.data('href')){
				getdata(me.data('data-href'));
			}
			$('.js-popbox').removeClass('openpop');
			
			show();
			if(me.data('closest')){
				me.closest(me.data('closest')).find('.dropdown-toggle').dropdown('toggle');
			}
			return false;
		  }
	var show=function(){
			 var clientWidth=document.documentElement.clientWidth;
			 var clientHeight=document.documentElement.clientHeight;
			 if( me.data('closest')) var target=me.closest(me.data('closest'));
			 else var target=me;
			
			 me.addClass('openpop');
			 var p=target.offset();
			 var bw=box.outerWidth(true);
			 var bh=box.outerHeight(true);
			 var w=target.outerWidth(true);
			 var h=target.outerHeight(true);
			 var left=0,top=0;
			 switch(me.data('placement')){
				 case 'right':
				 	left=p.left+w+2;
					top=p.top+h/2-bh/2;
					break;
				case 'top':
				 	top=p.top-bh-2;
					left=p.left+w/2-bw/2;
					break;
				case 'bottom':
				 	top=p.top+h+2;
					left=p.left;
					break;
				case 'left':
				 	left=p.left-bw-2;
					top=p.top+h/2-bh/2;
					break;
				default:
					left=p.left+w+2;
					top=p.top+h/2-bh/2;
					break;
			  }
			  //判断是否超出屏幕
			  if(me.data('auto-adapt')){
				  if(left+bw>clientWidth) left=clientWidth-bw-10;
				  if(top+bh>clientHeight) top=clientHeight-bh-10;
				  if(left<0) left=10;
				  if(top<0) top=10;
			  }
			  
			   box.css({'display': 'block', 'left':left,'top':top});
			   
			   $(document).off('click.popbox').on('click.popbox',function(event){
					 if(!$(event.target).closest('.popbox,.ui-icon,.dzzdate,.ui-corner-all','#jquery-color-picker').length){
						close();
						$('.openpop').removeClass('openpop');
					 }
				});
		  }
	var getdata=function(url){
		if(!url) url=me.data('href');
		url+='&t='+new Date().getTime();
		current=dataurl.push(url);
		   $.get(DZZSCRIPT+'?mod=news&op=menu&do='+url,function(html){
			  box.html(html);
			  box.find('.js-popbox').on('click',function(){
				  getdata($(this).data('href'));
				  return false;
			  }); 
			  box.find('.js-popbox-prev').on('click',function(){
				 goto_prev()
				  return false;
			  });
			  box.find('.close,.cancel').on('click', function(event){
				event.preventDefault();
				close();
			  });
			  show();
		  });
	  }
    var goto_prev=function(){
		if(current>1){
			current-=1;
		}else{
			current=0;
		}
	   url=dataurl[current-1];
		dataurl.splice(current-1,dataurl.length-current+1);
		getdata(url);
	}
	var close=function(){
		current=0;
		dataurl=[];
		box.data('prevel',null);
		box.fadeOut("fast",function(){
			box.html('<div class="loadding"></div>');
		});
		 me.removeClass('openpop');
		 $(document).off('click.popbox');
	}
	if(options=='update'){
		show();
	}else if(options=='open'){
		open();
	}else if(options=='close'){
		close();
	}else if(options=='getdata'){
		getdata();
	}else{
		$(this).off('click.popbox').on('click.popbox', open);
	}
  }
})(jQuery);
