var eventTool = {
    //���ݵĻ�ȡ�¼�����
    getEvent: function(e){
        return e || window.event;
    },
    //���ݵĻ�ȡclientX
    getClientX:function(e){
        return this.getEvent(e).clientX;
    },
    getClientY:function(e){
        return this.getEvent(e).clientY;
    },

    //���ݻ�ȡpageX��pageY
    //pageX = clientX + ҳ�������ȥ��ˮƽ����
    //pageY = clientY + ҳ�������ȥ�Ĵ�ֱ����
    getPageX:function(e){
        //return this.getEvent(e).pageX;
        ////���ǹȸ裿
        //var pageX = this.getClientX(e) + (window.pageXOffset || document.body.scrollLeft || document.documentElement.scrollLeft || 0);
        //return pageX;

        return this.getEvent(e).pageX || this.getClientX(e) + (window.pageXOffset || document.body.scrollLeft || document.documentElement.scrollLeft || 0);
    },
    getPageY:function(e){
        return this.getEvent(e).pageY || this.getClientY(e) + (window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop || 0);
    }
}
