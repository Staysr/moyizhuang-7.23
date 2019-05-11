/**
 * Created by Administrator on 2016/10/15.
 * @@@千家家纺
 */
try {
    var objTest = {
        url: 'http://erptest.jf1000.com/', //通信地址
        record: [] //此数组是根据分类显示分页商品列表
    };
    (function () {
        var progress = $.AMUI.progress;
        progress.start();
        document.onreadystatechange = subSomething;
        function subSomething() {
            if(document.readyState == "complete") {
                progress.done();
            }
        }
        //Ajax二次封装
        this.initAjax = function (url, data, successFun) {
            $.ajax({
                url: url,
                data: data,
                type: "post",
                dataType: "json",
                success:function (data) {
                    if(successFun && typeof(successFun) === "function") {
                        successFun(data);
                    }
                }
            });
        };
        this.addEvent = function (obj, type, handle) {
            try {
                obj.addEventListener(type, handle, false);
            } catch(e) {
                try{
                    obj.attachEvent('on' + type,handle);
                } catch(e) {
                    // obj['on' + type] = handle;
                }
            }
        };
        this.ieVersion = function () {
            var DEFAULT_VERSION = "9.0";
            var ua = navigator.userAgent.toLowerCase();
            var isIE = ua.indexOf("msie") > -1;
            var safariVersion;
            if(isIE){
                safariVersion = ua.match(/msie ([\d.]+)/)[1];
                if(safariVersion < DEFAULT_VERSION) {
                    alert("您的IE浏览器版本太低，请升级到IE8及以上，推荐使用下载谷歌浏览器");
                    location.href = "http://rj.baidu.com/soft/detail/14744.html?ald";
                }
            }
        };
        this.parseURL = function (urlParameter) {
            var _url = window.location.href.split("?")[1];
            if (_url != undefined) {
                var _index;
                var _arr = _url.split("&");
                for (var i = 0, _len = _arr.length; i < _len; i++) {
                    if (_arr[i].indexOf(urlParameter + "=") >= 0) {
                        _index = i;
                        break;
                    } else {
                        _index = -1;
                    }
                }
                if (_index >= 0) {
                    var _key = _arr[_index].split("=")[1];
                    return _key;
                }
            }
        };
        this.listGoods = function (arr, index) {
            console.log(arr, index);
            var key = objTest.parseURL('key');
            var data = {
                styleId: arr
            };
            if(data.styleId.length == 0) { pageObj.search2(key, index); }
            if(data.styleId == 5 || data.styleId == 7 || data.styleId == 3 || data.styleId == 2 || data.styleId == 10 || data.styleId == 6) { pageObj.seaStyle2(data.styleId, index); }
            if(data.styleId == '1,50' || data.styleId == '50,100' || data.styleId == '100,200' || data.styleId == '200,300' || data.styleId == '300,500' || data.styleId == '500,9999') { pageObj.price2(data.styleId, index, key); }
        }
    }).apply(objTest);
} catch(e) {
    console.log('对象被覆盖，请程序员仔细检查！');
}

