var SWFUP = {
	url : ____jsoncfg.posturl,
	picsize : "640*0,240*0,100*75*3",
	picbulk : "0,0,0",
	dpi : "0,0,0",
	piccut : "0*0*0*0,0*0*0*0,0*0*100*75",
	picwater : "True,False,False",
	extension : "jpg",
	btImg0 : ____jsoncfg.flashurl + "/img/on.png",
	btImg1 : ____jsoncfg.flashurl + "/img/over.png",
	btImg2 : ____jsoncfg.flashurl + "/img/click.png",
	btImg3 : ____jsoncfg.flashurl + "/img/disable.png",
	picMaxSize : Number(____jsoncfg.maxsize) * 1024,
	getFlashBtn : function() {
	},
	getImgNum : function() {
		return UpImageShowBar.getImgNum();
	},
	getUpsetting : function() {
		return {
			url : this.url,
			picsize : this.picsize,
			picbulk : this.picbulk,
			dpi : this.dpi,
			piccut : this.piccut,
			picwater : this.picwater,
			extension : this.extension,
			btImg0 : this.btImg0,
			btImg1 : this.btImg1,
			btImg2 : this.btImg2,
			btImg3 : this.btImg3,
			picMaxSize : this.picMaxSize
		};
	},
	beginAdd : function(a) {
		return UpImageShowBar.beginAdd(a);
	},
	addImg : function(d) {
		d.url = d.picName;
		var f = UpImageShowBar.imgs;
		for ( var e = 0; e < f.length; e++) {
			if (f[e].code == d.code) {
				f[e].url = d.url;
			}
		}
		var a = d.fileSize / 1024 / 1024;
		var c = 5000;
		if (a > 8) {
			c = 25000;
		} else {
			if (a > 6) {
				c = 15000;
			} else {
				if (a > 3) {
					c = 10000;
				} else {
					if (a > 1) {
						c = 5000;
					}
				}
			}
		}
		setTimeout(function() {
			UpImageShowBar.addImg(d);
		}, c);
	},
	getSWF : function(a) {
		if (navigator.appName.indexOf("Microsoft") != -1) {
			return document.getElementById(a);
		} else {
			return document[a];
		}
	},
	enableFlashBtn : function() {
		$("#albumDialog").removeClass("w_albumn").addClass("w_album");
		try {
			SWFUP.getSWF(SWFUP.name).setImgUpAble(true);
		} catch (b) {
			var a = arguments.callee;
			window.setTimeout(a, 3000);
		}
	},
	disableFlashBtn : function() {
		$("#albumDialog").removeClass("w_album").addClass("w_albumn");
		try {
			SWFUP.getSWF(SWFUP.name).setImgUpAble(false);
		} catch (b) {
			var a = arguments.callee;
			window.setTimeout(a, 3000);
		}
	},
	delImg : function(a) {
		SWFUP.getSWF(SWFUP.name).imgDel(a);
	},
	showError : function(b) {
		var d = "", c = b.errorType, e = b.infoCode, a = b.fileName;
		if (c == "1") {
			d = "上传文件 " + a + " 时，发生超时错误。";
		} else if (c == "2") {
			d = "上传文件 " + a + " 失败。";
		}
		UpImageShowBar.setImgErr(e);
		UpImageShowBar.showError(d);
	},
	scrollFunc : function() {
		window.setTimeout(UpImageShowBar.hideMultSel, 5000);
	},
	initFlashBtn : function(a) {
		if (a.name) {
			this.name = a.name;
		}
		UpImageShowBar.container.parent().mouseover(SWFUP.scrollFunc);
		UpImageShowBar.regEnableBtn(this.enableFlashBtn);
		UpImageShowBar.regDisableBtn(this.disableFlashBtn);
		UpImageShowBar.regDelImg(this.delImg);
	}
};
// PHP上传
var SINGLEUP = {
	url : "",
	picSize : -1,
	maxSize : Number(____jsoncfg.maxsize),
	createIframe : function() {
	},
	addImg : function(b, a, c) {
		if (b == 1) {
			UpImageShowBar.addImg({
				url : a,
				code : c
			});
		} else {
			UpImageShowBar.showError(a);
			UpImageShowBar.setImgErr(c);
		}
		$("iframe[name='frmUpload_" + c + "']").remove();
	},
	addImgLoad : function() {
		if ($(this).val() == "") {
			return;
		}
		UpImageShowBar.hideError();
		var b = UpImageShowBar.singleAdd();
		var a = SINGLEUP.getFileSize($("#fileUploadInput")[0]);
		if (a) {
			if (SINGLEUP.picSize > 0) {
				var c = SINGLEUP.picSize / 1024;
				if (c > SINGLEUP.maxSize) {
					UpImageShowBar.showError("不能上传大于"+SINGLEUP.maxSize+"K的图片");
					UpImageShowBar.setImgErr(b);
					UpImageShowBar.resetInfo();
					SINGLEUP.setFilePos();
					return;
				}
			}
			SINGLEUP.initForm({
				code : b
			});
		} else {
			setTimeout(function() {
				if (SINGLEUP.picSize > 0) {
					var d = SINGLEUP.picSize / 1024;
					if (d > SINGLEUP.maxSize) {
						UpImageShowBar.showError("不能上传大于"+SINGLEUP.maxSize+"K的图片");
						UpImageShowBar.setImgErr(b);
						UpImageShowBar.resetInfo();
						SINGLEUP.setFilePos();
						return;
					}
				}
				SINGLEUP.initForm({
					code : b
				});
			}, 700);
		}
		SINGLEUP.setFilePos();
		UpImageShowBar.resetInfo();
	},
	initForm : function(a) {
		$("#backFunction").after('<iframe width="1" height="1" name="frmUpload_' + a.code + '" ></iframe>');
		$("#SINGLEUP")[0].target = "frmUpload_" + a.code;
		$("#PicPos").val(a.code);
		$("#SINGLEUP").submit();
	},
	enableSingleBtn : function() {
		SINGLEUP.content.removeClass("w_localn").addClass("w_local");
		SINGLEUP.btnCon.show();
	},
	disableSingleBtn : function() {
		SINGLEUP.content.removeClass("w_local").addClass("w_localn");
		SINGLEUP.btnCon.hide();
	},
	delImg : function() {
		SINGLEUP.setFilePos();
	},
	setFilePos : function() {
		var a = SINGLEUP.content.offset();
		SINGLEUP.btnCon = $("#singleCon");
		SINGLEUP.btnCon.css({
			left : a.left + "px",
			top : a.top + "px"
		});
	},
	getFileSize : function(b) {
		var c = false;
		try {
			if (b.files) {
				SINGLEUP.picSize = b.files[0].size;
				c = true;
			} else {
				var a = new Image();
				a.onload = function() {
					SINGLEUP.picSize = a.fileSize;
					a.onload = a.onerror = null;
					delete a;
				};
				a.onerror = function() {
					SINGLEUP.picSize = -1;
					a.onload = a.onerror = null;
					delete a;
				};
				a.src = b.value;
			}
		} catch (d) {
			SINGLEUP.picSize = -1;
		}
		return c;
	},
	initBtn : function(a) {
		SINGLEUP.url = a.url;
		if ($("#SINGLEUP").length <= 0) {
			var b = [
					'<form id="SINGLEUP" name="SINGLEUP" method="post" target="frmUpload_' + a.code + '" action="' + SINGLEUP.url + '" enctype="multipart/form-data">',
					'<span style="display:none"><input type="text" id="name" name="name" value="php" />',
					'<input type="hidden" id="backFunction" name="backFunction" value="SINGLEUP.addImg" />',
					'<input type="hidden" name="PicPos" id="PicPos" value="' + a.code + '" /></span>',
					'<div id="singleCon" style="position:absolute;overflow:hidden;z-index:10"><input type="file" name="fileUploadInput" id="fileUploadInput" style="cursor:pointer" ></div></form>' ];
			$(document.body).append(b.join(""));
		}
		$("#fileUploadInput").change(SINGLEUP.addImgLoad);
		SINGLEUP.content = $("#flashContent").parent();
		SINGLEUP.content.html("图片上传");
		SINGLEUP.content.mouseover(SINGLEUP.setFilePos);
		$("#singleCon").mouseover(SINGLEUP.setFilePos);
		UpImageShowBar.regEnableBtn(SINGLEUP.enableSingleBtn);
		UpImageShowBar.regDisableBtn(SINGLEUP.disableSingleBtn);
		UpImageShowBar.regDelImg(SINGLEUP.delImg);
		SINGLEUP.btnCon = $("#singleCon");
		SINGLEUP.btnCon.css({
			width : "85px",
			height : "25px"
		});
		SINGLEUP.setFilePos();
		SINGLEUP.upbtn = $("#fileUploadInput");
		SINGLEUP.upbtn.mouseover(function(c) {
			SINGLEUP.content.css({
				color : "#000",
				"text-decoration" : "none"
			});
		}).mouseout(function(c) {
			SINGLEUP.content.css({
				color : "#666",
				"text-decoration" : "none"
			});
		});
	}
};
// FLASH上传
var UpImageShowBar = {
	"getImgNum" : function() {
		var b = 0;
		for ( var a = 0; a < this.imgs.length; a++) {
			if (this.imgs[a].url) {
				b++;
			}
		}
		return {
			hazNum : b,
			maxNum : this.imgMax
		};
	},
	"imgMax" : 8,
	"imgs" : [],
	"hazLabel" : false,
	"labels" : [],
	"flashName" : "PictureUpload",
	"hazDetail" : false,
	"maxFilsSize" : 1024 * 1024,
	"container" : null,
	"indexCode" : 0,
	"hideMultSel" : function() {
		$("#PictureUpload").next().hide();
	},
	"hasFlash" : function() {
		var a = false;
		var b = "flash";
		for ( var d = 0; d < navigator.plugins.length; d++) {
			if (navigator.plugins[d].name.toLowerCase().indexOf(b) > -1) {
				a = true;
				break;
			}
		}
		if (!a) {
			try {
				b = "ShockwaveFlash.ShockwaveFlash";
				new ActiveXObject(b);
				a = true;
			} catch (c) {
				a = false;
			}
		}
		return a;
	},
	"regEnableBtn" : function(a) {
		if (!this.enableBtnFuncs) {
			this.enableBtnFuncs = [];
		}
		this.enableBtnFuncs.push(a);
	},
	"enableBtns" : function() {
		if (!this.enableBtnFuncs) {
			return;
		}
		for ( var a = 0; a < this.enableBtnFuncs.length; a++) {
			this.enableBtnFuncs[a]();
		}
	},
	"regDisableBtn" : function(a) {
		if (!this.disableBtnFuncs) {
			this.disableBtnFuncs = [];
		}
		this.disableBtnFuncs.push(a);
	},
	"disableBtns" : function() {
		if (!this.disableBtnFuncs) {
			return;
		}
		for ( var a = 0; a < this.disableBtnFuncs.length; a++) {
			this.disableBtnFuncs[a]();
		}
	},
	"regDelImg" : function(a) {
		if (!this.delImgs) {
			this.delImgs = [];
		}
		this.delImgs.push(a);
	},
	"getIndexCode" : function() {
		return this.indexCode++;
	},
	callBack : function(){
	},
	addImg : function(c, d) {
		if (d && this.imgs.length >= this.imgMax) {
			this.disableBtns();
			var e = "您选择的图片数量超过允许总量，多余图片将不会上传！";
			this.showError(e);
			return false;
		}
		var a = [];
		if (d) {
			c.code = this.getIndexCode();
		}
		a.push('<div code="' + c.code + '" url="' + c.url + '" class="imgbox">');
		if (this.hazLabel) {
			a.push('<span class="img_selector"><span class="seltext">' + (c.label ? c.label : this.labels[0]) + "</span>");
			a.push('<ul style="width:79px" class="hc">');
			for ( var b = 1; b < this.labels.length; b++) {
				a.push('<li><a href="javascript:void(0)" >' + this.labels[b] + "</a></li>");
			}
			a.push('<i class="shadow"></i></ul></span>');
		} else {
			a.push('<span class="img_noselector"></span>');
		}
		a.push('<div class="w_upload"><a class="item_close" href="javascript:void(0)">删除</a><span class="item_box">');
		a.push('<img src="' + ____jsoncfg.attachsurl + c.url + '"></span><div class="isfenmian" style="display:none"></div><div class="setfenmian"></div>');
		if (this.hazDetail) {
			a.push('<span class="item_input"><i class="tline hc"></i><textarea cols="3" rows="3" class="c_ccc" >' + (c.detail ? c.detail : "图片简介...") + '</textarea><em class="hc f12">按Enter保存，Esc取消</em><i class="shadow hc"></i></span>');
		}
		a.push("</div></div>");
		if (d) {
			this.container.append(a.join(""));
			this.imgs.push(c);
			this.rbTAEvent(c.code);
		} else {
			for ( var b = 0; b < this.imgs.length; b++) {
				if (this.imgs[b].code == c.code) {
					this.imgs[b] = c;
					break;
				}
			}
			this.container.find("[code=" + c.code + "]").replaceWith(a.join(""));
			this.rbTAEvent(c.code);
		}
		this.initFenmian();
		if (this.container.find(".imgbox").length >= this.imgMax) {
			this.disableBtns();
		}
		this.resetInfo();
		UpImageShowBar.callBack();
	},
	addLaod : function(b) {
		if (this.imgs.length >= this.imgMax) {
			this.disableBtns();
			var c = "您选择的图片数量超过允许总量，多余图片将不会上传！";
			this.showError(c);
			return false;
		}
		var a = [];
		a.push('<div code="' + b.code + '" class="imgbox loading"><div class="w_upload"><a class="item_close" href="javascript:void(0)">关闭</a><span class="item_box"></span><span class="wait clearfix">图片上传中</span></div></div>');
		this.container.append(a.join(""));
		this.imgs.push(b);
		this.container.show();
		if (this.container.find(".imgbox").length >= this.imgMax) {
			this.disableBtns();
		}
	},
	"beginAdd" : function(b) {
		$("#hazupinfo").show();
		$("#uploadEx").hide();
		this.hideError();
		var e = "";
		if (b.num + this.imgs.length > this.imgMax) {
			e = "您选择的图片数量超过允许总量，多余图片将不会上传！";
			this.showError(e);
		} else {
			if (b.hazOver) {
				e = "您选择的部分图片超过允许大小总量，这些图片将不会上传！";
				this.showError(e);
			}
		}
		var a = [];
		for ( var c = 0; c < b.num && c < this.imgMax; c++) {
			var d = this.getIndexCode();
			a.push(d);
			this.addLaod({ "code" : d });
		}
		if (this.container.find(".imgbox").length >= this.imgMax) {
			this.disableBtns();
		}
		return a;
	},
	singleAdd : function() {
		var a = this.getIndexCode();
		this.addLaod({
			"code" : a
		});
		this.resetInfo();
		return a;
	},
	showError : function(a) {
		$("#upload_Tip").html('<em></em><font color="red">'+a+'</font>');
		$("#upload_Tip").show();
	},
	hideError : function(a) {
		$("#upload_Tip").hide();
		$("#upload_Tip").html('<em></em>按住"Ctrl"可多选');
	},
	delImg : function(c) {
		this.container.find(".imgbox[code='" + c + "']").replaceWith("");
		this.hideError();
		this.resetInfo();
		var b = "";
		for ( var d = 0; d < this.imgs.length; d++) {
			if (this.imgs[d].code == c) {
				b = this.imgs[d].url;
				this.imgs = this.imgs.slice(0, d).concat(this.imgs.slice(d + 1));
				break;
			}
		}
		if (this.imgs.length < this.imgMax) {
			this.enableBtns();
		}
		this.resetInfo();
		for ( var a = 0; a < this.delImgs.length; a++) {
			this.delImgs[a](c, b);
		}
		this.initFenmian();
	},
	setImgErr : function(a) {
		this.container.find(".imgbox[code='" + a + "']").find("span.item_box").css("backgroundImage", "url("+____jsoncfg.flashurl+"/img/fail.gif)");
		this.container.find(".imgbox[code='" + a + "']").find("span.wait").html("&nbsp;&nbsp;&nbsp;&nbsp;");
	},
	resetInfo : function() {
		var a = this.getImgNum();
		$(".upnum").html(a.hazNum);
		$(".maxnum").html(a.maxNum);
		if (a.hazNum > 0) {
			$("#hazupinfo").show();
			$("#uploadEx").hide();
			this.container.show();
		} else {
			if (this.container.find(".imgbox").length <= 0) {
				$("#hazupinfo").hide();
				$("#uploadEx").show();
				this.container.hide();
			}
		}
	},
	rbTAEvent : function(a) {
		this.container.find(".imgbox[code=" + a + "]").find("textarea").focus( function(b) {
			var c = $(b.target);
			if (c.val() == "图片简介...") {
				c.val("");
			}
			c.removeClass("c_ccc").addClass("c_666");
			c.parents(".item_input").addClass("on");
			c.parents(".imgbox").css({
				"z-index" : "99"
			});
		});
		this.container.find(".imgbox[code=" + a + "]").find("textarea").blur( function(b) {
			var d = $(b.target);
			if (d.val() == "") {
				d.val("图片简介...");
			}
			if (d.val().length > 200) {
				d.val($(this).val().substring(0, 200));
			}
			var c = d.parents(".imgbox").attr("code");
			UpImageShowBar.setDetail($(this).val(), c);
			d.removeClass("c_666").addClass("c_ccc");
			d.parents(".item_input").removeClass("on");
			d.parents(".imgbox").css({
				"z-index" : ""
			});
		});
		this.container.find(".imgbox[code=" + a + "]").find("textarea").keyup( function(b) {
			var d = $(b.target);
			var c = d.parents(".imgbox").attr("code");
			if (b.which == 13) {
				$(this).val($(this).val().replace("\n", ""));
				$(this).blur();
				return false;
			} else {
				if (b.which == 27) {
					$(this).val(UpImageShowBar.getDetail(c));
					$(this).blur();
					return false;
				} else {
					if ($(this).val().length > 200) {
						$(this).val($(this).val().substring(0, 200));
					}
				}
			}
		});
	},
	setDetail : function(c, b) {
		var d = UpImageShowBar.imgs;
		for ( var a = 0; a < d.length; a++) {
			if (d[a].code == b) {
				UpImageShowBar.imgs[a].detail = c;
				return d[a];
			}
		}
	},
	getDetail : function(b) {
		var c = UpImageShowBar.imgs;
		for ( var a = 0; a < c.length; a++) {
			if (c[a].code == b) {
				return c[a].detail;
			}
		}
	},
	getImgs : function() {
		var a = [];
		for ( var b = 0; b < this.imgs.length; b++) {
			if (this.imgs[b].url && this.imgs[b].url.indexOf(".") >= 0) {
				a.push(this.imgs[b]);
			}
		}
		return a;
	},
	initFenmian : function() {
		// 显示封面
		this.container.find(".isfenmian:eq(0)").show(); 
		this.container.find(".isfenmian:gt(0)").hide();
	},
	initBar : function(c) {
		this.container = $("#" + c.container);
		if (c.labels && c.labels.length > 0) {
			this.labels = c.labels;
			this.hazLabel = true;
		}
		if (c.flashName) {
			this.flashName = c.flashName;
		}
		if (c.hazDetail == true) {
			this.hazDetail = true;
		}
		if (c.maxFilsSize) {
			this.maxFilsSize = c.maxFilsSize;
		}
		if (c.imgMax) {
			this.imgMax = c.imgMax;
		}
		var l = $("#flashContent").parent().next();
		var n = swfobject.getFlashPlayerVersion();
		if (this.hasFlash() && ((n.major == 10 && n.minor >= 3) || n.major >= 11)) {
			var a = "10.2.0";
			var h = ____jsoncfg.flashurl + "/playerProductInstall.swf";
			var b = {};
			var e = {};
			e.quality = "high";
			e.bgcolor = "#ffffff";
			e.allowscriptaccess = "always";
			e.allowfullscreen = "false";
			e.wmode = "opaque";
			var f = {};
			f.id = this.flashName;
			f.name = this.flashName;
			f.align = "left";
			swfobject.embedSWF(____jsoncfg.flashurl + "/upload.swf","flashContent", "86", "30", a, h, b, e, f);
			swfobject.createCSS("#flashContent","display:block;text-align:left;");
			SWFUP.initFlashBtn({
				name : this.flashName
			});
			$("#size_limit").html(____jsoncfg.maxSize);
			$("#photo_type").html("jpg/gif/png");
			if (navigator.platform.indexOf("Mac") > -1) {
				var d = $($(".w_local span").get(1));
				d.html(d.html().replace("Ctrl", "command"));
				if (d.html().indexOf("command") > -1) {
					d.width(d.width() + 30);
				}
			}
		} else {
			this.resetInfo();
			$("#size_limit").html(____jsoncfg.maxSize);
			$("#photo_type").html("jpg/gif/bmp/png");
			SINGLEUP.initBtn({
				url : ____jsoncfg.posturl
			});
		}
		this.container.html("");
		if (c.images && c.images.length > 0) {
			for ( var g = 0; g < c.images.length; g++) {
				this.addImg(c.images[g], true);
			}
			this.resetInfo();
		} else {
			this.resetInfo();
		}
		this.container.bind("click", this, function(y) {
			var i = $(y.target);
			if (i.hasClass("item_close")) {
				y.data.delImg(i.parents(".imgbox").attr("code"));
				return false;
			} else {
				if (i.parents("ul.hc").length > 0) {
					var s = i.parents(".imgbox");
					s.find(".seltext").html(i.html());
					var v = s.prevAll().length;
					y.data.imgs[v].label = i.html();
					var x = s.find(".hover");
					x.removeClass("hover");
					return false;
				} else {
					if (i.hasClass("setfenmian")) {
						var r = i.parents(".imgbox");
						var t = UpImageShowBar.container.find(".imgbox");
						var w = t.index(r);
						if (w == 0) {
							return;
						}
						t.eq(w).before(t.eq(0)).find(".setfenmian").hide();
						UpImageShowBar.container.prepend(r);
						UpImageShowBar.initFenmian();
						var u = UpImageShowBar.imgs[w];
						UpImageShowBar.imgs[w] = UpImageShowBar.imgs[0];
						UpImageShowBar.imgs[0] = u;
					}
				}
			}
		});
		this.container.bind( "mouseover", this, function(i) {
			var r = $(i.target);
			if (r.hasClass("img_selector")) {
				r.addClass("hover");
			} else {
				if (r.parents(".img_selector").length > 0) {
					r.parents(".img_selector").addClass("hover");
				} else {
					// 设置封面
					if (r.parents(".w_upload").length > 0 && r.parents(".w_upload").find(".isfenmian:visible").length == 0) {
						r.parents(".w_upload").find(".setfenmian").css("opacity", 0.7).show();
					}
				}
			}
		}).bind("mouseout", this, function(i) {
			var r = $(i.target);
			if (r.hasClass("img_selector")) {
				r.removeClass("hover");
			} else {
				if (r.parents(".img_selector").length > 0) {
					r.parents(".img_selector").removeClass("hover");
				} else {
					if (r.parents(".w_upload").length > 0) {
						r.parents(".w_upload").find(".setfenmian").hide();
					}
				}
			}
		});
	}
};

