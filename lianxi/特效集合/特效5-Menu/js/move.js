/**
 * Created by wm on 2017/5/24.
 */
function getStyle(obj, attr)
{
    if(obj.currentStyle)
    {
        return obj.currentStyle[attr];
    }
    else
    {
        return getComputedStyle(obj, false)[attr];
    }
}
function startMove(obj, json, fnEnd)
{
    clearInterval(obj.timer);
    var attr;
    obj.timer=setInterval(function (){

        var bStop=true;		//鏄笉鏄兘鍒颁簡锛屽亣璁炬墍鏈夌殑閮藉埌浜�

        for(attr in json)
        {
            var iCur=0;

            //鍙栧綋鍓嶄綅缃�
            if(attr=='opacity')
            {
                iCur=Math.round(parseFloat(getStyle(obj, attr))*100);
            }
            else
            {
                iCur=parseInt(getStyle(obj, attr));
            }

            //绠楅€熷害
            var iSpeed=(json[attr]-iCur)/8;
            iSpeed=iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);

            //鍒版病鍒�

            if(attr=='opacity')
            {
                obj.style.filter='alpha(opacity:'+(iCur+iSpeed)+')';
                obj.style.opacity=(iCur+iSpeed)/100;
            }
            else
            {
                obj.style[attr]=iCur+iSpeed+'px';
            }

            if(iCur!=json[attr])
            {
                bStop=false;
            }
        }

        if(bStop)
        {
            clearInterval(obj.timer);
            if(fnEnd)
            {
                fnEnd();
            }
        }
        //alert(obj.offsetHeight);
    }, 30);
}