(function (win, doc, $, window, document, undefined) {
    objTest.ieVersion();
    //折叠
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        var links = this.el.find('.link');
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    };
    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
        var $this = $(this);
        var $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('open');
        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        }
    };
    var accordion = new Accordion($('#accordion'), false);

    //收货地址验证
    $.fn.checkForm = function (options) {
        var objThat = this, iSok = false;

        //自定义规则
        var defaults = {
            //验证错误提示信息
            tips_success: '',
            tips_required: '不能为空！',
            tips_name: '2到8个字的汉字,或2到16个英文',
            tips_mobile: '手机号码格式有误！',
            //匹配正则
            reg_email: /^\w+\@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/i,  //验证邮箱
            reg_name: /^(([\u4e00-\u9fa5]{2,8})|([a-zA-Z]{2,16}))$/,  //验证姓名
            reg_mobile: /^0?1[2|3|4|5|6|7|8|9][0-9]\d{8}$/  //验证手机
        };

        if(options){ $.extend(defaults, options); }

        $(":text,:password").each(function() {
            $(this).focus(function(){
                var _focus = $(this).attr("data-focus");
                var _name = $(this).attr("name");
                initText($(this), _name, _focus);
            });
        });

        $(":text, :password, textarea, select").each(function () {
            $(this).blur(function () {
                var _validate = $(this).attr("data-check"),
                    _name = $(this).attr("name");
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0 ,l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).val(), _name)){
                            return false;
                        } else{
                            continue;
                        }
                    }
                }
            })
        });

        function _onButton() {
            iSok = true;
            $(":text,:password, textarea, select").each(function () {
                var _validate = $(this).attr("data-check"),
                    _name = $(this).attr("name");
                if (_validate) {
                    var arr = _validate.split('||');
                    for (var i = 0, l = arr.length; i < l; i++) {
                        if (!check($(this), arr[i], $(this).val(), _name)) {
                            iSok = false;
                            return;
                        }
                    }
                }
            });
        }

        if (objThat.is("form")) {
            $('#hold').on('click', function () {
                _onButton();
                if(iSok === true){
                    // alert("提交成功");
//                                sendAjax()
                }
                return iSok;
            });
        }

        var check = function (obj, _match, _val, _name) {
            switch (_match) {
                case 'required':
                    return _val ? showMsg(obj, defaults.tips_success, true) : showMsg(obj, _name + defaults.tips_required, false);
                case 'name':
                    return chk(_val, defaults.reg_name) ? showMsg(obj, defaults.tips_success, true) : showMsg(obj, defaults.tips_name, false);
                case 'mobile':
                    return chk(_val, defaults.reg_mobile) ? showMsg(obj, defaults.tips_success, true) : showMsg(obj, defaults.tips_mobile, false);
                default:
                    return true;
            }
        };

        var chk = function (str, reg) {
            return reg.test(str);
        };

        var initText = function(obj, showName, focus) {
            $(obj).next(".err").remove();
            if (showName) {
                var _html = "<span class='err initText'>" + focus + "</span>";
            }
            $(obj).after(_html);
            return showName;
        };

        var showMsg = function (obj, msg, mark) {
            $(obj).next(".err").remove();
            var _html = "<span class='err errorText'>" + msg + "</span>";
            if (mark) {
                _html = "<span class='err successText'>" + msg + "</span>";
            }
            $(obj).after(_html);
            return mark;
        };
    };

    //回到顶部
    $.fn.toTop = function(t) {
        var i = this,
            e = $(window),
            s = $("html, body"),
            n = $.extend({
                autoHide: !0,
                offset: 420,
                speed: 500,
                position: !0,
                width: 40
            }, t);
        var o = e.scrollTop();
        i.css({
            cursor: "pointer"
        });
        n.autoHide && i.css("display", "none");
        n.position && i.css({
            position: "fixed",
            width: n.width
        });
        i.click(function() {
            s.animate({
                scrollTop: 0
            }, n.speed)
        });
        e.scroll(function() {
            var o = e.scrollTop();
            n.autoHide && (o > n.offset ? i.fadeIn(n.speed) : i.fadeOut(n.speed))
        });
        if(o > n.offset) {
            i.css("display", "block");
        }
    };

    //首页轮播
    $.fn.luBo = function(options){
        return this.each(function(){

            var _lubo = jQuery('.luBo');
            var _box = jQuery('.luBo_box');
            var _this = jQuery(this);
            var luboHei = _box.height();
            var Over = 'mouseover';
            var Out = 'mouseout';
            var Click = 'click';
            var Li = "li";
            var _cirBox = '.cir_box';
            var cirOn = 'cir_on';
            var _cirOn = '.cir_on';
            var cirlen = _box.children(Li).length;
            var luboTime = 3000;
            var switchTime = 400;
            cir();
            Btn();
            function cir(){
                _lubo.append('<ul class="cir_box"></ul>');
                var cir_box=jQuery('.cir_box');
                for(var i=0; i<cirlen;i++){
                    cir_box.append('<li style="" value="'+i+'"></li>');
                }
                var cir_dss=cir_box.width();
                cir_box.css({
                    left:'50%',
                    marginLeft:-cir_dss/2,
                    bottom:'10%'
                });
                cir_box.children(Li).eq(0).addClass(cirOn);
            }
            function Btn(){
                _lubo.append('<div class="lubo_btn"></div>');
                var _btn=jQuery('.luBo_btn');
                _btn.append('<div class="left_btn"><</div><div class="right_btn">></div>');
                var leftBtn=jQuery('.left_btn');
                var rightBtn=jQuery('.right_btn');
                leftBtn.bind(Click,function(){
                    var cir_box=jQuery(_cirBox);
                    var onLen=jQuery(_cirOn).val();
                    _box.children(Li).eq(onLen).stop(false,false).animate({
                        opacity:0
                    },switchTime);
                    if(onLen==0){
                        onLen=cirlen;
                    }
                    _box.children(Li).eq(onLen-1).stop(false,false).animate({
                        opacity:1
                    },switchTime);
                    cir_box.children(Li).eq(onLen-1).addClass(cirOn).siblings().removeClass(cirOn);
                });
                rightBtn.bind(Click,function(){
                    var cir_box=jQuery(_cirBox);
                    var onLen=jQuery(_cirOn).val();
                    _box.children(Li).eq(onLen).stop(false,false).animate({
                        opacity:0
                    },switchTime);
                    if(onLen==cirlen-1){
                        onLen=-1;
                    }
                    _box.children(Li).eq(onLen+1).stop(false,false).animate({
                        opacity:1
                    },switchTime);
                    cir_box.children(Li).eq(onLen+1).addClass(cirOn).siblings().removeClass(cirOn);
                })
            }
            int=setInterval(clock,luboTime);
            function clock(){
                var cir_box=jQuery(_cirBox);
                var onLen=jQuery(_cirOn).val();
                _box.children(Li).eq(onLen).stop(false,false).animate({
                    opacity:0
                },switchTime);
                if(onLen==cirlen-1){
                    onLen=-1;
                }
                _box.children(Li).eq(onLen+1).stop(false,false).animate({
                    opacity:1
                },switchTime);
                cir_box.children(Li).eq(onLen+1).addClass(cirOn).siblings().removeClass(cirOn);
            }
            _lubo.bind(Over,function(){
                clearTimeout(int);
            });
            _lubo.bind(Out,function(){
                int=setInterval(clock,luboTime);
            });
            jQuery(_cirBox).children(Li).bind(Over,function(){
                var inde = jQuery(this).index();
                jQuery(this).addClass(cirOn).siblings().removeClass(cirOn);
                _box.children(Li).stop(false,false).animate({
                    opacity:0
                },switchTime);
                _box.children(Li).eq(inde).stop(false,false).animate({
                    opacity:1
                },switchTime);
            });
        });
    };

    //滚动到指定位置
    var $scrollTo = $.scrollTo = function( target, duration, settings ){
        $(window).scrollTo( target, duration, settings );
    };
    $scrollTo.defaults = {
        axis:'y',
        duration:1
    };
    $scrollTo.window = function( scope ){
        return $(window).scrollable();
    };
    $.fn.scrollable = function(){
        return this.map(function(){
            var win = this.parentWindow || this.defaultView,
                elem = this.nodeName == '#document' ? win.frameElement || win : this,
                doc = elem.contentDocument || (elem.contentWindow || elem).document,
                isWin = elem.setInterval;
            return elem.nodeName == 'IFRAME' || isWin && $.browser.safari ? doc.body
                : isWin ? doc.documentElement
                : this;
        });
    };
    $.fn.scrollTo = function( target, duration, settings ){
        if( typeof duration == 'object' ){
            settings = duration;
            duration = 0;
        }
        if( typeof settings == 'function' )
            settings = { onAfter:settings };

        settings = $.extend( {}, $scrollTo.defaults, settings );
        duration = duration || settings.speed || settings.duration;
        settings.queue = settings.queue && settings.axis.length > 1;

        if( settings.queue )
            duration /= 2;
        settings.offset = both( settings.offset );
        settings.over = both( settings.over );

        return this.scrollable().each(function(){
            var elem = this,
                $elem = $(elem),
                targ = target, toff, attr = {},
                win = $elem.is('html,body');

            switch( typeof targ ){
                case 'number':
                case 'string':
                    if( /^([+-]=)?\d+(px)?$/.test(targ) ){
                        targ = both( targ );
                        break;
                    }

                    targ = $(targ,this);
                case 'object':
                    if( targ.is || targ.style )
                        toff = (targ = $(targ)).offset();
            }
            $.each( settings.axis.split(''), function( i, axis ){
                var Pos	= axis == 'x' ? 'Left' : 'Top',
                    pos = Pos.toLowerCase(),
                    key = 'scroll' + Pos,
                    old = elem[key],
                    Dim = axis == 'x' ? 'Width' : 'Height',
                    dim = Dim.toLowerCase();

                if( toff ){
                    attr[key] = toff[pos] + ( win ? 0 : old - $elem.offset()[pos] );

                    if( settings.margin ){
                        attr[key] -= parseInt(targ.css('margin'+Pos)) || 0;
                        attr[key] -= parseInt(targ.css('border'+Pos+'Width')) || 0;
                    }

                    attr[key] += settings.offset[pos] || 0;

                    if( settings.over[pos] )
                        attr[key] += targ[dim]() * settings.over[pos];
                }else
                    attr[key] = targ[pos];

                if( /^\d+$/.test(attr[key]) )
                    attr[key] = attr[key] <= 0 ? 0 : Math.min( attr[key], max(Dim) );

                if( !i && settings.queue ){
                    if( old != attr[key] )
                        animate( settings.onAfterFirst );
                    delete attr[key];
                }
            });
            animate( settings.onAfter );

            function animate( callback ){
                $elem.animate( attr, duration, settings.easing, callback && function(){
                        callback.call(this, target, settings);
                    });
            }
            function max( Dim ){
                var attr ='scroll'+Dim,
                    doc = elem.ownerDocument;

                return win
                    ? Math.max( doc.documentElement[attr], doc.body[attr]  )
                    : elem[attr];
            }
        }).end();
        function both( val ){
            return typeof val == 'object' ? val : { top:val, left:val };
        }
    };

    //分页
    var defaults = {
        totalData:0,
        showData:0,
        pageCount:9,
        current:1,
        prevCls:'prev',
        nextCls:'next',
        prevContent:'<',
        nextContent:'>',
        activeCls:'active',
        coping:false,
        homePage:'',
        endPage:'',
        count:3,
        jump:false,
        jumpIptCls:'jump-ipt',
        jumpBtnCls:'jump-btn',
        jumpBtn:'璺宠浆',
        callback:function(){}
    };
    var Pagination = function(element,options){
        var opts = options,
            current,
            $document = $(document),
            $obj = $(element);
        this.setTotalPage = function(page){
            return opts.pageCount = page;
        };
        this.getTotalPage = function(){
            var p = opts.totalData || opts.showData ? Math.ceil(parseInt(opts.totalData) / opts.showData) : opts.pageCount;
            return p;
        };
        this.getCurrent = function(){
            return current;
        };
        this.filling = function(index){
            var html = '';
            current = index || opts.current;
            var pageCount = this.getTotalPage();
            if(current > 1){
                html += '<a href="javascript:;" class="'+opts.prevCls+'">'+opts.prevContent+'</a>';
            }else{
                $obj.find('.'+opts.prevCls) && $obj.find('.'+opts.prevCls).remove();
            }
            if(current >= opts.count * 2 && current != 1 && pageCount != opts.count){
                var home = opts.coping && opts.homePage ? opts.homePage : '1';
                html += opts.coping ? '<a href="javascript:;" data-page="1">'+home+'</a><span>...</span>' : '';
            }
            var start = current - opts.count,
                end = current + opts.count;
            ((start > 1 && current < opts.count) || current == 1) && end++;
            (current > pageCount - opts.count && current >= pageCount) && start++;
            for (;start <= end; start++) {
                if(start <= pageCount && start >= 1){
                    if(start != current){
                        html += '<a href="javascript:;" data-page="'+start+'">'+ start +'</a>';
                    }else{
                        html += '<a href="javascript:;" class="'+opts.activeCls+'" data-page="1">'+ start +'</a>';
                    }
                }
            }
            if(current + opts.count < pageCount && current >= 1 && pageCount > opts.count){
                var end = opts.coping && opts.endPage ? opts.endPage : pageCount;
                html += opts.coping ? '<span>...</span><a href="javascript:;" data-page="'+pageCount+'">'+end+'</a>' : '';
            }
            if(current < pageCount){
                html += '<a href="javascript:;" class="'+opts.nextCls+'">'+opts.nextContent+'</a>'
            }else{
                $obj.find('.'+opts.nextCls) && $obj.find('.'+opts.nextCls).remove();
            }
            html += opts.jump ? '<input type="text" class="'+opts.jumpIptCls+'"><a href="javascript:;" class="'+opts.jumpBtnCls+'">'+opts.jumpBtn+'</a>' : '';
            $obj.empty().html(html);
        };
        this.eventBind = function(){
            var self = this;
            var pageCount = this.getTotalPage();
            $obj.off().on('click','a',function(){
                if($(this).hasClass(opts.nextCls)){
                    var index = parseInt($obj.find('.'+opts.activeCls).text()) + 1;
                    objTest.listGoods.call(objTest, objTest.record, index);
                }else if($(this).hasClass(opts.prevCls)){
                    var index = parseInt($obj.find('.'+opts.activeCls).text()) - 1;
                    objTest.listGoods.call(objTest, objTest.record, index);
                }else if($(this).hasClass(opts.jumpBtnCls)){
                    if($obj.find('.'+opts.jumpIptCls).val() !== ''){
                        var index = parseInt($obj.find('.'+opts.jumpIptCls).val());
                    }else{
                        return;
                    }
                }else{
                    var index = parseInt($(this).data('page'));
                    var val = $(this).html();
                    objTest.listGoods.call(objTest, objTest.record, val);
                }
                self.filling(index);
                typeof opts.callback === 'function' && opts.callback(self);
            });
            $obj.on('input propertychange','.'+opts.jumpIptCls,function(){
                var $this = $(this);
                var val = $this.val();
                var reg = /[^\d]/g;
                if (reg.test(val)) {
                    $this.val(val.replace(reg, ''));
                }
                (parseInt(val) > pageCount) && $this.val(pageCount);
                if(parseInt(val) === 0){
                    $this.val(1);
                }
            });
            $document.keydown(function(e){
                var self = this;
                if(e.keyCode == 13 && $obj.find('.'+opts.jumpIptCls).val()){
                    var index = parseInt($obj.find('.'+opts.jumpIptCls).val());
                    self.filling(index);
                    typeof opts.callback === 'function' && opts.callback(self);
                }
            });
        };
        this.init = function(){
            this.filling(opts.current);
            this.eventBind();
        };
        this.init();
    };
    $.fn.pagination = function(parameter,callback){
        if(typeof parameter == 'function'){
            callback = parameter;
            parameter = {};
        }else{
            parameter = parameter || {};
            callback = callback || function(){};
        }
        var options = $.extend({},defaults,parameter);
        return this.each(function(){
            var pagination = new Pagination(this, options);
            callback(pagination);
        });
    };
})(window, document, jQuery, window, document);

