var searchjson = {
    'after': 0,
    'before': 0,
    'owner': '',
    'type': [],
    'notename':[],
    'keyword': '',
    'mytype': [],
    'jids':[],
    'member':[],
    'uids':[],
    'labelname':[],
    'labels':[],
    'userselect':[],
    'jiluselect':[]
};
var modUrl=MOD_URL;
if(typeof jid != 'string'){
    var jid = '';
}
if(typeof type != 'string'){
    var type = '';
}
//判断搜索条件是否为空
function ishascondition() {
    for (var o in searchjson) {
        if (searchjson[o] != false) {
            jQuery('#emptysearchcondition').removeClass('hide');
            return true;
        }
    }
    return false;
}
jQuery(document).ready(function(e) {
    //特定的人开始
	//用户名分割问题
    //按成员搜索
    jQuery("#input-member").select2({
        placeholder: __lang.input_username_search,
        separator: ",",
        multiple:true,
        ajax: {
            url: modUrl+'&op=ajax&do=getusers'  ,
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    name: term,
                    page: page
                };
            },
            results: function(data, page) {
                var more = (page * 30) < data.count;
                return {
                    results: data.items,
                    more: more
                };
            }
        }
    }).on('change',function (e) {
        jQuery(this).val();
        if (searchjson['owner']) {
            if(searchjson['owner'] instanceof Array){
                usernamearr = searchjson['owner'];
            } else {
                usernamearr = searchjson['owner'].split(',');
            }
        } else {
            usernamearr = [];
        }
        
        if (typeof e.added != 'undefined') {
            var username = e.added.text;
            var userindex = jQuery.inArray(username, usernamearr);
            if (userindex == -1) {
                usernamearr.push(username);
            }
        } else if (typeof e.removed != 'undefined') {
            var username = e.removed.text;
            var userindex = jQuery.inArray(username, usernamearr);
            if (userindex != -1) {
                usernamearr.splice(userindex, 1);
            }
        }
        var val=jQuery(this).val();
        ownerstr = usernamearr.join(',');
        searchjson['owner'] = ownerstr;
        searchjson['uids']=val;
        searchConditionChange();
        return false;

    })
    //按记录本搜索
    var notesarr=[];
    jQuery("#input-notes").select2({
        placeholder: __lang.input_jiluname_search,
        separator: ",",
        multiple:true,
        ajax: {
            url: modUrl+'&op=ajax&do=getjilus&method=recycle' ,
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    title: term,
                    page: page
                };
            },
            results: function(data, page) {
                var more = (page * 30) < data.count;
                return {
                    results: data.items,
                    more: more
                };
            }
        }
    }).on('change',function (e) {
        jQuery(this).val();
        if (searchjson['notename'].length > 0) {
            if(searchjson['notename'] instanceof Array){
                notesarr = searchjson['notename'];
            } else {
                notesarr = searchjson['notename'].split(',');
            }
            
        } else {
            notesarr = [];
        }

        if (typeof e.added != 'undefined') {
            var notename = e.added.text;
            var noteindex = jQuery.inArray(notename, notesarr);
            if (noteindex == -1) {
                notesarr.push(notename);
            }
        } else if (typeof e.removed != 'undefined') {
            var notename = e.removed.text;
            var noteindex = jQuery.inArray(notename, notesarr);
            if (noteindex != -1) {
                notesarr.splice(noteindex, 1);
            }
        }
        var val=jQuery(this).val();
        notestr = notesarr.join(',');
        searchjson['notename'] = notestr;
        searchjson['jids']=val;
        searchConditionChange();
        return false;
    })

	//特定的人结束
	//特定的日期
	jQuery("#selectStart,#selectEnd").datepicker({ //添加日期选择功能
		numberOfMonths: 1, //显示几个月
		showButtonPanel: false, //是否显示按钮面板
		dateFormat: 'yy-mm-dd', //日期格式
		clearText: __lang.clear, //清除日期的按钮名称
		closeText: __lang.close, //关闭选择框的按钮名称
		yearSuffix: __lang.year, //年的后缀
		showMonthAfterYear: true, //是否把月放在年的后面
		constrainInput: true,
		maxDate: new Date(),
		setDate: 'date',
	
	});
});
//多条件搜索提交
jQuery('#conditionSearchFile').click(function () {
    searchStart();
});
//点击搜索图标搜索
jQuery(document).on('click', '.input-search-icon', function () {
    searchStart();
});
//点击重置搜索条件
jQuery(document).on('click', '.resetting', function () {
    resetting_condition();
});
jQuery('#searchval').on('keyup',function (event) {//回车搜索
	if (event.which !="") { e = event.which; }
	else if (event.charCode != "") { e = event.charCode; }
	else if (event.keyCode != "") { e = event.keyCode; }

	if(e==13){
		parseSearchInputVal(jQuery(this).val(),e);
        jQuery('.dropdown-width').hide();
        jQuery('.input-search-width').removeClass('dzz-arrow-dropup').addClass(' dzz-arrow-dropdown');
	}
});
jQuery('#searchval').focus(function (e) {//头部搜索框变颜色
    var hascondition = ishascondition();
    var placeval=jQuery(this).val();
    jQuery(this).parent().addClass('focus');
    if(!hascondition){
		jQuery('.dropdown-width').show();
        jQuery('.input-search-width').removeClass('dzz-arrow-dropdown').addClass('dzz-arrow-dropup');
	}
	dropdown_off();

});


