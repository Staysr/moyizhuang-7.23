/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
function attach_down(qid){
	var url=baseurl+'&op=down&qid='+qid;
	if(BROWSER.ie){
		window.open(url);
	}else{
		if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
		window.frames['hideframe'].location=url;
	}
}
function attach_saveto(qid){
	var url=baseurl+'&op=saveto&qid='+qid;
	if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
	window.frames['hideframe'].location=url;
	
}
function preview_box_close(obj){
	var el=jQuery(obj);
	var parent=el.closest('.file_fed');
	el.parent().slideUp(function(){jQuery(this).remove();parent.removeClass('previewing').find('.name_ffed,.ico_ffed').show();});
	
	
}
function understands_video() {
  return !!document.createElement('video').canPlayType; // boolean
}
function attach_preview(qid,obj){
	if(understands_video()){
		var ext=jQuery(obj).data('ext');
		switch(ext){
			case 'mp3':
				var parent=jQuery(obj).closest('.file_fed');
				if(parent.hasClass('previewing')){
					parent.removeClass('previewing');
					parent.find('.name_ffed').show();
					parent.find('.preview-box').remove();
				}else{
					parent.addClass('previewing');
					var html='<div class="preview-box" style="height:50px;display:block;padding-top:10px;background-color: #f7f8f9;z-index: 1;"><audio src="'+obj.href+'" controls="controls" autoplay="true" style="max-width:100%">您的浏览器不支持 audio 标签</audio><a href="javascript:;" onclick="preview_box_close(this);" class="audio-close" title="取消播放"><i class="dzz dzz-close"></i></a></div>'
					parent.find('.name_ffed').hide();
					jQuery(html).insertAfter(parent.find('.name_ffed'));
				}
				break;
			case 'mp4':
				var parent=jQuery(obj).closest('.file_fed');
				var width=parent.width()-parent.find('.ico_ffed').outerWidth(true)-1;
				if(parent.hasClass('previewing')){
					parent.removeClass('previewing');
					parent.find('.name_ffed,.ico_ffed').show();
					parent.find('.preview-box').remove();
				}else{
					parent.addClass('previewing');
					parent.find('.name_ffed,.ico_ffed').hide();
					var html='<div class="preview-box" style="width:100%;position:relative;display:block;height:415px;"><video src="'+obj.href+'" controls="controls" autoplay="true" width="100%">您的浏览器不支持 video 标签</video><a href="javascript:;" onclick="preview_box_close(this);" class="preview-box-close"><i class="glyphicon glyphicon-menu-up"></i> 收起</a></div>'
					jQuery(html).insertAfter(parent.find('.name_ffed'));
				}
				break;
			default:
				var url=baseurl+'&op=preview&qid='+qid;
				if(!top._config) window.open(url);
				else{
					if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
					window.frames['hideframe'].location=url;
				}
		}
	}else{
		var url=baseurl+'&op=preview&qid='+qid;
			if(!top._config) window.open(url);
			else{
				if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
				window.frames['hideframe'].location=url;
			}
	}
	
}
function attach_delete(qid){
	showDialog(__lang.be_true_to_delete_attach,"confirm",__lang.delete,function () {
        jQuery.getJSON(ajaxurl+'&do=attachdel&qid='+qid,function(json){
            if(json.error) showmessage(json.error,'danger',3000,1);
            else if(json.msg=='success'){
                jQuery('#qid_'+qid).slideUp(function(){jQuery(this).remove();});
            }
        });
    })
	// if(confirm(__lang.be_true_to_delete_attach)){
	//
	// }
}
function zan(obj,rid){
	var el=jQuery(obj);
	var zan=1;
	if(el.hasClass('zaned')){
		zan=0;
	}
	jQuery.post(ajaxurl+'&do=zan&rid='+rid+'&zan='+zan,function(json){
		if(json.msg=='success'){
			var num=parseInt(el.find('span').html());
			if(isNaN(num)) num=0;
			if(zan){
				jQuery(el).attr("data-original-title", __lang.cancle_praise).tooltip('fixTitle').tooltip('show').find("i").css('color', '#fbbb01');
				el.addClass('zaned').find('span').html(num+1);
				var html = '<i class="dzz dzz-thumbup big_finger"></i>';
				if(jQuery('#zan_wrap_'+rid).children().length < 1){
					jQuery('#zan_wrap_'+rid).html(html);
				}
				jQuery('<a href="user.php?uid='+json.uid+'" class="viaItem" data-uid="'+json.uid+'">'+json.avatar+'</a>').appendTo('#zan_wrap_'+rid);
			}else{
				el.removeClass('zaned').find('span').html((num-1<1)?__lang.praise:num-1);
				jQuery(el).attr("data-original-title", __lang.praise_one).tooltip('fixTitle').tooltip('show').find("i").css('color', '#4e5563');
				jQuery('#zan_wrap_'+rid+' a[data-uid='+json.uid+']').remove();
				if(jQuery('#zan_wrap_'+rid).children().length < 2){
					jQuery('#zan_wrap_'+rid).html('');
				}
				
			}
			if(jQuery('#zan_wrap_'+rid+' img').length<1){
				jQuery('#cmt_box_'+rid).removeClass('has-zans');
			}else{
				jQuery('#cmt_box_'+rid).addClass('has-zans');
			}
		}
	},'json');

}

