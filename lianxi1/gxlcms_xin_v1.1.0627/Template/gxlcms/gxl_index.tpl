<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<base target="_blank">
<title>{$sitename}</title>
<meta name="keywords" content="{$keywords}">
<meta name="description" content="{$description}">
<include file="gxlcms:include" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<include file="gxlcms:header" />
 



<php>$tv_new=gxl_sql_ting('field:ting_id,ting_cid,ting_name,ting_pic,ting_anchor,ting_title,ting_content,ting_gold,ting_addtime,ting_hits;limit:8;order:ting_hits desc');</php>
<div class="content-box fn-clear">
        <div class="box-model hot-layout">
            <div class="box-model-tit fn-clear">
                <h3>最近更新</h3>
            
                <div class="box-model-more"><a href="{:gxl_mytpl_url('my_new.html')}">更多<i class="iconfont">&#xe60b;</i></a></div>
            </div>
            <div class="hot-wrap zy-hover fn-clear" style="display: block">
                <ul class="fn-clear">
                <volist name="tv_new" id="gxlting" offset="0" length='1'> 
                    <li class="hot-list hot-box-400x300">
                            <a href="{$gxlting.ting_readurl}" title="{$gxlting.ting_name}" target="_blank" class="hot-bg-icon">
                                <img class="loading" src="{$apicss}v256/images/pic.png" data-original="{$gxlting.ting_picurl}"  alt="{$gxlting.ting_name}" />
                                <span class="hot-zy-span fn-clear">
                                    <em class="play-bg"><i class="iconfont">&#xe611;</i></em>
                                    <span>
                                        <em>{$gxlting.ting_name}</em>
                                        <em>{$gxlting.ting_content|msubstr=0,20,'...'}</em>
                                    </span>
                                </span>
                                <i class="hot-zy-bg"></i>
                            </a>
                            
                        </li>  
                        </volist>  
                        <volist name="tv_new" id="gxlting" offset="1" length='4'>                     
                             
                             <li class="hot-list hot-box-190x300">
                            <a href="{$gxlting.ting_readurl}" target="_blank" title="{$gxlting.ting_name}" class="first">
                                <span class="box-img">
                                    <img class="loading" src="{$apicss}v256/images/pic.png" data-original="{$gxlting.ting_picurl}"  alt="{$gxlting.ting_name}"/>
                                    <i class="box-img-h-bg"></i>
                                    <i class="box-img-play"></i>
                                </span>
                                <span class="box-tc">
                                    <em class="box-tc-t">{$gxlting.ting_name}</em>
                                    <em class="box-tc-c">{$gxlting.ting_actor|msubstr=0,15,'...'}</em>
                                </span>
                            </a>
                        </li>                 
                        </volist>
                        
                </ul>
            </div>
            
        </div>
        
    </div>
	
	
<php>$array_listidd = getlistall(2);</php>
<volist name="array_listidd" id="gxl_listid" key="k" offset="0" length='7'>  
<div class="content-box fn-clear">
    <div class="box-model hot-layout">
        <div class="box-model-tit fn-clear">
            <h3>{$gxl_listid.list_name}</h3>
            <div class="box-model-more"><a href="{$gxl_listid.list_url}">更多<i class="iconfont">&#xe60b;</i></a></div>
        </div>
        <div id="J-neidi-con" class="film-model-layout">
            <div class="box-model-cont fn-clear" style="display: block">
            <php>$mov_list = gxl_sql_ting('cid:'.$gxl_listid['list_id'].';field:ting_id,ting_cid,ting_name,ting_pic,ting_title,ting_gold;limit:6;order:ting_addtime desc');</php>  
             <fflist name="mov_list" id="ppting">
                <a href="{$ppting.ting_readurl}" title="{$ppting.ting_name}" <in name="i" value="1">class="first"</in>target="_blank">
                        <span class="box-img">
                            <img class="loading" src="{$apicss}v256/images/pic.png" data-original="{$ppting.ting_picurl}"  alt="{$ppting.ting_name}" />
                            <i class="box-img-h-bg"></i>
                            <i class="box-img-play"></i>
                        </span>
                        <span class="box-tc">
                            <em class="box-tc-t">{$ppting.ting_name}</em>
                            <em class="box-tc-c">{$ppting.ting_actor}</em>
                            <em class="box-tc-f">{$ppting.ting_gold}</em>
                        </span>
                    </a>
               </fflist>                          
            </div>
        
        </div>
    </div>
</div>
 </volist> 
<div class="content-box fn-clear">
  <div class="box-model hot-layout">
    <div class="box-model-tit fn-clear">
      <h3>合作伙伴</h3>
      <div class="box-model-nav" id="J-hz-nav"> <a  class="on">媒体合作</a> <a >友情链接</a> </div>
    </div>
    <div class="friend-link" id="J-hz-con">
      <div class="fl-model fl-friend fn-clear" style="display: block">
	  
	  
	   <volist name="list_link" id="ppting">  <eq name="ppting.link_type" value="2"><span><a href="{$ppting.link_url}" target="_blank"><img src="{$ppting.link_logo}" alt="{$ppting.link_name}友情链接"></a></span></eq></volist>
	  
	  </div>
      <div class="fl-model fl-link fn-clear" >
        <volist name="list_link" id="ppting">  <eq name="ppting.link_type" value="1"><span><a href="{$ppting.link_url}" target="_blank">{$ppting.link_name}</a></span></eq></volist>
      </div>
    </div>
  </div>
</div>
<include file="gxlcms:footer" />
<script>v256.index.init();v256.film.init();</script>
</body>
</html>