/*!	SWFObject v2.2 <http://code.google.com/p/swfobject/>
 is released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */
var swfobject=function(){var G="undefined",u="object",V="Shockwave Flash",Z="ShockwaveFlash.ShockwaveFlash",t="application/x-shockwave-flash",U="SWFObjectExprInst",A="onreadystatechange",R=window,j=document,w=navigator,W=false,X=[h],r=[],Q=[],L=[],l,T,H,E,M=false,a=false,n,J,m=true,P=function(){var ad=typeof j.getElementById!=G&&typeof j.getElementsByTagName!=G&&typeof j.createElement!=G,ak=w.userAgent.toLowerCase(),ab=w.platform.toLowerCase(),ah=ab?/win/.test(ab):/win/.test(ak),af=ab?/mac/.test(ab):/mac/.test(ak),ai=/webkit/.test(ak)?parseFloat(ak.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,aa=!+"\v1",aj=[0,0,0],ae=null;if(typeof w.plugins!=G&&typeof w.plugins[V]==u){ae=w.plugins[V].description;if(ae&&!(typeof w.mimeTypes!=G&&w.mimeTypes[t]&&!w.mimeTypes[t].enabledPlugin)){W=true;aa=false;ae=ae.replace(/^.*\s+(\S+\s+\S+$)/,"$1");aj[0]=parseInt(ae.replace(/^(.*)\..*$/,"$1"),10);aj[1]=parseInt(ae.replace(/^.*\.(.*)\s.*$/,"$1"),10);aj[2]=/[a-zA-Z]/.test(ae)?parseInt(ae.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0;}}else{if(typeof R.ActiveXObject!=G){try{var ag=new ActiveXObject(Z);if(ag){ae=ag.GetVariable("$version");if(ae){aa=true;ae=ae.split(" ")[1].split(",");aj=[parseInt(ae[0],10),parseInt(ae[1],10),parseInt(ae[2],10)];}}}catch(ac){}}}return{w3:ad,pv:aj,wk:ai,ie:aa,win:ah,mac:af};}(),k=function(){if(!P.w3){return;}if((typeof j.readyState!=G&&j.readyState=="complete")||(typeof j.readyState==G&&(j.getElementsByTagName("body")[0]||j.body))){f();}if(!M){if(typeof j.addEventListener!=G){j.addEventListener("DOMContentLoaded",f,false);}if(P.ie&&P.win){j.attachEvent(A,function(){if(j.readyState=="complete"){j.detachEvent(A,arguments.callee);f();}});if(R==top){(function(){if(M){return;}try{j.documentElement.doScroll("left");}catch(aa){setTimeout(arguments.callee,0);return;}f();})();}}if(P.wk){(function(){if(M){return;}if(!/loaded|complete/.test(j.readyState)){setTimeout(arguments.callee,0);return;}f();})();}v(f);}}();function f(){if(M){return;}try{var ac=j.getElementsByTagName("body")[0].appendChild(F("span"));ac.parentNode.removeChild(ac);}catch(ad){return;}M=true;var aa=X.length;for(var ab=0;ab<aa;ab++){X[ab]();}}function N(aa){if(M){aa();}else{X[X.length]=aa;}}function v(ab){if(typeof R.addEventListener!=G){R.addEventListener("load",ab,false);}else{if(typeof j.addEventListener!=G){j.addEventListener("load",ab,false);}else{if(typeof R.attachEvent!=G){i(R,"onload",ab);}else{if(typeof R.onload=="function"){var aa=R.onload;R.onload=function(){aa();ab();};}else{R.onload=ab;}}}}}function h(){if(W){Y();}else{K();}}function Y(){var aa=j.getElementsByTagName("body")[0];var ad=F(u);ad.setAttribute("type",t);var ac=aa.appendChild(ad);if(ac){var ab=0;(function(){if(typeof ac.GetVariable!=G){var ae=ac.GetVariable("$version");if(ae){ae=ae.split(" ")[1].split(",");P.pv=[parseInt(ae[0],10),parseInt(ae[1],10),parseInt(ae[2],10)];}}else{if(ab<10){ab++;setTimeout(arguments.callee,10);return;}}aa.removeChild(ad);ac=null;K();})();}else{K();}}function K(){var aj=r.length;if(aj>0){for(var ai=0;ai<aj;ai++){var ab=r[ai].id;var ae=r[ai].callbackFn;var ad={success:false,id:ab};if(P.pv[0]>0){var ah=c(ab);if(ah){if(I(r[ai].swfVersion)&&!(P.wk&&P.wk<312)){z(ab,true);if(ae){ad.success=true;ad.ref=C(ab);ae(ad);}}else{if(r[ai].expressInstall&&D()){var al={};al.data=r[ai].expressInstall;al.width=ah.getAttribute("width")||"0";al.height=ah.getAttribute("height")||"0";if(ah.getAttribute("class")){al.styleclass=ah.getAttribute("class");}if(ah.getAttribute("align")){al.align=ah.getAttribute("align");}var ak={};var aa=ah.getElementsByTagName("param");var af=aa.length;for(var ag=0;ag<af;ag++){if(aa[ag].getAttribute("name").toLowerCase()!="movie"){ak[aa[ag].getAttribute("name")]=aa[ag].getAttribute("value");}}S(al,ak,ab,ae);}else{s(ah);if(ae){ae(ad);}}}}}else{z(ab,true);if(ae){var ac=C(ab);if(ac&&typeof ac.SetVariable!=G){ad.success=true;ad.ref=ac;}ae(ad);}}}}}function C(ad){var aa=null;var ab=c(ad);if(ab&&ab.nodeName=="OBJECT"){if(typeof ab.SetVariable!=G){aa=ab;}else{var ac=ab.getElementsByTagName(u)[0];if(ac){aa=ac;}}}return aa;}function D(){return !a&&I("6.0.65")&&(P.win||P.mac)&&!(P.wk&&P.wk<312);}function S(ad,ae,aa,ac){a=true;H=ac||null;E={success:false,id:aa};var ah=c(aa);if(ah){if(ah.nodeName=="OBJECT"){l=g(ah);T=null;}else{l=ah;T=aa;}ad.id=U;if(typeof ad.width==G||(!/%$/.test(ad.width)&&parseInt(ad.width,10)<310)){ad.width="310";}if(typeof ad.height==G||(!/%$/.test(ad.height)&&parseInt(ad.height,10)<137)){ad.height="137";}j.title=j.title.slice(0,47)+" - Flash Player Installation";var ag=P.ie&&P.win?"ActiveX":"PlugIn",af="MMredirectURL="+encodeURI(window.location).toString().replace(/&/g,"%26")+"&MMplayerType="+ag+"&MMdoctitle="+j.title;if(typeof ae.flashvars!=G){ae.flashvars+="&"+af;}else{ae.flashvars=af;}if(P.ie&&P.win&&ah.readyState!=4){var ab=F("div");aa+="SWFObjectNew";ab.setAttribute("id",aa);ah.parentNode.insertBefore(ab,ah);ah.style.display="none";(function(){if(ah.readyState==4){ah.parentNode.removeChild(ah);}else{setTimeout(arguments.callee,10);}})();}x(ad,ae,aa);}}function s(ab){if(P.ie&&P.win&&ab.readyState!=4){var aa=F("div");ab.parentNode.insertBefore(aa,ab);aa.parentNode.replaceChild(g(ab),aa);ab.style.display="none";(function(){if(ab.readyState==4){ab.parentNode.removeChild(ab);}else{setTimeout(arguments.callee,10);}})();}else{ab.parentNode.replaceChild(g(ab),ab);}}function g(af){var ae=F("div");if(P.win&&P.ie){ae.innerHTML=af.innerHTML;}else{var ab=af.getElementsByTagName(u)[0];if(ab){var ag=ab.childNodes;if(ag){var aa=ag.length;for(var ad=0;ad<aa;ad++){if(!(ag[ad].nodeType==1&&ag[ad].nodeName=="PARAM")&&!(ag[ad].nodeType==8)){ae.appendChild(ag[ad].cloneNode(true));}}}}}return ae;}function x(al,aj,ab){var aa,ad=c(ab);if(P.wk&&P.wk<312){return aa;}if(ad){if(typeof al.id==G){al.id=ab;}if(P.ie&&P.win){var ak="";for(var ah in al){if(al[ah]!=Object.prototype[ah]){if(ah.toLowerCase()=="data"){aj.movie=al[ah];}else{if(ah.toLowerCase()=="styleclass"){ak+=' class="'+al[ah]+'"';}else{if(ah.toLowerCase()!="classid"){ak+=" "+ah+'="'+al[ah]+'"';}}}}}var ai="";for(var ag in aj){if(aj[ag]!=Object.prototype[ag]){ai+='<param name="'+ag+'" value="'+aj[ag]+'" />';}}ad.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+ak+">"+ai+"</object>";Q[Q.length]=al.id;aa=c(al.id);}else{var ac=F(u);ac.setAttribute("type",t);for(var af in al){if(al[af]!=Object.prototype[af]){if(af.toLowerCase()=="styleclass"){ac.setAttribute("class",al[af]);}else{if(af.toLowerCase()!="classid"){ac.setAttribute(af,al[af]);}}}}for(var ae in aj){if(aj[ae]!=Object.prototype[ae]&&ae.toLowerCase()!="movie"){e(ac,ae,aj[ae]);}}ad.parentNode.replaceChild(ac,ad);aa=ac;}}return aa;}function e(ac,aa,ab){var ad=F("param");ad.setAttribute("name",aa);ad.setAttribute("value",ab);ac.appendChild(ad);}function B(ab){var aa=c(ab);if(aa&&aa.nodeName=="OBJECT"){if(P.ie&&P.win){aa.style.display="none";(function(){if(aa.readyState==4){b(ab);}else{setTimeout(arguments.callee,10);}})();}else{aa.parentNode.removeChild(aa);}}}function b(ac){var ab=c(ac);if(ab){for(var aa in ab){if(typeof ab[aa]=="function"){ab[aa]=null;}}ab.parentNode.removeChild(ab);}}function c(ac){var aa=null;try{aa=j.getElementById(ac);}catch(ab){}return aa;}function F(aa){return j.createElement(aa);}function i(ac,aa,ab){ac.attachEvent(aa,ab);L[L.length]=[ac,aa,ab];}function I(ac){var ab=P.pv,aa=ac.split(".");aa[0]=parseInt(aa[0],10);aa[1]=parseInt(aa[1],10)||0;aa[2]=parseInt(aa[2],10)||0;return(ab[0]>aa[0]||(ab[0]==aa[0]&&ab[1]>aa[1])||(ab[0]==aa[0]&&ab[1]==aa[1]&&ab[2]>=aa[2]))?true:false;}function y(af,ab,ag,ae){if(P.ie&&P.mac){return;}var ad=j.getElementsByTagName("head")[0];if(!ad){return;}var aa=(ag&&typeof ag=="string")?ag:"screen";if(ae){n=null;J=null;}if(!n||J!=aa){var ac=F("style");ac.setAttribute("type","text/css");ac.setAttribute("media",aa);n=ad.appendChild(ac);if(P.ie&&P.win&&typeof j.styleSheets!=G&&j.styleSheets.length>0){n=j.styleSheets[j.styleSheets.length-1];}J=aa;}if(P.ie&&P.win){if(n&&typeof n.addRule==u){n.addRule(af,ab);}}else{if(n&&typeof j.createTextNode!=G){n.appendChild(j.createTextNode(af+" {"+ab+"}"));}}}function z(ac,aa){if(!m){return;}var ab=aa?"visible":"hidden";if(M&&c(ac)){c(ac).style.visibility=ab;}else{y("#"+ac,"visibility:"+ab);}}function O(ab){var ac=/[\\\"<>\.;]/;var aa=ac.exec(ab)!=null;return aa&&typeof encodeURIComponent!=G?encodeURIComponent(ab):ab;}var d=function(){if(P.ie&&P.win){window.attachEvent("onunload",function(){var af=L.length;for(var ae=0;ae<af;ae++){L[ae][0].detachEvent(L[ae][1],L[ae][2]);}var ac=Q.length;for(var ad=0;ad<ac;ad++){B(Q[ad]);}for(var ab in P){P[ab]=null;}P=null;for(var aa in swfobject){swfobject[aa]=null;}swfobject=null;});}}();return{registerObject:function(ae,aa,ad,ac){if(P.w3&&ae&&aa){var ab={};ab.id=ae;ab.swfVersion=aa;ab.expressInstall=ad;ab.callbackFn=ac;r[r.length]=ab;z(ae,false);}else{if(ac){ac({success:false,id:ae});}}},getObjectById:function(aa){if(P.w3){return C(aa);}},embedSWF:function(ae,ak,ah,aj,ab,ad,ac,ag,ai,af){var aa={success:false,id:ak};if(P.w3&&!(P.wk&&P.wk<312)&&ae&&ak&&ah&&aj&&ab){z(ak,false);N(function(){ah+="";aj+="";var am={};if(ai&&typeof ai===u){for(var ao in ai){am[ao]=ai[ao];}}am.data=ae;am.width=ah;am.height=aj;var ap={};if(ag&&typeof ag===u){for(var an in ag){ap[an]=ag[an];}}if(ac&&typeof ac===u){for(var al in ac){if(typeof ap.flashvars!=G){ap.flashvars+="&"+al+"="+ac[al];}else{ap.flashvars=al+"="+ac[al];}}}if(I(ab)){var aq=x(am,ap,ak);if(am.id==ak){z(ak,true);}aa.success=true;aa.ref=aq;}else{if(ad&&D()){am.data=ad;S(am,ap,ak,af);return;}else{z(ak,true);}}if(af){af(aa);}});}else{if(af){af(aa);}}},switchOffAutoHideShow:function(){m=false;},ua:P,getFlashPlayerVersion:function(){return{major:P.pv[0],minor:P.pv[1],release:P.pv[2]};},hasFlashPlayerVersion:I,createSWF:function(ac,ab,aa){if(P.w3){return x(ac,ab,aa);}else{return undefined;}},showExpressInstall:function(ac,ad,aa,ab){if(P.w3&&D()){S(ac,ad,aa,ab);}},removeSWF:function(aa){if(P.w3){B(aa);}},createCSS:function(ad,ac,ab,aa){if(P.w3){y(ad,ac,ab,aa);}},addDomLoadEvent:N,addLoadEvent:v,getQueryParamValue:function(ad){var ac=j.location.search||j.location.hash;if(ac){if(/\?/.test(ac)){ac=ac.split("?")[1];}if(ad==null){return O(ac);}var ab=ac.split("&");for(var aa=0;aa<ab.length;aa++){if(ab[aa].substring(0,ab[aa].indexOf("="))==ad){return O(ab[aa].substring((ab[aa].indexOf("=")+1)));}}}return"";},expressInstallCallback:function(){if(a){var aa=c(U);if(aa&&l){aa.parentNode.replaceChild(l,aa);if(T){z(T,true);if(P.ie&&P.win){l.style.display="block";}}if(H){H(E);}}a=false;}}};}();(function(){var b=document.getElementById("checkboxEx");if(!b){return;}var a=document.getElementById("way");b.onclick=function(){if(b.checked==true){a.style.display="block";}else{a.style.display="none";}};})();
