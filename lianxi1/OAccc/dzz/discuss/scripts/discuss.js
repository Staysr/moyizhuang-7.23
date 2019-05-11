/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

function favorite(obj){
	var el=jQuery(obj);
	jQuery.getJSON(el.attr('href'),function(json){
		if(json.error){
			showmessage(json.error,'error',1000,true);
		}else{
			showmessage(json.msg,'success',1000,true);
			if (json.status == 1) {
				el.html('<i class="color-i dzz dzz-star" style="font-size: 18px;vertical-align: -3px;"></i>&nbsp;__lang.cancel_favorite');
			} else {
				el.html('<i class="color-i dzz dzz-star" style="font-size: 18px;vertical-align: -3px;"></i>&nbsp;__lang.favorite');
			}
		}
	});
}

function discuss_reply_delete(pid,tid){
	if(confirm(__lang.true_delete)){
		jQuery.getJSON(DZZSCRIPT+'?mod=discuss&op=ajax&do=delete&pid='+pid,function(json){
			jQuery('#reply_'+pid).slideUp(500,function(){
				jQuery(this).remove();
			});
		});
	}
}
function discuss_reply_edit(pid,tid){
	jQuery('#reply_'+pid).load(DZZSCRIPT+'?mod=discuss&op=ajax&do=getReplyForm&tid='+tid+'&pid='+pid);
}
function discuss_attach_download(qid){
	var url=DZZSCRIPT+'?mod=discuss&op=down&qid='+qid;
	if(BROWSER.ie){
			window.open(url);
		}else{
			window.frames['hideframe'].location=url;
		}
}
function discuss_attach_saveto(qid){
	var url=DZZSCRIPT+'?mod=discuss&op=saveto&qid='+qid;
	window.frames['hideframe'].location=url;
	
}
function discuss_attach_preview(qid){
	var url=DZZSCRIPT+'?mod=discuss&op=preview&qid='+qid;
	window.frames['hideframe'].location=url;
	
}


function setatarget(v) {
	document.getElementById('atarget').className = 'y atarget_' + v;
	document.getElementById('atarget').onclick = function() {setatarget(v == 1 ? -1 : 1);};
	setcookie('atarget', v, 2592000);
}
function showTopLink() {
	var ft = document.getElementById('detail-container');
	if(ft){
		var scrolltop = document.getElementById('scrolltop');
		var viewPortHeight = parseInt(document.documentElement.clientHeight);
		var scrollHeight = parseInt(jQuery('.bs-main-container').scrollTop());
		var basew = parseInt(ft.clientWidth);
		var sw = scrolltop.clientWidth;
		if (basew < 1000) {
			var left = parseInt(fetchOffset(ft)['left']);
			left = left < sw ? left * 2 - sw : left;
			scrolltop.style.left = ( basew + left ) + 'px';
		} else {
			scrolltop.style.left = 'auto';
			scrolltop.style.right = 0;
		}

		if (BROWSER.ie && BROWSER.ie < 7) {
			scrolltop.style.top = viewPortHeight - scrollHeight - 150 + 'px';
		}
		if (scrollHeight>100) {
			scrolltop.style.visibility = 'visible';
		} else {
			scrolltop.style.visibility = 'hidden';
		}
	}
}


function modaction(action, pid, extra, mod) {
	if(!action) {
		return;
	}
	var mod = mod ? mod : DZZSCRIPT+'?mod=discuss&op=topicadmin';
	var extra = !extra ? '' : '&' + extra;
	if(!pid && in_array(action, ['delpost', 'banpost'])) {
		var checked = 0;
		var pid = '';
		for(var i = 0; i < document.getElementById('modactions').elements.length; i++) {
			if(document.getElementById('modactions').elements[i].name.match('topiclist')) {
				checked = 1;
				break;
			}
		}
	} else {
		var checked = 1;
	}
	if(!checked) {
		alert(__lang.please_chose_board);
	} else {
		document.getElementById('modactions').action = mod + '&action='+ action +'&fid=' + fid + '&tid=' + tid + '&handlekey=mods&infloat=yes&nopost=yes' + (!pid ? '' : '&topiclist[]=' + pid) + extra + '&r' + Math.random();
		showWindow('mods', 'modactions', 'post');
		if(BROWSER.ie) {
			doane(event);
		}
		hideMenu();
	}
}