jQuery('#searchval').blur(function (e) {//失去焦点时
	var hascondition = ishascondition();
    if (!hascondition) {
        jQuery('#emptysearchcondition').addClass('hide');
    }
})

//清空搜索框
jQuery(document).on('click', '#emptysearchcondition', function () {
    jQuery(this).addClass('hide');
   // allowseracrinputwrite = true;
	resetting_condition();
	jQuery('#searchval').val('').focus();
})

var emptypreg = /^\s*jQuery/i;
function show_more_search_condition(e) {
    //时间
    if(searchjson['after'] && !searchjson['before']){
        var day = getRecentNum(searchjson['after']);
        var dayarr = [1,-1,-7,-30,-90];
        if(jQuery.inArray(day,dayarr) > -1){
            var text =jQuery('.searchdate').find('li a[data-val="' + day + '"]').text();
            jQuery('.searchdate').closest('.dropdown-type').find('.anytime').text(text);
        }else{ //自定义时间
            var text = jQuery('.searchdate').find('li a[data-val="datetime"]').text();
            jQuery('.searchdate').closest('.dropdown-type').find('.anytime').text(text);
            jQuery('.searchdate').parents('.dropdown-type').find('.typexdate').show();
            jQuery('#selectStart').datepicker('setDate',searchjson['after']);
            jQuery('#selectEnd').datepicker('setDate',searchjson['before']);
        }
	}else if(!searchjson['after'] && !searchjson['before']){
		  var text = jQuery('.searchdate').find('li a[data-val="all"]').text();
			jQuery('.searchdate').closest('.dropdown-type').find('.anytime').text(text);
			jQuery('.searchdate').parents('.dropdown-type').find('.typexdate').hide();
		
    }else{
        var text = jQuery('.searchdate').find('li a[data-val="datetime"]').text();
        jQuery('.searchdate').closest('.dropdown-type').find('.anytime').text(text);
        jQuery('.searchdate').parents('.dropdown-type').find('.typexdate').show();
        jQuery('#selectStart').datepicker('setDate',searchjson['after']);
        jQuery('#selectEnd').datepicker('setDate',searchjson['before']);
    }


    if (searchjson['keyword']) {
        jQuery('#resourcesname').val(searchjson['keyword']);
    }
    //用户、记录本设置（搜索形式）
    if (typeof searchjson['userselect'] != 'undefined' && searchjson['userselect'] && jQuery('#input-member').length > 0) {
        $('#input-member').select2('data', searchjson['userselect']);
    }
    if (typeof searchjson['jiluselect'] != 'undefined' && searchjson['jiluselect'] && jQuery('#input-notes').length > 0) {
        $('#input-notes').select2('data', searchjson['jiluselect']);
    }
    //记录本
    jQuery(".jilu-dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
        })
    if (typeof searchjson['jids'] != 'undefined' && searchjson['jids'].length > 0) {
        jQuery(".jilu-dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
            for( var i in searchjson['jids'] ) {
                if(searchjson['jids'][i] == jQuery(this).val()) {
                    jQuery(this).prop("checked", true);
                }
            }
        })
    }
    //用户
    jQuery(".member-dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
        })
    if (typeof searchjson['uids'] != 'undefined' &&searchjson['uids'].length > 0) {
        jQuery(".member-dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
            for(var i in searchjson['uids'] ) {
                if( searchjson['uids'][i] == jQuery(this).val()) {
                    jQuery(this).prop("checked", true);
                }
            }
        })
    }
    //标签
    jQuery(".label-dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
        })
    if (typeof searchjson['labels'] != 'undefined' && searchjson['labels'].length > 0) {
        jQuery(".label-dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
            for(var i in searchjson['labels'] ) {
                if( searchjson['labels'][i] == jQuery(this).val()) {
                    jQuery(this).prop("checked", true);
                }
            }
        })
    }

    //mytype筛选
    jQuery(".mytype_dropdown").find("input").each(function(){
            jQuery(this).prop("checked", false);
        })
    if (typeof searchjson['mytype'] != 'undefined' && searchjson['mytype'].length > 0 ) {
        for ( var i in searchjson['mytype'] ) {
            if (searchjson['mytype'][i] == 'myfllow') {
                jQuery(".mytype_dropdown").find("input[value='myfllow']").prop("checked", true);
            }
            if (searchjson['mytype'][i] == 'mycooper') {
                jQuery(".mytype_dropdown").find("input[value='mycooper']").prop("checked", true);
            }
            if (searchjson['mytype'][i] == 'mycreate') {
                jQuery(".mytype_dropdown").find("input[value='mycreate']").prop("checked", true);
            }
        }
    }
    if (jQuery('.dropdown-width').is(":hidden")) {
        jQuery('.dropdown-width').show();
        jQuery('.input-search-width').removeClass('dzz-arrow-dropdown').addClass('dzz-arrow-dropup');
		dropdown_off();
    } else {
        jQuery('.dropdown-width').hide();
        jQuery('.input-search-width').removeClass('dzz-arrow-dropup').addClass(' dzz-arrow-dropdown');
    }
    e.stopPropagation();
}