function loadfirst(url){
	 jQuery('#loadfirst').show();
	 jQuery.get(url,function(html){
		jQuery('#loadfirst').replaceWith(html);
	 });
}
var pageloading=false;
function loadmore(url){
	if(!url || pageloading) return;
	 jQuery('#loadmore').show();
	 pageloading=true;
	 jQuery.get(url,function(html){
		pageloading=false;
		jQuery('#loadmore').replaceWith(html);
		 
	 });
}

function setImage(img){
	imgReady(img.src, function () {
		width=this.width; 
		height=this.height;
		var clientWidth=jQuery('#header').outerWidth(true);
		var clientHeight=jQuery('#header').outerHeight(true);
		var r0=clientWidth/clientHeight;
		var r1=width/height;
		if(r0>r1){//width充满
			w=width>clientWidth?clientWidth:width;
			h=w*(height/width);
		}else{
			h=height>clientHeight?clientHeight:height;
			w=h*(width/height);
		}
		jQuery('#imgbg').css('margin-top',(clientHeight-h)/2)
		.css('margin-left',(clientWidth-w)/2)
		.css('width',w)
		.css('height',h);
		//document.getElementById('imgbg').style.width=w+'px';
		//document.getElementById('imgbg').style.height=h+'px';
	});
}
function gridview9_init(gridview){
	jQuery(gridview).each(function(){

	   var el=jQuery(this).find('td').children();
	   var sum=el.length;
		var size=0;
		switch(sum){
			case 1:
				size=100;
				 el.css('width',size+'%').css('visibility','visible');
				 el.css('border', 'none');
				break;
			case 2:case 3:case 4:
				size=50;
				 el.css('width',size+'%').css('visibility','visible');
				break;
			case 5:
			   size=33;
			   el.css('width',size+'%').css('visibility','visible');
			   el.eq(0).css('width',size+'%').css('margin-left',1);
			   el.eq(1).css('width',size+'%').css('margin-right',1);
				break;
			case 6:case 9:
			   size=33;
			   el.css('width',size+'%').css('visibility','visible');
			   break;
			case 7:case 8:
				size=33;
			    el.css('width',size+'%').css('visibility','visible');
			    el.eq(0).css('width',size+'%').css('margin-left',1);
			    el.eq(1).css('width',size+'%').css('margin-right',1);
			   break;
		}
		el.each(function(){
			jQuery(this).height(jQuery(this).width());
			jQuery(this).css("lineHeight",jQuery(this).width()+'px');
		})
		if (sum > 1) {
			el.css('fontSize', '14px');
		}
	});
	jQuery(gridview).find('img').css('display', 'inline-block');
	jQuery(gridview).find('span').css('display', 'inline-block');
}
function item_delete(rid){
	showDialog(__lang.be_true_to_delete_jilu_item,'confirm','',function () {
        jQuery.post(ajaxurl+'&do=item_delete&rid='+rid,function(json){
            if(json.msg=='success'){
                jQuery('#item_'+rid).slideUp(function(){jQuery(this).remove();});
            }else{
                showmessage(json.error,'danger',3000,1);
            }
        },'json');
    });
	// if(confirm(__lang.be_true_to_delete_jilu_item)){
	//
	// }
}
//还原记录本 start
function jilu_restore(jid) {
	showDialog(__lang.be_true_to_recovery_jilu,'confirm','',function () {
        jQuery.ajax({
            url:ajaxurl+'&ajax=recovery_jilu&jid='+jid,
            type:'post',
            dataType:'json',
            success:function (msg) {
                showmessage(msg.message,'success',3000,1);
                jQuery('#jilu_'+jid).slideUp(function(){jQuery(this).remove();});
            },
            error:function (msg) {
                showmessage(msg.message,'danger',3000,1);
            }
        })
    })
}
//还原记录本 end
//用户删除记录 start
function user_delete(rid) {
    showDialog('<p>'+__lang.be_true_to_delete_jilu_item+'</p>','confirm', '', function(){
        jQuery.ajax({
            url:ajaxurl+'&ajax=deletejiluItem&rid='+rid,
            type:'post',
            dataType:'json',
            success:function (msg) {
                showmessage(msg.message,'success',3000,1);
                jQuery('#item_'+rid).slideUp(function(){jQuery(this).remove();});
            },
            error:function (msg) {
                showmessage(msg.message,'danger',3000,1);
            }
        })
    }, 1,null,'',__lang.delete)
}
//用户删除记录 end
//用户删除记录本 start
function delete_jilu(jid) {
    showDialog('<p>'+__lang.recycle_delete_jilu_alert+'</p>','confirm', '', function(){
        jQuery.ajax({
            url:ajaxurl+'&ajax=deletejilu&jid='+jid,
            type:'post',
            dataType:'json',
            success:function (msg) {
                showmessage(msg.message,'success',3000,1);
                jQuery('#jilu_'+jid).slideUp(function(){jQuery(this).remove();});
            },
            error:function (msg) {
                showmessage(msg.message,'danger',3000,1);
            }
        })
    }, 1,null,'',__lang.delete)
}
//用户删除记录本 end
//还原 start
function item_restore(rid){
	showDialog(__lang.be_true_to_delete_jilu_item,'confirm','',function () {
        jQuery.ajax({
            url:ajaxurl+'&ajax=recovery_jilu_item&rid='+rid,
            type:'post',
            dataType:'json',
            success:function (msg) {
                showmessage(msg.message,'success',3000,1);
                jQuery('#item_'+rid).slideUp(function(){jQuery(this).remove();});
            },
            error:function (msg) {
                showmessage(msg.message,'danger',3000,1);
            }
        })
    })
}
//还原 end