function modthreads(optgroup, operation) {
	var operation = !operation ? '' : operation;
	document.getElementById('modactions').action = DZZSCRIPT+'?mod=discuss&op=topicadmin&action=moderate&fid=' + fid + '&moderate[]=' + tid + '&handlekey=mods&infloat=yes&nopost=yes' + (optgroup != 3 && optgroup != 2 ? '&from=' + tid : '');
	document.getElementById('modactions').optgroup.value = optgroup;
	document.getElementById('modactions').operation.value = operation;
	hideWindow('mods');
	showWindow('mods', 'modactions', 'post', 0);
	if(BROWSER.ie) {
		doane(event);
	}
}

function pidchecked(obj) {
	if(obj.checked) {
		try {
			var inp = document.createElement('<input name="topiclist[]" />');
		} catch(e) {
			try {
				var inp = document.createElement('input');
				inp.name = 'topiclist[]';
			} catch(e) {
				return;
			}
		}
		inp.id = 'topiclist_' + obj.value;
		inp.value = obj.value;
		inp.type = 'hidden';
		document.getElementById('modactions').appendChild(inp);
	} else {
		document.getElementById('modactions').removeChild(document.getElementById('topiclist_' + obj.value));
	}
}
/* @authorcode  codestrings */
var modclickcount = 0;
function modclick(obj, pid) {
	if(obj.checked) {
		modclickcount++;
	} else {
		modclickcount--;
	}
	document.getElementById('mdct').innerHTML = modclickcount;
	if(modclickcount > 0) {
		var offset = fetchOffset(obj);
		document.getElementById('mdly').style.top = offset['top'] - 65 + 'px';
		document.getElementById('mdly').style.left = offset['left'] - 235 + 'px';
		document.getElementById('mdly').style.display = '';
	} else {
		document.getElementById('mdly').style.display = 'none';
	}
}

function resetmodcount() {
	modclickcount = 0;
	document.getElementById('mdly').style.display = 'none';
}

function tmodclick(obj) {
	if(obj.checked) {
		modclickcount++;
	} else {
		modclickcount--;
	}
	document.getElementById('mdct').innerHTML = modclickcount;
	if(modclickcount > 0) {
		var top_offset = obj.offsetTop;
		while((obj = obj.offsetParent).id != 'threadlist') {
			top_offset += obj.offsetTop;
		}
		document.getElementById('mdly').style.top = top_offset - 7 + 'px';
		document.getElementById('mdly').style.display = '';
	} else {
		document.getElementById('mdly').style.display = 'none';
	}
}

function tmodthreads(optgroup, operation) {
	var checked = 0;
	var operation = !operation ? '' : operation;
	for(var i = 0; i < document.getElementById('moderate').elements.length; i++) {
		if(document.getElementById('moderate').elements[i].name.match('moderate') && document.getElementById('moderate').elements[i].checked) {
			checked = 1;
			break;
		}
	}
	if(!checked) {
		alert(__lang.please_chose_board);
	} else {
		document.getElementById('moderate').optgroup.value = optgroup;
		document.getElementById('moderate').operation.value = operation;
		hideWindow('mods');
		showWindow('mods', 'moderate', 'post', 0);
	}
}

function getthreadclass() {
	var fid = document.getElementById('fid');
	if(fid) {
		ajaxget(DZZSCRIPT+'?mod=discuss&op=ajax&od=getthreadclass&fid=' + fid.value, 'threadclass', null, null, null, showthreadclass);
	}
}
/* @authorcode  codestrings */
function showthreadclass() {
	try{
		document.getElementById('append_parent').removeChild(document.getElementById('typeid_ctrl_menu'));
	}catch(e) {}
	simulateSelect('typeid');
}

