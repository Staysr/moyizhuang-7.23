/**
 * Created by mona on 2016/12/13.
 */


/****获取scroll Top和left  用法: scroll().top; scroll().left;****/
function scroll() {
    if(window.pageYOffset!=null){//IE9和最新浏览器
        return{
            top:window.pageYOffset,
            left:window.pageXOffset
        }
    }else if(document.compatMode=='CSS1Compt'){//兼容火狐
        return{
            top:document.documentElement.scrollTop,
            left:document.documentElement.scrollLeft
        }
    }else {//兼容谷歌
        return{
            top:document.body.scrollTop,
            left:document.body.scrollLeft
        }
    }

}

function $(tag) {
    return document.getElementById(tag);
}







