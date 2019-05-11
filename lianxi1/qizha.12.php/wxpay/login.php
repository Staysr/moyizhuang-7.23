<?php
require '../conn/conn2.php';
require '../conn/function.php';

if ($_SESSION["from"] == "") {
    $from = "../member/index.php";
} else {
    $from = $_SESSION["from"];
}
$genkey = $_GET["genkey"];
$Code = $_GET["code"];
if ($Code == "") {

    Header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $C_wx_appid . "&redirect_uri=" . URLEncode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"] . "?genkey=" . $genkey) . "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
} else {
    $C_config = getbody("https://api.weixin.qq.com/sns/oauth2/access_token", "appid=" . $C_wx_appid . "&secret=" . $C_wx_appsecret . "&code=" . $_GET["code"] . "&grant_type=authorization_code");

    $openid = json_decode($C_config)->openid;
    $access_token = json_decode($C_config)->access_token;
}
$C_config = getbody("https://api.weixin.qq.com/sns/userinfo", "access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN");
$nickname = json_decode($C_config)->nickname;
$headimgurl = json_decode($C_config)->headimgurl;
$country = json_decode($C_config)->country;
$province = json_decode($C_config)->province;
$city = json_decode($C_config)->city;
if ($nickname == "") {
    box("授权失败，请重新登录！", "../member/member_login.php", "error");
} else {
    $sql = "select * from SL_member where M_qqid='" . $openid . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $M_login = $row["M_login"];
        $M_id = $row["M_id"];
        $_SESSION["M_login"] = $M_login;
        $_SESSION["M_id"] = $M_id;
        $_SESSION["M_pwd"] = $openid;
        mysqli_query($conn, "update SL_member set M_genkey='" . $genkey . "' where M_qqid='" . $openid . "'");
        box("欢迎回来！" . $M_login . "", URLdecode($from) , "success");
    } else {
        $sql = "insert into SL_member(M_login,M_pwd,M_email,M_fen,M_pic,M_regtime,M_qqid,M_genkey,M_add) values('". $nickname . "','" . $openid . "','@qq.com',0,'" . $headimgurl . "','" . date('Y-m-d H:i:s') . "','" . $openid . "','" . $genkey . "','" . $country . $province . $city . "')";
        mysqli_query($conn, $sql);
        $_SESSION["M_login"] = $nickname;
        $_SESSION["M_pwd"] = $openid;
        $sql = "select * from SL_Member order by M_id desc limit 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["M_id"] = $row["M_id"];
            uplevel($row["M_id"]);
        }
        if ($_COOKIE["uid"] != "") {
            mysqli_query($conn, "update SL_member set M_fen=M_fen+" . $C_Invitation . " where M_id=" . $_COOKIE["uid"]);
            mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type) values('邀请好友'," . $_COOKIE["uid"] . "," . $C_Invitation . ",'" . date('Y-m-d H:i:s') . "',1)");
        }
        box("登录成功！" . $nickname . "", URLdecode($from) , "success");
    }
}
?>