function dropdown_off(){
	if (!jQuery('.input-search').hasClass('focus') && !jQuery('.dropdown-width').is(":hidden")) {
		jQuery('.input-search').addClass('focus');
	}
	jQuery(document).off('mousedown.headersearch').on('mousedown.headersearch',function(e) {//关闭搜索内容
		if(jQuery(event.target).closest('#form_search,.ui-datepicker-calendar').length<1){
			jQuery('.dropdown-width').hide();
			jQuery('#searchval').trigger('blur');
			jQuery('.input-search').removeClass('focus');
            jQuery('.input-search-width').removeClass('dzz-arrow-dropup').addClass(' dzz-arrow-dropdown');
			jQuery(document).off('mousedown.headersearch')
		}
	});
}