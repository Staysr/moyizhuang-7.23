/**
 * Created by Administrator on 2016/9/20.
 * @@@米兰家纺
 */
try {
    var objTest = {};
    (function () {
        //Ajax二次封装
        this.initAjax = function (url, data, successFun) {
            $.ajax({
                url: url,
                data: data,
                type: "post",
                dataType: "json",
                success:function (data) {
                    if(successFun && typeof(successFun) === "function"){
                        successFun(data);
                    }
                }
            });
        };
    }).apply(objTest);
} catch(e) {
    console.log('对象被覆盖，请程序员仔细检查！');
}

//效果
(function(doc, win, $) {
    var $this = $(this);
    //模态框
    $('.Milan-gL-situation').append('<div id="public-modal" class="public-modal"><div id="bag"></div></div><div id="public-bg" class="public-bg"></div>');
    objTest._Modal = $('#public-modal');
    objTest._bg = $('#public-bg');
    objTest._testMsg = $('#textMsg');
    objTest._bag = $('#bag');
    objTest.timer = null;
    $.fn.center = function(loaded) {
        var obj = this,
            body_width = parseInt($(window).width()),
            body_height = parseInt($(window).height()),
            block_width = parseInt(obj.width()),
            block_height = parseInt(obj.height()),
            left_position = parseInt(body_width - block_width) / 2 - 10,
            top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
        if (body_width < block_width) {
            left_position = 0 + $(window).scrollLeft();
        }
        if (body_height < block_height) {
            top_position = 0 + $(window).scrollTop();
        }
        if (!loaded) {
            //obj.css({ 'position': 'absolute' });
            obj.css({ 'top': (($(window).height() / 2) - ($('#public-modal').height()) * 0.5), 'left': left_position });
            // $(window).bind('resize', function() { obj.center(!loaded); });
            // $(window).bind('scroll', function() { obj.center(!loaded); });
        } else {
            obj.stop();
            obj.css({'position': 'absolute'});
            obj.animate({'top': top_position}, 200, 'linear');
        }
    };
    //背景关闭Modal
    $.fn.BgClose = function() {
        objTest._bg.fadeOut();
        objTest._Modal.fadeOut();
    };
    //背景关闭Modal
    objTest._bg.on('click', function() {
        $this.BgClose();
    });

    //商品列表3表单验证
    $.fn.checkForm2 = function (options) {
        var objThat = this, iSok = false;
        //自定义规则
        var defaults = {
            //验证错误提示信息
            tips_success: '', //验证成功时的提示信息，默认为空
            tips_required: '不能为空',
            tips_mobile: '手机号码格式有误',
            //匹配正则
            reg_mobile: /^0?1[2|3|4|5|6|7|8|9][0-9]\d{8}$/ //验证手机
        };

        if(options){ $.extend(defaults, options); }

        //失去焦点时验证
        $(':text, :password').each(function () {
            $(this).blur(function () {
                var _validate = $(this).attr('data-check'),
                    dataInformation = $(this).attr('data-information');
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).val(), dataInformation)){
                            return false;
                        } else {
                            continue;
                        }
                    }
                }
            })
        });

        function _onButton() {
            iSok = true;
            $(':text,:password').each(function () {
                var _validate = $(this).attr('data-check'),
                    _dataInformation = $(this).attr('data-information');
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).val(), _dataInformation)) {
                            iSok = false;
                            return false;
                        }
                    }
                }
            });

            $('#titleVal').each(function () {
                var _validate = $(this).attr('data-check'),
                    _dataInformation = $(this).attr('data-information');
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).text(), _dataInformation)) {
                            iSok = false;
                            return false;
                        }
                    }
                }
            });
        }

        if (objThat.is('form')) {
            objThat.submit(function (e) {
                _onButton();
                e.preventDefault();
                //验证成功后AJAX提交
                if(iSok === true) {
                    console.log('提交成功');
                }
                return iSok;
            })
        }

        //验证方法
        var check = function (obj, _match, _val, dataText) {
            switch (_match) {
                case 'required':
                    return _val ? SuccessMsg(obj, defaults.tips_success, true) : Err(obj, dataText + defaults.tips_required, false);
                case 'mobile':
                    return chk(_val, defaults.reg_mobile) ? SuccessMsg(obj, defaults.tips_success, true) : Err(obj, defaults.tips_mobile, false);
                default:
                    return true;
            }
        };

        var chk = function (str, reg) {
            return reg.test(str);
        };

        var SuccessMsg = function (obj, msg, mark) {
            return mark;
        };

        var Err = function (obj, msg, mark) {
            objTest._Modal.empty().addClass('mdVail').append('<div id="textMsg">'+msg+'</div>').center();
            $('#textMsg').addClass('textMsg');
            objTest._Modal.show();
            objTest.timer = setTimeout(function () {
                objTest._Modal.hide();
                obj.val('');
            },1500);
            setTimeout(function () {
                if(obj.val()) {
                    obj.val('');
                }
            },1500);
            return mark;
        }
    };

    //商品列表2表单验证
    $.fn.checkForm = function (options) {
        var objThat = this, iSok = false;
        //自定义规则
        var defaults = {
            //验证错误提示信息
            tips_success: '', //验证成功时的提示信息，默认为空
            tips_required: '不能为空',
            tips_mobile: '手机号码格式有误',
            tips_number: '只能输入数字并且不能为负数',
            //匹配正则
            reg_mobile: /^0?1[2|3|4|5|6|7|8|9][0-9]\d{8}$/,  //验证手机
            reg_number: /^([1-9]\d{0,9})(\.[0-9]{2})?$/    //验证价格
        };

        if(options){ $.extend(defaults, options); }

        //失去焦点时验证
        $(':text, :password').each(function () {
            $(this).blur(function () {
                var _validate = $(this).attr('data-check'),
                    dataInformation = $(this).attr('data-information');
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).val(), dataInformation)){
                            return false;
                        } else {
                            continue;
                        }
                    }
                }
            })
        });

        function _onButton() {
            iSok = true;
            $(':text,:password').each(function () {
                var _validate = $(this).attr('data-check'),
                    _dataInformation = $(this).attr('data-information');
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).val(), _dataInformation)) {
                            iSok = false;
                            return false;
                        }
                    }
                }
            });

            $('#titleVal').each(function () {
                var _validate = $(this).attr('data-check'),
                    _dataInformation = $(this).attr('data-information');
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).text(), _dataInformation)) {
                            iSok = false;
                            return false;
                        }
                    }
                }
            });
        }

        if (objThat.is('form')) {
            objThat.submit(function (e) {
                _onButton();
                e.preventDefault();
                //验证成功后AJAX提交
                if(iSok === true) {
                    console.log('提交成功');
                }
                return iSok;
            })
        }

        //验证方法
        var check = function (obj, _match, _val, dataText) {
            switch (_match) {
                case 'required':
                    return _val ? SuccessMsg(obj, defaults.tips_success, true) : Err(obj, dataText + defaults.tips_required, false);
                case 'mobile':
                    return chk(_val, defaults.reg_mobile) ? SuccessMsg(obj, defaults.tips_success, true) : Err(obj, defaults.tips_mobile, false);
                case 'number':
                    return chk(_val, defaults.reg_number) ? SuccessMsg(obj, defaults.tips_success, true) : Err(obj, defaults.tips_number, false);
                default:
                    return true;
            }
        };

        var chk = function (str, reg) {
            return reg.test(str);
        };

        var SuccessMsg = function (obj, msg, mark) {
            return mark;
        };

        var Err = function (obj, msg, mark) {
            objTest._Modal.empty().addClass('mdVail').append('<div id="textMsg">'+msg+'</div>').center();
            $('#textMsg').addClass('textMsg');
            objTest._Modal.show();
            objTest.timer = setTimeout(function () {
                if(objTest._Modal.hasClass('mdVail')) {
                    objTest._Modal.hide();
                }
                obj.val('');
            },1500);
            setTimeout(function () {
                if(obj.val()) {
                    obj.val('');
                }
            },1500);
            return mark;
        }
    };

    //核销在线订单切换
    $.organicTabs = function(el, options) {
        var base = this;
        base.$el = $(el);
        base.$nav = base.$el.find(".nav");
        base.init = function() {
            base.options = $.extend({},$.organicTabs.defaultOptions, options);
            $(".hide").css({
                "position": "relative",
                "top": 0,
                "left": 0,
                "display": "none"
            });
            base.$nav.delegate("li > a", "click", function() {
                var curList = base.$el.find("a.current").attr("href").substring(1),
                    $newList = $(this),
                    listID = $newList.attr("href").substring(1),
                    $allListWrap = base.$el.find(".list-wrap"),
                    curListHeight = $allListWrap.height();
                $allListWrap.height(curListHeight);

                if ((listID != curList) && ( base.$el.find(":animated").length == 0)) {
                    base.$el.find("#"+curList).fadeOut(base.options.speed, function() {
                        base.$el.find("#"+listID).fadeIn(base.options.speed);
                        var newHeight = base.$el.find("#"+listID).height();
                        $allListWrap.animate({
                            height: newHeight
                        });
                        base.$el.find(".nav li a").removeClass("current");
                        $newList.addClass("current");
                    });
                }
                return false;
            });
        };
        base.init();
    };
    $.organicTabs.defaultOptions = {
        "speed": 0
    };
    $.fn.organicTabs = function(options) {
        return this.each(function() {
            (new $.organicTabs(this, options));
        });
    };
})(document, window, jQuery);

