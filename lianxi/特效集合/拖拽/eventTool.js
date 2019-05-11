var eventTool = {
    //兼容的获取事件对象
    getEvent: function(e){
        return e || window.event;
    },
    //兼容的获取clientX
    getClientX:function(e){
        return this.getEvent(e).clientX;
    },
    getClientY:function(e){
        return this.getEvent(e).clientY;
    },

    //兼容获取pageX和pageY
    //pageX = clientX + 页面滚动出去的水平距离
    //pageY = clientY + 页面滚动出去的垂直距离
    getPageX:function(e){
        //return this.getEvent(e).pageX;
        ////不是谷歌？
        //var pageX = this.getClientX(e) + (window.pageXOffset || document.body.scrollLeft || document.documentElement.scrollLeft || 0);
        //return pageX;

        return this.getEvent(e).pageX || this.getClientX(e) + (window.pageXOffset || document.body.scrollLeft || document.documentElement.scrollLeft || 0);
    },
    getPageY:function(e){
        return this.getEvent(e).pageY || this.getClientY(e) + (window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop || 0);
    }
}
