// JavaScript Document
var xmlhttp = false;      
//当指定XMLHttpRequest为异步传输时(false),发生任何状态的变化，该对象都会调用onreadystatechange所指定的函数  
if (window.XMLHttpRequest) {    //Mozilla、Safari等浏览器  
    xmlhttp = new XMLHttpRequest();  
}   
else if (window.ActiveXObject) {    //IE浏览器  
    try {  
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");  
    } catch (e) {  
        try {  
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
       } catch (e) {}  
    }  
}  