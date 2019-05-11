$('.bigpagenation a:first').addClass('active');
var switchers = new Array();
function horizontalSwitcher(switcher_name,switcher_direction) {
	var s = new Switcher();
	var key_switcher_name = switcher_name;
	if (!switcher_name) {
		key_switcher_name = 'default';
	}
	switchers[key_switcher_name] = s;
	if (switcher_direction == null || switcher_direction == undefined) {
		switcher_direction = 1;
	}
	s.init(switcher_name,switcher_direction);
}

Switcher = function(){
	this.setting = {
		switcher_name : null,		// 图片切换模块的名称
		switcher_direction : 0,		// @param -> decoration 元素切换的方向，默认为 0 是左右切换，其他值为上下切换
		direction : 'left',			// 通过 switcher_direction 计算得出的切换方向，默认是 left 左右切换
		animway : 0,				// @param -> animway 获得图片的切换方式，默认 0 为移动切换，其他值为渐显/渐隐切换
		showCount : 0,				// @param -> show 每大页展示多少个元素
		fadein : 0,					// @param -> fadein 左右切换的时候是否出现渐显/渐隐效果
		pagebt : 0,					// @param -> pagebt 是否显示分页切换的按钮，比如首页 Banner 的按钮，非左右按钮
		hidebt : 1,					// @param -> hidebt 在切换到边界时是否自动隐藏左右切换按钮
		itemCount : 0,				// 图片切换组件中共有多少个可以切换的元素
		prePointer : 0,				// 上一个切换到的位置，比如切换到第二张，元素位置是 2，那么该属性就会被自动赋值为 1 或者上次切换到的位置
		currentPointer : 1,			// 当前切换到的位置，注意：不是从 0 开始，而是从 1 开始
		animate_show_time : 500,	// @param -> showtime 如果有大图预览区域，该参数控制预览区域渐显渐隐的时间
		animate_move_time : 500,	// @param -> movetime 控制切换列表左右切换、渐显渐隐的动画时间
		thisSwitcher : null,		// 整个图片切换模块的对象
		items : null,				// 整个图片切换模块下的可切换元素集合
		itemWidth : 0,				// 每个元素的宽度/高度
		barWidth : 0,				// 内部切换区域容器的宽度/高度
		moveableBar : null,			// 内部切换区域容器的对象
		leftButton : null,			// 向左切换的按钮对象
		rightButton : null,			// 向右切换的按钮对象
		pageButton : null,			// 分页切换按钮的对象集合
		preItem : null,				// 在左右切换的过程中，如果临界元素需要渐显渐隐，该变量就保存前一个与之临界的元素对象
		endItem : null,				// 在左右切换的过程中，如果临界元素需要渐显渐隐，该变量就保存后一个与之临界的元素对象
		lastLose : 0,				// 在分页中，如果一页显示多个元素，那么该属性就保存 总元素个数/每页显示个数 的到的余数，用于边界处理
		gotoPage : 0,				// 自动切换、点击分页按钮切换时，该属性用于保存切换到的页数
		pointer : 0,				// 自动切换、点击分页按钮切换时，该属性用于保存切换到某页所经过的整数个 showCount 的值
		moveLeft : 0,				// 在左右/上下切换时，该属性保存元素容器当前切换到距离左侧/顶部的偏移值，一直小于等于零
		isScrollRun : false,		// 滚动动画是否正在执行，如果为 true 则被触发的下一个滚动事件将不会被执行，需要等到执行完才能再次执行
		isShowRun : false,			// 展示动画是否正在执行，如果为 true 则被触发的下一个展示动画将不会被执行，需要等到执行完才能再次执行
		isAutoRun : 0,				// @param -> auto 动画是否自动播放
		autoRunTime : 3000,			// @param -> autotime 自动播放时，动画间隔时间
		autoTimeout : null,			// 自动播放的定时器
		autoActive : false,			// 是否启动切换时自动设置当前元素激活状态，自动触发上一个/下一个的点击事件，到达边界时再进行滚动
		lastTime : 3000,			// 在自动播放的时候进行倒计时的时间
		use100 : 0					// 是否强制100%宽度全屏展示动画
	};
	
	/**
	 * switcher.init() 该方法用于初始化 switcher 模块
	 * 
	 * @param switcher_name 是该模块的独特名称，一个页面若多次使用 Switcher 组件，则需要给每个组件命名
	 * 
	 */
	this.init = function(switcher_name) {
		var s = this.setting;
		s.switcher_name = switcher_name;
		if (!s.switcher_name) {
			s.switcher_name = 'horizontal';
			if ($("."+s.switcher_name+"-switcher")[0] == undefined) {
				return;
			}
		} else if (s.switcher_name && $("."+s.switcher_name+"-switcher")[0] == undefined) {
			return;
		}
		s.thisSwitcher = $("."+s.switcher_name+"-switcher");
		if (s.thisSwitcher[0] != undefined) {
			/**
			 * 初始化参数
			 */
			s.fadein = parseInt(s.thisSwitcher.attr("fadein")) > 0 ? 1 : 0;
			s.pagebt = parseInt(s.thisSwitcher.attr("pagebt")) > 0 ? 1 : 0;
			s.hidebt = parseInt(s.thisSwitcher.attr('hidebt')) > 0 ? 1 : 0;
			s.showCount = parseInt(s.thisSwitcher.attr("show")) > 0 ? parseInt(s.thisSwitcher.attr("show")) : 1;
			s.isAutoRun = parseInt(s.thisSwitcher.attr('auto')) > 0 ? 1 : 0;
			s.animate_move_time = parseInt(s.thisSwitcher.attr('movetime')) > 0 ? parseInt(s.thisSwitcher.attr('movetime')) : s.animate_move_time;
			s.animate_show_time = parseInt(s.thisSwitcher.attr('showtime')) > 0 ? parseInt(s.thisSwitcher.attr('showtime')) : s.animate_show_time;
			s.autoRunTime = parseInt(s.thisSwitcher.attr('autotime')) > 0 ? parseInt(s.thisSwitcher.attr('autotime')) : s.autoRunTime;
			s.lastTime = s.autoRunTime+1000;
			s.switcher_direction = parseInt(s.thisSwitcher.attr('decoration')) > 0 ? 1 : 0;
			s.animway = parseInt(s.thisSwitcher.attr('animway')) > 0 ? 1 : 0;
			s.direction = s.switcher_direction == 0 ? 'left' : 'top';
			s.autoActive = parseInt(s.thisSwitcher.attr('autoactive')) > 0 ? true : false;
			s.use100 = parseInt(s.thisSwitcher.attr('use100'));
			
			s.leftButton = s.thisSwitcher.find(".left-button");
			s.rightButton = s.thisSwitcher.find(".right-button");
			
			s.items = s.thisSwitcher.find(".item");
			eval('s.itemWidth = s.items.outer'+(s.direction == 'left' ? 'Width' : 'Height')+'();');
			
			/**
			 * 动画是左右切换还是渐显渐隐，如果为渐显渐隐，则需要给元素绑定位置
			 */
			if (s.animway) {
				for (var i = 0; i < s.items.length; i++) {
					$(s.items[i]).css({
						position:'absolute',
						left:(s.switcher_direction == 0 ? i%s.showCount*s.itemWidth : 0),
						top:(s.switcher_direction == 0 ? 0 : i%s.showCount*s.itemWidth)
					});
				}
				
				s.items.css({position:'absolute',left:0});
				s.barWidth = s.itemWidth;
			} else {
				s.barWidth = s.items.length * s.itemWidth;
			}
			
			if (s.use100 == 1) {
				s.barWidth = '100%';
			}
			
			s.moveableBar = s.thisSwitcher.find(".moveable");
			eval('s.moveableBar.css({'+s.direction+':0});\
					s.moveableBar.'+(s.direction == 'left' ? 'width' : 'height')+'(s.barWidth);');
				
			s.itemCount = s.items.length;
			s.lastLose = s.itemCount % s.showCount != 0 ? s.itemCount % s.showCount : 0;
			if (s.hidebt == 1) {
				if (s.leftButton[0] != undefined) s.leftButton.css({opacity:0});
				if (s.itemCount <= s.showCount && s.rightButton[0] != undefined) {
					s.rightButton.css({opacity:0});
				}
			}
			this.startSwitcher();
		}
	};
	
	/**
	 * switcher.startSwitcher() 运行 Switcher
	 */
	this.startSwitcher = function() {
		var temp_obj = this;
		var s = this.setting;
		if (s.items.length > 0 && s.animway) {
			s.items.css({opacity:0,'z-index':1});
			$(s.items[0]).css({opacity:1,'z-index':2});
		}
		if (s.items.length > 0 && $("."+s.switcher_name+"-scroll-area")[0] != undefined) {	   
			s.items.removeClass('active');
			$(s.items[0]).addClass('active');
			s.items.click(function(){
				temp_obj.clickItem(this);
			});
		}
		
		if (s.rightButton[0] != undefined) {
			s.rightButton.click(function(){
				temp_obj.clickRightButton(this);
			});
		}
		if (s.leftButton[0] != undefined) {
			s.leftButton.click(function(){
				temp_obj.clickLeftButton(this);
			});
		}
		
		if (s.pagebt == 1 && s.thisSwitcher.find(".bigpagenation")[0] != undefined) {
			s.pageButton = s.thisSwitcher.find(".pagenation-b");
			s.pageButton.click(function(){
				temp_obj.clickPageButton(this);
			});
		}
		
		if (s.isAutoRun && s.itemCount > 1 && s.pageButton != null) {
			s.gotoPage = 1;
			this.startAutoRun(this);
		}
	};
	
	/**
	 * switcher.startAutoRun() 启动自动切换
	 */
	this.startAutoRun = function(obj) {
		obj.setting.lastTime -= 1000;
		if (obj.setting.lastTime <= 0) {
			if (!obj.setting.isScrollRun && !obj.setting.isShowRun) obj.autoRun();
			obj.setting.lastTime = obj.setting.autoRunTime;
		}
		this.setting.autoTimeout = setTimeout(function(){
			obj.startAutoRun(obj);
		},1000);
	}
	
	/**
	 * switcher.autoRun() 执行分页切换
	 */
	this.autoRun = function() {
		var s = this.setting;
		s.gotoPage++;
		if (s.gotoPage > Math.ceil(s.itemCount/s.showCount)) {
			s.gotoPage = 1;
		}
		
		this.clickPageButton(s.gotoPage);
	};
	
	/**
	 * switcher.clickItem() 监听切换元素的点击事件
	 * 
	 * @param ele 点击切换的元素时，位元素改变当前状态，并在大预览区展示预览
	 * 
	 */
	this.clickItem = function(ele) {
		var s = this.setting;
		if (s.isShowRun == true) return;
		s.isShowRun = true;
		
		var temp_obj = this;
		s.prePointer = s.currentPointer;
		s.currentPointer = parseInt($(ele).attr('id'));
		
		if ($(ele).attr('class').indexOf('active') < 0) {
			$('.'+s.switcher_name+'-scroll-area .one-view').each(function(){
				if ($(this).attr('id') != s.currentPointer+'_item') {
					$(this).animate({opacity:0},s.animate_show_time,function(){
						$(this).hide();
					});
				}
			});
			
			if ($('#'+s.currentPointer+'_item')[0] != undefined) {
				$('#'+s.currentPointer+'_item').css({opacity:0}).show().animate({opacity:1},s.animate_show_time,function(){
					s.lastTime = s.autoRunTime;
					s.isShowRun = false;
				});
			} else {
				s.lastTime = s.autoRunTime;
				s.isShowRun = false;
			}
		} else {
			s.lastTime = s.autoRunTime;
			s.isShowRun = false;
		}
		
		s.items.removeClass('active');
		$(ele).addClass('active');
	};
	
	/**
	 * switcher.getActiveItem() 获得当前已经激活的滚动元素
	 */
	this.getActiveItem = function() {
		var s = this.setting;
		var activeItem = s.thisSwitcher.find(".item.active");
		return activeItem[0] == undefined ? s.items[0] : activeItem;
	}
	
	/**
	 * switcher.clickPageButton() 监听左切换按钮事件
	 * 
	 * @param ele 左切换按钮的对象，暂未使用
	 * 
	 */
	this.clickLeftButton = function(ele) {
		var s = this.setting;
		var activeItem = this.getActiveItem();
		if (s.autoActive && activeItem == undefined) return;
		
		eval('s.moveLeft = parseInt(s.moveableBar.css(\''+s.direction+'\')) == NaN ? 0 : parseInt(s.moveableBar.css(\''+s.direction+'\'))');
		
		var isGo = true;
		if (s.autoActive) isGo = this.setAutoActive(-1,activeItem);
		if (isGo) this.goIt(-1);
	};
	
	/**
	 * switcher.clickPageButton() 监听右切换按钮事件
	 * 
	 * @param ele 右切换按钮的对象，暂未使用
	 * 
	 */
	this.clickRightButton = function(ele) {
		var s = this.setting;
		var activeItem = this.getActiveItem();
		if (s.autoActive && activeItem == undefined) return;
		
		eval('s.moveLeft = parseInt(s.moveableBar.css(\''+s.direction+'\')) >= 0 ? 0 : parseInt(s.moveableBar.css(\''+s.direction+'\'))');
		
		var isGo = true;
		if (s.autoActive) isGo = this.setAutoActive(1,activeItem);
		if (isGo) this.goIt(1);
	};
	
	/**
	 * switcher.setAutoActive() 监听分页按钮点击事件
	 * 
	 * @param where 该参数控制切换的方向
	 * 
	 */
	this.setAutoActive = function(where,activeItem) {
		var s = this.setting;
		if (s.isShowRun == true) return false;
		
		var activeId = parseInt($(activeItem).attr('id'));
		var pre_activeId = activeId;
		var return_val = true;
		if (where == 1 && activeId < s.items.length-1) {
			activeId++;
		} else if (where == -1 && activeId > 0) {
			activeId--;
		}
		if (pre_activeId != activeId) this.clickItem(s.items[activeId]);
		if (s.animway == 0 && (Math.abs(s.moveLeft)+(s.showCount-1)*s.itemWidth) >= activeId*s.itemWidth && Math.abs(s.moveLeft) <= activeId*s.itemWidth) {
			return_val = false;
		} else {
			var get_cur = (activeId+1)/s.showCount;
			var floor_get_cur = Math.floor(get_cur);
			if (get_cur == floor_get_cur) floor_get_cur -= 1;
			s.currentPointer = get_cur <= Math.ceil(s.itemCount/s.showCount)-1 ? (floor_get_cur == 0 ? 0 : floor_get_cur*s.showCount) : floor_get_cur*s.showCount-(s.lastLose > 0 ? s.showCount-s.lastLose : 0);
			where > 0 ? s.currentPointer-- : s.currentPointer++;
		}
		return return_val;
	}
	
	/**
	 * switcher.clickPageButton() 监听分页按钮点击事件
	 * 
	 * @param ele 切换到哪一页，可以是具体页数，也可以是分页按钮元素的对象
	 * 
	 */
	this.clickPageButton = function(ele) {
		var s = this.setting;
		if (s.isScrollRun == true) return;
		
		s.prePointer = s.currentPointer;
		s.gotoPage = !isNaN(parseInt(ele)) ? ele : parseInt($(ele).attr("title"));
		s.pointer = (s.gotoPage-1)*s.showCount;
		
		var page_to_where = s.gotoPage < Math.ceil(s.itemCount/s.showCount) || s.lastLose == 0;
		s.currentPointer = page_to_where ? s.pointer : (s.itemCount - s.pointer < s.showCount ? s.pointer-(s.showCount-s.lastLose) : s.pointer);
		
		this.goIt(0,'pagebt');
	};
	
	/**
	 * switcher.goIt() 响应按钮事件进行切换
	 * 
	 * @param where 该参数控制切换的方向
	 * 
	 */
	this.goIt = function(where) {
		var s = this.setting;
		
		var other_arg = '';
		if (arguments.length > 1) other_arg = arguments[1];
		
		if (other_arg == 'pagebt') if (s.isScrollRun == true || s.isShowRun == true) return;
		else if (s.isScrollRun == true) return;
		s.isScrollRun = true;
		
		if (s.autoActive && s.pagebt) s.moveLeft = -s.currentPointer*s.itemWidth;
		
		var is_go = false;
		if (other_arg == 'pagebt' && where == 0) {
			is_go = true;
		} else if (s.animway == 0 && s.moveLeft < 0 && where == -1) {
			is_go = true;
		} else if (s.animway == 0 && s.moveLeft > -s.itemWidth * (s.itemCount - s.showCount) && where == 1) {
			is_go = true;
		} else if (s.animway == 1 && s.currentPointer > 0 && where == -1) {
			is_go = true;
		} else if (s.animway == 1 && s.currentPointer < s.itemCount - s.showCount + 1 && where == 1) {
			is_go = true;
		}
		
		if (is_go) {
			this.goMove(where);
		} else {
			s.lastTime = s.autoRunTime;
			s.isScrollRun = false;
		}
	};
	
	/**
	 * switcher.goMove() 执行元素移动/显隐
	 * 
	 * @param where 该参数控制切换的方向
	 * 
	 */
	this.goMove = function(where) {
		var temp_obj = this;
		var s = this.setting;
		
		var curabs = -1;
		if (s.autoActive) {
			curabs *= s.currentPointer;
		} else {
			eval('curabs = parseInt(s.moveableBar.css(\''+s.direction+'\'))/s.itemWidth');
		}
		
		if (where != 0 && s.animway == 0 && !s.autoActive) {
			s.prePointer = s.currentPointer;
			s.currentPointer = Math.floor(Math.abs(curabs));
		}
		
		curabs = curabs == 0 ? -1 : curabs/Math.abs(curabs);
		where > 0 ? s.currentPointer++ : (where < 0 ? s.currentPointer-- : s.currentPointer);
		if (s.currentPointer > s.itemCount-1) s.currentPointer = s.itemCount-1;
		if (s.currentPointer < 0) s.currentPointer = 0;
		//$('#search_key_words').val(s.currentPointer);
		if (s.animway) {
			var start = s.currentPointer;
			var end = s.currentPointer + s.showCount;
			var anim_items = [];
			for (var k = start; k < end; k++) {
				anim_items.push(k);
			}

			for (var i = 0; i < s.items.length; i++) {
				var find_item = anim_items.indexOf(i) > -1;
				$(s.items[i]).animate({opacity:find_item ? 1 : 0,'z-index':find_item ? 2 : 1},s.animate_move_time,function(){
					s.lastTime = s.autoRunTime;
					s.isScrollRun = false;
					temp_obj.setItemActive();
					temp_obj.setPageActive();
				});
			}
		} else {
			eval('s.moveableBar.animate({\
					'+s.direction+':curabs*s.itemWidth*s.currentPointer+"px"\
				},s.animate_move_time,\'easeOutCirc\',function(){\
					s.lastTime = s.autoRunTime;\
					s.isScrollRun = false;\
					temp_obj.setItemActive();\
					temp_obj.setPageActive();\
				});');
			
			temp_obj.fadeIt(where);
		}
	};
	
	/**
	 * switcher.fadeIt() 在左右切换过程中处理临界元素的显隐
	 * 
	 * @param where 该参数控制切换的方向，方法内可通过此参数控制临界元素的显隐
	 * 
	 */
	this.fadeIt = function(where) {
		var s = this.setting;
		if (s.fadein == 1 && where != 0 && s.animway == 0) {
			s.preItem = s.moveableBar.find(".item:eq("+(s.currentPointer-(where > 0 ? 1 : 0))+")");
			s.endItem = s.moveableBar.find(".item:eq("+(s.currentPointer+(where > 0 ? s.showCount-1 : s.showCount))+")");
			s.preItem.css("opacity",where > 0 ? 1 : 0);
			s.preItem.fadeTo(s.animate_move_time,where > 0 ? 0 : 1);
			s.endItem.css("opacity",where > 0 ? 0 : 1);
			s.endItem.fadeTo(s.animate_move_time,where > 0 ? 1 : 0);
		} else {
			s.items.css({opacity:1});
		}
	};
	
	/**
	 * switcher.setActive() 自动设置当前切换到的位置的各种状态
	 */
	this.setItemActive = function() {
		var s = this.setting;
		if (s.hidebt == 1 && s.animway == 0) {
			eval('s.moveLeft = parseInt(s.moveableBar.css(\''+s.direction+'\')) == NaN ? 0 : parseInt(s.moveableBar.css(\''+s.direction+'\'));');
			if (s.leftButton[0] != undefined) {
				if(s.moveLeft < 0) {
					s.leftButton.fadeTo(s.animate_move_time,1);
				} else {
					s.leftButton.fadeTo(s.animate_move_time,0);
				}
			}
			if (s.rightButton[0] != undefined) {
				if (s.moveLeft > -s.itemWidth * (s.itemCount - s.showCount)) {
					s.rightButton.fadeTo(s.animate_move_time,1);
				} else {
					s.rightButton.fadeTo(s.animate_move_time,0);
				}
			}
		} else if (s.hidebt == 1 && s.animway == 1) {
			if (s.leftButton[0] != undefined) {
				if (s.currentPointer > 1) {
					s.leftButton.fadeTo(s.animate_move_time,1);
				} else {
					s.leftButton.fadeTo(s.animate_move_time,0);
				}
			}
			if (s.rightButton[0] != undefined) {
				if (s.currentPointer < s.itemCount - s.showCount + 1) {
					s.rightButton.fadeTo(s.animate_move_time,1);
				} else {
					s.rightButton.fadeTo(s.animate_move_time,0);
				}
			}
		}
	};
	
	/**
	 * switcher.setPageActive() 自动设置当前切换到的分页的各种状态
	 */
	this.setPageActive = function() {
		var s = this.setting;
		if (s.pageButton != null && s.pageButton != undefined) {
			s.pageButton.removeClass("active");
			$(".bigpagenation a[title="+Math.ceil(s.currentPointer/s.showCount+1)+"]").addClass("active");
		}
	};
}

/**
 * jQuery 缓动方法扩展
 */
if (typeof jQuery != 'undefined') {
	jQuery.easing['jswing'] = jQuery.easing['swing'];
	jQuery.extend( jQuery.easing,
	{
		def: 'easeOutQuad',
		swing: function (x, t, b, c, d) {
			return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
		},
		easeOutQuad: function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		},
		easeOutCirc: function (x, t, b, c, d) {
			return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
		}
	});
}

/**
 * Array 类的 indexOf 方法扩展
 */
Array.prototype.indexOf = function(el){
	for(var i=this.length-1; i>=0; i--){
		if(this[i]==el) return i;
	}
    return -1;
}