//页面路由
$(function() {
    var _pathname = window.location.pathname.split("/");
    var _paLen = _pathname.length;

    switch (_pathname[_paLen-1])
    {
        case "goodsList.html":
            Goods();
            break;
        case "index.html":
            index();
            break;
        case "goodsDetailsPage.html":
            GoodDp();
            break;
        case "shoppingCart.html":
            shopCart();
            break;
        case "reLogistics.html":
            shopLogistics();
            break;
        default:
    }
});

/**
 * 业务逻辑
 */
//首页
var index = function () {
    return new index.prototype.init();
};
index.prototype = {
    init: function () {
        var _self = this;
        $('#scrollTop').toTop();
        $(".luBo").luBo({});
        $('#gwCart').on('mouseenter', function () {
            $(this).find('i').addClass('SpinIng-id-icon-cart2');
        }).on('mouseleave', function () {
            $(this).find('i').removeClass('SpinIng-id-icon-cart2');
        });
        $('#coupon').on('mouseenter', function () {
            $(this).find('i').addClass('SpinIng-id-icon-collE2');
        }).on('mouseleave', function () {
            $(this).find('i').removeClass('SpinIng-id-icon-collE2');
        });
        $('#scjLove').on('mouseenter', function () {
            $(this).find('i').addClass('SpinIng-id-icon-love2');
        }).on('mouseleave', function () {
            $(this).find('i').removeClass('SpinIng-id-icon-love2');
        });
        $('.SpinIng-id-fenLei2').on('mouseenter', function () {
            $('.SpinIng-id-fenLeiRight2').css({
                'display': 'block'
            });
        }).on('mouseleave', function () {
            $('.SpinIng-id-fenLeiRight2').css({
                'display': 'none'
            });
        });
        $('.SpinIng-id-fenLeiRight2').on('mouseenter', function () {
            $(this).css({
                'display': 'block'
            });
        }).on('mouseleave', function () {
            $(this).css({
                'display': 'none'
            });
        });
        $('.SpinIng-id-yhTc1202 ul li').on('click', function () {
            var index = $(this).index();
            $(this).addClass('SpinIng-id-yhTcRed');
            $(this).find('div').addClass('SpinIng-id-popup');
            $(this).siblings('li').removeClass('SpinIng-id-yhTcRed');
            $(this).siblings('li').find('div').removeClass('SpinIng-id-popup');
            $('#fadeInOut').children().eq(index).show().siblings('div').hide();
        });
        $('#search').on('click',function () {
            var val = $('#SpinIng-id-hir').val();
            _self.searchList(val);
        });
        //滚动到指定位置
        $('.SpinIng-id-left ul li').on('click', function () {
            var index = $(this).index();
            switch (index) {
                case 0:
                    $.scrollTo('#double11', 200);
                    break;
                case 1:
                    $.scrollTo('#newSp', 200);
                    break;
                case 2:
                    $.scrollTo('#hot', 200);
                    break;
                case 3:
                    $.scrollTo('#Package', 200);
                    break;
                case 4:
                    $.scrollTo('#suite', 200);
                    break;
                case 5:
                    $.scrollTo('#quilt', 200);
                    break;
                case 6:
                    $.scrollTo('#Pillow', 200);
                    break;
                case 7:
                    $.scrollTo('#home', 200);
                    break;
                case 8:
                    $.scrollTo('#blanket', 200);
                    break;
                case 9:
                    $.scrollTo('#mattress', 200);
                    break;
                case 10:
                    $.scrollTo('#nym', 200);
                    break;
                default:
            }

        });
    },
    /*
     搜索列表
     */
    searchList: function (val) {
        $.get(objTest.url + 'index.php/api/goods/goods_list', { Keyword: val, Uid: 1, token: 1, _debug: 1 }, function(data) {
            if(data.error == 0) {
                window.location.href = 'goodsList.html?key=' + val;
            } else {
                alert('网络连接失败，请重试！');
            }
        },'json');
    }
};
index.prototype.init.prototype = index.prototype;

