/**
 * Created by mona on 2016/12/13.
 */
window.onload=function () {
    //1.实现瀑布流
    waterFull('all','box');
    //2.实现滚动的瀑布流
    var timers=null;
    window.onscroll=function () {
        clearTimeout(timers);
        timers=setTimeout(function () {
            if(checkWillLoadNewImage()){
                // console.log('节流验证');
                //创建假数据
                var dateArr=[
                    {src:'4.jpg'},
                    {src:'10.jpg'},
                    {src:'11.jpg'},
                    {src:'13.jpg'},
                    {src:'14.jpg'},
                    {src:'19.jpg'},
                    {src:'16.jpg'},
                    {src:'20.jpg'},
                    {src:'18.jpg'}
                ]
                var all=document.getElementById('all');
                for(var i=0;i<dateArr.length;i++){
                    var newBox=document.createElement('div');
                    newBox.className='box';
                    all.appendChild(newBox);

                    var newPic=document.createElement('div');
                    newPic.className='pic';
                    newBox.appendChild(newPic);

                    var newImg=document.createElement('img');
                    newImg.src='images/'+dateArr[i].src;
                    newPic.appendChild(newImg);
                    // waterFull('all','box');
                }
                waterFull('all','box');

            }
        },100)

    }
    //3.监听屏幕宽的改变(下面有一处需清空style)
    var timer = null;//用一次定时器节流
    window.onresize = function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            // console.log('---------');//节流测试
            waterFull('all', 'box');

        }, 200)
}


}

function waterFull(parent,box) {
    var widthBox;
    var heightArr=[];
    var boxHeight;
    //1.父盒子居中
    var all=document.getElementById(parent);
    var aBox=all.children;
    //计算屏幕宽度
    var scrallX=document.documentElement.clientWidth;
    //计算列宽
    widthBox=aBox[0].offsetWidth;
    // console.log(widthBox);
    //计算列数
    var cols=parseInt(scrallX/widthBox);
    // alert(cols);
    //计算父盒子的宽度,设置水平居中
    all.style.width=cols * widthBox+'px';
    all.style.margin='0 auto';
    // console.log(widthBox);

    //2.子盒子居中
    //定义高度数组

    for(var i=0;i<aBox.length;i++){
        //获取每个盒子的高度
        boxHeight=aBox[i].offsetHeight;
        //取出第一行的盒子的高度放到数组中
        if(i<cols){
            heightArr.push(boxHeight);
            //在监听屏幕宽的事件中,需要给第一行的清空样式
            aBox[i].style='';
        }else {//剩余行
            //1.求出高度数组中最矮的盒子的高度
            var minBoxHeight=_.min(heightArr);
            // alert(minBoxHeight);
            // 求出最矮的盒子对应的索引
            var minBoxIndex=getMinBoxIndex(heightArr,minBoxHeight);
            // console.log('minBoxInde:'+minBoxIndex);
            //ring定位到最小盒子的位子
            aBox[i].style.position='absolute';
            aBox[i].style.left=minBoxIndex*widthBox+'px';
            aBox[i].style.top=minBoxHeight+'px';
            //更新盒子高度
            heightArr[minBoxIndex]+=boxHeight;
        }

    }

}
// 求出最矮的盒子对应的索引
function getMinBoxIndex(arr,val) {
    for(var i=0;i<arr.length;i++){
        if(arr[i]==val){
            return i;
        }
    }
}

//判断是否符合加载新图片
function checkWillLoadNewImage() {
    var aBox=document.getElementsByClassName('box');
    //求出最后一个盒子
    var lastBox=aBox[aBox.length-1];
    //最后一个盒子距离顶部的距离//最后一个盒子的高度
    var lastBoxTop = lastBox.offsetTop+lastBox.offsetHeight*0.5;

    //屏幕的高度
    var scallH=document.documentElement.clientHeight;
    //向上滚动的高度
    var scallTop=scroll().top;
     return (scallTop+scallH) >= lastBoxTop;//正值需要加载照片

}