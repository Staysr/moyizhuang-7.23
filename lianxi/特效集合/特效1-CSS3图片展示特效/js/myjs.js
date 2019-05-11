/**
 * Created by wm
 */
function getByClass(oParent, sClass) {
    var aEle = oParent.getElementsByTagName('*');
    var re = new RegExp('\\b' + sClass + '\\b', 'i');
    var aResult = [];

    for (var i = 0; i < aEle.length; i++) {
        if (re.test(aEle[i].className)) {
            aResult.push(aEle[i]);
        }
    }

    return aResult;
}

function getEle(sExp, oParent) {
    var aResult = [];
    var i = 0;

    oParent || (oParent = document);

    if (oParent instanceof Array) {
        for (i = 0; i < oParent.length; i++)aResult = aResult.concat(getEle(sExp, oParent[i]));
    }
    else if (typeof sExp == 'object') {
        if (sExp instanceof Array) {
            return sExp;
        }
        else {
            return [sExp];
        }
    }
    else {
        //xxx, xxx, xxx
        if (/,/.test(sExp)) {
            var arr = sExp.split(/,+/);
            for (i = 0; i < arr.length; i++)aResult = aResult.concat(getEle(arr[i], oParent));
        }
        //xxx xxx xxx 或者 xxx>xxx>xxx
        else if (/[ >]/.test(sExp)) {
            var aParent = [];
            var aChild = [];

            var arr = sExp.split(/[ >]+/);

            aChild = [oParent];

            for (i = 0; i < arr.length; i++) {
                aParent = aChild;
                aChild = [];
                for (j = 0; j < aParent.length; j++) {
                    aChild = aChild.concat(getEle(arr[i], aParent[j]));
                }
            }

            aResult = aChild;
        }
        //#xxx .xxx xxx
        else {
            switch (sExp.charAt(0)) {
                case '#':
                    return [document.getElementById(sExp.substring(1))];
                case '.':
                    return getByClass(oParent, sExp.substring(1));
                default:
                    return [].append(oParent.getElementsByTagName(sExp));
            }
        }
    }

    return aResult;
}

//cookie
function setCookie(name, value, iDay) {
    if (iDay !== false) {
        var oDate = new Date();
        oDate.setDate(oDate.getDate() + iDay);

        document.cookie = name + '=' + value + ';expires=' + oDate + ';path=/';
    }
    else {
        document.cookie = name + '=' + value;
    }
}
function getCookie(name) {
    var arr = document.cookie.split('; ');
    var i = 0;

    for (i = 0; i < arr.length; i++) {
        var arr2 = arr[i].split('=');

        if (arr2[0] == name) {
            return arr2[1];
        }
    }

    return '';
}

//弹性运动
var zns =
    {
        site:			//官网空间
            {
                fx: {},			//效果
                z: {}			//后台接口
            },
        app:			//移动端空间
            {
                z: {}			//后台接口
            }
    };

