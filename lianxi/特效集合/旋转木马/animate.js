/**
 * Created by Invoker on 2016/12/1.
 */
function $id(id) {
    return document.getElementById(id);
}

function getStyle(element, attr) {
    return element.currentStyle ? element.currentStyle[attr] : window.getComputedStyle(element, null)[attr] || 0;
}

function animatev0(element, target) {
    clearInterval(element.timer);
    element.timer = setInterval(function() {
        var current = element.offsetLeft;
        var step = (target - current) / 10;
        step = step > 0 ? Math.ceil(step) : Math.floor(step);
        current += step;
        element.style.left = current + "px";
        if (current == target) {
            clearInterval(element.timer);
        }
    }, 20);
}

function animatev1(element, attr, target) {
    clearInterval(element.timer);
    element.timer = setInterval(function() {
        var current = parseInt(getStyle(element, attr));
        var step = (target - current) / 10;
        step = step > 0 ? Math.ceil(step) : Math.floor(step);
        current += step;
        element.style[attr] = current + "px";
        if (current == target) {
            clearInterval(element.timer);
        }
    }, 20);
}

function animatev2(element, json) {
    clearInterval(element.timer);
    element.timer = setInterval(function() {
        for (var key in json) {
            var current = parseInt(getStyle(element, key));
            var target = json[key];
            var step = (target - current) / 10;
            step = step > 0 ? Math.ceil(step) : Math.floor(step);
            current += step;
            element.style[key] = current + "px";
            if (current == target) {
                clearInterval(element.timer);
            }
        }
    }, 20);
}

function animatev3(element, json) {
    clearInterval(element.timer);
    element.timer = setInterval(function() {
        var flag = true;
        for (var key in json) {
            var current = parseInt(getStyle(element, key));
            var target = json[key];
            var step = (target - current) / 10;
            step = step > 0 ? Math.ceil(step) : Math.floor(step);
            current += step;
            element.style[key] = current + "px";;
            if (current != target) {
                flag = false;
            }
        }
        if (flag) {
            clearInterval(element.timer);
        }
    }, 20);
}

function animatev4(element, json, fn) {
    clearInterval(element.timer);
    element.timer = setInterval(function() {
        var falg = true;
        for (var key in json) {
            var current = parseInt(getStyle(element, key));
            var target = json[key];
            var step = (target - current) / 10;
            step = step > 0 ? Math.ceil(step) : Math.floor(step);
            current += step;
            element.style[key] = current + "px";
            if (current != target) {
                flag = false;
            }
        }
        if (flag) {
            clearInterval(element.timer);
            (fn && typeof(fn) == "functoin") && fn();
        }
    }, 20);
}

function animatev5(element, json, fn) {
    clearInterval(element.timer);
    element.timer = setInterval(function() {
        var flag = true;
        for (var key in json) {
            if (key == "opacity") {
                var current = getStyle(element, key) * 100 || 0;
                var target = json[key] * 100;
                var step = (target - current) / 10;
                step = step > 0 ? Math.ceil(step) : Math.floor(step);
                current += step;
                element.style[key] = current / 100;
            } else if (key == "zIndex") {
                element.style[key] = json[key];
            } else {
                var current = parseInt(getStyle(element, key)) || 0;
                var target = json[key];
                var step = (target - current) / 10;
                step = step > 0 ? Math.ceil(step) : Math.floor(step);
                current += step;
                element.style[key] = current + "px";
            }
            if (current != target) {
                flag = false;
            }
        }
        if (flag) {
            clearInterval(element.timer);
            (typeof fn == "function") && fn();
        }
    }, 20);
}