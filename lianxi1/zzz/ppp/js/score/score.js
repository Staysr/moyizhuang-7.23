function score_show(v,n)
{
	var videostar = Math.round(n / 2);
	var startip = new Array("很差劲","一般般","值得一看","推荐","力荐")
	$("#score_show").empty();
	for(var i=1;i<=5;i++)
	{
		pic = "js/score/"+(i<=videostar?"star1.png":"star2.png");
		$("#score_show").append("<img title=\""+startip[i-1]+"\" src=\""+pic+"\" onmouseover=\"score_change("+i+");\" onmouseout=\"score_change("+videostar+");\" onclick=\"score_send("+v+","+i+");\" />");
	}	
}
function score_change(n)
{
	if($("#score_show img").length > 0)
	{
		var stars = $("#score_show img");
		for (var i=1;i<=5;i++)
		{
			pic = "js/score/"+(i<=n?"star1.png":"star2.png");
			stars.eq(i-1).attr("src",pic);
		}
	}
}
function score_send(v,n)
{
	if(n>=1 && n<=5)
	{
		$.ajax({
			type:"POST",
			url:"ajax.php",
			data:"action=videostar&vid="+v+"&starnum="+n,
			success:function(data,st){
				alert(data);
			}
		});			
	}
}