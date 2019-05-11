/**
 * Created by wm on 2017/7/5.
 */
/* 无缝轮播*/
$(function () {
    /*
     * 1.添加定时器,让ul进行向左移动
     * 2.鼠标移入时,停止动画,当前为高亮,其它的兄弟变暗
     * 3.鼠标移出时,开始动画.
     * */

    /*1.定义属性记录当前的位置*/
    var leftX = 0;
    var timer = null;
    var imgLen = $('.slide li').width();
    console.log(imgLen);

    /*
     * 滚动图片
     * */
    function scrollPic() {
        timer = setInterval(function () {
            /*向左侧移动,值减小*/
            leftX += 3;

            /*当起到最后一个时,做复位操作*/
            if (leftX > 1200) {
                leftX = 0;
            }
            /*获取ul*/
            $('.slide ul').css({left:-leftX});

        },30);
    }
    scrollPic();

    /*2.处理鼠标移入事件*/
    $('.slide li').hover(function () {
        /*停止定时器*/
        clearInterval(timer);
        /*移入时调用*/
        $(this).fadeTo(300,1).siblings().fadeTo(300,0.3);
    },function () {
        /*移出时调用*/
        /*把所有设置为不透明*/
        $('.slide li').fadeTo(300,1);
        /*开始滚动*/
        scrollPic();
    });
});

/*tab */
$(function () {

    $(window).scroll(function () {
        var bottomH = 50;
        var windowH = $(window).height(); //console.log();//331
        var scollT = $(window).scrollTop();//console.log();
        var documentH = $(document).height();//console.log();//617
        var totleH = windowH + scollT + bottomH;
        if(totleH >= documentH){
            console.log(totleH);
            console.log(documentH);
            alert("超出了底部栏。需要加载数据了");
        }
    });

    //tab栏

    $(".tab .top li").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        //获取当前角标
        var index = $(this).index() + 1;
//            console.log(index);
        ajax(index);//展示内容

    });
    ajax(1);//默认显示第一个标签内容
    // url, data, callback, type
    function ajax(index) {
        $.get("tabdata.json",function (data) {
            //插入元素前情况内容
            $(".tab .con").empty();
            for (var i=0; i<data.length; i++){
                var val = data[i];
                if(val.type == index){
//                        console.log(data[i]);

                    var w1 = '<div class="show" id='+val.id+'>'+
                        '<div class="title">'+
                        '<span>| '+val.group+' |</span>'+
                        '<h3>'+val.title+'</h3>'+
                        '</div>'+
                        '<div class="bottom">'+
                        '<a target="_blank" href='+val.url+'>'+
                        '<img src='+val.img+' alt="">'+
                        '</a>'+
                        '<dl>'+
                        '<dt>'+val.introduce+'</dt>'+
                        '<dd>'+val.time+'</dd>'+
                        '<dd>'+val.author+'</dd>'+
                        '</dl>'+
                        '</div>'+
                        '</div>';
                    $(".tab .con").append(w1);
                }
                else {

                }
            }
        })
    }

})