//页面路由
$(function() {
    var _pathname = window.location.pathname.split("/");
    var _paLen = _pathname.length;

    switch (_pathname[_paLen-1])
    {
        case "index.html":
            index();
            break;
        case "goodsList.html":
            Goods();
            break;
        case "goodsList2.html":
            Goods2();
            break;
        case "goodsList3.html":
            Goods3();
            break;
        case "bargainDe.html":
            BarDe();
            break;
        case "myOrders.html":
            MyOd();
            break;
        default:
    }
});

/**
 * 业务逻辑
 */
var Goods = function () {
    return new Goods.prototype.init();
};
//商品列表1
Goods.prototype = {
    init: function () {
        var _self = this,
            arr = [];
        $('.Milan-gL-rd').on('click', function () { var self = $(this); _self.selected(self, arr); }); //选中
    },
    /*
     选中
     */
    selected: function (_self, arr) {
        var number = _self.attr('data-number'),
            submit = $('#submit');
        if(_self.hasClass('Milan-gL-sd')) {
            _self.removeClass('Milan-gL-sd').css({
                'border': 'solid 1px #d9d9d9',
                'borderRadius': 50 + '%'
            });
            arr.pop();
        } else {
            _self.addClass('Milan-gL-sd').css({
                'border': 0
            });
            arr.push(number);
        }
        if(arr.length > 0) {
            submit.addClass('Milan-gL-st').attr('disabled', false);
        } else {
            submit.removeClass('Milan-gL-st').attr('disabled', true);
        }
        return _self;
    }
};
Goods.prototype.init.prototype = Goods.prototype;

