//数组--每一个数组元素都是一个键值对的对象
var config = [{
        width: 400,
        top: 20,
        left: 50,
        opacity: 0.2,
        zIndex: 2
    }, //0
    {
        width: 600,
        top: 70,
        left: 0,
        opacity: 0.8,
        zIndex: 3
    }, //1
    {
        width: 800,
        top: 100,
        left: 200,
        opacity: 1,
        zIndex: 4
    }, //2
    {
        width: 600,
        top: 70,
        left: 600,
        opacity: 0.8,
        zIndex: 3
    }, //3
    {
        width: 400,
        top: 20,
        left: 750,
        opacity: 0.2,
        zIndex: 2
    } //4
];
// 1 先把所有的图片散开
window.onload = function() {
    var imgList = $id("slide").children[0].children;

    function rotate() {
        for (var i = 0; i < imgList.length; i++) {
            animatev5(imgList[i], config[i]);
        }
    }

    rotate();

    $id("wrap").onmouseover = function() {
        animatev5($id("arrow"), { "opacity": 1 });
    }
    $id("wrap").onmouseout = function() {
        animatev5($id("arrow"), { "opacity": 0 });
    }

    $id("arrRight").onclick = function() {
        config.push(config.shift());
        rotate();
    }

    $id("arrLeft").onclick = function(){
        config.unshift(config.pop());
        rotate();
    }
}