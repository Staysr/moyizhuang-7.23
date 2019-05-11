//递归显示左侧菜单效果=========================================================
function main_list_all(htmlclass){
	//上级高亮
	if(document.getElementById('cat'+catpid)){
		var parlev=$('#cat'+catpid);
	} else {
		var parlev=$('#cat'+catid);
	}
	parlev.addClass("A");
	//下一级打开
	parlev.next().removeClass("close");
	parlev.next().addClass("open");
	//加号变减号
	parlev.prev().removeClass("close");
	parlev.prev().addClass("open");
	var prolist_side=$("."+htmlclass);
	var time;
	//默认加减号鼠标触发
	prolist_side.find("span").bind("mouseover",function(){
		if($(this).attr("class")=="open"){
			$(this).css("background-position","right -283px");
		}else{
			$(this).css("background-position","right -83px");	
		}
	});
	prolist_side.find("span").bind("mouseout",function(){
		if($(this).attr("class")=="open"){
			$(this).css("background-position","right -183px");
		}else{
			$(this).css("background-position","right 9px");	
		}
	});
	
	//点击变化
	prolist_side.find("span").bind("click",function(){
		var ul=$(this).next().next();
		var alpha=true;
		if($.browser.msie){
			alpha=false;	
		}
		if(ul.css("display")=="none"){
			//将加号变为减号
			$(this).css("background-position","right -283px");
			$(this).attr("class","open");
			(ul.height()<140)?time=100:time=ul.height();			
			if(alpha)(ul.children()).hide().fadeIn(time);
			ul.slideDown(time);
		}else{
			//将减号变为加号
			$(this).css("background-position","right -83px");
			$(this).attr("class","close");
			((ul.height()-100)<100)?time=100:time=ul.height()-100;
			if(alpha)(ul.children()).fadeOut(time);
			ul.slideUp(time);
		}
	});
}

//等比缩放图片===============================================================
function AutoResizeImage(maxWidth,maxHeight,objImg,margintop){
	var img = new Image();
	img.src = objImg.src;
	var hRatio;
	var wRatio;
	var Ratio = 1;
	var w = img.width;
	var h = img.height;
	wRatio = maxWidth / w;
	hRatio = maxHeight / h;
	if (maxWidth ==0 && maxHeight==0){
		Ratio = 1;
	}else if (maxWidth==0){//
		if (hRatio<1) Ratio = hRatio;
	}else if (maxHeight==0){
		if (wRatio<1) Ratio = wRatio;
	}else if (wRatio<1 || hRatio<1){
		Ratio = (wRatio<=hRatio?wRatio:hRatio);
	}
	if (Ratio<1){
		w = w * Ratio;
		h = h * Ratio;
	}
	//如果是空白图片则用最大尺寸代替
	if(objImg.src.indexOf("null.gif")!=-1){
		w=maxWidth;
		h=maxHeight;	
	}
	objImg.height = h;
	objImg.width = w;
	//如果高度小于容器高度则垂直居中
	if(margintop==true || margintop==1){
		if(maxHeight>h){
			objImg.style.marginTop=parseInt(parseInt(maxHeight-parseInt(h))/2)+"px";
		}
	}
}