//商品列表1
var Goods = function () {
    return new Goods.prototype.init();
};
Goods.prototype = {
    obj: 1,
    init: function () {
        var self = this;
        $('.open').on('click', function(event) {
            var $this = $(this);
            self.openHeight($this, self.obj, event.type);
        });
        $('.cart').mouseenter(function() {
            $(this).attr('src', 'images/cartRed.jpg');
        }).mouseleave(function() {
            $(this).attr('src', 'images/cartGray.jpg');
        });
        $('.love').mouseenter(function() {
            $(this).attr('src', 'images/loveYellow.jpg');
        }).mouseleave(function() {
            $(this).attr('src', 'images/loveGray.jpg');
        });
    },
    /*
     三角形旋转
     */
    openHeight: function (self, state, type) {
        var _self = this;
        if(state === 1 && type === 'click') {
            self.children('i').css('transform','rotate(180deg)');
            _self.obj--;
            self.parents('.SpinIng-gl-row1').children('div').eq(0).addClass('SpinIng-gl-moreAfter2');
            self.parents('.SpinIng-gl-row1').children('div').eq(1).addClass('SpinIng-gl-moreMr25').removeClass('SpinIng-gl-moreMr251');
        } else if(state === 0) {
            self.children('i').css('transform','rotate(0deg)');
            _self.obj++;
            self.parents('.SpinIng-gl-row1').children('div').eq(0).addClass('SpinIng-gl-moreAfter').removeClass('SpinIng-gl-moreAfter2');
            self.parents('.SpinIng-gl-row1').children('div').eq(1).addClass('SpinIng-gl-moreMr251').removeClass('SpinIng-gl-moreMr25');
        }

    }
};
Goods.prototype.init.prototype = Goods.prototype;

