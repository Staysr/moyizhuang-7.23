(function($){
	'use strict'
	$('.text-box').hover(function(){

		$(this).find('.detail a img').attr('src','img/about/arrow-hover.png');
	
	},function(){
		$(this).find('.detail a img').attr('src','img/about/arrow.png');
	});
	$('.arrow_hover').hover(function(){

		$(this).find('.arrow').attr('src','img/about/arrow-hover.png');
	
	},function(){
		$(this).find('.arrow').attr('src','img/about/arrow.png');
	});
	$('.question_div').hover(function(){

		$(this).find('img').attr('src','img/about/arrow-hover.png');
	
	},function(){
		$(this).find('img').attr('src','img/about/arrow.png');
	});
	$('.pagination-a').on('click',function(){
		$('.pagination-a').removeClass('active');

	});
	$("#news-foot-left").hover(function(){
			$(this).find('img').attr('src','img/case/prev-hover.png');
	},function(){
			$(this).find('img').attr('src','img/case/prev-normal.png');
	});
	$("#news-foot-right").hover(function(){
			$(this).find('img').attr('src','img/case/next-hover.png');
	},function(){
			$(this).find('img').attr('src','img/case/next-normal.png');
	});

		var checkboxlist = $('.checkboxlist'),
			checkall = $('#checkall');
		// $('#checkall').on('change',function(){
		// 	if(this.checked){    
				
		//        $(".list :checkbox").prop("checked", false);
		//        $('#checkall').prop("checked", true);
		       
	 //    	}
		// })
		checkboxlist.on('change',function(){
				checkall.prop("checked", false);
		})
		checkall.on('change',function(){
				checkboxlist.prop("checked", false);
		})
		

	$('.drow').on('click',function(){
		$('#nav').slideToggle();
	});

	var headLi = $('.head-nav').find('.head-li'),
		minLi = $('#nav').find('.nav-li');
	minLi.on('click',function(){
		$(this).find('.minul').slideToggle();
	})
	headLi.hover(function(){
		$(this).find('ul').slideDown();
	},function(){
		$(this).find('ul').slideUp();
	})

		// $('.nav-item').on('click',function(){
		
		// 	$(this).find('span').addClass('active');
		// })

	var detail_up = $('.product_detail-p a');
	detail_up.on('click',function(){
		$(this).siblings().removeClass('_detail-line');
	});

	var $detailli = $('.detail-ul-img li');
	var detailpic = $('#detail-pic img');
	$detailli.on('click',function(){
		var $detailli_img = $(this).find('img').attr('src');
		console.log($detailli_img)

		$('.mypic').attr('src',$detailli_img);
		detailpic.attr('src',$detailli_img);
	})
	var mymousepic = $('#detail-pic img');
	$('.detail-img').on('mousemove',function(event){
		var cursor= {'x':event.clientX,'y':event.clientY};
		console.log(cursor);
		$('#detail-pic').show();
		mymousepic.css({'left':-cursor.x,'top':-cursor.y});
	}).on('mouseout',function(event){
		$('#detail-pic').hide();
		var cursor = null;
		console.log(cursor);
	})
var $footli = $('.foot-box ul li'),
	$foota = $('.foot-box ul a');

	$footli.hover(function(){
		$(this).css('color','rgb(105,105,105)');
	},function(){
		$footli.css('color','rgb(77,77,77)');
	});
	$foota.hover(function(){
		$(this).css('color','rgb(105,105,105)');
	},function(){
		$foota.css('color','rgb(77,77,77)');
	});



	// $('.detail-img').(function(){
		
	// }).onmousemove(function(event){

	// 	$('#detail-pic').hide();
	// });

	// $('.myvideo').on('click',function(){
	// 	$(this)[0].pause();
	// })
})(jQuery)