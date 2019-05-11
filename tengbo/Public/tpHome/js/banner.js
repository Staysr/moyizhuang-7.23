(function(){
	var swiper = new Swiper(".index-container", {
		parallax : true,
	   	loop: true,
	   	speed:3000,
	   	autoplay:2000,

    onSlideChangeStart: function(swiper) {
        var index = swiper.activeIndex;
        var newindex = index-2;

        $(".banner-pagination span").removeClass("active");
        $(".banner-pagination span").eq(newindex).addClass("active");
	    }
	});

	$(".banner-pagination span").click(function(e){
	    e.preventDefault();
	    var index = $(this).index();
	    $(".banner-pagination span").removeClass("active");
	    $(this).addClass("active");
	    swiper.swipeTo(index+1);
	    return false;
	});
})(jQuery)