(function($){
	'use strict'
	$('.text-box').hover(function(){

		$(this).find('.detail a img').attr('src',url+'img/about/arrow-hover.png');
	
	},function(){
		$(this).find('.detail a img').attr('src',url+'img/about/arrow.png');
	});
	$('.arrow_hover').hover(function(){

		$(this).find('.arrow').attr('src',url+'img/about/arrow-hover.png');
	
	},function(){
		$(this).find('.arrow').attr('src',url+'img/about/arrow.png');
	});
	$('.question_div').hover(function(){

		$(this).find('img').attr('src',url+'img/about/arrow-hover.png');
	
	},function(){
		$(this).find('img').attr('src',url+'img/about/arrow.png');
	});
	$('.pagination-a').on('click',function(){
		$('.pagination-a').removeClass('active');

	});
	$("#news-foot-left").hover(function(){
			$(this).find('img').attr('src',url+'img/case/prev-hover.png');
	},function(){
			$(this).find('img').attr('src',url+'img/case/prev-normal.png');
	});
	$("#news-foot-right").hover(function(){
			$(this).find('img').attr('src',url+'img/case/next-hover.png');
	},function(){
			$(this).find('img').attr('src',url+'img/case/next-normal.png');
	});



	$('.drow').on('click',function(){
		$('#nav').slideToggle();
	});

	var headLi = $('.head-nav').find('.head-li'),
		minLi = $('#nav').find('.nav-li');
	minLi.on('click',function(){
		var $this = $(this);
		var $dropDown = $this.find('.minul');
		$dropDown.slideToggle('normal',function(){
			if ($(this).is(':hidden')) {
				$(this).parent().find('span').html('&nbsp +');
			}else{
				$(this).parent().find('span').html('&nbsp -');
			}
		});
		

	})
	var timer;
	headLi.on({
	"mouseenter":function(){
		var $this = $(this);
		clearTimeout(timer);
		timer=setTimeout(function(){
		$this.find('ul').slideDown();	
		},300);
		},
	"mouseleave":function(){
		var $this = $(this);
		clearTimeout(timer);
		$this.find('ul').slideUp();
		}
	}); 

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
		mymousepic.css({'left':-cursor.x/2,'top':-cursor.y/2});
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


	// $('.industry-container').on('click',function(){
	// 	window.location.href='news_detail.html';
	// });
	// $('.arrow_hover').on('click',function(){
	// 	window.location.href='news_detail.html';
	// });
    //
	// $('.product-div').on('click',function(){
	// 	window.location.href='product_detail.html';
	// });

	// $('.detail-img').(function(){
		
	// }).onmousemove(function(event){

	// 	$('#detail-pic').hide();
	// });

	// $('.myvideo').on('click',function(){
	// 	$(this)[0].pause();
	// })
})(jQuery)