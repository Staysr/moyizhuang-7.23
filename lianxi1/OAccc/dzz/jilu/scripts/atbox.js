/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
var atbox={};
atbox.init=function(el,url){
	atbox.container=el;
	atbox.dataurl=!url?ajaxurl:url;
	el.find('.atbox-title .atbox-expend').on('click',function(){
		if(!el.hasClass('atbox-init')){
			atbox.getList(atbox.dataurl);
		}
		if(el.find('.atbox-body').hasClass('hide')){
			el.find('.atbox-body').removeClass('hide');
			el.find('.atbox-avatar-wrap').css('min-height',36);
		}else{
			el.find('.atbox-body').addClass('hide');
			el.find('.atbox-avatar-wrap').css('min-height',0);
		}
	});
	jQuery(document).on('keyup',el.selector+' .atbox-input-search',function(){
		atbox.filter(this.value);
	});
	jQuery(document).on('click',el.selector+' .atbox-search-result li',function(){
		if(jQuery(this).hasClass('checked')){
			atbox.setData(jQuery(this).data('uid'),'remove');
		}else{
			atbox.setData(jQuery(this).data('uid'),'add');
		}
	});
	jQuery(document).on('click',el.selector+' .atbox-avatar-item',function(){
		atbox.setData(jQuery(this).data('uid'),'remove');
		return false;
	});
	atbox.container.find('.atbox-search .input-addon').on('click',function(){
		if(jQuery(this).hasClass('checked')){
			atbox.container.find('.atbox-search-result li:visible').each(function(){
				atbox.setData(jQuery(this).data('uid'),'remove');
				jQuery(this).find("input").prop("checked", false);
			});
			jQuery(this).find("input").prop("checked", false);
		}else{
			atbox.container.find('.atbox-search-result li:visible').each(function(){
				atbox.setData(jQuery(this).data('uid'),'add');
				jQuery(this).find("input").prop("checked", true);
			});
			jQuery(this).find("input").prop("checked", true);
		}
		jQuery(this).toggleClass('checked');
		return false;
	});
	
}

atbox.filter=function(key){
	var sum=0;
	atbox.container.find('.atbox-search-result li').each(function(){
		var py=jQuery(this).data('py');
		var username=jQuery(this).text();
		if(py.indexOf(key)!==-1 || username.indexOf(key)!==-1){
			jQuery(this).show();
			sum++;
		}else{
			jQuery(this).hide();
		}
		if(sum>0){
			atbox.container.find('.atbox-noresult').addClass('hide');
		}else{
			atbox.container.find('.atbox-noresult').removeClass('hide');
		}
	});
}
atbox.setData=function(uid,op){
	if(op=='add'){
		if(!atbox.container.find('.atbox-avatar-item[data-uid="'+uid+'"]').length){
			jQuery('<a class="atbox-avatar-item"  title="移除" data-uid="'+uid+'" href="javascript:;">'+
				'<img src="avatar.php?uid='+uid+'&size=small" />'+
				'<input type="hidden" name="ats[]" value="'+uid+'"></a>'
				).appendTo(atbox.container.find('.atbox-avatar-wrap'));
		}
		atbox.container.find('.atbox-search-result li[data-uid="'+uid+'"]').addClass('checked');
	}else{
		atbox.container.find('.atbox-search-result li[data-uid="'+uid+'"]').removeClass('checked')
		.end().find('.atbox-avatar-item[data-uid="'+uid+'"]').remove();
	}
	if(atbox.container.find('.atbox-avatar-item').length){
		atbox.container.find('.atbox-title .atbox-expend .btn-at').addClass('hover');
	}else{
		atbox.container.find('.atbox-title .atbox-expend .btn-at').removeClass('hover');
	}
}
atbox.getList=function(url){
	atbox.container.find('.atbox-search-result').load(url+'&do=getAtList',function(html){
		atbox.container.addClass('atbox-init');
		if(html=='') atbox.container.find('.atbox-noresult').removeClass('hide');
		atbox.Checked();
	});
}
atbox.Checked=function(){
	atbox.container.find('.atbox-avatar-item').each(function(){
		var uid=jQuery(this).data('uid');
		atbox.container.find('.atbox-search-result li[data-uid="'+uid+'"]').addClass('checked');
	});
	
}