//商品详情
var GoodDp = function () {
    return new GoodDp.prototype.init();
};
GoodDp.prototype = {
    init: function () {
        var self = this,
            iddArr = [1,2,3],
            up = document.getElementById('up'),
            upBlur = '';
        self.TotalQuantity(iddArr);
        self.UpDown();
        $('#tb-switch li').on('click', function () {
            $(this).addClass('selected').find('div').addClass('tb-selected-indicator');
            $(this).siblings('li').find('div').removeClass('tb-selected-indicator').css({
                'border-bottom': '1px solid #e5e5e5'
            });
            $(this).siblings('li').removeClass('selected SpinIng-gd-ed');
            if($(this).index() == 0) {
                DataIndex(1,2,3);
            } else if($(this).index() == 1) {
                DataIndex(2,1,3);
            } else {
                DataIndex(3,1,2);
            }
            function DataIndex(s, h1, h2) {
                $('#dataCorr'+s).show();
                $('#dataCorr'+h1).hide();
                $('#dataCorr'+h2).hide();
            }
        });
        //验证采购数量
        for(var i = 1, l = iddArr.length + 1; i < l; i++) {
            (function (i) {
                upBlur = document.getElementById('upBlur' + i);
                objTest.addEvent(upBlur, 'keyup', function () {
                    (this.v = function() {
                        this.value = this.value.replace(/[^0-9]+/, '');
                    }).call(this);
                });
                objTest.addEvent(upBlur, 'blur', function () {
                    try {
                        this.v();
                    } catch (e) {
                        console.log('方法不存在！');
                    }
                });
            })(i);
        }
    },
    /*
     计算采购数量和总价
     */
    TotalQuantity: function (id) {
        var rd = '',
            sib = '';
        for(var i = 0, l = id; i < l.length + 1; i++) {
            rd = document.getElementById('reduce' + i);
            objTest.addEvent(rd, 'click', function () {
                var _self = this;
                sib = siblings(_self);
                sum(sib);
            });
        }
        function sum(sib) {
            sib[1].value++;
            topV();
            if(sib[1].value > 0) {
                sib[0].style.cursor = 'pointer';
                objTest.addEvent(sib[0], 'click', reduce);
            } else {
                sib[0].style.cursor = 'not-allowed';
                sib[0].removeEventListener('click', reduce, false);
            }
        }
        function siblings(elm) {
            var a = [];
            var p = elm.parentNode.children;
            for(var i = 0, pl = p.length; i < pl; i++) {
                if(p[i] !== elm) {
                    a.push(p[i]);
                }
            }
            return a;
        }
        function reduce() {
            var sib0 = siblings(this)[0].value--;
            topV();
            if(sib0 <= 1) {
                this.removeEventListener('click', reduce, false);
                this.style.cursor = 'not-allowed';
            }
        }
        function topV() {
            var topMenus = getClass('input','SpinIng-gd-text'),
                topV = 0,
                total = 0;
            for(var j = 1, k = id.length + 1; j < k; j++) {
                total += document.getElementById('SpinIng-gd-tr' + j).childNodes[5].innerText.split('￥')[1] * document.getElementById('SpinIng-gd-tr' + j).childNodes[7].childNodes[1].children[1].value;
            }
            document.getElementById('total').innerHTML = total + '.00';
            for(var i = 0; i < topMenus.length; i++) {
                topV += parseInt(topMenus[i].value);
            }
            document.getElementById('piece').innerHTML = topV + '';
        }
        function getClass (tagName,className) {
            if(document.getElementsByClassName) {
                return document.getElementsByClassName(className);
            } else {
                var tags = document.getElementsByTagName(tagName);
                var tagArr = [];
                for(var i = 0; i < tags.length; i++) {
                    if(tags[i].class == className) {
                        tagArr[tagArr.length] = tags[i];
                    }
                }
                return tagArr;
            }
        }
    },
    /*
     热卖推荐轮播
     */
    UpDown: function () {
        function $ (id) {
            return typeof id === "string" ? document.getElementById(id) : id;
        }
        function $$ (elem, oParent) {
            return (oParent || document).getElementsByTagName(elem);
        }
        function $$$ (className, oParent) {
            var aClass = [];
            var reClass = new RegExp("(//s|^)" + className + "($|//s)");
            var aElem = $$("*", oParent);
            for (var i = 0; i < aElem.length; i++) reClass.test(aElem[i].className) && aClass.push(aElem[i]);
            return aClass
        }
        function Roll () {
            this.initialize.apply(this, arguments)
        }
        Roll.prototype = {
            initialize: function (obj) {
                var _this = this;
                this.obj = $(obj);
                this.oUp = $$$("up", this.obj)[0];
                this.oDown = $$$("down_zzjs__net", this.obj)[0];
                this.oList = $$$("list_wwwzzjsnet", this.obj)[0];
                this.aItem = this.oList.children;
                this.timer = null;
                this.iHeight = this.aItem[0].offsetHeight;
                this.oUp.onclick = function () {
                    _this.up()
                };
                this.oDown.onclick = function () {
                    _this.down()
                }
            },
            up: function () {
                this.oList.insertBefore(this.aItem[this.aItem.length - 1], this.oList.firstChild);
                this.oList.style.top = -this.iHeight + "px";
                this.doMove(0)
            },
            down: function () {
                this.doMove(-this.iHeight, function () {
                    this.oList.appendChild(this.aItem[0]);
                    this.oList.style.top = 0;
                })
            },
            doMove: function (iTarget, callBack) {
                var _this = this;
                clearInterval(this.timer);
                this.timer = setInterval(function () {
                    var iSpeed = (iTarget - _this.oList.offsetTop) / 5;
                    iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
                    _this.oList.offsetTop == iTarget ? (clearInterval(_this.timer),
                    callBack && callBack.apply(_this)) : _this.oList.style.top = iSpeed + _this.oList.offsetTop + "px";
                }, 10)
            }
        };
        new Roll("SpinIng-gd-box");
    }
};
GoodDp.prototype.init.prototype = GoodDp.prototype;

