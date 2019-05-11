// 手机端左右滑动切换菜单栏
if ('ontouchstart' in document.documentElement) {
    var startX, startY, moveEndX, moveEndY, relativeX, relativeY, element;
    element = $('body', top.document);
    $("body").on("touchstart", function (e) {
        startX = e.originalEvent.changedTouches[0].pageX;
        startY = e.originalEvent.changedTouches[0].pageY;
    });
    $("body").on("touchend", function (e) {
        moveEndX = e.originalEvent.changedTouches[0].pageX;
        moveEndY = e.originalEvent.changedTouches[0].pageY;
        relativeX = moveEndX - startX;
        relativeY = moveEndY - startY;

        // 判断标准
        //右滑
        if (relativeX > 45) {
            if ((Math.abs(relativeX) - Math.abs(relativeY)) > 50) {
                element.addClass("sidebar-open");
            }
        }
        //左滑
        else if (relativeX < -45) {
            if ((Math.abs(relativeX) - Math.abs(relativeY)) > 50) {
                element.removeClass("sidebar-open");
            }
        }
    });
}