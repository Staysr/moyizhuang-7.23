(function(){
	var swiper = new Swiper(".min-banner", {
    onSlideChangeStart: function(swiper) {
        var index = swiper.activeIndex;
        $(".min-pagination span").removeClass("active");
        $(".min-pagination span").eq(index).addClass("active");
	    }
	});

	$(".min-pagination span").click(function(e){
	    e.preventDefault();
	    var index = $(this).index();
	    $(".min-pagination span").removeClass("active");
	    $(this).addClass("active");
	    swiper.swipeTo(index);
	    return false;
	});

	var page_index =0;
	$('.page_next').click(function(){		
		page_index++;
		
		
		if(page_index ===7){
			page_index =0;
		}
		swiper.swipeTo(page_index);
	})
		$('.page_up').click(function(){		
		page_index--;
		
		
		if(page_index ===-1){
			page_index =6;
		}
		swiper.swipeTo(page_index);
	})



})()