//根据当前时间获取相差天数
function getRecentNum(date) {
    var now = new Date().getTime();
    var end = new Date(date).getTime();
    var chaTime = now - end;
    var days = Math.floor(chaTime / (24 * 3600 * 1000));
    if (days == 0) {
        return 1;
    }
    return parseInt('-' + days);
}

jQuery('.input-search-width').click(function (event) {//搜索框三角点击
    show_more_search_condition(event);
	 jQuery('.dropdown-height').hide();
});
function dropdown_off(){
	jQuery('.input-search').addClass('focus');
	jQuery(document).off('mousedown.headersearch').on('mousedown.headersearch',function(e) {//关闭搜索内容
		if(jQuery(event.target).closest('.input-search,.ui-datepicker').length<1){
			jQuery('.dropdown-width').hide();
			jQuery('#searchval').trigger('blur');
			jQuery('.input-search').removeClass('focus');
            jQuery('.input-search-width').removeClass('dzz-arrow-dropup').addClass(' dzz-arrow-dropdown');
			jQuery(document).off('mousedown.headersearch')
		}
	});
}

jQuery('.dropdown-width .close').click(function () {//关闭搜索内容
    jQuery('.dropdown-width').hide();
    jQuery('.input-search-width').removeClass('dzz-arrow-dropup').addClass(' dzz-arrow-dropdown');
});


//头部搜索框中类型选择开始

//设置筛选框的值
function searchConditionChange() {
    ishascondition();
    var searcharr = [];
    for (var o in searchjson) {
        if (searchjson[o] != false && o != 'mytype' && o != 'uids' && o != 'jids' && o != 'labels' && o != 'userselect' && o != 'jiluselect') {
            if(!searchjson[o]) continue;
            if(searchjson[o] instanceof  Array){
                searcharr.unshift(o + ':' + searchjson[o].toString() + ' ');
            } else {
                searcharr.unshift(o + ':' + searchjson[o] + ' ');
            }
        }
    }
    var searchval = searcharr.join(' ');
    jQuery('#searchval').val(searchval);
}

var usernamearr = [];

