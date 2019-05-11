$(function(){
	$(".icon").click(function(){
		if($(".music").css("display") == "block"){
				$(".txl-music").animate(
				{left:'-100%'},function(){
				$(".music").css("display","none");
				$(".icon").html(">");
				$(".icon").css("background","rgba(0,0,0,0.5)");
				});
		}else{
				$(".txl-music").animate({left:'-40%'});
				$(".music").css("display","block");
				$(".icon").html("<");
				$(".icon").css("background","#000000");
		}
	});
});