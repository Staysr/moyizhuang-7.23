/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

function setSave(name,val,orgid){
	 if(name=='title'){
		 if(val==''){
			 showmessage('名称不能为空','danger',1000,1);
			 jQuery('#title_1').focus();
			 return;
		 } 
	 }
	 jQuery.post(ajaxurl+'&do=setSave&orgid='+orgid,{name:name,val:val});
}
function setImage(img,clientWidth,clientHeight,scale){
	if(clientWidth=='100%') clientWidth=jQuery(img).parent().width();
	if(clientHeight=='100%') clientHeight=jQuery(img).parent().height();
	
	imgReady(img.src, function () {
		width=this.width; 
		height=this.height;
		
		var r0=clientWidth/clientHeight;
		var r1=width/height;
		if(r0>r1){//width充满
			if(!scale){
				w=width>clientWidth?clientWidth:width;
			}else{
				w=clientWidth;
			}
			h=w*(height/width);
		}else{
			if(!scale){
			  h=height>clientHeight?clientHeight:height;
			}else{
				h=clientHeight;
			}
			w=h*(width/height);
		}
		
			if(width<=clientWidth && height<=clientHeight ){
				if(!scale){
					w=width;
					h=height;
				}
				jQuery(img).css('margin-top',(clientHeight-h)/2)
				.css('margin-left',(clientWidth-w)/2)
				.css('width',w)
				.css('height',h);
			}else if(height<clientHeight && width>clientWidth){
				if(!scale){
					w=clientWidth;
					h=w*(height/width);
				}
				
				jQuery(img).css('margin-top',(clientHeight-h)/2)
				.css('margin-left',(clientWidth-w)/2)
				.css('width',w)
				.css('height',h);	
			}else if(height>clientHeight && width<clientWidth){
				if(!scale){
					h=clientHidth;
					w=h*(width/height);
				}
				jQuery(img).css('margin-top',(clientHeight-h)/2)
				.css('margin-left',(clientWidth-w)/2)
				.css('width',w)
				.css('height',h);	
			}else{
				jQuery(img).css('margin-top',(clientHeight-h)/2)
				.css('margin-left',(clientWidth-w)/2)
				.css('width',w)
				.css('height',h);
			}
		
	});
}