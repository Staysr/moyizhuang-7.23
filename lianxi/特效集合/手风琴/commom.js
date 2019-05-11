
function $id(id) {
    return document.getElementById(id);
}

/**
 * 获取元素计算过后样式的兼容写法
 * @param element   目标元素
 * @param attr  想要获取的属性
 * @returns {*} 对应属性的当前值
 */
function getStyle(element,attr) {
    return element.currentStyle ? element.currentStyle[attr] : window.getComputedStyle(element,null)[attr];
}