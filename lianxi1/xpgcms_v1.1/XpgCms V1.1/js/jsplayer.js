var ArrTips = new Array();
ArrTips[0] = document.getElementById("topdes").innerHTML;
ArrTips[1] = '请记住本站网址: ' + window.location.host;
function getRandomNum(lbound, ubound) {
    return (Math.floor(Math.random() * (ubound - lbound)) + lbound)
};
function macTips() {
    var id = getRandomNum(0, 2);
    document.getElementById("topdes").innerHTML = ArrTips[id]
};
setInterval('macTips()', 10000);


if(MacPlayer.Status) {
	setTimeout(function() {
		$(".MacBuffer").hide();
		$(".MacBuffer").html('')
	},
	11000);
}
else{
var showdown_from = (MacPlayer.PlayFrom == undefined ? MacPlayer.playfrom : MacPlayer.PlayFrom);
var showdown_height = (MacPlayer.Height == undefined ? MacPlayer.height : MacPlayer.Height);
$("#install").get(0).innerHTML = '<iframe border="0" src="' + '/player/' + showdown_from + '.html' + '" marginWidth="0" frameSpacing="0" marginHeight="0" frameBorder="0" scrolling="no" width="100%" height="' + showdown_height + '" vspale="0"></iframe>';
	
}