var Goods2 = function () {
    return new Goods2.prototype.init();
};
//商品列表2
Goods2.prototype = {
    init: function () {
        var _self = this;
        //验证
        $('#subGoodList2').checkForm();
    }
};
Goods2.prototype.init.prototype = Goods2.prototype;

var Goods3 = function () {
    return new Goods3.prototype.init();
};
//商品列表3
Goods3.prototype = {
    init: function () {
        var _self = this,
            curr = new Date().getFullYear(),
            pT = $('#pickTime'),
            pT2 = $('#pickTime2'),
            start = '',
            opt = {};
            opt.date = {preset : 'date'};
            opt.datetime = {preset : 'datetime'};
            opt.time = {preset : 'time'};
            opt.default = {
                theme: 'android-holo light', //皮肤样式
                display: 'modal', //显示方式
                mode: 'scroller', //日期选择模式
                dateFormat: 'yyyy-mm-dd',
                lang: 'zh',
                showNow: true,
                nowText: "今天",
                stepMinute: 1,
                startYear: curr - 0, //开始年份
                endYear: curr + 2 //结束年份
            };
            $('.settings').bind('change', function() {
                var demo = 'datetime';
                if (!demo.match(/select/i)) {
                    $('.demo-test-' + demo).val('');
                }
                $('.demo-test-' + demo).scroller('destroy').scroller($.extend(opt['datetime'], opt['default']));
                $('.demo').hide();
                $('.demo-' + demo).show();
            });
        $('#demo').trigger('change');
        //活动标题
        $('#title').on('click', function () {
            clearTimeout(objTest.timer);
            objTest._Modal.removeClass('mdVail');
            if(objTest._Modal.hasClass('mdVail')) {
                objTest._Modal.removeClass('mdVail').append('<div id="textMsg">' +
                    '<input class="Milan-gL3-ip" id="activityId" type="text" placeholder="请输入活动标题" maxlength="18">' +
                    '</div>' +
                    '<div id="Ft" class="Milan-gL3-footer">' +
                    '<a class="Milan-gL3-footer1" id="sure" href="javascript:;">确定</a>' +
                    '<a class="Milan-gL3-footer2" id="cancel" href="javascript:;">取消</a>' +
                    '</div>');
                objTest._Modal.unbind().empty().center();
            } else {
                objTest._Modal.unbind().empty().center();
                objTest._Modal.append('<div id="textMsg">' +
                    '<input class="Milan-gL3-ip" id="activityId" type="text" placeholder="请输入活动标题" maxlength="18">' +
                    '</div>' +
                    '<div id="Ft" class="Milan-gL3-footer">' +
                    '<a class="Milan-gL3-footer1" id="sure" href="javascript:;">确定</a>' +
                    '<a class="Milan-gL3-footer2" id="cancel" href="javascript:;">取消</a>' +
                    '</div>');
            }
            objTest._bg.fadeIn();
            objTest._Modal.fadeIn();
            //传input值给活动标题
            $('#sure').on('click', function () {
                var _val = $('#activityId').val();
                $('#titleVal').text(_val);
                $(this).BgClose();
            });
            //取消
            $('#cancel').on('click', function () {
                $(this).BgClose();
            })
        });
        //验证
        $('#subGoodList3').checkForm2();
        start = _self.startTime(pT); //时间初始化
        _self.endTime(pT2, start);
    },
    /*
     开始时间初始化
     */
    startTime: function (id) {
        var date = new Date();
        var sePor1 = "-";
        var sePor2 = ":";
        var s = "";
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        if(date.getMinutes() < 10) {
            s = sePor2 + 0 + date.getMinutes();
        } else {
            s = sePor2 + date.getMinutes();
        }
        var currDate = date.getFullYear() + sePor1 + month + sePor1 + strDate + " " + date.getHours() + s;
        id.attr('placeholder', currDate);
        return currDate;
    },
    /*
     结束时间初始化
     */
    endTime: function (id, end) {
        var arr = end.split('-');
        var year = arr[0]; //获取当前日期的年份
        var month = arr[1]; //获取当前日期的月份
        var day = arr[2]; //获取当前日期的日
        var days = new Date(year, month, 0);
        days = days.getDate(); //获取当前日期中的月的天数
        var year2 = year;
        var month2 = parseInt(month) + 1;
        if (month2 == 13) {
            year2 = parseInt(year2) + 1;
            month2 = 1;
        }
        var day2 = day;
        var days2 = new Date(year2, month2, 0);
        days2 = days2.getDate();
        if (day2 > days2) {
            day2 = days2;
        }
        if (month2 < 10) {
            month2 = '0' + month2;
        }
        var t2 = year2 + '-' + month2 + '-' + day2;
        id.attr('placeholder', t2);
        return t2;
    }
};
Goods3.prototype.init.prototype = Goods3.prototype;