//清空回收站 start
    function deleteAll() {
        showDialog('<p>'+__lang.be_true_to_clear_recycle+'</p>','confirm','',function(){
            jQuery.ajax({
                url:ajaxurl+'&ajax=empty_trash',
                type:'post',
                dataType:'json',
                success:function (msg) {
                    jQuery('.noteswrap').slideUp(function(){jQuery(this).remove();});
                    jQuery('.num').html('0');
                    showmessage(__lang.clear_success,'success',3000,1);
                },
                error:function (msg) {
                    showmessage(msg.message,'danger',3000,1);
                }
            });
            }, 1,null,'',__lang.delete)
    }
//清空回收站 end

function item_pin(rid,display, pin_type){
	jQuery.post(ajaxurl+'&do=item_pin&rid='+rid+'&display='+display+'&pin_type='+pin_type,function(json){
		if(json.msg=='success'){
			if(display) {//置顶
				if(pin_type == 1){
					jQuery('#item_'+rid).attr('pin',display).find('.topImg-wrap').html('<img src="'+modpath+'/images/topImg.gif" />');
				} else {
					jQuery('#item_'+rid).attr('pin',display).find('.topImg-wrap').html('<img src="'+modpath+'/images/admin-topImg.png" />');
				}	
			} else {//取消置顶
				jQuery('#item_'+rid).attr('pin',display).find('.topImg-wrap').html('');
			}
			jQuery('.popbox').hide();
		}else{
			showmessage(json.error,'danger',3000,1);
		}
	},'json');
	
}
function follow(obj,jid){
	jQuery.post(ajaxurl+'&do=follow&jid='+jid,function(json){
		var num=parseInt(jQuery(obj).find('.follow-num').html());
		if(isNaN(num)) num=0;
		if(json.msg=='success'){
			if(parseInt(json.follow)>0){
				jQuery(obj).removeClass('btn-default').addClass('btn-success').html('<i class="glyphicon glyphicon-ok"></i> '+__lang.follow_success);
				window.setTimeout(function(){jQuery(obj).addClass('btn-default').removeClass('btn-success').html('<i class="glyphicon glyphicon-eye-open"></i> <span class="hidden-xs">关注</span> <span class="follow-num">'+(num+1)+'</span>');},1000);
			}else{
				jQuery(obj).removeClass('btn-default').addClass('btn-danger').html('<i class="glyphicon glyphicon-ok"></i> '+__lang.cancle_follow_success);
				window.setTimeout(function(){jQuery(obj).addClass('btn-default').removeClass('btn-danger').html('<i class="glyphicon glyphicon-eye-open"></i> <span class="hidden-xs">关注</span> <span class="follow-num">'+(num-1>0?num-1:'')+'</span>');},1000);
			}
		}else{
			jQuery(obj).removeClass('btn-default').addClass('btn-danger').html(json.error);
			window.setTimeout(function(){jQuery(obj).addClass('btn-default').removeClass('btn-danger').html('<i class="glyphicon glyphicon-eye-open"></i> <span class="hidden-xs">关注</span> <span class="follow-num">'+(num?num:'')+'</span>');},1000);
		}
	},'json');
}
function image_resize(img,scale){
	imgReady(img.src, function () {
		width=this.width; 
		height=this.height;
		
		if(!scale) scale=jQuery(img).parent().parent().width();
		var r=width/height;
		if(r>1){
			jQuery(img).css({'max-height':'100%','max-width':'auto'});
			if(height>scale) jQuery(img).css({'margin-left':(scale-width*(scale/height))/2+'px'});
			else jQuery(img).css({'margin-left':(scale-width)/2+'px','margin-top':(scale-height)/2+'px'});
		}else if(r<1){
			jQuery(img).css({'max-width':'100%','max-height':'auto'});
			if(width>scale) jQuery(img).css({'margin-top':(scale-height*(scale/width))/2+'px'});
			else jQuery(img).css({'margin-left':(scale-width)/2+'px','margin-top':(scale-height)/2+'px'});
		}else{
			jQuery(img).css({'max-width':'100%','max-height':'100%','margin-left':(scale>width?(scale-width)/2:0)+'px','margin-top':(scale>height?(scale-height)/2:0)+'px'});
		}
	});
}
function todolist_toggle(obj,todoid){
	var obj = jQuery(obj);
	var checked=parseInt(obj.attr('data-checked'));
	jQuery.post(ajaxurl+'&do=todocheck',{'checked':(checked>0?0:1),'todoid':todoid},function(json){
		if(json.msg=='success'){
			obj.attr("data-checked",checked>0?0:1);
			if(checked){
				obj.next().find("p").removeClass("line-through");
				obj.find("input").prop("checked", false);
			}else{
				obj.next().find("p").addClass("line-through");
				obj.find("input").prop("checked", true);
			}
		} else {
			showmessage(json.error, 'waring', 1000, 1);
		}
	},'json');
}
function cmt_loadmore(obj,rid,t){
	var el=jQuery(obj);
	el.html('<img src="'+modpath+'/images/loading.gif" height="14" > <span class="text-muted">'+__lang.loading+'</span>');
	jQuery.get(ajaxurl+'&do=cmt_more&rid='+rid+'&t='+t,function(html){
		el.replaceWith(html);
	});
}
function cmt_reply(rid,uid,username,pcid){ 
	jQuery('#cmt_form_'+rid).find('.stateadd').remove();
	var html = '<input type="hidden" class="stateadd" name="pcid" value="'+pcid+'" /><input type="hidden" class="stateadd" name="pauthorid" value="'+uid+'" />';
	jQuery('#cmt_form_'+rid).prepend(html);
	jQuery('#cmt_input_'+rid).attr('placeholder',__lang.w_reply+username).focus();
}
function cmt_del(obj,cid,rid,reply){
	showDialog(__lang.be_true_to_delete_comment,'confirm','',function () {
        jQuery.post(ajaxurl+'&do=cmt_del&cid='+cid,function(json){
            if(json.msg=='success'){
                cmt_set_sum(rid,-1);
                if(reply == 'reply'){
                    jQuery(obj).closest('.replyItem').slideUp(function(){jQuery(this).remove();});
                } else {
                    jQuery(obj).closest('.cmt-item').slideUp(function(){jQuery(this).remove();});
                    jQuery(".replyItem[pcid='"+cid+"']").slideUp(function(){jQuery(this).remove()});
                }
            }else{
                showmessage(json.error,'danger',3000,1);
            }
        },'json');
    })
	// if(confirm('确定要删除此条评论吗?')){
	//
	// }
}
function cmt_form_show(rid,obj,ty,flag){
	jQuery('#cmt_form_'+rid).find('.stateadd').remove();
	jQuery('#cmt_input_'+rid).attr('placeholder',__lang.publish_your_comment);
	var el=jQuery(obj);
	var tel=jQuery('#cmt_form_box_'+rid);
	var type=ty;
	if(el.hasClass('open')){
		if(flag=='show') return;
		el.removeClass('open');
		tel.slideUp();
		tel.data('genre','');
		jQuery('#cmt_box_'+rid).removeClass('has-cmtform');
	}else{
		if(flag=='hide') return;
		el.addClass('open');
		tel.slideDown(function(){jQuery('#cmt_input_'+rid).focus();});
		tel.data('genre',type);
		console.log(tel.data('genre'));
		jQuery('#cmt_box_'+rid).addClass('has-cmtform');
	}
}
function cmt_set_sum(rid,sum){
	var tel=jQuery('#inter_comment_'+rid+' span');
	var osum=parseInt(tel.html());
	if(isNaN(osum)) osum=0;
	osum+=sum;
	if(osum>0){
		tel.html(osum);
		jQuery('#cmt_box_'+rid).addClass('has-comments');
	}else{
		tel.html(__lang.w_comment);
		jQuery('#cmt_box_'+rid).removeClass('has-comments');
	}
	
}
function item_label(rid,pow,obj){//选择标签
	var el=jQuery(obj);
	var flag=el.find('.dzz-done').length;
	console.log(flag);
	var labelname=el.attr('title');
	var color=el.data('color');
	el.find('.dzz').toggleClass('dzz-done');
	if(flag){
			jQuery.post(ajaxurl+'&do=setLabel&t='+new Date().getTime(),{"pow":pow,"rid":rid,'isadd':0},function(json){
				if(json.msg=='success'){
					jQuery('#tags_'+rid+' .color-label[pow='+pow+']').remove();
					if(jQuery('#tags_'+rid).children().length < 1){
						jQuery('#item_'+rid).find('.item-footer').find('.item-tags').remove();
					}
				}
			},'json');
	}else{
			jQuery.post(ajaxurl+'&do=setLabel&t='+new Date().getTime(),{"pow":pow,"rid":rid,'isadd':1},function(json){
				if(json.msg=='success') {
					if (jQuery('#tags_'+rid).length < 1) {
						var html = '<div class="item-tags item-tags1"><span class="tagTit">'+__lang.label+':</span><span id="tags_'+rid+'" class="tags-wrap clearfix"></span></div>';
						jQuery('#item_'+rid).find('.item-footer').prepend(html);
					}
					jQuery('<span class="color-label '+color+'-label" pow="'+pow+'" title="'+labelname+'">'+'</span>').appendTo('#tags_'+rid);
			}
			},'json');
	}
	
}


