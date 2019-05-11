<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:1:{s:86:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/orguser/template/detail_org.htm";i:1536850350;}*/?>
<style>
.progress-relative {
    position: relative;
    height: 30px;
    line-height: 22px;
    background-color: #e6e6e6;
overflow:visible;
padding:4px;
max-width:750px;
}
.progress-relative .progress-cover {
    position: absolute;
    text-align: center;
    width: 100%;
    font-size: 75%;
    color: #FFF;
    text-shadow: 1px 1px 1px #000;
    font-weight: 700;
}

</style>
<div class="main-header" style="line-height:34px;padding:3px 15px;">
<b id="title_orgname"><?php echo $org['orgname'];?> </b>
<?php if($_G['adminid']==1) { ?>
<a href="<?php echo ADMINSCRIPT;?>?mod=orguser&op=export&orgid=<?php echo $orgid;?>" class="btn btn-link pull-right" title="导出此部门的所有用户到excl文件" target="_blank">导出用户</a>
<?php } ?>
</div>
<div class="main-body" style="padding:15px 15px 15px 22px;">
<dl>
<dt>机构名称</dt>
<dd class="clearfix">
              <input type="text" id="orgname" data-oldname="<?php echo $org['orgname'];?>" class="form-control" value="<?php echo $org['orgname'];?>" placeholder="输入机构(群组)名称" onchange="set_org_orgname('<?php echo $org['orgid'];?>',this)">
        </dd>
     </dl> 
     <dl>
<dt>Logo</dt>
<dd class="clearfix" style="position:relative">

            <ul class="group-head">

                <li class="head-portrait">
<?php echo $org['avatar'];?>
                   
                    <div class="head-checkbox  hover" >
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" class="headinput-checkbox" name="arr[aid]" value="<?php echo $value['aid'];?>"
                                   checked="checked"  onchange="set_org_logo('<?php echo $org['orgid'];?>',this.value)">
                            
                        </div>
                    </div>
                </li>

                <li class="head-file">
                    <input type="file" style=" cursor: pointer;" onclick="upload_bgphoto(this,true)"> 
                    <button type="button" class="btn btn-primary" style="margin-top: 5px;cursor: pointer;">更换</button>
                </li>
            </ul>
         </dd>
     </dl>
      <dl>
<dt>简介</dt> 
        <dd class="clearfix">                 
             <textarea class="form-control setup-textarea" name="arr[desc]" rows="1" placeholder="输入机构(群组)简要介绍" onchange="set_org_desc('<?php echo $org['orgid'];?>',this.value)"><?php echo $org['desc'];?></textarea>
           </dd>
     </dl>   
      
<?php if($folder_available) { ?>
<dl>
<!--原共享目录设置：diron,此处暂时用来控制应用内是否开启共享目录，如网盘群组开关不开启，表示网盘内不显示该目录-->
<dt>共享目录设置</dt>
<dd class="clearfix">
<div class="radio-custom radio-primary pull-left"><input type="radio" id="folder_available_1" name="fid" value="1" <?php if($org['diron']>0) { ?>checked="checked"<?php } ?> onclick="folder_available(1,'<?php echo $orgid;?>');"  /><label>启用</label>
            </div>
            <div class="radio-custom radio-primary ml20 pull-left">
<input type="radio" id="folder_available_0" name="fid"  value="0" <?php if($org['diron']<1) { ?>checked="checked"<?php } ?> onclick="folder_available(0,'<?php echo $orgid;?>');" /><label>不启用</label>
            </div>
        </dd>
        <dd class="clearfix">
<?php if($org['forgid']<1) { ?>
<span class="help-inline ml20">开启后,可在网盘等应用中能够使用该机构或部门的目录。</span>
<?php } else { ?>
<span class="help-inline ml20">启用后，企业盘机构下才会显示此部门的共享目录。</span>
<?php } ?>
</dd>
</dl>
<dl id="indesk" style="display:none">
<dt>共享目录桌面快捷方式:</dt>
<dd class="clearfix">
<div class="radio-custom radio-primary pull-left"><input type="radio" id="folder_indesk_1" onclick="folder_indesk(1,'<?php echo $orgid;?>');" name="indesk" value="1" <?php if($org['indesk']>0) { ?>checked="checked"<?php } ?> /><label>创建</label></div>
<div class="radio-custom radio-primary ml20 pull-left"><input type="radio" id="folder_indesk_0" onclick="folder_indesk(0,'<?php echo $orgid;?>');" name="indesk" value="0" <?php if($org['indesk']<1) { ?>checked="checked"<?php } ?> /><label>不创建</label></div>

</dd>
        <dd class="clearfix">
       	 	<span class="help-inline ml20">创建快捷方式后，所属成员桌面默认都会有相应快捷方式。</span>
        </dd>
</dl>
<?php } ?>
    <?php if($group_on) { ?>
<!--	<dl>
<dt>群组功能设置</dt>
<dd class="clearfix">
<div class="radio-custom radio-primary pull-left"><input type="radio" id="folder_syatemon_1" name="syatemon" value="1" &lt;!&ndash;<?php if($org['manageon']>0) { ?>&ndash;&gt;checked="checked"&lt;!&ndash;<?php } ?>&ndash;&gt;      onclick="group_on(1,'<?php echo $orgid;?>');"  /><label>启用</label></div>
<div class="radio-custom radio-primary ml20 pull-left"><input type="radio" id="folder_syatemon_0" name="syatemon"  value="0" &lt;!&ndash;<?php if($org['manageon']<1) { ?>&ndash;&gt;checked="checked"&lt;!&ndash;<?php } ?>&ndash;&gt; onclick="group_on(0,'<?php echo $orgid;?>');" /><label>不启用</label></div>
        </dd>
        <dd class="clearfix">
&lt;!&ndash;<?php if($org['forgid']<1) { ?>&ndash;&gt;
<span class="help-inline ml20">开启后，资源管理器会显示该机构群组选项。</span>
&lt;!&ndash;<?php } else { ?>&ndash;&gt;
<span class="help-inline ml20">不开启，资源管理器不会显示该机构群组选项。</span>
&lt;!&ndash;<?php } ?>&ndash;&gt;
</dd>
</dl>-->
<?php } ?>
     <?php if($_G['adminid']==1 || $topmoderator) { ?>
    <dl>
    	<dt>分配空间大小</dt>
        <dd class="clearfix">
          <div  style="width:180px;display:inline-block">
          	<div class="input-group " >
            <input type="text" class="form-control input-sm" id="maxspacesize" style="width:146px;"  name="maxspacesize" value="<?php echo $org['maxspacesize'];?>" onchange="folder_maxspacesize(this,'<?php echo $orgid;?>')" />
            <span class="input-group-addon">M</span>
            </div> 
            
          </div> 
         <ul class="help-block" style="padding-left:10px">
        	 <li>当前可以分配的最大可用空间:<span class="text-danger"><?php echo ($allowallotspace == 0) ? lang('no_limit'):formatsize($allowallotspace);?></span></li>
        	  <li>单位M，留空或者0表示不限制，-1表示无空间</li><li>限制整个机构或部门（包括下级所有部门）可以使用的空间大小(机构下所有部门的空间使用总和不能超过这个限制）</li><li>部门分配的空间只能从上级部门的可用空间里面划分；一旦分配，上级部门的剩余空间就会相应减少，不够这些分配的空间是否实际使用完</li>
          </ul>
       </dd>
    </dl>
    <?php } ?>
     <dl>
    	<dt><?php if($org['forgid']>0) { ?>部门空间使用<?php } else { ?>机构总空间使用<?php } ?></dt>
        <dd class="clearfix">
          <div class="progress progress-relative" style="margin:0">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(100*($org[usesize]/($org[maxspacesize]?$org[maxspacesize]*1024*1024:($org[usesize]+1024*1024*1024))))?>%">

            <span class="sr-only"> <?php echo formatsize($org[usesize])?>/<?php if($org[maxallotspacesize] == -1) echo formatsize($org[usesize]);else echo ($org[maxallotspacesize] == 0)?lang('no_limit'):formatsize($org[maxallotspacesize])?> </span>
          </div>
          <div class="progress-cover"> <?php echo formatsize($org[usesize])?>/<?php if($org[maxallotspacesize] == -1) echo formatsize($org[usesize]);else echo ($org[maxallotspacesize] == 0)?lang('no_limit'):formatsize($org[maxallotspacesize])?></div>
        </div>
         <ul class="help-block" style="padding-left:10px">
            <li>限制整个机构或部门（包括下级所有部门）可以使用的空间大小</li><li>下级部门分配的空间会从上级的可用空间里面分配</li>
          </ul>
       </dd>
       </dl>
   

<dl>
<dt>职位管理</dt>
<dd class="clearfix jobs"><?php if(is_array($jobs)) foreach($jobs as $value) { ?><div id="job_<?php echo $value['jobid'];?>" orgid="<?php echo $value['orgid'];?>" class="job-item-edit pull-left mb10">
<button onclick="job_show_editor('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>', this)" class="btn btn-simple job-name mr20"><?php echo $value['name'];?></button>
<div class="edit hide" style="min-width:250px">
<div class="job-edit-control pull-left">
<input type="text" class="form-control" value="<?php echo $value['name'];?>" style="width:100px" onkeyup="if(event.keyCode==13){job_save('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>');return false;}">
</div>
<button onclick="job_save('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>')" data-loading-text="保存" class="btn btn-success job-save">保存 </button>
<button class="btn btn-link todo-del" onclick="job_del('<?php echo $value['jobid'];?>','<?php echo $value['orgid'];?>')"> 删除 </button>
</div>
</div>
<?php } ?>
<div class="new-job pull-left" style="padding:0 10px;">
<a href="javascript:;" onclick="job_show_add_editor('<?php echo $orgid;?>',this)" class="btn btn-simple "> 添加职位 </a>
<div class="new-job-control hide" style="min-width:250px">
<div class="pull-left">
<input type="text" class="new-job-text form-control" style="width:100px" onkeyup="if(event.keyCode==13){job_add('<?php echo $orgid;?>');return false;}" placeholder="职位名称">
</div>
<button class="btn btn-success" data-loading-text="添加" onclick="job_add('<?php echo $orgid;?>')">添加 </button>
<button class="btn btn-link job-del" onclick="job_cancel_add_editor('<?php echo $orgid;?>')"> 取消 </button>
</div>

</div>
</dd>

</dl>

       

<dl>
<dt><?php if($org['forgid']<1) { ?>机构<?php } else { ?>部门<?php } ?>管理员</dt>
<dd class="clearfix">
<ul id="moderators_container_<?php echo $orgid;?>" class="moderators-container list-unstyled clearfix">
<?php if($pmoderator) { ?>
<li class="moderators-acceptor pull-left" orgid="<?php echo $orgid;?>" style="">
<div class="avatar-cover"></div>
<div class="user-item-avatar">
<div class="avatar-face">
<img src="avatar.php?uid=0&amp;size=middle">
</div>
</div>
</li>
<?php } if(is_array($moderators)) foreach($moderators as $value) { ?><li class="user-item pull-left" uid="<?php echo $value['uid'];?>">
<?php if($pmoderator) { ?>
<div class="delete" onclick="moderator_del('<?php echo $value['id'];?>','<?php echo $orgid;?>',this);"><i style="color:#d2322d;font-size:16px" class="glyphicon glyphicon-remove-sign">&nbsp;</i></div>
<?php } ?>
<div class="avatar-cover"></div>
<div class="user-item-avatar">
<div class="avatar-face"><?php echo avatar_block($value[uid]);?></div>
</div>
<p class="text-center" style="height:20px;margin:5px 0;line-height:25px;overflow:hidden;"> <?php echo $value['username'];?></p>
</li>
<?php } ?>

</ul>
</dd>

<dd class="clearfix">
<ul class="help-block " style="line-height:2">
<strong class="pull-left" style="margin-left:-45px;">注：</strong>
				<li>机构管理员权限：设置本机构下所有部门管理员，管理本机构中所有人员，管理本机构所有共享目录。</li>
				<li>部门管理员权限：设置本部门下所有子部门管理员，管理本部门中所有人员，管理本部门所有共享目录。</li>
</ul>
</dd>
</dl>

</div>


<script type="text/javascript">
jQuery(document).ready(function(e) {
jQuery('textarea').TextAreaExpander(33);
});
    function set_submit(form) {
        jQuery.post('<?php echo $_G['siteurl'];?>'+'admin.php?mod=orguser&op=ajax&do=orginfo',jQuery(form).serialize(), function (data) {
            if (data['success']) {
showmessage('更新资料成功,3秒后将为您跳转','success',3000,1);
setTimeout(location.reload(),30000);
            }else if(data['error']){
showmessage(data['error'],'danger',3000,1);
            }
        },'json');
        
        return false;
    }
jQuery(document).on('click','.moderators-acceptor',function(){
var ids=[];
jQuery('.moderators-container .user-item').each(function(){
ids.push(jQuery(this).attr('uid'));
});
showWindow('moderators','index.php?mod=system&op=selorguser&stype=2&multiple=1&callback=callback_moderators&token=<?php echo $orgid;?>&ids='+ids.join(','),'get',0)

});
    jQuery(document).on('click','.headinput-checkbox',function(){
        if(jQuery(this).prop("checked")){
            jQuery(this).closest('.head-portrait').siblings('.head-portrait').find('.headinput-checkbox').prop('checked',false).parents('.head-checkbox').removeClass('hover');
            jQuery(this).parents('.head-portrait').find('.head-checkbox').addClass('hover');
        }else{
            jQuery(this).parents('.head-portrait').find('.head-checkbox').removeClass('hover');
        }

    });
function upload_bgphoto(obj,fact) {
        'use strict';
        jQuery(obj).fileupload({
            url: 'admin.php?mod=orguser&op=ajax&do=upload',
            dataType: 'json',
            autoUpload: true,
            maxFileSize: 2000000,// 2 MB
            maxChunkSize: 2000000,//2M
            acceptFileTypes: new RegExp("\.([jpe?g|gif|png])$", 'i'),
            sequentialUploads: true,
            add: function (e, data) {
                data.context = jQuery('<div id="main"></div>');
                if (jQuery('#main div:first').length > 0) jQuery('#main div:first').before(data.context);
                else {
                    jQuery('#main').append(data.context);
                }
                data.process().done(function () {
                    data.submit();
                });
            },
            progress: function (e, data) {
                var index = 0; //data.index,
                var node = jQuery(data.context.children()[index]);
                var progress = parseInt(data.loaded / data.total * 100, 10);
                node.find('.progress-bar').css(
                        'width',
                        progress + '%'
                );
            },
            done: function (e, data) {

                jQuery.each(data.result.files, function (index, file) {
                    if (file.error) {
                        data.context.find('.progress').replaceWith('<span class="text-danger">' + file.error + '</span>');
                    } else {
                    	if(fact){
                    		var imgsexists = false;
                    		jQuery('.headinput-checkbox').each(function(){
                    			var oldaid = jQuery(this).val();
if(oldaid == file.data.aid){
jQuery(this).prop('checked',true);
imgsexists = true;
showmessage('该图片已经上传过了，只需勾选即可','success',3000,1);
return false;
}
})
if(!imgsexists){
/*jQuery.post('admin.php?mod=orguser&op=ajax&do=getdefaultpic',{aid:file.data.aid},function(data){
if(data['success']){
//jQuery('.head-checkbox').removeClass('hover').find('.headinput-checkbox').prop('checked',false);*/
var html ='<li class="head-portrait">'+'<img src="'+file.data.img+'"><div class="head-checkbox hover">'+
'<div class="checkbox-custom checkbox-primary"> <input type="checkbox" class="headinput-checkbox" name="arr[aid]" value="'+file.data.aid+'" checked="checked" onchange="set_org_logo(\'<?php echo $org['orgid'];?>\',this.value)" />'+
' </div> </div> ';
jQuery('.head-portrait').replaceWith(html);
set_org_logo('<?php echo $orgid;?>',file.data.aid);
/*	}
},'json')*/
}
                    	}else{
                    		data.context.data('aid', file.data.aid).find('img').attr('src', file.data.img).end().find('.progress-container').hide();
                            var html = '<div class="col-sm-7 setting-img"><img class="img-rounded" src="'+file.data.img+'"><p class="upload-click">点击上传</p> <input type="file" id="exampleInputFile" onclick="upload_bgphoto(this)" name="files[]"></div>';				
set_org_bgphoto('<?php echo $org['orgid'];?>',file.data.aid);
                            jQuery('.setting-img').replaceWith(html);

                    	}
                        
                    }
                });
            }
        })
    };
 
 
</script>