/***
 * Dialog��������
 * ��дʱ�䣺2013��4��8��
 * version:Dialog.1.0.js
 * author:С��<i@windyland.com>
***/
(function($) {
	$.extend({
		DialogBox: {
			defaults: {
				title: "ллʹ��Dialog-jQuery���",
				name: "D" + new Date().getTime(),
				type: "text",
				content: "������ı���[������������]<br/>",
				width: 700,
				height: 500,
				time: 0
			},
			ex: {
				t: null,
				_move: false,
				_x: 0,
				_y: 0,
				newz: 1,
				oldz: 1
			},
			timer: {
				stc: null,
				clear: function() {
					if (this.st) clearTimeout(this.st);
					if (this.stc) clearTimeout(this.stc);
				}
			},
			config: function(def) {
				this.defaults = $.extend(this.defaults, def);
			},
			created: false,
			create: function(op) {
				this.created = true;
				var ops = $.extend({},
				this.defaults, op);
				this.element = $("<div class='floatBoxBg' id='fb" + ops.name + "'></div><div class='floatBox' id='" + ops.name + "'><div class='title' id='t" + ops.name + "'><h4></h4><span class='closeDialog' id='c" + ops.name + "' title=\"�ر�\">X</span></div><div class='content'></div></div>");
				$("body").prepend(this.element);
				this.blank = $("#fb" + ops.name);
				this.title = $("#" + ops.name + " .title h4");
				this.content = $("#" + ops.name + " .content");
				this.dialog = $("#" + ops.name + "");
				this.closeE = $("#c" + ops.name);
				this.ttt = $("#t" + ops.name);
				if ($.browser.msie && ($.browser.version == "6.0") && !$.support.style) {
					this.blank.css({
						height: $(document).height(),
						width: $(document).width()
					});
				}
				this.closeE.click(function(e) {
					var DB = $.DialogBox;
					DB.blank.animate({
						opacity: "0.0"
					},
					"normal",
					function() {
						DB.blank.hide();
						DB.dialog.hide();
					});
					DB.timer.clear();
				});
				this.closeE.mousedown(function(e) {
					e.stopPropagation();
				});
				this.ttt.mousedown(function(e) {
					var DB = $.DialogBox;
					DB.ex._move = true;
					DB.ex.newz = parseInt(DB.dialog.css("z-index"));
					DB.dialog.css({
						"z-index": DB.ex.newz + DB.ex.oldz
					});
					DB.ex._x = e.pageX - parseInt(DB.dialog.css("left"));
					DB.ex._y = e.pageY - parseInt(DB.dialog.css("top"));
					DB.dialog.fadeTo(50, 0.5);
				});
				this.ttt.mouseup(function(e) {
					var DB = $.DialogBox;
					DB.ex._move = false;
					DB.dialog.fadeTo("fast", 1);
					DB.ex.oldz = parseInt(DB.dialog.css("z-index"));
				});
				$(document).on("mousemove",
				function(e) {
					var DB = $.DialogBox;
					if (DB.ex._move) {
						var x = e.pageX - DB.ex._x;
						var y = e.pageY - DB.ex._y;
						DB.dialog.css({
							top: y,
							left: x
						});
					}
				});
			},
			show: function(op) {
				if(!this.created){
					this.create();
					}
				var the = this;
				var ops = $.extend({},
				this.defaults, op);
				this.title.html(ops.title);
				switch (ops.type) {
				case "url":
					the.content.html("loading...");
					$.get(ops.content,
					function(html) {
						the.content.html(html);
					});
					break;
				case "text":
					the.content.html(ops.content);
					break;
				case "selector":
					the.content.html($(ops.content).html());
					break;
				case "iframe":
					the.content.html("<iframe src=\"" + ops.content + "\" width=\"100%\" height=\"" + (parseInt(ops.height) - 50) + "px" + "\" scrolling=\"auto\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>");
					break;
				default:
					the.content.html(ops.content);
					break;
				}
				the.blank.show();
				the.blank.animate({
					opacity:
					"0.5"
				},
				"normal");
				the.dialog.css({
					display: "block",
					left: (($(document).width()) / 2 - (parseInt(ops.width) / 2) - 5) + "px",
					top: ((document.documentElement.clientHeight) / 2 - (parseInt(ops.height) / 2)) + "px",
					width: ops.width,
					height: ops.height
				});
				if ($.isNumeric(ops.time) && ops.time > 0) {
					the.timer.clear();
					the.timer.stc = setTimeout(function() {
						//var DB = $.DialogBox;
						the.close();
					},
					ops.time);
				}
				return {
					dialog: the.dialog,
					blank: the.blank,
					content: the.content
				}
			},
			close: function() {
				this.closeE.trigger("click");
			}
		},
		Dialog: function(con, ops) {
			if ($.isPlainObject(con)) {
				if(con.close){
					$.DialogBox.close();
					return true;
				}
				$.DialogBox.config(con);
				return true;
			}
			ops = ops ||{};
			$.extend(ops,{content:con||$.DialogBox.defaults.content});
			return $.DialogBox.show(ops);
		}
	})
})(jQuery);