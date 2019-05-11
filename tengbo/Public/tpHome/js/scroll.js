(function(){
	'use strict'
			window.onscroll = function(){
			var win = $(window).height(),
			scroll = $(document).scrollTop(),
			item = $('.nav-box').offset().top; 
			console.log(win);
			console.log(scroll);
			if(scroll<1000){
				// $('.scroll').removeClass('active');
				$('.scroll-1').addClass('active').parents().
				siblings().find('span').removeClass('active');
				
			}else if(scroll>1000 && scroll<1500){
				// $('.scroll').removeClass('active');
				$('.scroll-2').addClass('active').parents().
				siblings().find('span').removeClass('active');
				
			}else if(scroll>1500 && scroll<2100){
				// $('.scroll').removeClass('active');
				$('.scroll-3').addClass('active').parents().
				siblings().find('span').removeClass('active');
				

			}else if(scroll>2100 && scroll<2600){
				// $('.scroll').removeClass('active');
				$('.scroll-4').addClass('active').parents().
				siblings().find('span').removeClass('active');
				

			}else if(scroll >2600 && scroll<2700){
				// $('.scroll').removeClass('active');
				
				$('.scroll-5').addClass('active').parents().
				siblings().find('span').removeClass('active');
				

			}else if(scroll>3000){
				$('.nav_container').hide();
			}else if(scroll<3000 && scroll>2800){
				$('.nav_container').show();
			}
		}

		$('.scroll-1').on('click',function(){
			$(this).addClass('active').parents().siblings().find('span').removeClass('active');
			  window.location.hash="#one";
		});
		$('.scroll-2').on('click',function(){
			$(this).addClass('active').parents().siblings().find('span').removeClass('active');
			window.location.hash="#two";
		})
		$('.scroll-3').on('click',function(){
			$(this).addClass('active').parents().siblings().find('span').removeClass('active');
			window.location.hash="#three";
		})
		$('.scroll-4').on('click',function(){
			$(this).addClass('active').parents().siblings().find('span').removeClass('active');
			window.location.hash="#four";
		})
		$('.scroll-5').on('click',function(){
			$(this).addClass('active').parents().siblings().find('span').removeClass('active');
			window.location.hash="#five";
		})

})(jQuery)