function animate(element,target){
//先清除上一次动画的额计时器
    clearInterval(element.timer);
    //清除之后，开启档次动画的计时器
    element.timer =  setInterval(function(){
        //1 获取当前值
        var currentLeft = element.offsetLeft;
        //2 修改当前值 -- 两个不同的方向要判断处理
        //写一个步长，方便管理
        var step = 60;
        currentLeft += target >= currentLeft ? step : -step;
        //3 设置left属性
        element.style.left = currentLeft + "px";
        //4 停下来  -- 我们处理停下来的策略：  如果目标位置和当前位置的距离小于每次移动的距离，就停下来
        if( Math.abs(target - currentLeft) <= step){
            clearInterval(element.timer);
            element.style.left = target + "px";
        }
    },20);
}