//购物车
var shopCart = function () {
    return new shopCart.prototype.init();
};
shopCart.prototype = {
    all: 'all',
    array: [],
    init: function () {
        var _this = this,
            $this,
            slideRed = $('.SpinIng-sc-slideRed'),
            checkAll = $('#checkAll'),
            SpinIngCk = $('.SpinIng-sc-ck'),
            set = $('.SpinIng-sc-set'),
            siLength = SpinIngCk.find('img').length;
        $('.SpinIng-sc-ulCur li').on('click mouseenter', function (event) {
            var $this = $(this);
            var offLeft = slideRed.position().left;
            _this.slide($this, slideRed, offLeft, event.type);
        });
        set.on('click', function () {
            window.location.href = 'reLogistics.html';
        });
        //删除购物车商品
        $('.SpinIng-gd-fz142').on('click', function() {
            $this = $(this);
            $('#my-confirm').modal();
        });
        $('#sc-confirm').on('click', function () {
            $this.parent().remove();
            siLength--;
        });
        //购物车全选
        checkAll.on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            _this.checkAll($this, SpinIngCk, _this, siLength);
        });
        SpinIngCk.on('click', function (e) {
            e.preventDefault();
            var b = $(this).find('img');
            $(this).find('img').attr('src') ? aaa() : bbb();
            function aaa() {
                b.attr('src', '');
                _this.array.pop();
                if(siLength >= _this.array.length) {
                    console.log(111);
                    checkAll.find('img').attr('src', '');
                }
            }
            function bbb() {
                _this.array.push(1);
                b.attr('src', 'images/check.jpg');
                if(siLength <= _this.array.length) {
                    console.log(111);
                    checkAll.find('img').attr('src', 'images/check.jpg');
                }
            }
        })
    },
    /*
     全选反选
     */
    checkAll: function (self, son, $this, sl) {
        var state = $this.all;
        var init = {
            attr: function (self, son, img) {
                self.find('img').attr('src', img);
                son.find('img').attr('src', img);
            }
        };
        switch(state) {
            case 'all':
                init['attr'](self, son, 'images/check.jpg');
                $this.all = 'side';
                for(var i = son.find('img').length; i--;) {
                    Array.prototype.push.call($this.array, i);
                }
                break;
            case 'side':
                if(sl <= $this.array.length) {
                    if($this.array.length > 0) {
                        console.log(11);
                    }
                    init['attr'](self, son, '');
                    $this.all = 'all';
                    $this.array.splice(0, $this.array.length);
                } else {
                    for(var l = $this.array.length; l++;) {
                        Array.prototype.push.call($this.array, l);
                        if(sl <= $this.array.length) {
                            init['attr'](self, son, 'images/check.jpg');
                            return false;
                        }
                    }
                }
                break;
            default:
                break;
        }
    },
    slide: function (self, slideRed, left, type) {
        var nb = self.index();
        if(type === 'click') {
            $('#threeTab ul:eq('+nb+')').show().siblings().hide();
        }
        console.log();
        var end = self.outerWidth(true) * self.index();
        slideRed.stop(true, true).animate({
            'left': end
        },'fast');
        self.mouseleave(function () {
            slideRed.stop(true, true).animate({
                'left': left
            },0);
        });
    }
};
shopCart.prototype.init.prototype = shopCart.prototype;

