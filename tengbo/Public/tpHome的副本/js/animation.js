(function(){
	'use strict'
	var body = $('body'),
		header = $('header'),
		div = $('.container'),
		swiperContainer = $('.index-container');
	function Animation(){
		body.hide().fadeIn(2000);
		header.hide().slideDown(1500,function(){
			
		});
		div.hide().fadeIn(3000,function(){
			
		});
		swiperContainer.hide().fadeIn(3000);
		
	}
	new Animation;
})(jQuery)