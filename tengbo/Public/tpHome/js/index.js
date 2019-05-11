(function(){

	var swiper = new Swiper(".banner-container", {
    onSlideChangeStart: function(swiper) {
        var index = swiper.activeIndex;
        $(".circle span").removeClass("circle-active");
	    $(".circle span").eq(index).addClass("circle-active");
	    
	    }

	});

	$(".circle span").click(function(e){
	    e.preventDefault();
	    var index = $(this).index();
	    $(".circle span").removeClass("circle-active");
	    $(this).addClass("circle-active");
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
	});
	var indexPic = $('.index-pic');
	indexPic.hover(function(){
		var $this = $(this);
		$this.find('img').prop('src','img/go-hover.png');
		
	},function(){
		indexPic.find('img').prop('src','img/go.png');
		
	});

		var carbonBtn = $('.carbon-btn');
	carbonBtn.on('click',function(){
		window.location.href='industry_news.html';
	});
	$('.project').on('click',function(){
		window.location.href="project.html";
	})
	$('.tech_question').on('click',function(){
		window.location.href="tech_question.html";
	})
	$('.product').on('click',function(){
		window.location.href="product.html";
	})
	$('.solution_theatre').on('click',function(){
		window.location.href="solution_theatre.html";
	})
	$('.page-left img').hover(function(){
		$(this).prop('src','img/left-go-hover.png');
		
	},function(){
		$(this).prop('src','img/left.png');
		
	});
	$('.page-right img').hover(function(){
		$(this).prop('src','img/go-hover.png');
		
	},function(){
		$(this).prop('src','img/go.png');
		
	});
})()