//指定时间
jQuery('.dropdown-type .searchdate li').click(function () {
    var val = jQuery(this).find('a').data('val');
    if (typeof val == 'undefined' || val == 'all') {
        val = '';
    }
    //日期选择器
    if (val == 'datetime') {
        jQuery(this).parents('.dropdown-type').find('.typexdate').show();
        var text = jQuery(this).text();
        jQuery(this).closest('.dropdown-type').find('.anytime').text(text);
    } else {
        jQuery(this).parents('.dropdown-type').find('.typexdate').hide();
        if (val != '') {
            val = getRecentDate(val);
        }
        searchjson['after'] = val;
        var text = jQuery(this).text();
        jQuery(this).closest('.dropdown-type').find('.anytime').text(text);
        searchConditionChange();
    }
})

jQuery('#selectStart').change(function () {
    var start = jQuery('#selectStart').val();
    var end = jQuery('#selectEnd').val();
    if (jQuery('#selectStart').val() != '' &&jQuery('#selectEnd').val() != '') {
        var satrtdate = new Date(start);
        var enddate = new Date(end);
        if (enddate.getTime() < satrtdate.getTime()) {
            showmessage(__lang.starttime_not_gt_enttime,'danger',1000,1);
            return false;
        }
    }
    searchjson['after'] = start;
    searchConditionChange();
})
jQuery('#selectEnd').change(function () {
    var start = jQuery('#selectStart').val();
    var end = jQuery('#selectEnd').val();
    if (satrtdate != '' && enddate != '') {
        var satrtdate = new Date(start);
        var enddate = new Date(end);
        if (enddate.getTime() < satrtdate.getTime()) {
            showmessage(__lang.starttime_not_gt_enttime,'danger',1000,1);
            return false;
        }
    }
    searchjson['before'] = end;
    searchConditionChange();
});

//筛选
jQuery(document).on('click','.dropdown-type .choose-li .search-li',function () {
    if(!searchjson['mytype']) searchjson['mytype'] = [];
    if(!searchjson['type']) searchjson['type'] = [];
    var obj = jQuery(this).find('input[name="choose"]');
    if(obj.prop('checked')==true) {
        obj.prop('checked',false);
    }else if(obj.prop('checked')==false) {
        obj.prop('checked',true);
    }
    if (obj.prop('checked')) {
        var pname = obj.next('label').text();
        var val = obj.val();
        searchjson['mytype'].push(val);
        searchjson['type'].push(pname);
    } else {
        var pname = obj.next('label').text();
        var val = obj.val();
        if (jQuery.inArray(val, searchjson['mytype']) != -1) {
            searchjson['mytype'].splice(jQuery.inArray(val, searchjson['mytype']), 1);
        }
        if (jQuery.inArray(pname, searchjson['type']) != -1) {
            searchjson['type'].splice(jQuery.inArray(pname, searchjson['type']), 1);
        }
    }
    searchConditionChange();
})
//按记录本筛选
jQuery(document).on('click','.dropdown-type .note-ul .note-item',function () {
    if(!searchjson['jids']) searchjson['jids'] = [];
    if(!searchjson['notename']) searchjson['notename'] = [];
    var obj = jQuery(this).find('input[name="note-name"]');
    if(obj.prop('checked')==true) {
        obj.prop('checked',false);
    }else if(obj.prop('checked')==false) {
        obj.prop('checked',true);
    }
    if (obj.prop('checked')) {
        var pname = obj.next('label').text();
        var val = obj.val();
        searchjson['jids'].push(val);
        searchjson['notename'].push(pname);
    } else {
        var pname = obj.next('label').text();
        var val = obj.val();

        if (jQuery.inArray(val, searchjson['jids']) != -1) {
            searchjson['jids'].splice(jQuery.inArray(val, searchjson['jids']), 1);
        }

        if (jQuery.inArray(pname, searchjson['notename']) != -1) {
            searchjson['notename'].splice(jQuery.inArray(pname, searchjson['notename']), 1);
        }
    }
    searchConditionChange();
})
//按成员筛选
jQuery(document).on('click','.dropdown-type .member-ul .member-item',function () {
    if(!searchjson['uids']) searchjson['uids'] = [];
    if(!searchjson['owner']) searchjson['owner'] = [];
    var obj = jQuery(this).find('input[name="user"]');
    if(obj.prop('checked')==true) {
        obj.prop('checked',false);
    }else if(obj.prop('checked')==false) {
        obj.prop('checked',true);
    }
    if (obj.prop('checked')) {
        var pname = obj.parents('.avatar-face').next().text();
        var val = obj.val();
        searchjson['uids'].push(val);
        searchjson['owner'].push(pname);
    } else {
        var pname = obj.parents('.avatar-face').next().text();
        var val = obj.val();
        if (jQuery.inArray(val, searchjson['uids']) != -1) {
            searchjson['uids'].splice(jQuery.inArray(val, searchjson['uids']), 1);
        }
        if (jQuery.inArray(pname, searchjson['owner']) != -1) {
            searchjson['owner'].splice(jQuery.inArray(pname, searchjson['owner']), 1);
        }
    }
    searchConditionChange();
})
//按标签筛选
jQuery(document).on('click','.dropdown-type .label-ul .label-item',function () {
    if(!searchjson['labels']) searchjson['labels'] = [];
    if(!searchjson['labelname']) searchjson['labelname'] = [];
    var obj = jQuery(this).find('input[name="label"]');
    if(obj.prop('checked')==true) {
        obj.prop('checked',false);
    }else if(obj.prop('checked')==false) {
        obj.prop('checked',true);
    }
    if (obj.prop('checked')) {
        var pname = obj.next('label').text();
        var val = obj.val();
        searchjson['labels'].push(val);
        searchjson['labelname'].push(pname);
    } else {
        var pname = obj.next('label').text();
        var val = obj.val();

        if (jQuery.inArray(val, searchjson['labels']) != -1) {
            searchjson['labels'].splice(jQuery.inArray(val, searchjson['labels']), 1);
        }

        if (jQuery.inArray(pname, searchjson['labelname']) != -1) {
            searchjson['labelname'].splice(jQuery.inArray(pname, searchjson['labelname']), 1);
        }
    }
    searchConditionChange();
})
//根据前几天或后几天获取日期函数
function getRecentDate(num) {
    var now = new Date;
    if (num != 1) {
        now.setDate(now.getDate() + num);//获取num天后的日期
    }
    var y = now.getFullYear();
    var m = (now.getMonth() + 1) < 10 ? '0' + (now.getMonth() + 1) : (now.getMonth() + 1);
    var d = now.getDate() < 10 ? '0' + now.getDate() : now.getDate();
    return y + '-' + m + '-' + d;
}