var BarDe = function () {
    return new BarDe.prototype.init();
};
//砍价详情
BarDe.prototype = {
    init: function () {
        var _self = this;
        _self.BarDe();
    },
    /*
     好友活动Tab切换
     */
    BarDe: function () {
        var windowWidth = document.body.clientWidth - 23.4375; //window 宽度;
        var wrap = document.getElementById('wrap');
        var tabClick = wrap.querySelectorAll('.tabClick')[0];
        var tabLi = tabClick.getElementsByTagName('li');
        var tabBox =  wrap.querySelectorAll('.tabBox')[0];
        var tabList = tabBox.querySelectorAll('.tabList');
        var lineBorder = wrap.querySelectorAll('.lineBorder')[0];
        var tar = 0;
        var endX = 0;
        var dist = 0;
        tabBox.style.overflow = 'hidden';
        tabBox.style.position = 'relative';
        tabBox.style.width = windowWidth * tabList.length + "px";

        for(var i = 0; i < tabLi.length; i++ ){
            tabList[i].style.width = windowWidth+"px";
            tabList[i].style.float = 'left';
            tabList[i].style.float = 'left';
            tabList[i].style.padding = '0';
            tabList[i].style.margin = '0';
            tabList[i].style.verticalAlign = 'top';
            tabList[i].style.display = 'table-cell';
        }

        for(var i = 0; i < tabLi.length; i++ ) {
            tabLi[i].start = i;
            tabLi[i].onclick = function() {
                if($(this).index() === 1) {
                    $('#wrap').css({
                        'height': 13 + 'rem'
                    });
                } else {
                    $('#wrap').css({
                        'height': 'auto'
                    });
                }
                var star = this.start;
                for(var i = 0; i < tabLi.length; i++ ){
                    tabLi[i].className = 'Milan-bD-li';
                }
                tabLi[star].className = 'Milan-bD-active';
                init.translate(tabBox, windowWidth, star);
                endX = -star * windowWidth;
            }
        }

        function OnTab(star){
            if(star < 0){
                star = 0;
            }else if(star >= tabLi.length){
                star = tabLi.length-1
            }
            for(var i = 0; i < tabLi.length; i++ ){
                tabLi[i].className = 'Milan-bD-li';
            }
            tabLi[star].className='Milan-bD-active';
            init.translate(tabBox,windowWidth,star);
            endX= -star*windowWidth;
        }
        tabBox.addEventListener('touchstart', chstart, false);
        tabBox.addEventListener('touchmove', chmove, false);
        tabBox.addEventListener('touchend', chend, false);
        //按下
        function chstart(ev){
            ev.preventDefault;
            var touch = ev.touches[0];
            tar=touch.pageX;
            tabBox.style.webkitTransition='all 0s ease-in-out';
            tabBox.style.transition='all 0s ease-in-out';
        }
        //滑动
        function chmove(ev){
            ev.preventDefault;
            var touch = ev.touches[0];
            var distance = touch.pageX-tar;
            dist = distance;
            // init.touchs(tabBox,windowWidth,tar,distance,endX);
        }
        //离开
        function chend(ev){
            var str= tabBox.style.transform;
            var strs = JSON.stringify(str.split(",",1));
            endX = Number(strs.substr(14,strs.length-18));

            if(endX>0){
                init.back(tabBox,windowWidth,tar,0,0,0.3);
                endX=0
            }else if(endX<-windowWidth*tabList.length+windowWidth){
                endX = -windowWidth*tabList.length + windowWidth;
                init.back(tabBox,windowWidth,tar,0,endX,0.3);
            }else if(dist<-windowWidth/3){
                init.back(tabBox,windowWidth,tar,0,endX,0.3);
            }else if(dist>windowWidth/3){
                OnTab(tabClick.querySelector('.Milan-bD-active').start-1);
            }else{
                OnTab(tabClick.querySelector('.Milan-bD-active').start);
            }
        }
        var init = {
            translate:function(obj, windowWidth, star){
                obj.style.webkitTransform = 'translate3d('+-star*windowWidth + 'px,0,0)';
                obj.style.transform = 'translate3d('+-star*windowWidth + ',0,0)px';
                obj.style.webkitTransition = 'all 0.3s ease-in-out';
                obj.style.transition = 'all 0.3s ease-in-out';
            },
            touchs:function(obj, windowWidth, tar, distance, endX){
                obj.style.webkitTransform = 'translate3d('+(distance+endX)+'px,0,0)';
                obj.style.transform = 'translate3d('+(distance+endX)+',0,0)px';
            },
            back:function(obj,windowWidth,tar,distance,endX,time){
                obj.style.webkitTransform = 'translate3d('+(distance+endX)+'px,0,0)';
                obj.style.transform = 'translate3d('+(distance+endX)+',0,0)px';
                obj.style.webkitTransition = 'all '+time+'s ease-in-out';
                obj.style.transition = 'all '+time+'s ease-in-out';
            }
        };
    }
};
BarDe.prototype.init.prototype = BarDe.prototype;

var MyOd = function () {
    return new MyOd.prototype.init();
};
//砍价详情
MyOd.prototype = {
    init: function () {
        var _self = this;
        _self.OdTab();
    },
    /*
     核销在线切换
     */
    OdTab: function () {
        $("#example-one").organicTabs();
    }
};
MyOd.prototype.init.prototype = MyOd.prototype;