//确认收货地址及物流方式
var shopLogistics = function () {
    return new shopLogistics.prototype.init();
};
shopLogistics.prototype = {
    state: 'open',
    init: function () {
        var self = this;
        self.location(); //地址三级联动
        self.address(); //鼠标移动到地址框上及选中效果
        //千家万纺商品物流选择
        $('.SpinIng-rl-labVa').on('click', function () {
            $(this).removeClass('SpinIng-rl-bdc');
            $(this).find('img').attr('src', 'images/check.jpg');
            $(this).parents('.SpinIng-rl-div48').siblings('div').children('.SpinIng-rl-labVa').addClass('SpinIng-rl-bdc');
            $(this).parents('.SpinIng-rl-div48').siblings('div').find('.SpinIng-rl-labVa img').attr('src', '');
        });
        //显示全部地址
        $('.SpinIng-rl-tr14').on('click', function () {
            var seLeCt = $('.SpinIng-rl-selection');
            seLeCt.append('<div class="SpinIng-rl-ik245 SpinIng-rl-ik2452" style="">' +
                '<h1 class="SpinIng-rl-lh38">夏日香气</h1> ' +
                '<span class="SpinIng-rl-i14">上海市闵行区浦江镇知新村二组25号上海市闵行区浦江镇知新村二组25号市闵行区浦江镇</span> ' +
                '<p class="SpinIng-rl-14666">15955376598</p> ' +
                '</div>');
            $(this).hide();
            seLeCt.css({
                height: 'auto'
            });
            self.address();
        });
        //新增收货地址验证
        $("#addressForm").checkForm();
        //设置为默认收货地址
        $('#checkAll').on('click', function () {
            var state = self.state;
            switch(state) {
                case "open":
                    $(this).find('img').attr('src', 'images/check.jpg');
                    self.state = 'shut';
                    return false;
                    break;
                case "shut":
                    $(this).find('img').attr('src', '');
                    self.state = 'open';
                    return false;
                    break;
                default:
                    break;
            }
        });
        //返回购物车
        $('.SpinIng-sc-shopBt').on('click', function () {
            window.location.href = "shoppingCart.html"
        });
        //确认收货地址及物流方式
        $('.SpinIng-sc-set').on('click', function () {
            window.location.href = "spinningReel.html"
        })
    },
    location: function () {
        var province = $('#province'),
            city = $('#city'),
            county = $('#county'),
            select = '',
            select2 = '',
            select3 = '',
            select4 = '';
        $.get(objTest.url + '/index.php/Passport/Share/province', function(data) {
            for (var i = 0, l = data.length; i < l; i++) {
                select += '<option value='+data[i]['pid']+'>'+data[i]['province_name']+'</option>';
            }
            province.append('<option value="">请选择</option>' + select);
            province.on('change', function () {
                county.find("option").remove();
                var selfVal = $(this).val();
                if(selfVal > 0) {
                    select2 = '';
                    $.get(objTest.url + '/index.php/Passport/Share/getcity/cityid/' + selfVal, function(data2) {
                        for (var j = 0, k = data2.length; j < k; j++) {
                            select2 += '<option value='+data2[j]['cid']+'>'+data2[j]['city_name']+'</option>';
                        }
                        city.find("option").remove();
                        city.append(select2);

                        var firVal = city.find('option:first').val();

                        $.get(objTest.url + '/index.php/passport/share/getcounty/cid/' + firVal, function(data4) {
                            select4 = '';
                            for (var c = 0, d = data4.length; c < d; c++) {
                                select4 += '<option value='+data4[c]['did']+'>'+data4[c]['district_name']+'</option>';
                            }
                            county.find("option").remove();
                            county.append(select4);
                        },'json');

                        city.on('change', function () {
                            var cityVal = $(this).val();
                            $.get(objTest.url + '/index.php/passport/share/getcounty/cid/' + cityVal, function(data3) {
                                select3 = '';
                                for (var a = 0, b = data3.length; a < b; a++) {
                                    select3 += '<option value='+data3[a]['did']+'>'+data3[a]['district_name']+'</option>';
                                }
                                county.find("option").remove();
                                county.append(select3);
                            },'json');
                        });
                    },'json');
                } else {
                    city.html('');
                }
            });
        },'json');
    },
    address: function () {
        $('.SpinIng-rl-selection .SpinIng-rl-ik245').mouseenter(function () {
            if(!$(this).hasClass('SpinIng-rl-onBg')) {
                $(this).css({
                    'background': 'url(images/bg_address_selected.png) no-repeat'
                });
            }
        }).mouseleave(function () {
            $(this).removeAttr("style");
        }).on('click', function () {
            $(this).removeAttr("style");
            $(this).addClass('SpinIng-rl-onBg').removeClass('SpinIng-rl-ik2452');
            $(this).siblings('div').removeClass('SpinIng-rl-onBg').addClass('SpinIng-rl-ik2452');
        });
    }
};
shopLogistics.prototype.init.prototype = shopLogistics.prototype;