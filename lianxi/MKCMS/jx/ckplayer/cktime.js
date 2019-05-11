	var cookie = {
		set: function(name, value) {
			var Days = 30;
			var exp = new Date();
			exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
			document.cookie = name + '=' + escape(value) + ';expires=' + exp.toGMTString();
		},
		get: function(name) {
			var arr, reg = new RegExp('(^| )' + name + '=([^;]*)(;|$)');
			if(arr = document.cookie.match(reg)) {
				return unescape(arr[2]);
			} else {
				return null;
			}
		},
		del: function(name) {
			var exp = new Date();
			exp.setTime(exp.getTime() - 1);
			var cval = getCookie(name);
			if(cval != null) {
				document.cookie = name + '=' + cval + ';expires=' + exp.toGMTString();
			}
		}
	};
	var cookieTime = cookie.get('time_' + vid);
	//console.log(cookieTime);
	if(!cookieTime || cookieTime == undefined) {
		cookieTime = 0;
	}
	var isiPad = navigator.userAgent.match(/iPhone|Linux|Android|iPad|iPod|ios|iOS|Windows Phone|Phone|WebOS/i) != null; 	
	if (isiPad){
    var videoObject = {
		container: '.a1',
		variable: 'player',
		loaded:'loadHandler',
		poster:'loading.gif',
		video: vid
	};
	}else{
	var videoObject = {
		container: '.a1',
		variable: 'player',
		loaded:'loadHandler',
		autoplay:true,
		video: vid
	};
	}
	if(cookieTime > 0) { 
		videoObject['seek'] = cookieTime;
	}
	var player = new ckplayer(videoObject);
 
	function loadHandler() {
		player.addListener('time', timeHandler);
	}
 
	function timeHandler(t) {
		cookie.set('time_' + vid, t); 
	}

	if ((navigator.userAgent.indexOf('MSIE') >= 0)
			|| (navigator.userAgent.indexOf('Trident') >= 0)) {
		alert("\u517c\u5bb9\u6a21\u5f0f\u0020\u6613\u4ea7\u751f\u64ad\u653e\u95ee\u9898\uff0c\u8bf7\u5c06\u6d4f\u89c8\u5668\u8bbe\u7f6e\u4e3a\u0020\u6781\u901f\u6a21\u5f0f\uff01");
     }