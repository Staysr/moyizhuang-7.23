    /**
      顶部滚动
     **/
var s,s2,s3,timer;
function init(){
s=getid("div1");
s2=getid("div2");
s3=getid("div3");
s3.innerHTML=s2.innerHTML;
timer=setInterval(mar,30)
}
function mar(){
if(s2.offsetWidth<=s.scrollLeft){
s.scrollLeft-=s2.offsetWidth;
}else{s.scrollLeft++;}
}
function getid(id){
return document.getElementById(id);
}
window.onload=init;