var filter={'labels':[],'uids':[],'datetype':'','starttime':'','endtime':'','keyword':'','jids':[],'mytype':[],'jid':''};
function item_filter_isempty(){
	if(filter.labels.length<1 && filter.uids.length<1 && filter.jids.length<1 && filter.datetype=='' && filter.starttime=='' && filter.endtime=='' && filter.keyword==''){
		return true;
	}
	return false;
}
function filter_turn(){
	var btn=jQuery('.btn-filter');
	if(item_filter_isempty()){
		btn.removeClass('btn-danger').addClass('btn-default');
		btn.find('.filter-turn-on').addClass('hide');
		btn.find('.filter-turn-off').removeClass('hide');
	}else{
		btn.removeClass('btn-default').addClass('btn-danger');
		btn.find('.filter-turn-on').removeClass('hide');
		btn.find('.filter-turn-off').addClass('hide');
	}
}
function filter_init(){ //根据filter的值设置pobbox
	filter_turn();
	
	//设置关键词
	jQuery('#filtermenu input').val(filter.keyword);
		
	//设置标签
	jQuery('#filtermenu .label-item a').each(function(){
		if(jQuery.inArray(jQuery(this).attr('pow'),filter.labels)>-1){
			jQuery(this).find('.glyphicon').addClass('glyphicon-ok');
		}else{
			jQuery(this).find('.glyphicon').removeClass('glyphicon-ok');
		}
	});
	
	//设置用户
	jQuery('#filtermenu .member-item a').each(function(){
		if(jQuery.inArray(jQuery(this).attr('uid'),filter.uids)>-1){
			jQuery(this).parent().addClass('selected');
		}else{
			jQuery(this).parent().removeClass('selected');
		}
	});
	//设置记录本
	jQuery('#filtermenu .jilu-item a').each(function(){
		if(jQuery.inArray(jQuery(this).attr('jid'),filter.jids)>-1){
			jQuery(this).parent().addClass('selected');
		}else{
			jQuery(this).parent().removeClass('selected');
		}
	});
	//设置日期
	jQuery('#filtermenu .datefilter-list a').each(function(){
		if(jQuery(this).attr('datetype')==filter.datetype){
			jQuery(this).addClass('selected');
		}else{
			jQuery(this).removeClass('selected');
		}
	});
	if(filter.starttime){
		jQuery('#filter_starttime').val(filter.starttime);
	}else{
		jQuery('#filter_starttime').val('');
	}
	if(filter.endtime){
		jQuery('#filter_endtime').val(filter.endtime);
	}else{
		jQuery('#filter_endtime').val('');
	}
		
}

