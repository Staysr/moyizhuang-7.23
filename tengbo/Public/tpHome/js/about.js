(function($){
	$('#history_left').hover(function(){
		$(this).attr('src',url+'img/about/left-hover.png');
		
	},function(){
		$(this).attr('src',url+'img/about/left.png');
	})
	$('#history_right').hover(function(){
		$(this).attr('src',url+'img/about/right-hover.png');
	},function(){
		$(this).attr('src',url+'img/about/right.png');
	})


	var i =0;
	function TranslateLeft($elem,history_blok){
		$elem.click(function(){
			$('.active').prev().addClass('active').siblings()
			.removeClass('active');
			$('.show').prev().addClass('show').siblings()
			.removeClass('show');
			$('.show').show().siblings().hide();
				i++;
			if(i>=1){
				
				history_blok.animate({ right: '+=10px'}, 100);
				i--;
			}else{
				console.log(i)
				history_blok.animate({ left: '-=10px'}, 100);
				
			}
		})

	}
	function TranslateReft($elem,history_blok){
		$elem.click(function(){
			$('.active').next().addClass('active').siblings()
			.removeClass('active');
			$('.show').next().addClass('show').siblings()
			.removeClass('show');
			$('.show').show().siblings().hide();
			i--;
			if(i<=-5){
				i++;
				history_blok.animate({ right: '+=10px'}, 300);
				// console.log($('.blok_1').next())
				// $('.blok_1').next().addClass('active').siblings()
				// .removeClass('active');
			}else{
			console.log(i)
				history_blok.animate({ left: '+=10px'}, 300);
				// $('.blok_6').prev().addClass('active').siblings()
				// .removeClass('active');
			}
		})
	}

	$('.about_block').on('click',function(){
		$(this).addClass('active').siblings().removeClass('active');
		if($(this).hasClass('blok_1')){
			$('.show1').addClass('show').show().siblings()
			.removeClass('show').hide();
		}else if($(this).hasClass('blok_2')){
			$('.show2').addClass('show').show().siblings()
			.removeClass('show').hide();
		}else if($(this).hasClass('blok_3')){
			$('.show3').addClass('show').show().siblings()
			.removeClass('show').hide();
		}else if($(this).hasClass('blok_4')){
			$('.show4').addClass('show').show().siblings()
			.removeClass('show').hide();
		}else if($(this).hasClass('blok_5')){
			$('.show5').addClass('show').show().siblings()
			.removeClass('show').hide();
		}
	})

	// $('.history_lefta').click(function(){
	// 	HistoryLeft($('#history_a'));
	// })
	// $('.history_refta').click(function(){
	// 	HistoryReft($('#history_a'));
	// })
	// function HistoryLeft($elem){
	// 	console.log($elem);
	// 	$elem.find('active').prev().addClass('active')
	// 	.siblings().removeClass('active');
	// }
	// function HistoryReft($elem){
	// 	$elem.find('active').next().addClass('active')
	// 	.siblings().removeClass('active');
	// }
	window.TranslateReft=TranslateReft;
	window.TranslateLeft=TranslateLeft;
	// $('#history_left').on('click',function(){

	// 		i++;
	// 		if(i>=5){
				
	// 			history_blok.animate({ right: '+=10px'}, 100);
	// 			i--;
	// 		}else{
	// 			console.log(i)
	// 			history_blok.animate({ left: '-=10px'}, 100);
				
	// 		}
		
		
	// })
	// $('#history_right').on('click',function(){
	// 		i--;
	// 		if(i<=-5){
	// 			i++;
	// 			history_blok.animate({ right: '+=10px'}, 300);
				
	// 		}else{
	// 		console.log(i)
	// 			history_blok.animate({ left: '+=10px'}, 300);
				
	// 		}
		
	// 	// history_blok.animate({ left: '+=10px'}, 300);
	// })


})(jQuery)