zns.site.fx.browser_test = {};
(function () {
    var flex = zns.site.fx.flex;
    var buffer = zns.site.fx.buffer;
    var linear = zns.site.fx.linear;

    zns.site.fx.browser_test.IE6 = window.navigator.userAgent.search(/MSIE 6/) != -1;
    zns.site.fx.browser_test.IE7 = window.navigator.userAgent.search(/MSIE 7/) != -1;
    zns.site.fx.browser_test.IE8 = window.navigator.userAgent.search(/MSIE 8/) != -1;
    zns.site.fx.browser_test.IE9 = window.navigator.userAgent.search(/MSIE 9/) != -1;
    zns.site.fx.browser_test.IE10 = window.navigator.userAgent.search(/MSIE 10/) != -1;

    zns.site.fx.browser_test.createDOM = function () {
        var oDiv = document.createElement('div');

        oDiv.className = 'browser_alert';
        oDiv.innerHTML =
            '<a href="javascript:;" title="关闭" class="browser_close"></a>' +
            '<p class="browser_title">您的浏览器版本过低</p>' +
            '<p class="browser_content">' +
            '本网站采用了HTML5技术进行开发，所以低版本浏览器将无法展现网站的全部效果，建议您升级浏览器，然后进行访问。<br><br>' +
            '<em>因为网页使用了Web3D技术，所以在没有显卡的计算机上，升级浏览器后仍会收到此提示，这时您将仍无法查看部分3D效果</em>' +
            '</p>' +
            '<p class="browser_btn">' +
            '<a href="http://www.google.cn/chrome" class="upgrade" target="_blank"></a><a href="support_list.html" class="testing" target="_blank"></a><a href="javascript:;" class="prompt"></a>' +
            '</p>';

        document.body.appendChild(oDiv);
    };
    zns.site.fx.browser_test.create = function () {
        zns.site.fx.browser_test.createDOM();
        if (
            !Modernizr.csstransforms3d || !Modernizr.canvas || !Modernizr.geolocation || !Modernizr.websockets || !Modernizr.boxshadow || !Modernizr.cssanimations
        ) {
            var oAlert = getEle('.browser_alert')[0];
            var oBg = getEle('.shadow_bg')[0];
            var oClose = getEle('.browser_alert .browser_close')[0];
            var oBtnNotShowAgain = getEle('.browser_alert .prompt')[0];

            var ie6 = zns.site.fx.browser_test.IE6;
            var ie7 = zns.site.fx.browser_test.IE7;

            setTimeout(open, 1500);

            function open() {
                if (getCookie('zns_not_show_browser_test_again') == '1')return;
                oBg.style.display = 'block';
                oAlert.style.display = 'block';

                if (!ie6 && !ie7) {
                    buffer(oBg, {alpha: 0}, {alpha: 100}, function (now) {
                        oBg.style.filter = 'alpha(opacity: ' + now.alpha * 0.8 + ')';
                        oBg.style.opacity = now.alpha * 0.8 / 100;

                        oAlert.style.filter = 'alpha(opacity: ' + now.alpha + ')';
                        oAlert.style.opacity = now.alpha / 100;
                    }, function () {
                        oAlert.style.filter = '';
                        oAlert.style.opacity = 1;
                    });
                }
                else if (ie7) {
                    oBg.style.filter = 'alpha(opacity:80)';
                    oBg.style.opacity = 0.8;
                }
            }

            oClose.onclick = close;

            function close() {
                if (window.navigator.userAgent.search(/MSIE 6|MSIE 7/) == -1) {
                    buffer(oBg, {alpha: 100}, {alpha: 0}, function (now) {
                        oBg.style.filter = 'alpha(opacity: ' + now.alpha * 0.8 + ')';
                        oBg.style.opacity = now.alpha * 0.8 / 100;

                        oAlert.style.filter = 'alpha(opacity: ' + now.alpha + ')';
                        oAlert.style.opacity = now.alpha / 100;
                    }, function () {
                        oBg.style.display = 'none';
                        oAlert.style.display = 'none';
                    });
                }
                else {
                    oBg.style.display = 'none';
                    oAlert.style.display = 'none';
                }
            }

            oBtnNotShowAgain.onclick = function () {
                close();
                setCookie('zns_not_show_browser_test_again', '1', false);
            };
        }
    };
})();