function item_filter_load(){
	jQuery('#itemContainer').html('<div class="w-load2"><div class="loader"> <div class="loader-inner ball-beat"> <div></div> <div></div> <div></div> </div> </div></div>');
	var data={};
	for(var key in filter){
		
		if(key=='labels' && filter.labels.length){
			data.labels=filter.labels.join(',');
		}else if(key=='uids' && filter.uids.length){
			data.uids=filter.uids;
		}else if(key=='jids' && filter.jids.length){
			data.jids=filter.jids;
		}else if(filter[key]!==''){
			data[key]=filter[key];
		}
	}
	jQuery.get(ajaxurl+'&do=loadmore&method='+op,data,function(html){
		jQuery('#itemContainer').html(html);
	});
}
var keyTimer=null;
var keyDelay=0;
function item_filter(){ //过滤结果
	if(keyTimer) window.clearTimeout(keyTimer);
	keyTimer=window.setTimeout(function(){item_filter_load();},keyDelay);
}
function item_filter_label(pow,obj){
    var el=jQuery(obj);
	el.find('.dzz').toggleClass('dzz-done');
	if(el.find('.dzz-done').length){//添加到filter
		if(jQuery.inArray(pow,filter.labels)<0){
			filter.labels.push(pow);
		}
	}else{
		if(jQuery.inArray(pow,filter.labels)>-1){
			for(var i in filter.labels){
				if(filter.labels[i]==pow) filter.labels.splice(i,1);
			}
		}
	}
	setTimeout(function () {
		jQuery('#searchval1').focus();
    },1)
    // filter_turn();
    // item_filter();
}
function item_filter_user(uid,obj){
	var el=jQuery(obj).parent();
	var inp=jQuery(obj).find('.userCheckbox');
	el.toggleClass('selected1');
	if(el.hasClass('selected1')){//添加到filter
        inp.find('input').prop('checked',true);
        jQuery(obj).find('.avaName').css('color','rgba(34, 34, 34, 1)');
		if(jQuery.inArray(uid,filter.uids)<0){
			filter.uids.push(uid);
		}
	}else{
        inp.find('input').prop('checked',false);
        jQuery(obj).find('.avaName').css('color','rgba(102, 102, 102, 1)');
		if(jQuery.inArray(uid,filter.uids)>-1){
			for(var i in filter.uids){
				if(filter.uids[i]==uid) filter.uids.splice(i,1);
			}
		}
	}
    setTimeout(function () {
        jQuery('#searchval1').focus();
    },1)
	// filter_turn();
	// item_filter();
}
function item_filter_jilu(jid,obj){
	if(jQuery(obj).find('input').is(':checked')){
		jQuery(obj).find('input').prop("checked", false);
	}else{
		jQuery(obj).find('input').prop("checked", true);
	};
	var el=jQuery(obj).parent();
	el.toggleClass('selected1');
    if(el.hasClass('selected1')) {

	   var val=el.find('.noteName-wrap').text();
	   var jid=jid;

	   if(jQuery.inArray(val,searchjson.notes)==-1) {
	   		searchjson.notes.push(val);
	   }
	   if(jQuery.inArray(jid,filter.jids)==-1) {
	   	filter.jids.push(jid);
	   }
   }else {
       var val=el.find('.noteName-wrap').text();
       var jid=jid;
       if(jQuery.inArray(val,searchjson.notes != -1)) {
           for(var i in searchjson.notes) {
               if(searchjson.notes[i]==val) {
                   searchjson.notes.splice(i,1);
               }
           }
       }
        if(jQuery.inArray(jid,filter.jids != -1)) {
            for(var i in filter.jids) {
                if(filter.jids[i]==jid) {
                    filter.jids.splice(i,1);
                }
            }
        }
   }
    searchConditionChange();
    setTimeout(function () {
        jQuery('#searchval1').focus();
    },1)
}
//搜索
function search_click() {
    filter_turn();
    item_filter();
    jQuery("#dropdown-width").hide();
}
//重置函数
function replacement_click() {
    searchjson = {
        'after': '',
        'before': '',
        'owner': 0,
        'type': 0,
        'notesname':0,
        'tags':[],
        'position': [],
        'member':[],
        'notes':[],
        'name': 0,
        'uid': 0,
        'fid': [],
        'flag': [],
        'date':0,
    };
    filter={'labels':[],'uids':[],'datetype':'','owner':'','starttime':'','endtime':'','keyword':'','jids':[],'mytype':[]};
    jQuery('.time').find('a').removeClass('selected');
    jQuery('#filter_starttime,#filter_endtime').val('');
    jQuery('.filter_tags').find('.icon-white').removeClass('dzz-done');
    jQuery('#searchval1').val('');
    jQuery('.a-close').hide();
    jQuery('.filter-member').find('.member-item').removeClass('selected1');
    jQuery('.filter-member').find('.userCheckbox').css('display','none');
    jQuery('.filter-notes').find('.datafilter_li').removeClass('selected1');
    jQuery('.filter-notes').find('.note_ok').css('display','none');
    jQuery('.filter-choose').find('.datafilter_li').removeClass('selected1');
    jQuery('.filter-choose').find('.note_ok').css('display','none');
    jQuery('#input-member').select2('val','');
    jQuery('#input-notes').select2('val','');
    jQuery(".dropdown-cap").find("input").prop("checked", false);
    filter_turn();
    item_filter();
    jQuery("#dropdown-width").hide();
}
//我关注的
function item_filter_way(way,obj) {
	if(jQuery(obj).find('input').is(':checked')){
		jQuery(obj).find('input').prop("checked", false);
	}else{
		jQuery(obj).find('input').prop("checked", true);
	};
    var el=jQuery(obj).parent();
    el.toggleClass('selected1');
    el.find('i').toggle();
    if(el.hasClass('selected1')){//添加到filter
        if(jQuery.inArray(way, filter.mytype) == -1) filter.mytype.push(way);
    }else{
        filter.mytype.splice(jQuery.inArray(way, filter.mytype), 1);
    }
    setTimeout(function () {
        jQuery('#searchval1').focus();
    },1)
    // filter_turn();
    // item_filter();
}

