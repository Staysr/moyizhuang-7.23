/**
 * Created by Administrator on 2016/9/24.
 * 动态计算FontSize
 */
(function () {
    //动态计算fonSize
    this.rootNodeFontSize = function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            reCalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';
            };
        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, reCalc, false);
        doc.addEventListener('DOMContentLoaded', reCalc, false);
    }(document, window);
    //loading加载
    this.PageLoading = function (options) {
        var defaults = {
            opacity: 1,
            backgroundColor: "#fff",
            loadingTips: "",
            TipsColor: "#666",
            delayTime: 0,
            zIndex: 999,
            sleep: 0
        };
        var options = $.extend(defaults, options);
        var _PageHeight = document.documentElement.clientHeight,
            _PageWidth = document.documentElement.clientWidth;
        var _LoadingHtml = '<div id="loadingPage" style="position:fixed;left:0;top:0;_position: absolute;width:100%;height:' + _PageHeight + 'px;background:' + options.backgroundColor + ';opacity:' + options.opacity + ';filter:alpha(opacity=' + options.opacity * 100 + ');z-index:' + options.zIndex + ';"><div id="loadingTips" style="position: absolute; width: 40px;; height: 32px; background: ' + options.backgroundColor + ' url(images/loading.gif) no-repeat 5px center; color:' + options.TipsColor + '; font-size: 0px;">' + options.loadingTips + '</div></div>';
        $("body").append(_LoadingHtml);
        var _LoadingTipsH = document.getElementById("loadingTips").clientHeight,
            _LoadingTipsW = document.getElementById("loadingTips").clientWidth;

        var _LoadingTop = _PageHeight > _LoadingTipsH ? (_PageHeight - _LoadingTipsH) / 2 : 0,
            _LoadingLeft = _PageWidth > _LoadingTipsW ? (_PageWidth - _LoadingTipsW) / 2 + 40 / 4 : 0;

        $("#loadingTips").css({
            "left": _LoadingLeft + "px",
            "top": _LoadingTop + "px"
        });
        document.onreadystatechange = PageLoaded;
        function PageLoaded () {
            if (document.readyState == "complete") {
                var loadingMask = $('#loadingPage');
                setTimeout(function () {loadingMask.animate({"opacity": 0}, options.delayTime, function () {
                    $(this).hide();
                    $(this).remove();
                });}, options.delayTime);
            }
        }
    }({sleep: 3000000000});
})();