zns.site.fx.buffer = function (obj, cur, target, fnDo, fnEnd, fs) {
    if (zns.site.fx.browser_test.IE6) {
        fnDo && fnDo.call(obj, target);
        fnEnd && fnEnd.call(obj, target);
        return;
    }

    if (!fs)fs = 6;
    var now = {};
    var x = 0;
    var v = 0;

    if (!obj.__last_timer)obj.__last_timer = 0;
    var t = new Date().getTime();
    if (t - obj.__last_timer > 20) {
        fnMove();
        obj.__last_timer = t;
    }

    clearInterval(obj.timer);
    obj.timer = setInterval(fnMove, 20);
    function fnMove() {
        v = Math.ceil((100 - x) / fs);

        x += v;

        for (var i in cur) {
            now[i] = (target[i] - cur[i]) * x / 100 + cur[i];
        }


        if (fnDo)fnDo.call(obj, now);

        if (Math.abs(v) < 1 && Math.abs(100 - x) < 1) {
            clearInterval(obj.timer);
            if (fnEnd)fnEnd.call(obj, target);
        }
    }
};
zns.site.fx.linear = function (obj, cur, target, fnDo, fnEnd, fs) {
    if (zns.site.fx.browser_test.IE6) {
        fnDo && fnDo.call(obj, target);
        fnEnd && fnEnd.call(obj, target);
        return;
    }
    if (!fs)fs = 50;
    var now = {};
    var x = 0;
    var v = 0;

    if (!obj.__last_timer)obj.__last_timer = 0;
    var t = new Date().getTime();
    if (t - obj.__last_timer > 20) {
        fnMove();
        obj.__last_timer = t;
    }

    clearInterval(obj.timer);
    obj.timer = setInterval(fnMove, 20);

    v = 100 / fs;
    function fnMove() {
        x += v;

        for (var i in cur) {
            now[i] = (target[i] - cur[i]) * x / 100 + cur[i];
        }

        if (fnDo)fnDo.call(obj, now);

        if (Math.abs(100 - x) < 1) {
            clearInterval(obj.timer);
            if (fnEnd)fnEnd.call(obj, target);
        }
    }
};
zns.site.fx.flex = function (obj, cur, target, fnDo, fnEnd, fs, ms) {
    if (zns.site.fx.browser_test.IE6) {
        fnDo && fnDo.call(obj, target);
        fnEnd && fnEnd.call(obj, target);
        return;
    }
    var MAX_SPEED = 16;

    if (!fs)fs = 6;
    if (!ms)ms = 0.75;
    var now = {};
    var x = 0;	//0-100

    if (!obj.__flex_v)obj.__flex_v = 0;

    if (!obj.__last_timer)obj.__last_timer = 0;
    var t = new Date().getTime();
    if (t - obj.__last_timer > 20) {
        fnMove();
        obj.__last_timer = t;
    }

    clearInterval(obj.timer);
    obj.timer = setInterval(fnMove, 20);

    function fnMove() {
        obj.__flex_v += (100 - x) / fs;
        obj.__flex_v *= ms;

        if (Math.abs(obj.__flex_v) > MAX_SPEED)obj.__flex_v = obj.__flex_v > 0 ? MAX_SPEED : -MAX_SPEED;

        x += obj.__flex_v;

        for (var i in cur) {
            now[i] = (target[i] - cur[i]) * x / 100 + cur[i];
        }


        if (fnDo)fnDo.call(obj, now);

        if (Math.abs(obj.__flex_v) < 1 && Math.abs(100 - x) < 1) {
            clearInterval(obj.timer);
            if (fnEnd)fnEnd.call(obj, target);
            obj.__flex_v = 0;
        }
    }
};
/**/

function setStyle3(obj, name, value) {
    obj.style['Webkit' + name.charAt(0).toUpperCase() + name.substring(1)] = value;
    obj.style['Moz' + name.charAt(0).toUpperCase() + name.substring(1)] = value;
    obj.style['ms' + name.charAt(0).toUpperCase() + name.substring(1)] = value;
    obj.style['O' + name.charAt(0).toUpperCase() + name.substring(1)] = value;
    obj.style[name] = value;
}
function setStyle(obj, json) {
    if (obj.length)
        for (var i = 0; i < obj.length; i++) setStyle(obj[i], json);
    else {
        if (arguments.length == 2)	//json
            for (var i in json) setStyle(obj, i, json[i]);
        else	//name, value
        {
            switch (arguments[1].toLowerCase()) {
                case 'opacity':
                    obj.style.filter = 'alpha(opacity:' + arguments[2] + ')';
                    obj.style.opacity = arguments[2] / 100;
                    break;
                default:
                    if (typeof arguments[2] == 'number') {
                        obj.style[arguments[1]] = arguments[2] + 'px';
                    }
                    else {
                        obj.style[arguments[1]] = arguments[2];
                    }
                    break;
            }
        }
    }
}