function item_filter_date(datetype,obj,optype){
	var el=jQuery(obj);
	if(datetype=='starttime'){
		if(el.val().match(/\d+-\d+-\d+/i)){//添加到filter
			filter[datetype]=el.val();
			searchjson.after=el.val();
		}else{
			filter[datetype]='';
		}
		filter.datetype='';
		// el.closest('.js-task-datefilter').find('a').removeClass('selected');
	}else if(datetype=='endtime') {
        if(el.val().match(/\d+-\d+-\d+/i)){//添加到filter
            filter[datetype]=el.val();
            searchjson.before=el.val();
        }else{
            filter[datetype]='';
        }
        filter.datetype='';
        // el.closest('.js-task-datefilter').find('a').removeClass('selected');
	}else{
        jQuery('.time li').removeClass('selected');
        jQuery('.time li').find('input').prop('checked',false);
		if(el.hasClass('selected')) {
            filter.datetype='';
			el.removeClass('selected');
			el.find('input').prop('checked',false);
			console.log(1211);

		}else {
            filter.datetype=datetype;
            el.find('input').prop('checked',true);
            el.addClass('selected');
		}
		switch(datetype){
				case 'today':
					var today=new Date().format('yyyy-MM-dd');
					jQuery('#filter_starttime,#filter_endtime').val(today);
					// ser.value = 'after:'+today;
					searchjson.after=today;
					break;

				case 'week':
					var today=new Date();
					var cday=today.getDay();
					var date=today.getDate();
					var week_l=new Date();
					week_l.setDate(date-cday+1);
					var week_u=new Date();
					week_u.setDate(date+(7-cday));
                    // ser.value = 'after:'+week_l.format('yyyy-MM-dd')+','+'bofore:'+week_u.format('yyyy-MM-dd');
					jQuery('#filter_starttime').val(week_l.format('yyyy-MM-dd'));
					jQuery('#filter_endtime').val(week_u.format('yyyy-MM-dd'));
                    searchjson.after=week_l.format('yyyy-MM-dd');
                    searchjson.before=week_u.format('yyyy-MM-dd');

                    break;

				case 'month':
					var today=new Date();
					var cmonth=today.getMonth();
					var date=today.getDate();
					var month_l=new Date();
					month_l.setDate(1);
					var month_u=new Date();
					month_u.setMonth(cmonth+1);
					month_u.setDate(1);
                    // ser.value = 'after:'+month_l.format('yyyy-MM-dd')+','+'bofore:'+month_u.format('yyyy-MM-dd');
					jQuery('#filter_starttime').val(month_l.format('yyyy-MM-dd'));
					jQuery('#filter_endtime').val(month_u.format('yyyy-MM-dd'));
                    searchjson.after=month_l.format('yyyy-MM-dd');
                    searchjson.before=month_u.format('yyyy-MM-dd');
                    break;

			}
		// if(el.hasClass('selected')){//添加到filter
		// 	filter.datetype=datetype;
         //    el.find("input").prop("checked", true);
         //    // ser.value=val;
		// }else{
		// 	filter.datetype='';
         //    el.find("input").prop("checked", false);
        //
		// }
		if(optype){
			filter.optype = optype;
		}
		filter.starttime='';
		filter.endtime='';

		// el.addClass('selected');
        // el.find("input").prop("checked", true);
		// if(filter.datetype!=''){
		// 	el.addClass('selected');
		// 	el.find("input").prop("checked", true);
		// }

	}
	// console.log(searchjson);
	// console.log(filter);
	// filter_turn();
	// item_filter();
    setTimeout(function () {
        jQuery('#searchval1').focus();
    },1)
    searchConditionChange();
}
/* @authorcode  codestrings */