function createPalette(colorid, id, func) {
	var iframe = "<iframe name=\"c"+colorid+"_frame\" src=\"\" frameborder=\"0\" width=\"210\" height=\"148\" scrolling=\"no\"></iframe>";
	if (!$("c"+colorid+"_menu")) {
		var dom = document.createElement('span');
		dom.id = "c"+colorid+"_menu";
		dom.style.display = 'none';
		dom.innerHTML = iframe;
		document.getElementById('append_parent').appendChild(dom);
	}
	func = !func ? '' : '|' + func;
	window.frames["c"+colorid+"_frame"].location.href = SITEURL+"static/image/tool/getcolor.htm?c"+colorid+"|"+id+func;
	showMenu({'ctrlid':'c'+colorid});
	var iframeid = "c"+colorid+"_menu";
	_attachEvent(window, 'scroll', function(){hideMenu(iframeid);});
}
/* @authorcode  codestrings */

var checkForumcount = 0, checkForumtimeout = 30000, checkForumnew_handle;
function checkForumnew(fid, lasttime) {
	var timeout = checkForumtimeout;
	var x = new Ajax();
	x.get(DZZSCRIPT+'?mod=discuss&op=ajax&do=forumchecknew&fid=' + fid + '&time=' + lasttime + '&inajax=yes', function(s){
		if(s > 0) {
			var table = document.getElementById('separatorline').parentNode;
			if(!isUndefined(checkForumnew_handle)) {
				clearTimeout(checkForumnew_handle);
			}
			removetbodyrow(table, 'forumnewshow');
			var colspan = 20;//table.getElementsByTagName('tbody')[0].rows[0].children.length;
			var checknew = {'tid':'', 'thread':{'common':{'className':'', 'val':'<a href="javascript:void(0);" onclick="ajaxget(\''+DZZSCRIPT+'?mod=discuss&op=ajax&do=forumchecknew&fid=' + fid+ '&time='+lasttime+'&uncheck=1&inajax=yes\', \'forumnew\');">有新回复的主题，点击查看', 'colspan': colspan }}};
			addtbodyrow(table, ['thead'], ['forumnewshow'], 'separatorline', checknew);
		} else {
			if(checkForumcount < 50) {
				if(checkForumcount > 0) {
					var multiple =  Math.ceil(50 / checkForumcount);
					if(multiple < 5) {
						timeout = checkForumtimeout * (5 - multiple + 1);
					}
				}
				checkForumnew_handle = setTimeout(function () {checkForumnew(fid, lasttime);}, timeout);
			}
		}
		checkForumcount++;
	});

}
function checkForumnew_btn(fid) {
	if(isUndefined(fid)) return;
	ajaxget(DZZSCRIPT+'?mod=discuss&op=ajax&do=forumchecknew&fid=' + fid+ '&time='+lasttime+'&uncheck=2&inajax=yes', 'forumnew', 'ajaxwaitid');
	lasttime = parseInt(Date.parse(new Date()) / 1000);
}
/* @authorcode  codestrings */
function addtbodyrow(table, insertID, changename, separatorid, jsonval) {
	if(isUndefined(table) || isUndefined(insertID[0])) {
		return;
	}

	var insertobj = document.createElement(insertID[0]);
	var thread = jsonval.thread;
	var tid = !isUndefined(jsonval.tid) ? jsonval.tid : '' ;

	if(!isUndefined(changename[1])) {
		removetbodyrow(table, changename[1] + tid);
	}

	insertobj.id = changename[0] + tid;
	if(!isUndefined(insertID[1])) {
		insertobj.className = insertID[1];
	}
	if($(separatorid)) {
		table.insertBefore(insertobj, $(separatorid).nextSibling);
	} else {
		table.insertBefore(insertobj, table.firstChild);
	}
	var newTH = insertobj.insertRow(-1);
	for(var value in thread) {
		if(value != 0) {
			var cell = newTH.insertCell(-1);
			if(isUndefined(thread[value]['val'])) {
				cell.innerHTML = thread[value];
			} else {
				cell.innerHTML = thread[value]['val'];
			}
			if(!isUndefined(thread[value]['className'])) {
				cell.className = thread[value]['className'];
			}
			if(!isUndefined(thread[value]['colspan'])) {
				cell.colSpan = thread[value]['colspan'];
			}
		}
	}

	if(!isUndefined(insertID[2])) {
		_attachEvent(insertobj, insertID[2], function() {insertobj.className = '';});
	}
}
function removetbodyrow(from, objid) {
	if(!isUndefined(from) && $(objid)) {
		from.removeChild($(objid));
	}
}
/* @authorcode  codestrings */