//产品焦点图显示脚本(带水印)=====================================================
function pro_focus_mark(htmlid,borderColor,backgroundColor,zoom){
	var zoomer=document.getElementById(htmlid+"_zoomer");//右下角放大镜图标
	var imgsA=document.getElementById(htmlid+"_focus_imgs_list").getElementsByTagName("a");
	var thistab=0;//自动移动控制
	var moveVal=66;
	var dostat=true;
	for(var i=0;i<imgsA.length;i++){
		imgsA[i].setAttribute("tab",i);//设置tab序号
		imgsA[i].onclick=function(){
			thistab=this.getAttribute("tab");//得到当前tab		
			
			var focusBig=document.getElementById(htmlid+"_focus_img").getElementsByTagName("img")[0];
			focusBig.src=this.getElementsByTagName("img")[0].src;
			focusBig.style.display="none";			
			$(focusBig).fadeIn(4000/8);			
			
			for(var s=0;s<imgsA.length;s++){//清除之前点击状态
				imgsA[s].style.border="1px solid #DDD";
				imgsA[s].style.backgroundColor="";
			}
			this.style.border="1px solid "+borderColor;//设置当前tab状态
			this.style.backgroundColor=backgroundColor;
			
			if(zoom==1 || zoom==true){
				$("#"+htmlid+"_img_zoom").attr("href",$(focusBig).attr("src"));			
				$("img.zxx_zoom_image").jqueryzoom();
			}
			
			//自动移动
			if(imgsA.length>4){
				dostat=false;
				if(thistab<=1){$("#"+htmlid+"_focus_imgs_list").stop().animate({marginLeft:"0px"},600,'easeOutBack',function(){dostat=true;});}
				else if(thistab>=imgsA.length-3){$("#"+htmlid+"_focus_imgs_list").stop().animate({marginLeft:-((imgsA.length-4)*moveVal)+"px"},600,'easeOutBack',function(){dostat=true;});}
				else{$("#"+htmlid+"_focus_imgs_list").stop().animate({marginLeft:-(thistab-1)*moveVal+"px"},600,'easeOutBack',function(){dostat=true;});}
			}
		}
	}
	
	//放大镜图标
	if(zoom==1 || zoom==true){
		$("#"+htmlid+"_img").bind("mouseover",function(){
			$("#"+htmlid+"_zoomer").css("display","none");
		});
		$("#"+htmlid+"_img").bind("mouseout",function(){
			$("#"+htmlid+"_zoomer").css("display","block");
		});
	}
	
	//左右按钮控制
	$("#"+htmlid+"_img_list_r").bind("click",function(){
		if(dostat==false)return null;
		if(imgsA.length<=4)return null;
		var place=-(imgsA.length-4)*moveVal;
		if(parseInt($('#'+htmlid+'_focus_imgs_list').css('marginLeft'))<=place)return null;
		dostat=false;
		$("#"+htmlid+"_focus_imgs_list").animate({marginLeft:(parseInt($('#'+htmlid+'_focus_imgs_list').css('marginLeft'))-moveVal)+"px"},600,'easeOutBack',function(){dostat=true;});
	});
	$("#"+htmlid+"_img_list_l").bind("click",function(){
	    if(dostat==false)return null;
	  	if(parseInt($('#'+htmlid+'_focus_imgs_list').css('marginLeft'))>=0)return null;
		dostat=false;
		$("#"+htmlid+"_focus_imgs_list").animate({marginLeft:(parseInt($('#'+htmlid+'_focus_imgs_list').css('marginLeft'))+moveVal)+"px"},600,'easeOutBack',function(){dostat=true;});
	});
	//左右按钮颜色变化
	$("#"+htmlid+"_img_list_r").bind("mouseover",function(){$(this).css("border-color","#CCC");});
	$("#"+htmlid+"_img_list_r").bind("mouseout",function(){$(this).css("border-color","#DDD");});
	$("#"+htmlid+"_img_list_l").bind("mouseover",function(){$(this).css("border-color","#CCC");});
	$("#"+htmlid+"_img_list_l").bind("mouseout",function(){$(this).css("border-color","#DDD");});
	
	//默认第一个显示
	if(imgsA[0]!=null){
		if(document.all){//IE
			setTimeout(function(){imgsA[0].click();},1000);
		}else{//修复FF下pic的click事件
			var evt = document.createEvent("MouseEvents");
			evt.initEvent("click",true,true);
			setTimeout(function(){imgsA[0].dispatchEvent(evt);},1000);
		}
		if(zoomer!=null)zoomer.style.display="none";
		if(zoomer!=null)zoomer.style.display="block";
	}
	
	//屏蔽右键
	$("#"+htmlid+"_img,#"+htmlid+"_focus_imgs_list").bind('click',function(){return false;});
	$("#"+htmlid+"_img,#"+htmlid+"_focus_imgs_list").bind('contextmenu',function(){return false;});
}