function item_filter_keyword(keyword){
	if(keyword != '') {
        searchjson['name']=keyword;
        filter.keyword=keyword;
        console.log(searchjson['name']);
	}

	filter_turn();
	item_filter();
    searchConditionChange();
}

function item_filter_clear(){
	filter={'labels':[],'uids':[],'datetype':'','starttime':'','endtime':'','keyword':'','jids':[]};
	filter_init();
	item_filter();
}
 Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
}
function loadnewestInfo(){
	if(!jQuery('#newest_tips').length){
		jQuery.post(ajaxurl+'&do=loadnewestinfo&t='+lastvisit,function(json){
			if(parseInt(json.count)>0 && !jQuery('#newest_tips').length){
					var html='<div id="newest_tips" class="alert alert-warning text-center" style="padding:10px;margin:10px 0;">'
							+'  <a href="javascript:;" onclick="loadnewest(this,'+json.starttime+')">'+__lang.have_new_content+'</a>'
							+'</div>';
					var tel=jQuery('#itemContainer>.list-item').first();
					if(tel.length){
						jQuery(html).insertBefore(tel).slideDown();
					}else{
						jQuery(html).appendTo('#itemContainer').slideDown();
					}
				
			}
			lastvisit=parseInt(json.lastvisit);
			newdelay=parseInt(json.timeout);
			window.setTimeout(function(){loadnewestInfo();},newdelay);
		},'json');
	}
}
function loadnewest(obj,time){
	jQuery.get(ajaxurl+'&do=loadnewest&t='+time,function(html){
		jQuery(obj).parent().replaceWith(html);	
	});
	window.setTimeout(function(){loadnewestInfo();},newdelay);
}

function getMoreReply(t,cid,start){
	jQuery.post(ajaxurl+'&do=getReply',{cid:cid,start:start},function(html){
		jQuery(t).replaceWith(html);
	})
}
function getMoreCmt(t,rid,start){
	jQuery.post(ajaxurl+'&do=getMoreCmt',{rid:rid,start:start},function(html){
		jQuery(t).replaceWith(html);
	})
}
function publish_menu(type,url){
	if (jQuery("#publishform").attr('data-type') == type) {
		return;
	} else {
		jQuery.get(url, function(res){
			jQuery(".butonGroups").prevAll().remove();
			jQuery(".clickInput").prepend(res);
			jQuery('.V').css('color','#4e5563');
	        jQuery('.V[data-type='+type+']').css({
	            'color':'#ffba00'
			});
			jQuery("#publishform").attr('data-type', type);
		});
	}

}


