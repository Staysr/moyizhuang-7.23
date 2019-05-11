<?php include('../system/inc.php');
function cctv(){    
    $tv = array(
        3641 => array ( 'name' => 'CCTV1-综合高清', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv1hd.m3u8',), 
        3643 => array ( 'name' => 'CCTV2-财经', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv2hd.m3u8', ), 
        3644 => array ( 'name' => 'CCTV3-综艺高清', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv3hd.m3u8', ), 
        3646 => array ( 'name' => 'CCTV4-中文国际', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv4hd.m3u8', ), 
        3647 => array ( 'name' => 'CCTV5高清', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv5hd.m3u8', ), 
        3648 => array ( 'name' => 'CCTV-5+体育赛事高清', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv5phd.m3u8', ),
        3650 => array ( 'name' => 'CCTV6-电影高清', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv6hd.m3u8', ),         
        3653 => array ( 'name' => 'CCTV-7军事与农业', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv7hd.m3u8', ), 
        3654 => array ( 'name' => 'CCTV-8电视剧高清', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv8hd.m3u8', ),
        3657 => array ( 'name' => 'CCTV-9记录国际', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv9hd.m3u8', ), 
        3658 => array ( 'name' => 'CCTV-10科教', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv10hd.m3u8', ),
        3661 => array ( 'name' => 'CCTV-11戏曲', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv11hd.m3u8', ), 
        3662 => array ( 'name' => 'CCTV-12社会与法', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv12hd.m3u8', ),
        3664 => array ( 'name' => 'CCTV-13新闻', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv13hd.m3u8', ), 
        3666 => array ( 'name' => 'CCTV-14少儿', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv14hd.m3u8', ),
        3668 => array ( 'name' => 'CCTV-15音乐', 'playurl' => 'http://ivi.bupt.edu.cn/hls/cctv15hd.m3u8', ),     
    );
    return $tv;
}
function cntv(){    
    $tv = array(
        3570 => array ( 'name' => 'CNTV动作电影', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225529/index.m3u8', ), 
        3571 => array ( 'name' => 'CNTV爱情喜剧', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225525/index.m3u8', ), 
        3572 => array ( 'name' => 'CNTV古装剧场', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225527/index.m3u8', ), 
        3573 => array ( 'name' => 'CNTV军旅剧场', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225531/index.m3u8', ), 
        3574 => array ( 'name' => 'CNTV军事评论', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225533/index.m3u8', ), 
        3575 => array ( 'name' => 'CNTV明星大片', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225535/index.m3u8', ), 
        3576 => array ( 'name' => 'CNTV农业致富', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225537/index.m3u8', ), 
        3577 => array ( 'name' => 'CNTV完美游戏', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225539/index.m3u8', ), 
        3578 => array ( 'name' => 'CNTV经典影院', 'playurl' => 'http://183.207.249.8/PLTV/3/224/3221225541/index.m3u8', ), 
        3579 => array ( 'name' => 'CNTV精品大剧', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225591/index.m3u8', ), 
        3580 => array ( 'name' => 'CNTV精品体育', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225543/index.m3u8', ), 
        3581 => array ( 'name' => 'CNTV健康有约', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225545/index.m3u8', ), 
        3582 => array ( 'name' => 'CNTV海外剧场', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225547/index.m3u8', ), 
        3583 => array ( 'name' => 'CNTV家庭剧场', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225549/index.m3u8', ), 
        3584 => array ( 'name' => 'CNTV动画王国', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225555/index.m3u8', ), 
        3585 => array ( 'name' => 'CNTV精品记录', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225557/index.m3u8', ), 
        3586 => array ( 'name' => 'CNTV金牌综艺', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225559/index.m3u8', ), 
        3587 => array ( 'name' => 'CNTV惊悚悬疑', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225561/index.m3u8', ), 
        3588 => array ( 'name' => 'CNTV精品电影', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225567/index.m3u8', ), 
    );
    return $tv;
}
function wstv(){    
    $tv = array(    
        3636 => array ( 'name' => '北京卫视高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221226257/index.m3u8', ),
        // 3690 => array ( 'name' => 'BTV新闻', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225577/index.m3u8', ),             
        3632 => array ( 'name' => '湖南卫视高清', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225521/index.m3u8', ), 
        3633 => array ( 'name' => '广东卫视高清', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225592/index.m3u8', ), 
        3634 => array ( 'name' => '山东卫视高清', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225596/index.m3u8', ), 
        3635 => array ( 'name' => '黑龙江卫视高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225652/index.m3u8', ),      
        3637 => array ( 'name' => '天津卫视高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221226265/index.m3u8', ),        
        3639 => array ( 'name' => '浙江卫视-高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225544/index.m3u8', ),        
        3590 => array ( 'name' => '东方卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225558/index.m3u8', ),        
        3592 => array ( 'name' => '浙江卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225544/index.m3u8', ), 
        3593 => array ( 'name' => '山西卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225576/index.m3u8', ), 
        3594 => array ( 'name' => '广东卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225578/index.m3u8', ), 
        3595 => array ( 'name' => '广西卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225554/index.m3u8', ), 
        3596 => array ( 'name' => '西藏卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225579/index.m3u8', ), 
        3597 => array ( 'name' => '青海卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225580/index.m3u8', ), 
        3598 => array ( 'name' => '深圳卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225582/index.m3u8', ), 
        3599 => array ( 'name' => '四川卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225570/index.m3u8', ), 
        3600 => array ( 'name' => '旅游卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225585/index.m3u8', ), 
        3601 => array ( 'name' => '山东卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225586/index.m3u8', ), 
        3602 => array ( 'name' => '吉林卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225589/index.m3u8', ), 
        3603 => array ( 'name' => '甘肃卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225590/index.m3u8', ), 
        3604 => array ( 'name' => '贵州卫视', 'playurl' => 'http://183.207.249.8/PLTV/3/224/3221225540/index.m3u8', ), 
        3605 => array ( 'name' => '云南卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225569/index.m3u8', ), 
        3606 => array ( 'name' => '东南卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225598/index.m3u8', ), 
        3607 => array ( 'name' => '河北卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225602/index.m3u8', ), 
        3608 => array ( 'name' => '重庆卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225594/index.m3u8', ), 
        3609 => array ( 'name' => '天津卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225562/index.m3u8', ),        
        3611 => array ( 'name' => '辽宁卫视', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225566/index.m3u8', ),       
        3613 => array ( 'name' => '新疆卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225523/index.m3u8', ), 
        3614 => array ( 'name' => '贵州卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225540/index.m3u8', ), 
        3615 => array ( 'name' => '东方卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225558/index.m3u8', ), 
        3616 => array ( 'name' => '四川卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225570/index.m3u8', ), 
        3617 => array ( 'name' => '内蒙古卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225624/index.m3u8', ), 
        3618 => array ( 'name' => '安徽卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225634/index.m3u8', ), 
        3619 => array ( 'name' => '江苏卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225650/index.m3u8', ),       
        3622 => array ( 'name' => '旅游卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225585/index.m3u8', ), 
        3623 => array ( 'name' => '东南卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225598/index.m3u8', ), 
        3624 => array ( 'name' => '江西卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225537/index.m3u8', ), 
        3625 => array ( 'name' => '广西卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225554/index.m3u8', ), 
        3626 => array ( 'name' => '山西卫视', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225576/index.m3u8', ), 
        3627 => array ( 'name' => '金鹰卡通', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225620/index.m3u8', ), 
        3628 => array ( 'name' => '优漫卡通', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225600/index.m3u8', ), 
        3629 => array ( 'name' => '第一财经', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225573/index.m3u8', ),      
        3630 => array ( 'name' => '徐州-1高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225945/index.m3u8', ), 
        3631 => array ( 'name' => '徐州-4高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225951/index.m3u8', ), 
    );
    return $tv;
}
function qttv(){    
    $tv = array(
        3673 => array ( 'name' => '动作电影高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225529/index.m3u8', ), 
        3674 => array ( 'name' => '金牌综艺高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225559/index.m3u8', ), 
        3675 => array ( 'name' => '惊悚悬疑高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225561/index.m3u8', ), 
        3676 => array ( 'name' => '军旅剧场', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225531/index.m3u8', ), 
        3677 => array ( 'name' => '农业致富', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225537/index.m3u8', ), 
        3678 => array ( 'name' => '精品体育', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225543/index.m3u8', ), 
        3679 => array ( 'name' => '海外剧场', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225547/index.m3u8', ), 
        3680 => array ( 'name' => '古装剧场', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225527/index.m3u8', ), 
        3681 => array ( 'name' => '动画王国', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225555/index.m3u8', ), 
        3682 => array ( 'name' => '完美游戏', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225539/index.m3u8', ), 
        3683 => array ( 'name' => '军事评论', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225533/index.m3u8', ), 
        3684 => array ( 'name' => '明星大片-高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225535/index.m3u8', ), 
        3685 => array ( 'name' => '电影-高清', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225541/index.m3u8', ), 
        3686 => array ( 'name' => '健康有约', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225545/index.m3u8', ), 
        3687 => array ( 'name' => '家庭剧场', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225549/index.m3u8', ), 
        3688 => array ( 'name' => '精品纪录', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225557/index.m3u8', ), 
        3689 => array ( 'name' => '精品电影', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225567/index.m3u8', ), 
        3691 => array ( 'name' => 'GOOD2', 'playurl' => 'http://210.59.248.53/hls-live/livepkgr/_definst_/liveevent/live-ch2-3.m3u8', ),
        3692 => array ( 'name' => '韩TVN', 'playurl' => 'http://121.156.62.136:1935/chc09/s5.stream/playlist.m3u8', ),
        3693 => array ( 'name' => '韩-PLAYY', 'playurl' => 'http://123.108.164.71/etv2sb/phd770/lihattv.m3u8', ),
        3694 => array ( 'name' => '韩KoreaTV', 'playurl' => 'http://111.118.21.79/etv1/phd393/playlist.m3u8', ),
        3695 => array ( 'name' => '韩-KNN', 'playurl' => 'http://211.220.195.200:1935/live/mp4:KnnTv.stream/playlist.m3u8', ),
        3696 => array ( 'name' => '韩-KCTVN', 'playurl' => 'http://122.202.129.136:1935/live/ch4/playlist.m3u8', ),
        3697 => array ( 'name' => '韩INET高清', 'playurl' => 'http://123.108.164.71/etv2sb/pld263/lihattv.m3u8', ),
        3698 => array ( 'name' => '韩GOODTV', 'playurl' => 'http://123.108.164.71/etv2sb/phd29/playlist.m3u8', ),
		3710 => array ( 'name' => 'CCTV1-綜合HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225680/index.m3u8', ),
3711 => array ( 'name' => 'CCTV1-綜合HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225680/index.m3u8', ),
3712 => array ( 'name' => 'CCTV3-綜藝HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225588/index.m3u8', ),
3713 => array ( 'name' => 'CCTV4-中文國際HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225534/index.m3u8', ),
3714 => array ( 'name' => 'CCTV5+-HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225604/index.m3u8', ),
3715 => array ( 'name' => 'CCTV6-電影HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225548/index.m3u8', ),
3716 => array ( 'name' => 'CCTV-7軍事與農業HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225546/index.m3u8', ),
3717 => array ( 'name' => 'CCTV-9記錄國際', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225572/index.m3u8', ),
3718 => array ( 'name' => 'CCTV10-科教', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225550/index.m3u8', ),
3719 => array ( 'name' => 'CCTV11-戲曲', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225552/index.m3u8', ),
3720 => array ( 'name' => 'CCTV12-社會與法', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225556/index.m3u8', ),
3721 => array ( 'name' => 'CCTV13-新聞', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225560/index.m3u8', ),
3722 => array ( 'name' => 'CCTV-15音樂', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225568/index.m3u8', ),
3723 => array ( 'name' => '明星大片HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225535/index.m3u8', ),
3724 => array ( 'name' => '動作電影HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225529/index.m3u8', ),
3725 => array ( 'name' => '軍旅劇場', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225531/index.m3u8', ),
3726 => array ( 'name' => '軍事評論', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225533/index.m3u8', ),
3727 => array ( 'name' => '海外劇場', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225547/index.m3u8', ),
3728 => array ( 'name' => '古裝劇場', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225527/index.m3u8', ),
3729 => array ( 'name' => '動畫有FUN', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225555/index.m3u8', ),
3730 => array ( 'name' => '金鷹卡通', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225620/index.m3u8', ),
3731 => array ( 'name' => '完美遊戲', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225539/index.m3u8', ),
3732 => array ( 'name' => '愛情喜劇', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225525/index.m3u8', ),
3733 => array ( 'name' => '健康有約', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225545/index.m3u8', ),
3734 => array ( 'name' => '家庭劇場', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225549/index.m3u8', ),
3735 => array ( 'name' => '金牌綜藝', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225559/index.m3u8', ),
3736 => array ( 'name' => '驚悚懸疑', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225561/index.m3u8', ),
3737 => array ( 'name' => '精品大劇', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225569/index.m3u8', ),
3738 => array ( 'name' => '精品電影', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225567/index.m3u8', ),
3739 => array ( 'name' => '精品紀錄', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225557/index.m3u8', ),
3740 => array ( 'name' => '精品體育', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225543/index.m3u8', ),
3741 => array ( 'name' => '農業致富', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225537/index.m3u8', ),
3742 => array ( 'name' => '徐州-1HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225945/index.m3u8', ),
3743 => array ( 'name' => '徐州-4HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225951/index.m3u8', ),
3744 => array ( 'name' => '北京衛視HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221226257/index.m3u8', ),
3745 => array ( 'name' => '天津衛視HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221226265/index.m3u8', ),
3746 => array ( 'name' => '浙江衛視HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225544/index.m3u8', ),
3747 => array ( 'name' => '湖南衛視HD', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225521/index.m3u8', ),
3748 => array ( 'name' => '廣東衛視HD', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225592/index.m3u8', ),
3749 => array ( 'name' => '黑龍江衛視HD', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225652/index.m3u8', ),
3750 => array ( 'name' => '北京衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225574/index.m3u8', ),
3751 => array ( 'name' => '東方衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225558/index.m3u8', ),
3752 => array ( 'name' => '安徽衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225634/index.m3u8', ),
3753 => array ( 'name' => '天津衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225562/index.m3u8', ),
3754 => array ( 'name' => '山西衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225576/index.m3u8', ),
3755 => array ( 'name' => '廣東衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225578/index.m3u8', ),
3756 => array ( 'name' => '廣西衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225554/index.m3u8', ),
3757 => array ( 'name' => '西藏衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225579/index.m3u8', ),
3758 => array ( 'name' => '青海衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225580/index.m3u8', ),
3759 => array ( 'name' => '深圳衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225582/index.m3u8', ),
3760 => array ( 'name' => '旅遊衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225585/index.m3u8', ),
3761 => array ( 'name' => '山東衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225586/index.m3u8', ),
3762 => array ( 'name' => '吉林衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225589/index.m3u8', ),
3763 => array ( 'name' => '甘肅衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225590/index.m3u8', ),
3764 => array ( 'name' => '雲南衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225591/index.m3u8', ),
3765 => array ( 'name' => '重慶衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225594/index.m3u8', ),
3766 => array ( 'name' => '東南衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225598/index.m3u8', ),
3767 => array ( 'name' => '河北衛視', 'playurl' => 'http://183.207.249.7/PLTV/3/224/3221225602/index.m3u8', ),
3768 => array ( 'name' => '新疆衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225523/index.m3u8', ),
3769 => array ( 'name' => '貴州衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225540/index.m3u8', ),
3770 => array ( 'name' => '江西衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225537/index.m3u8', ),
3771 => array ( 'name' => '遼寧衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225566/index.m3u8', ),
3772 => array ( 'name' => '四川衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225570/index.m3u8', ),
3773 => array ( 'name' => '內蒙古衛視', 'playurl' => 'http://183.207.249.15/PLTV/3/224/3221225624/index.m3u8', ), 
    );
    return $tv;
}
$cctv = cctv();
$cntv = cntv();
$wstv = wstv();
$qttv = qttv();  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';
$zy='class="active"'?>
<title>电视频道</title>
<script>
  $(function(){
    TagNav('#tagnav',{
        type: 'scrollToFirst',
    });
    $('.weui_tab').tab({
    defaultIndex: 0,
    activeClass:'weui_bar_item_on',
    onToggle:function(index){
    if(index>0){
    alert(index)
    }
    }
});
});     
</script>
<style type="text/css">
  .leimu_zui{width: auto}
  .weui-navigator-list li{font-weight: 500}
  .weui-navigator-list li.weui-state-hover, .weui-navigator-list li.weui-state-active a:after{background-color: none}
</style>
</head>
<body>
<?php include 'header.php'; ?>
<?php echo get_ad(16)?>
<?php if($_GET["url"]!=""){?>
<iframe allowFullscreen="true" src="http://jiexi.thecook.com.cn/vip/m3u8.php?url=<?php echo $_GET["url"]?>"  width="100%" height="200px" allowTransparency="true" frameborder="0" scrolling="no"></iframe>
<?php }?>  
<div class="page-bd">  
<ul>
<li >  
<div class="weui-flex js-category">
    <p class="weui-flex-item">CCTV</p>
    <i class="icon icon-74"></i>
</div>
<div class="page-category js-categoryInner">    
<div class="weui_cells weui_cells_access" style="margin-top: 0px;">
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv1hd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV1-综合</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv2hd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV2-财经</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv3hd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV3-综艺</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv4hd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV4-中文国际</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv5hd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV5高清</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv5phd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-5+体育赛事</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv6.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV6-电影高清</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv7.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-7军事与农业</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv8.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-8电视剧高清</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv9.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-9记录国际</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv10.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-10科教</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv11.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-11戏曲</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv12.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-12社会与法</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv13.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-13新闻</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv14.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-14少儿</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cctv15.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>CCTV-15音乐</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
    
</div>
</div>
</li>  
<li >
<div class="weui-flex js-category">
    <p class="weui-flex-item">卫视频道</p>
    <i class="icon icon-74"></i>
</div>
<div class="page-category js-categoryInner">    
<div class="weui_cells weui_cells_access" style="margin-top: 0px;">
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv1hd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv2.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京文艺</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
  <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv3.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京科教</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
  <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv4.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京影视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
   <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv5.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京财经</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
   <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv6.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京体育</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
   <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv7.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京生活</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
   <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv8.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京青年</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
   <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv9.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京新闻</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
   <a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/btv10.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>北京卡酷少儿</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/hunanhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>湖南卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/gdhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>广东卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/ahhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>安徽卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/sdhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>山东卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/hljtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>黑龙江卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/tjhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>天津卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/zjhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>浙江卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/dfhd.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>东方卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/gxtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>山西卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/hbtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>湖北卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/dntv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>福建东南卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/sztv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>深圳卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/sctv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>四川卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/jltv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>吉林卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/gstv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>甘肃卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/gztv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>贵州卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/yntv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>云南卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/hebtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>河北卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/cqtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>重庆卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/hntv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>河南卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/sxtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>陕西卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/lntv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>辽宁卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/xztv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>新疆卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/nmtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>内蒙古卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/jstv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>江苏卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/lytv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>旅游卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/jxtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>江西卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/gxtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>广西卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/nxtv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>宁夏卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>  
<a class="weui_cell " href="zhibo.php?url=http://ivi.bupt.edu.cn/hls/xztv.m3u8">
    <div class="weui_cell_bd weui_cell_primary">
        <p>西藏卫视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>
    
</div>
</div>
</li> 
<li >
<div class="weui-flex js-category">
    <p class="weui-flex-item">CNTV</p>
    <i class="icon icon-74"></i>
</div>
<div class="page-category js-categoryInner">    
<div class="weui_cells weui_cells_access" style="margin-top: 0px;">
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F183.207.249.12%2FPLTV%2F3%2F224%2F3221225525%2Findex.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>喜剧电影</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F183.207.249.14%2FPLTV%2F3%2F224%2F3221225549%2Findex.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>家庭剧场</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2Fhbmc.chinashadt.com%3A2739%2Flive%2Fdzdy.stream_360p%2Fchunklist_w453299418.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>动作电影</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2Fhbmc.chinashadt.com%3A2739%2Flive%2Fdzdy.stream_360p%2Fchunklist_w1196540526.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>经典剧场</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F183.207.249.14%2FPLTV%2F3%2F224%2F3221225567%2Findex.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>热播电视</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F183.207.249.14%2FPLTV%2F3%2F224%2F3221225569%2Findex.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>都市剧场</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F183.207.249.15%2FPLTV%2F3%2F224%2F3221225531%2Findex.m3u8&channel=cntv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>经典大片</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
    
</div>
</div>
</li>
<li >
<div class="weui-flex js-category">
    <p class="weui-flex-item">体育频道</p>
    <i class="icon icon-74"></i>
</div>
<div class="page-category js-categoryInner">    
<div class="weui_cells weui_cells_access" style="margin-top: 0px;">
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F183.207.249.16%2FPLTV%2F3%2F224%2F3221225543%2Findex.m3u8&channel=qttv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>精品体育</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2Flive3.tdm.com.mo%3A1935%2Fch4%2Fsport_ch4.live%2Fplaylist.m3u8&channel=qttv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>澳视体育</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2Faudio.live.cntv.dnion.com%2Fcache%2F259_%2Fseg0%2Findex.m3u8&channel=qttv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>cctv5</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
<a class="weui_cell " href="zhibo.php?url=http%3A%2F%2F223.110.243.170%2FPLTV%2F2510088%2F224%2F3221227344%2F1.m3u8&channel=qttv">
    <div class="weui_cell_bd weui_cell_primary">
        <p>风云足球</p>
    </div>
    <div class="weui_cell_ft"></div>
</a>   
    
</div>
</div>
</li>           
</ul>
</div> 
 
 <script>
$(function(){
    $('.js-category').click(function(){
    $parent = $(this).parent('li');
    if($parent.hasClass('js-show')){
            $parent.removeClass('js-show');
            $(this).children('i').removeClass('icon-35').addClass('icon-74');
        }else{
            $parent.siblings().removeClass('js-show');
            $parent.addClass('js-show');
            $(this).children('i').removeClass('icon-74').addClass('icon-35');
            $parent.siblings().find('i').removeClass('icon-35').addClass('icon-74');
        }
    });
});
</script>

<!-- 轮播 效果 JS文件   -->

<?php  include 'footer.php';?>