//输入框值发生改变
jQuery('#searchval').change(function(){
    var val = jQuery(this).val();
    parseSearchInputVal(val);
});

//开始执行搜素
function searchStart(){
    var loading = '<div class="w-load2" id="loadfirst">'
                +   '<div class="loader">'
                +       '<div class="loader-inner ball-beat">'
                +           '<div></div>'
                +           '<div></div>'
                +           '<div></div>'
                +        '</div>'
                +    '</div>'
                +  '</div>';
    jQuery("#itemContainer").html(loading);
    jQuery("#loadfirst").show();
    jQuery('.dropdown-width').hide();
    jQuery('.input-search-width').removeClass('dzz-arrow-dropup').addClass(' dzz-arrow-dropdown');
    var val = jQuery('#searchval').val();
    if (emptypreg.test(val)) {
        return false;
    }
    parseSearchInputVal(val);
    execute_search();
}
//处理输入框值
function parseSearchInputVal(val,e){
        var emptyprge = /\s+/;
        var questryjson = {
                            'after': 0,
                            'before': 0,
                            'keyword': '',
                            'type': [],
                            'owner':[],
                            'notename':[],
                            'labels': [],
                            'labelname':[],
                            'uids': [],
                            'userselect': [],
                            'jiluselect': [],
                        };
        val = val.split(emptyprge);
        var splitstr = /\s*:\s*/;
        for(var o in val){
            if(splitstr.test(val[o])){
                var arr =  val[o].split(splitstr);
                if(typeof questryjson[arr[0]] != 'undefined'){
                    if(questryjson[arr[0]] instanceof  Array){
                        questryjson[arr[0]] = arr[1].split(',');
                    } else {
                        questryjson[arr[0]] = arr[1];
                    }
                }
            }else{
                questryjson['keyword'] += val[o];
            }

        }
        createQueryStr(questryjson,e);
}
//根据输入框值生成搜索条件执行搜索
function createQueryStr(json,e){
    if(json['type'].length > 0){
        var mytype = [];
        var type_t = [];
        for (var i in json['type']) {
            if(json['type'][i] == __lang.my_follow){
                type_t.push(__lang.my_follow);
                mytype.push('myfllow');
            }
            if(json['type'][i] == __lang.my_cooper){
                type_t.push(__lang.my_cooper);
                mytype.push('mycooper');
            }
            if(json['type'][i] == __lang.my_create){
                type_t.push(__lang.my_create);
                mytype.push('mycreate');
            }
        }
        json['mytype'] = mytype;
        json['type'] = type_t;
    }


    if(json['notename'].length > 0 || json['owner'].length > 0 || json['labelname'].length > 0){
        var data = {'username':[], 'jilu':[]};
        if(json['owner'].length > 0){
            data['username'] = json['owner'];
        }
        if(json['notename'].length > 0){
            data['jilu'] = json['notename'];
        }
        if(json['labelname'].length > 0){
            data['labelname'] = json['labelname'];
        }
        
        jQuery.post(modUrl+'&op=ajax&do=parseinputcondition&jid='+jid,data, function(data){
            if(data.jids){
                json['notename'] = data.notename;
                json['jids'] = data.jids;
                json['jiluselect'] = data.jilu;
            } else {
                json['notename'] = [];
                json['jids'] = [];
                json['jiluselect'] = [];
            }
            if(data.uids){
                json['owner'] = data.owner;
                json['uids'] = data.uids;
                json['userselect'] = data.user;
            } else {
                json['owner'] = [];
                json['uids'] = [];
                json['userselect'] = [];
            }
            if(data.labels){
                json['labels'] = data.labels;
                json['labelname'] = data.labelname;
            } else {
                json['labels'] = [];
                json['labelname'] = [];
            }
            searchjson = json;
            searchConditionChange();
            if(e == 13) execute_search();
        }, 'json')
    } else {
        searchjson = json;
        searchConditionChange();
        if(e == 13) execute_search();
    }

}
//生成搜索条件值
function searchvalbuild() {
    var searchSubmitCondition = {"after": 0, "before": 0, "mytype": [], "name": 0, "uids": 0, "jids": 0, "labels": [],'keyword':0};
    for (var o in searchSubmitCondition) {
        if (searchjson[o]) {
            searchSubmitCondition[o] = searchjson[o];
        }
    }

    return searchSubmitCondition;
}

