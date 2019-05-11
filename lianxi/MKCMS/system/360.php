<?php
$arr=explode('pageno',$flid1);
$yourneed=$arr[0];
$yema=$yourneed;
$arr=explode('pageno',$yema);
$yemama=$arr[0];
$mama='&pageno=';
$wangzhi="http://www.360kan.com"; 
$flid2=''.$wangzhi.$yemama.$mama.$page.'';
//$rurl=file_get_contents($flid2); 
mkdir('./data');
mkdir('./data/runtime');
$gxpd=time()-filemtime('./data/runtime/'.md5($flid2));
if($gxpd>2*60*60){
$fcon=curl_file_get_contents($flid2);
file_put_contents('./data/runtime/'.md5($flid2),gzdeflate($fcon));
}	
$fcon=gzinflate(file_get_contents('./data/runtime/'.md5($flid2)));
$rurl=$fcon;

$vname='#<span class="s1">(.*?)</span>#';
$fname='#<span class="s2">(.*?)</span>#';
$vlist='#<a class="js-tongjic" href="(.*?)">#';
$vstar='# <p class="star">(.*?)</p>#';
$vvlist='#<div class="s-tab-main">[\s\S]+?<div monitor-desc#';
$vimg='#<img src="(.*?)">#'; 
$bflist='#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play"></a>#';
$jishu='#<span class="hint">(.*?)</span> #'; 
$fufei='#<span class="pay">(.*?)</span>#'; 
$yuming='http://www.360kan.com'; 
preg_match_all($vname, $rurl,$xarr); 
preg_match_all($fname, $rurl,$xarrf); 
preg_match_all($vlist, $rurl,$xarr1); 
preg_match_all($vstar, $rurl,$xarr2); 
preg_match_all($vvlist, $rurl,$imglist);
$zcf=implode($glue, $imglist[0]);
preg_match_all($vimg, $zcf,$xarr3); 
preg_match_all($bflist, $rurl,$xarr4); 
preg_match_all($jishu, $rurl,$xarr5); 
preg_match_all($fufei, $rurl,$xarrff); 

$xname=$xarr[1];$lname=$xarrf[1];
$xlist=$xarr1[1];$xstar=$xarr2[1];
$ximg=$xarr3[1];$xbflist=$xarr4[1];
$xjishu=$xarr5[1];
$xfufei=$xarrff[1]; 
?>