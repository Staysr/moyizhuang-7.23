function Clock() {
var date = new Date();
this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
this.toString = function() {
return this.hour + ":" + this.minute + ":" + this.second;
};
this.toSimpleDate = function() {
return this.year + "-" + this.month + "-" + this.date;
};
this.toDetailDate = function() {
return this.year + "-" + this.month + "-" + this.date + " " + this.hour + ":" + this.minute + ":" + this.second;
};
this.display = function(ele) {
var clock = new Clock();
ele.innerHTML = clock.toString();
window.setTimeout(function() {clock.display(ele);}, 1000);
};
}