//执行搜索
function execute_search() {
    var searchSubmitCondition = searchvalbuild();
    jQuery.post(ajaxurl+'&do=loadmore&type='+type,searchSubmitCondition,function(html){
        jQuery('#itemContainer').html(html);
    });
    var querystr = '';
    for (var o in searchSubmitCondition) {
        if (!searchSubmitCondition[o] || searchSubmitCondition[o].length == 0) {
            continue;
        }
        querystr += o + '=' + searchSubmitCondition[o] + '&';
    }
    querystr = querystr.substr(0, querystr.length - 1);
    var requeststr = encodeURIComponent(querystr);
    location.hash = '#search&searchtype=' + requeststr;

}
// jQuery(function () {
//     setSearchValue();
// })
function isHash(){
    var hash=location.hash;
    var searchstr = hash.replace(/#search&searchtype=/, '');
    var searchval = decodeURIComponent(searchstr);
    if(searchval) {
        return searchval;
    } else {
        return false;
    }
}
//页面刷新 根据hash值设置searchjson
function setSearchValue() {
    var hash=location.hash;
    var searchstr = hash.replace(/#search&searchtype=/, '');
    var searchval = decodeURIComponent(searchstr);
    //请求参数
    var searcharr = searchval.split('&');
    for (var i in searcharr) {
        var arr_temp = searcharr[i].split('=');
        switch(arr_temp[0])
        {
            case 'after':
                searchjson['after'] = arr_temp[1];

            break;

            case 'before':
                searchjson['before'] = arr_temp[1];
            break;

            case 'mytype':
                for (var i = arr_temp[1].split(',').length - 1; i >= 0; i--) {
                    if(arr_temp[1].split(',')[i] == 'myfllow'){
                      searchjson['type'].push(__lang.my_follow);  
                    }
                    if(arr_temp[1].split(',')[i] == 'mycooper'){
                      searchjson['type'].push(__lang.my_cooper);  
                    }
                    if(arr_temp[1].split(',')[i] == 'mycreate'){
                      searchjson['type'].push(__lang.my_create);  
                    }
                    searchjson['mytype'].push(arr_temp[1].split(',')[i]);
                }
            break;

            case 'keyword':
                searchjson['keyword'] = arr_temp[1];
            break;
            case 'jids':
                for (var i = arr_temp[1].split(',').length - 1; i >= 0; i--) {
                    searchjson['jids'].push(arr_temp[1].split(',')[i]);
                }
            break;
            case 'uids':
                for (var i = arr_temp[1].split(',').length - 1; i >= 0; i--) {
                    searchjson['uids'].push(arr_temp[1].split(',')[i]);
                }
            break;
            case 'labels':
                for (var i = arr_temp[1].split(',').length - 1; i >= 0; i--) {
                    searchjson['labels'].push(arr_temp[1].split(',')[i]);
                }
            break;
        }
    }
    if (searchjson['uids'].length > 0 || searchjson['jids'].length > 0 || searchjson['labels'].length > 0) {
        //获取用户名和记录本名
        jQuery.post(modUrl+'&op=ajax&do=getsearchval&jid='+jid, {'uids':searchjson['uids'],'jids':searchjson['jids'], 'labels':searchjson['labels']}, function(data){
            if(data.user){
                for (var i in data['user']) {
                    searchjson['owner'] += data['user'][i] + ',';
                    searchjson['userselect'].push({'id':i, 'text':data['user'][i]});
                }
                searchjson['owner'] = searchjson['owner'].substr(0, searchjson['owner'].length - 1);
            }
            if(data.jilu){
                for (var i in data['jilu']) {
                    searchjson['jiluselect'].push({'id':i, 'text':data['jilu'][i]});
                    searchjson['notename'].push(data['jilu'][i]);
                }
            }
            if(data.label){
                searchjson['labelname'] = [];
                for(var i in data['label']) {
                    searchjson['labelname'].push(data['label'][i][1]);
                }
            }
            setSearchCondition();
            execute_search();
        },'json')
    } else {
        setSearchCondition();
        execute_search();
    }
}
//重置函数
function resetting_condition() {
    jQuery('.dropdown-type').each(function () {
        var obj = jQuery(this);
        var text = obj.find("a[data-val='all']").text();
        obj.find('.anytime').text(text);
        obj.find('.typexdate').hide();
        obj.find('.typeowner').hide();
    });
    jQuery('.checkbox-custom').find('input:checkbox').prop('checked', false);
  	 jQuery('#emptysearchcondition').addClass('hide');
    jQuery('#id_label_multiples').select2('data', '');
    jQuery('#input-member').select2('data','');
    jQuery('#input-notes').select2('data','');
    jQuery('#selectStart').val('');
    jQuery('#selectEnd').val('');
    jQuery('#resourcesname').val('');
    searchjson = {
        'after': 0,
        'before': 0,
        'owner': 0,
        'type': [],
        'notename':[],
        'keyword': 0,
        'mytype': [],
        'jids':[],
        'member':[],
        'uids':[],
        'labelname':[],
        'labels':[]
    };
	jQuery('#searchval').val('');
}

//设置搜索框的值
function setSearchCondition() {
    ishascondition();
    var arr = [];
    for (var o in searchjson) {
        if (searchjson[o] != false && o != 'uids' && o != 'jids' && o != 'labels' && o != 'mytype' && o != 'userselect' && o != 'jiluselect') {
            if(searchjson[o] instanceof  Array){
                arr.unshift(o + ':' + searchjson[o].toString() + '');
            } else {
                arr.unshift(o + ':' + searchjson[o] + ' ');
            }
        }
    }
    var searchval = arr.join(' ');
    jQuery('#searchval').val(searchval);

}
function unique(arr) {
    var res = [];
    var json = {};
    for (var i = 0; i < arr.length; i++) {
        if (!json[arr[i]]) {
            res.push(arr[i]);
            json[arr[i]] = 1;
        }
    }
    return res;
}
//搜索页面js结束